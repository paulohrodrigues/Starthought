<?php
namespace middleware;

class DeslogadoMiddleware extends Middleware
{
	public function __invoke($request, $response, $next){
		if(isset($_SESSION["dados_login"])){
			return $response->withRedirect($this->container->router->pathFor("home"));
		}
		return $next($request,$response);
	}
}