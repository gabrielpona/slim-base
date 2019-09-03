<?php
namespace App\Controller;

use App\Abstracts\AbstractController;

use App\Dao\UnidadeDao;
use App\Entity\Unidade;
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


    public function getCreate($request,$response,$args){
        return $this->container->view->render($response,'pages/unidade/create.twig',array());
    }

    public function getEdit($request,$response,$args){

        $route = $request->getAttribute('route');
        $id = $route->getArgument('id');

        try{

            if(isset($args['unidade'])){
                $unidade = $args['unidade'];

            }else{
                if($id ==null || !is_numeric($id)|| $id<=0 ) {
                    throw new \Exception("Unidade inválida.");

                }else{
                    $unidade = $this->unidadeDao->findById($id);
                }
            }

            if($unidade==null)
                throw new \Exception("Unidade não encontrada.");

            $data['unidade'] = $unidade;
            $data['id'] = 0;

            return $this->container->view->render($response,'pages/unidade/edit.twig',$data);

        }catch (\Exception $e){
            $this->container['flash']->addMessage('error', $e->getMessage());
            return $response->withRedirect($this->container->router->pathFor('unidade.list'));
        }

    }


    public function postCreate($request,$response,$args){

        try{

            $unidade = new Unidade();
            $unidade->setNome($request->getParam('unidade_nome'));
            $unidade->setSigla($request->getParam('unidade_sigla'));

            $this->unidadeDao->createEntity($unidade);

            $this->container['flash']->addMessage('info', 'Unidade adicionada com sucesso.');
            return $response->withRedirect($this->container->router->pathFor('unidade.list'));

        }catch(\Exception $e){
            $this->container['flash']->addMessage('error', $e->getMessage());
            return $response->withRedirect($this->container->router->pathFor('unidade.create'));
        }

    }

    public function postEdit($request,$response,$args){

        $id = 0;
        $unidade = new Unidade();

        try{
            $id = $request->getParam('unidade_id');

            $unidade = $this->unidadeDao->findById($id,false);
            $unidade->setNome($request->getParam('unidade_nome'));
            $unidade->setSigla($request->getParam('unidade_sigla'));

            $this->unidadeDao->updateEntity($unidade);

            $this->container['flash']->addMessage('info', 'Unidade atualizada com sucesso.');
            return $response->withRedirect($this->container->router->pathFor('unidade.list'));

        }catch(\Exception $e){
            $this->container['flash']->addMessage('error', $e->getMessage());
            return $response->withRedirect($this->getEdit($request,$response,array('id'=>$id,'unidade'=>$unidade)))
                ->withStatus(302)
                ->withoutHeader('Location');
        }

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


    }

}