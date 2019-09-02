<?php
namespace App\Controller;

use App\Abstracts\AbstractController;

use App\Dao\UnidadeDao;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class UnidadeController extends AbstractController
{

    private $unidadeDao;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->unidadeDao = new UnidadeDao($container->get('em'));
    }

    public function getList($request, $response, $args){
        return $this->container->view->render($response,'pages/unidade/list.twig',array());
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
            $datatables = $this->unidadeDao->listDtJson($search,$start,$length,$orderColumn,$orderDirection);
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