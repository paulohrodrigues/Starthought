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

		$busca=DB::findAll("escrito","privacidade='publico' or privacidade='anonimo' or id_user=? ORDER BY id DESC",array($_SESSION["dados_login"]["id"]));

		foreach ($busca as $value) {
			array_push($timeLineArray,
				array(
					"id"=>				$value->id,
					"titulo"=> 			$value->titulo,
					"data"=>			$value->data,
					"conteudo"=> 		$value->texto.(($value->id_user==$_SESSION["dados_login"]["id"])?"</br><a href='/escrita/new/".$value->id."'> Editar</a> <a href='/escrita/del/".$value->id."'> Excluir</a>":""),
					"qtdLikes"=> 		$value->like,
					"qtdComentarios"=>	0,
					"img"=>DB::findOne("usuarios", "id=?",array($value->id_user))->foto,
					"privacidade"=> ($value->privacidade=="eu")?"Somente eu":$value->privacidade,
					"tipo"=> $value->tipo,
					"id_user"=>$value->id_user
				)
			);
		}


		return $this->app->view->render($response, 'home.twig',
			array(
				'timeline'=>$timeLineArray
			)
		);
	}
}