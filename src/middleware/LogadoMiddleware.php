<?php
namespace middleware;

class LogadoMiddleware extends Middleware
{
	public function __invoke($request, $response, $next){
		if(!isset($_SESSION["dados_login"])){
			return $response->withRedirect($this->container->router->pathFor("index"));
		}
		return $next($request,$response);
	}
}