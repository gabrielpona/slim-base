<?php

namespace App\Middleware;


use App\Helper\AclHelper;

class AuthMiddleware extends Middleware
{

	public function __invoke($request, $response, $next)
	{
		if($this->container->auth->check()) {

		    $aclHelper = new AclHelper();
		    $route = $request->getAttribute('route');
            $role = $_SESSION['usuario']['perfil']['slug'];
            if(!$aclHelper->isAllowed($route->getName(),$role)){
                $this->container->flash->addMessage('error', 'Você não pode acessar esta área.');
                return $response->withRedirect($this->container->router->pathFor('painel.index'));
            }
		}else{
            $this->container->flash->addMessage('error', 'Você precisa estar logado para acessar esta área.');
            return $response->withRedirect($this->container->router->pathFor('auth.signin'));
        }

		$response = $next($request, $response);
		return $response;
	}
}