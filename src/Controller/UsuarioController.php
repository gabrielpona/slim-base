<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 29/07/2019
 * Time: 09:32
 */

namespace App\Controller;


use App\Abstracts\AbstractController;
use App\Dao\UnidadeDao;
use App\Entity\Usuario;
use App\Helper\CryptUtil;
use App\Dao\PerfilDao;
use App\Dao\UsuarioDao;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class UsuarioController extends AbstractController
{

    private $usuarioDao;
    private $perfilDao;
    private $unidadeDao;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->usuarioDao = new UsuarioDao($container->get('em'));
        $this->perfilDao = new PerfilDao($container->get('em'));
        $this->unidadeDao = new UnidadeDao(($container->get('em')));
    }

    public function getList($request, $response, $args){

        return $this->container->view->render($response,'pages/usuario/list.twig',array());
    }


    public function getCreate($request,$response,$args){

        $perfilList = $this->perfilDao->listAll();
        $unidadeList = $this->unidadeDao->listAll();
        $data['perfilList'] = $perfilList;
        $data['unidadeList'] = $unidadeList;
        return $this->container->view->render($response,'pages/usuario/create.twig',$data);
    }

    public function getEdit($request,$response,$args){

        $route = $request->getAttribute('route');
        $id = $route->getArgument('id');
        $usuario = null;

        try{

            if(isset($args['usuario'])){
                $usuario = $args['usuario'];

            }else{
                if($id ==null || !is_numeric($id)|| $id<=0 ) {
                    throw new \Exception("Usuário inválido.");

                }else{
                    $usuario = $this->usuarioDao->findById($id);
                }
            }

            if($usuario==null)
                throw new \Exception("Usuário não encontrado.");

            $data['usuario'] = $usuario;

            $perfilList = $this->perfilDao->listAll();
            $unidadeList = $this->unidadeDao->listAll();
            $data['perfilList'] = $perfilList;
            $data['unidadeList'] = $unidadeList;

            return $this->container->view->render($response,'pages/usuario/edit.twig',$data);

        }catch (\Exception $e){
            $this->container['flash']->addMessage('error', $e->getMessage());
            return $response->withRedirect($this->container->router->pathFor('usuario.list'));
        }

    }

    public function postEdit($request,$response,$args){

        $id = 0;
        $usuario = new Usuario();

        try{
            $id = $request->getParam('usuario_id');

            $usuario = $this->usuarioDao->findById($id,false);
            $usuario->setNome($request->getParam('usuario_nome'));
            $usuario->setEmail($request->getParam('usuario_email'));
            $usuario->setAtivo((boolean)$request->getParam('usuario_ativo'));
            $usuario->setLogin($request->getParam('usuario_login'));
            //$usuario->setSenha($cryptUtil->encrypt($request->getParam('usuario_senha')));

            //TODO: Any Doctrine turnaround?
            $perfil = $this->perfilDao->findById((integer)$request->getParam('usuario_perfil_id'),false);
            $usuario->setPerfil($perfil);


            if($request->getParam('usuario_unidade_id')>0){
                $unidadeId = $usuario->getUnidade()!=null? $usuario->getUnidade()->getId():null;
                if($request->getParam('usuario_unidade_id')!=$unidadeId){
                    $usuario->setUnidade($this->unidadeDao->findById($request->getParam('usuario_unidade_id'),false));
                }
            }else{
                $usuario->setUnidade(null);
            }

            $this->usuarioDao->updateEntity($usuario);

            $this->container['flash']->addMessage('info', 'Usuário atualizado com sucesso.');
            return $response->withRedirect($this->container->router->pathFor('usuario.list'));

        }catch(\Exception $e){
            $this->container['flash']->addMessage('error', $e->getMessage());
            //$url = $this->container->router->pathFor('usuario.edit', ['id' => $id]);
            return $response->withRedirect($this->getEdit($request,$response,array('id'=>$id,'usuario'=>$usuario)))
                ->withStatus(302)
                ->withoutHeader('Location');
        }

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

            if($request->getParam('usuario_unidade_id')>0){
                $usuario->setUnidade($this->unidadeDao->findById($request->getParam('usuario_unidade_id'),false));
            }

            $this->usuarioDao->createEntity($usuario);

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

            $this->usuarioDao->changePassword($usrId,$currPwd,$newPwd);

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

            $unidadeId = 0;
            if(isset($_SESSION['usuario']['unidade']['id'])){
                $unidadeId = $_SESSION['usuario']['unidade']['id'];
            }

            //(DtUsuario $dtUsuario,$search,$start,$length,$orderColumn,$orderDirection)
            $datatables = $this->usuarioDao->listDtJson($search,$start,$length,$orderColumn,$orderDirection,$unidadeId);
            $datatables->setDraw($draw);
            //return $response->withJson($datatables);
            return $response->withJson($datatables->__toArray());

        }catch (Exception $e){
            return $response->withJson($e,$e->getCode());
        }

    }




}