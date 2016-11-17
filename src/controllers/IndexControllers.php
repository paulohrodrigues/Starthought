<?php
namespace controllers;
use configs\DB as DB;

class IndexControllers
{
	
	protected $app;
	function __construct($app){
		$this->app=$app;
	}
	
	public function index($request, $response){

		$fb = new \Facebook\Facebook([
			'app_id' => '1007052772726200',
			'app_secret' => 'd094beff21dd43c0e9feddc78b3468b9',
			'default_graph_version' => 'v2.7',

			]);

		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email', 'user_likes'];
		$loginUrl = $helper->getLoginUrl('http://localhost:8989/verificaLogin', $permissions);

		if(isset($_SESSION["nome_cadastro"])){	
			$nome_cadastro	= $_SESSION["nome_cadastro"];
			$id_cadastro	= $_SESSION["id_cadastro"];

			$this->app->view->getEnvironment()->addGlobal('nome_cadastro',$nome_cadastro);
			$this->app->view->getEnvironment()->addGlobal('id_cadastro',$id_cadastro);
			unset($_SESSION["nome_cadastro"]);
			unset($_SESSION["id_cadastro"]);
		}
		if(isset($_SESSION["chamaModal"])){
			$this->app->view->getEnvironment()->addGlobal('chamaModal',true);
			unset($_SESSION["chamaModal"]);
		}
		$this->app->view->getEnvironment()->addGlobal('url_face',$loginUrl);


		return $this->app->view->render($response, 'index.twig');
	}
	
	public function logadoIndex($request, $response){

		$timeLineArray=array();
		$favoritoArray=array();
		$login=$_SESSION["dados_login"]["id"];
		$fotouserlogado=$_SESSION["dados_login"]["img"];

		$busca=DB::findAll("escrito","privacidade='publico' or privacidade='anonimo' or id_user=? ORDER BY id DESC",array($_SESSION["dados_login"]["id"]));

		$buscaCurtida=DB::findAll("curtidas","id_usuario=?",array($_SESSION["dados_login"]["id"]));
		$buscaFavoritos=DB::findAll("favoritos","id_usuario=?",array($_SESSION["dados_login"]["id"]));

	
		
		foreach ($busca as $value) {
			$curti =  0;
			$favorito =  0;

			foreach ($buscaCurtida as $valor) {
				if($value->id==$valor->id_publicacao){
					$curti = 1;
				}	
			}

			foreach ($buscaFavoritos as $valor) {
				if($value->id==$valor->id_publicacao){
					$favorito = 1;
					array_push($favoritoArray,
						array(
							"id"=>				$valor->id,
							"id_publicacao"=>	$valor->id_publicacao,
							"id_user"=>			$valor->id_user,							
							"titulo"=> 			$value->titulo
					));
				}	
			}

			array_push($timeLineArray,
				array(
					"id"=>				$value->id,
					"titulo"=> 			$value->titulo,
					"data"=>			$value->data,
					"conteudo"=> 		$value->texto.(($value->id_user==$_SESSION["dados_login"]["id"])?"</br><a href='/escrita/new/".$value->id."'><i class='fa fa-pencil fa-fw' aria-hidden='true'></i></a> <a href='/escrita/del/".$value->id."'>  <i class='fa fa-trash-o fa-lg'></i> </a>":""),
					"qtdLikes"=> 		$value->like,
					"qtdComentarios"=>	$value->comentarios, 
					"img"=>DB::findOne("usuarios", "id=?",array($value->id_user))->foto,
					"privacidade"=> ($value->privacidade=="eu")?"Somente eu":$value->privacidade,
					"tipo"=> $value->tipo,
					"id_user"=>$value->id_user,
					"id_login"=>$login,
					"statusCurtida"=>$curti,
					"foto"=>$fotouserlogado,
					"statusFavoritos"=>$favorito

				)
			);
		}


		return $this->app->view->render($response, 'home.twig',
			array(
				'timeline'=>$timeLineArray, 
				'favoritos'=>$favoritoArray
			)
		);
	}
}