<?php
namespace controllers;
use classes\Usuario as Usuario;
use configs\DB as DB;
use Respect\Validation\Validator as Valida;

class UsuariosController extends Usuario
{

	protected $app;
	function __construct($app){
		$this->app=$app;
	}

	public function indexConfigurar($request, $response, $args){
		
		$busca=DB::findOne("usuarios","id=?",array($_SESSION["dados_login"]["id"]));

    	return $this->app->view->render($response, 'configuracao.twig',array("dadosConfiguracao"=>$busca));
	}

	public function cadastrar($request, $response){
		

		$img="erro";
		$usuario = DB::dispense('usuarios');
    	if(isset($_POST["foto_id"])){
    		$usuario->id = $_SESSION["dados_login"]["id"];
    		$img = new \classes\Upload();
    		$img=$img::upload();
    	}
    	$usuario->nome 		= $_POST["nome"];
    	if(!isset($_POST["foto_id"])){
    		$usuario->id_face 	= $_POST["id_face"];
    	}
    	$usuario->email 	= $_POST["email"];
    	$usuario->senha 	= $_POST["senha"];
    	$usuario->login 	= $_POST["login"];
    	
    	if($img!="erro"){
    		$usuario->foto 		= (isset($_POST["foto_id"])) ? $img : "avatar.jpg";
    	}
    	
    	$id = DB::store($usuario);

    	$this->loginControle("login",
    		array(
    			"login" =>	$_POST["login"],
				"id"	=>	$id,
				"email"	=>	$_POST["email"],
				"nome"	=>	$_POST["nome"],
				"img"	=>  DB::findOne("usuarios","id=?",array($id))->foto
    		)
    	);
	    if(!isset($_POST["foto_id"])){
	    	return $response->withRedirect($this->app->router->pathFor("index"));
	    }else{
	    	return $response->withRedirect($this->app->router->pathFor("configuracao"));
	    }
	}

	private function loginControle($op,$dados=null){
		if($op=="sair"){
			unset($_SESSION["dados_login"]);
		}else{
			$_SESSION["dados_login"]=$dados;
		}	
	}

	public function login($request, $response){
		$busca=DB::findOne("usuarios","login=? and senha=?",array($_POST["login"],$_POST["senha"]));
 	
		$validador=$this->app->validador->validar($request,[
			"login"=>Valida::loginValidacao($busca),
			"senha"=>Valida::noWhitespace()->notEmpty(),
		]);

		if($validador->erro()){
			$_SESSION["chamaModal"]=true;
			return $response->withRedirect($this->app->router->pathFor("index"));
		}
		if($busca!=null){
			$this->loginControle(
				"login",
				array(
					"login" =>	$busca->login,
					"id"	=>	$busca->id,
					"email"	=>	$busca->email,
					"nome"	=>	$busca->nome,
					"img"	=> 	$busca->foto
				)
			);
		}
		return $response->withRedirect($this->app->router->pathFor("index"));
	}

	public function sair($request, $response){
		$this->loginControle("sair");
		return $response->withRedirect($this->app->router->pathFor("index"));
	}

	public function verificaLogin($request, $response){

		$fb = new \Facebook\Facebook([
			'app_id' => 'xxxxxx',
			'app_secret' => 'xxxxx',
			'default_graph_version' => 'v2.7',
			]);
			$helper = $fb->getRedirectLoginHelper();

		try {
			$accessToken = $helper->getAccessToken();
			$responseF = $fb->get('/me',$accessToken);
		} catch(\Facebook\Exceptions\FacebookResponseException $e) {
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(\Facebook\Exceptions\FacebookSDKException $e) {
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		$me = $responseF->getGraphUser();
		$busca=DB::findOne("usuarios","id_face=?",array($me->getId()));
		if($busca!=null){
			$this->loginControle(
				"login",
				array(
					"login" =>	$busca->login,
					"id"	=>	$busca->id,
					"email"	=>	$busca->email,
					"nome"	=>	$busca->nome,
					"img"	=>  $busca->foto
				)
			);
		}else{
			$_SESSION["id_cadastro"]	=	$me->getId();
			$_SESSION["nome_cadastro"]	=	$me->getName();
		}
		return $response->withRedirect($this->app->router->pathFor("index"));
	}



}