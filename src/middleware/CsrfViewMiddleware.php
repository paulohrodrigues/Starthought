<?php
namespace middleware;

class CsrfViewMiddleware extends Middleware
{
	public function __invoke($request, $response, $next){

		$this->container->view->getEnvironment()->addGlobal('htmlHidden',[
			"html"=>'
				<input type="hidden" name="'.$this->container->csrf->getTokenNamekey().'" value="'.$this->container->csrf->getTokenName().'" id="nameKey">
				<input type="hidden" name="'.$this->container->csrf->getTokenValueKey().'" value="'.$this->container->csrf->getTokenValue().'" id="valueKey">
			',
		]);
		return $next($request,$response);
	}
}