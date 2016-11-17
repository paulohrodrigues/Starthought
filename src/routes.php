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
		$this->get("/curtir","controllers\CurtidasControllers:addCurtida")->setName("addCurtida");
		$this->get("/descurtir","controllers\CurtidasControllers:removerCurtida")->setName("removerCurtida");
		$this->get("/comentarios","controllers\ComentarioControllers:add")->setName("add");
		$this->get("/mostarComentarios","controllers\ComentarioControllers:verificarComentarios")->setName("verificarComentarios");
		$this->get("/busca","controllers\Busca:pesquisarBusca")->setName("pesquisarBusca");
		
		$this->get("/favoritar","controllers\FavoritosControllers:addFavorito")->setName("addFavorito");
		$this->get("/desfavoritar","controllers\FavoritosControllers:removerEstrela")->setName("removerEstrela");
		$this->get("/favoritos[/{id}]","controllers\FavoritosControllers:mostrarFavorito")->setName("mostrarFavorito");
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