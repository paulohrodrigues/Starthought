<?php
namespace middleware;

class CarregaDadosMiddleware extends Middleware
{
	
	public function __invoke($request, $response, $next){
		$this->container->view->getEnvironment()->addGlobal('dadosDoUsuario',$_SESSION["dados_login"]);
		return $next($request,$response);
	}
}