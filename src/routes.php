<?php 
use configs\DB as DB;
new DB();
	
//############# INICIO LOGADO ###############################

	$app->group('', function () use ($app) {
		$this->get("/home","controllers\IndexControllers:logadoIndex")->setName("home");
		$this->get("/my[/{id}]","controllers\EscreverContoller:index")->setName("my");
		$this->get("/escrita/new[/{id}]","controllers\EscreverContoller:new_index")->setName("new");
		$this->get("/escrita/del[/{id}]","controllers\EscreverContoller:delEscrito")->setName("del");
		$this->get("/sair","controllers\UsuariosController:sair")->setName("sair");
		$this->post("/cadastraEscrito","controllers\EscreverContoller:newEscrito")->setName("cadastraEscrito");
		$this->get("/configuracao","controllers\UsuariosController:indexConfigurar")->setName("configuracao");
		
	})->add(new middleware\LogadoMiddleware($container));

//############# FIM LOGADO ##################################


//############# INICIO DESLOGADO ##################################
	$app->group('', function () use ($app) {
		$this->get("/","controllers\IndexControllers:index")->setName("index");
		$this->get("/verificaLogin","controllers\UsuariosController:verificaLogin")->setName("verificaLogin");
		$this->post("/login","controllers\UsuariosController:login")->setName("login");
		

	})->add(new middleware\DeslogadoMiddleware($container));
//############# FIM DESLOGADO ##################################





//############# INICIO INDEPENDENTE ##################################

	$app->group('', function () use ($app) {
		$this->post("/cadastroUsuario","controllers\UsuariosController:cadastrar")->setName("cadastraUsuario");
	});

//############# FIM INDEPENDENTE #####################################