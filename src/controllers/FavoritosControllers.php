<?php
namespace controllers;
use configs\DB as DB;


class FavoritosControllers
{
	protected $app; 
	function __construct($app){
		$this->app=$app;
	}

	public function mostrarFavorito($request, $response, $args){
		
		$codigo=$args["id"];
		$favoritoArray=array();
		$favoritosArray=array();

		$login=$_SESSION["dados_login"]["id"];
		$fotoUser=$_SESSION["dados_login"]["img"];

		$buscaCurtida=DB::findAll("curtidas","id_usuario=?",array($login));
		$buscaFavorito=DB::findAll("favoritos","id_usuario=?",array($login));
		
		$busca=DB::findAll("escrito");

		if($buscaFavorito!=null){

			foreach ($busca as $value) {

				$curti =  0;

				foreach ($buscaCurtida as $valor) {
					if($value->id==$valor->id_publicacao){
						$curti = 1;
					}	
				}

				foreach ($buscaFavorito as $valor) {
					if($value->id==$valor->id_publicacao){

						array_push($favoritosArray,
							array(
								"id"=>				$valor->id,
								"id_publicacao"=>	$valor->id_publicacao,
								"id_user"=>			$valor->id_user,							
								"titulo"=> 			$value->titulo
						));
					}
					if(($value->id==$valor->id_publicacao) && ($codigo==$valor->id)){

						array_push($favoritoArray,
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
								"statusFavoritos"=>1, 
								"statusCurtida"=>$curti,
								"id_login"=>$login, 
								"foto"=>$fotoUser
						));
					}
				}		
			}
		}
		
		return $this->app->view->render($response, 'meus_favoritos.twig',
			array(
				'favorito'=>$favoritoArray,
				'favoritos'=>$favoritosArray
			)
		);

	}

	public function addFavorito($request, $response, $args){
		$codigoPublicacao=$_GET["codigo"];
		$codigoUser=$_GET["codUser"];
		

		$buscaFavorito=DB::findAll("favoritos","id_usuario=? and id_publicacao=?",array($codigoUser, $codigoPublicacao));
		$busca=DB::findOne("escrito","id=?",array($codigoPublicacao));

		if($buscaFavorito==null){
			$adicionarFavorito=DB::dispense('favoritos');
			$adicionarFavorito->id_usuario	 	=$codigoUser;
			$adicionarFavorito->id_publicacao	=$codigoPublicacao;
			$id=DB::store($adicionarFavorito);
		
		}else{
			
		}		


		return json_encode(['codig'=>$codigoPublicacao]);
	}

	public function removerEstrela($request, $response, $args){
		$codigoPublicacao=$_GET["codigo"];
		$codigoUser=$_GET["codUser"];
		
		$buscaCurtida=DB::findOne("favoritos","id_usuario=? and id_publicacao=?",array($codigoUser, $codigoPublicacao));

		if($buscaCurtida!=null){
			DB::exec("DELETE FROM favoritos WHERE id=?",array($buscaCurtida->id));
		}else{
			
		}	

		return json_encode(['codig'=>$codigoPublicacao]);

	}

}