<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 29/07/2019
 * Time: 09:32
 */

namespace App\Controller\restricted;


use App\Abstracts\AbstractController;
use App\Entity\Perfil;
use App\Entity\Usuario;
use App\Helper\CryptUtil;
use App\Helper\Datatables\DataTables;
use App\Resource\PerfilDao;
use App\Resource\UsuarioDao;
use App\Transients\DataTables\DtUsuario;


use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class UsuarioController extends AbstractController
{


    private $perfilDao;

    public function __construct($container)
    {
        parent::__construct($container,new UsuarioDao($container->get('em')));
        $this->perfilDao = new PerfilDao($container->get('em'));
    }

    public function getList($request, $response, $args){


        $list = $this->dao->listAll();

        $data = ['usuarioList' => $list];

        return $this->container->view->render($response,'usuario.list.twig',$data);
    }



    public function getCreate($request,$response,$args){

        $perfilList = $this->perfilDao->listAll();
        $data['perfilList'] = $perfilList;

        return $this->container->view->render($response,'usuario.create.twig',$data);
    }

    public function getEdit($request,$response,$args){

        $route = $request->getAttribute('route');
        $data['id'] = $route->getArgument('id');

        $perfilList = $this->perfilDao->listAll();
        $data['perfilList'] = $perfilList;

        return $this->container->view->render($response,'usuario.edit.twig',$data);
    }

    public function postCreate($request,$response,$args){

        try{

            $cryptUtil = new CryptUtil(getenv("APP_KEY"));

            $usuario = new Usuario();
            $usuario->setNome($request->getParam('usuario_nome'));
            $usuario->setEmail($request->getParam('usuario_email'));
            $usuario->setAtivo((boolean)$request->getParam('usuario_ativo'));
            $usuario->setLogin($request->getParam('usuario_login'));
            $usuario->setSenha($cryptUtil->encrypt($request->getParam('usuario_senha')));

            //TODO: Realmente necessário popular o objeto desta maneira?
            $perfil = $this->perfilDao->findById((integer)$request->getParam('usuario_perfil_id'),false);
            $usuario->setPerfil($perfil);

            $this->dao->createEntity($usuario);

            $this->container['flash']->addMessage('info', 'Usuário adicionado com sucesso.');
            return $response->withRedirect($this->container->router->pathFor('usuario.list'));

        }catch(\Exception $e){
            $this->container['flash']->addMessage('error', $e->getMessage());
            return $response->withRedirect($this->container->router->pathFor('usuario.create'));
        }

    }

    public function postPwdChange($request,$response,$args){
        try{

            $cryptUtil = new CryptUtil(getenv("APP_KEY"));

            $usrId = $request->getParam('usuario_id');
            $currPwd = $request->getParam('curr_pwd');
            $newPwd = $request->getParam('new_pdw');

            $currPwd = $cryptUtil->encrypt($currPwd);
            $newPwd = $cryptUtil->encrypt($newPwd);

            $this->dao->changePassword($usrId,$currPwd,$newPwd);

            $this->container['flash']->addMessage('info', 'Senha alterada. Reinicie a sessão para que as alterações tenham efeito.');
        }catch(\Exception $e){
            $this->container['flash']->addMessage('error', $e->getMessage());
        }
        return $response->withRedirect($this->container->router->pathFor('painel.index'));
    }


    public function postDtJson(ServerRequestInterface $request, ResponseInterface $response){
        try{


            $pb = $request->getParsedBody();

            $draw = $pb['draw'];
            $start = $pb['start'];
            $length = $pb['length'];
            $orderColumn = $pb['order'][0]['column'];
            $orderDirection = $pb['order'][0]['dir'];
            $search = $pb['search']['value'];


            //(DtUsuario $dtUsuario,$search,$start,$length,$orderColumn,$orderDirection)
            $datatables = $this->dao->listDtJson($search,$start,$length,$orderColumn,$orderDirection);
            $datatables->setDraw($draw);
            //return $response->withJson($datatables);
            return $response->withJson($datatables->__toArray());

        }catch (Exception $e){
            return $response->withJson($e,$e->getCode());
        }

        /*
         * try {
            Long associacaoId = 0L;
            if(userSession.getUsuario().isAssociacao()){
                associacaoId = userSession.getUsuario().getAssociacao().getId();
            }
            DataTables<DtUsuario> dataTables = usuarioDao.listJson(dtUsuario, associacaoId,start, length, orderColumn, orderDirection);
            dataTables.setDraw(draw);
            result.use(Results.json()).withoutRoot().from(dataTables).include("data").serialize();
        } catch (Exception e) {
            JsonUtils.setErrorJsonResult(result, e);
        }
         */
    }




}