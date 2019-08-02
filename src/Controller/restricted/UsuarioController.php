<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 29/07/2019
 * Time: 09:32
 */

namespace App\Controller\restricted;


use App\Abstracts\AbstractController;
use App\Helper\Datatables\DataTables;
use App\Resource\UsuarioDao;
use App\Transients\DataTables\DtUsuario;
use PHPUnit\Util\Exception;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class UsuarioController extends AbstractController
{


    public function __construct($container)
    {
        parent::__construct($container,new UsuarioDao($container->get('em')));
    }

    public function getList($request, $response, $args){


        $list = $this->dao->listAll();

        $data = ['usuarioList' => $list];

        return $this->container->view->render($response,'usuario.list.twig',$data);
    }


    /*
    @Post("/painel/usuario/list.json")
    @Permission({Role.SYSADMIN,Role.SUPERVISOR,Role.ASSOCIACAO_GERENTE})
    public void listDtJson(Integer draw, DtUsuario dtUsuario, int start, int length, @Named("order[0][column]") int orderColumn,
                           @Named("order[0][dir]") String orderDirection) {
    try {
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
    }
    */


    public function postTeste (ServerRequestInterface $request, ResponseInterface $response,array $args){

        $parsedBody = $request->getParsedBody();


        var_dump($parsedBody['nasc']);


        //return $response->withJson("a");

    }

    public function postDtJson(ServerRequestInterface $request, ResponseInterface $response){
        try{


            $pb = $request->getParsedBody();

            $draw = $pb['draw'];
            $start = $pb['start'];
            $length = $pb['length'];
            //$orderColumn = $pb['orderColumn'];
            //$orderDirection = $pb['orderDirection'];
            $orderColumn = 0;
            $orderDirection = 'asc';

            $dtUsuario = new DtUsuario();
            //$dtUsuario->setDTRowId($pb['dtUsuario']['DTRowId']);
            //$dtUsuario->setLogin($pb['dtUsuario']['login']);


            //(DtUsuario $dtUsuario,$search,$start,$length,$orderColumn,$orderDirection)
            $datatables = $this->dao->listDtJson($dtUsuario,"",$start,$length,$orderColumn,$orderDirection);
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