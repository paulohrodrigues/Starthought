<?php
namespace controllers;
header('Access-Control-Allow-Origin: *');
use configs\DB as DB;


class CurtidasControllers
{
	protected $app; 
	function __construct($app){
		$this->app=$app;
	}

	public function verificarCurtida($user_login){
		
	}

	public function addCurtida($request, $response, $args){
		$codigoPublicacao=$_GET["codigo"];
		$codigoUser=$_GET["codUser"];
		

		$buscaCurtida=DB::findAll("curtidas","id_usuario=? and id_publicacao=?",array($codigoUser, $codigoPublicacao));
		$busca=DB::findOne("escrito","id=?",array($codigoPublicacao));

		if($buscaCurtida==null){
			$adicionarCurtida=DB::dispense('curtidas');
			$adicionarCurtida->id_usuario	 	=$codigoUser;
			$adicionarCurtida->id_publicacao	=$codigoPublicacao;
			//$adicionarCurtida->id_dono			=$busca->id_user;
			//$adicionarCurtida->class			="fa fa-heart";
			$id=DB::store($adicionarCurtida);
		

			$quantidade=$busca->like+1;

			if($busca!=null){
				$like=DB::dispense('escrito');
				$like->id=$busca->id;
				$like->like=$quantidade;
				$id=DB::store($like);
			}
		}else{
			$quantidade=$busca->like;
		}		


		return json_encode(['codig'=>$codigoPublicacao, 'quantidadeDeCurtidas'=>$quantidade]);
	}
	public function removerCurtida($request, $response, $args){
	
		$codigoPublicacao=$_GET["codigo"];
		$codigoUser=$_GET["codUser"];
		

		$buscaCurtida=DB::findOne("curtidas","id_usuario=? and id_publicacao=?",array($codigoUser, $codigoPublicacao));
		$busca=DB::findOne("escrito","id=?",array($codigoPublicacao));

		if($buscaCurtida!=null){
			$quantidade=$busca->like-1;

			if($busca!=null){
				$like=DB::dispense('escrito');
				$like->id=$busca->id;
				$like->like=$quantidade;
				$id=DB::store($like);
			}

			DB::exec("DELETE FROM curtidas WHERE id=?",array($buscaCurtida->id));
		}else{
			$quantidade=$busca->like;
		}		


		return json_encode(['codig'=>$codigoPublicacao, 'quantidadeDeCurtidas'=>$quantidade]);

	}
}