<?php 

namespace controllers;
header('Access-Control-Allow-Origin: *');
use configs\DB as DB;


class ComentarioControllers 
{
	
	protected $app; 
	function __construct($app){
		$this->app=$app;
	}

	//Verificar e mostrar os comentarios 
	public function verificarComentarios($request, $response, $args){
		$codigoPublicacao=$_GET["codigo"];
		$codigoUser=$_GET["codUser"];
		$arrayComentarios=array();

		$buscaComentarios=DB::findAll("comentarios","id_escrito=?",array($codigoPublicacao));
		$buscaUsuarios=DB::findAll("usuarios");

			foreach ($buscaUsuarios as $value) {
				foreach ($buscaComentarios as $valor) {
					if($valor->id_user==$value->id){
						if($codigoPublicacao==$valor->id_escrito){  	
							array_push($arrayComentarios,
							array(
								"id"=> $valor->id,
								"texto"=> $valor->texto,
								"nome"=> $value->nome, 
								"foto"=> $value->foto 
								)
							);
						}
				}
			}
		}

		return json_encode($arrayComentarios);
	}

	//adicionar comentario 
	public function add($request, $response, $args){
		$codigoPublicacao=$_GET["codigo"];
		$codigoUser=$_GET["codUser"];
		$texto=$_GET["texto"];

		$busca=DB::findOne("escrito","id=?",array($codigoPublicacao));
		if(isset($texto)){
			$adicionarComentario=DB::dispense('comentarios');
			$adicionarComentario->id_user 	=$codigoUser;
			$adicionarComentario->id_escrito	=$codigoPublicacao;
			$adicionarComentario->texto	=$texto;
			$id=DB::store($adicionarComentario);
		

			$quantidade=$busca->comentarios+1;

			if($busca!=null){
				$comentarios=DB::dispense('escrito');
				$comentarios->id=$busca->id;
				$comentarios->comentarios=$quantidade;
				$id=DB::store($comentarios);
			}

			return json_encode(['codig'=>$codigoPublicacao, 'quantidadeDeComentarios'=>$quantidade]);
		}else{

		}		
	}



}