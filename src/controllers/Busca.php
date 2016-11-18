<?php 

namespace controllers;
use configs\DB as DB;


class Busca 
{
	
	protected $app; 
	function __construct($app){
		$this->app=$app;
	}

	public function pesquisarBusca($request, $response, $args){
		
		$pesquisarP=$_GET["pesquisa"];
		$arrayUser=array();

		$buscaUser=DB::findAll('usuarios','nome LIKE ? ',array($pesquisarP."%"));

		foreach ($buscaUser as $value) {
			array_push($arrayUser,
							array(
								"id"=> $value->id,
								"nome"=> $value->nome, 
								"foto"=> $value->foto 
								)
							);
		}

		return json_encode($arrayUser);
	}
	
	public function pesquisarMinhasEscritas($request, $response, $args){
		
		$pesquisarP=$_GET["pesquisa"];
		$login=$_SESSION["dados_login"]["id"];
		$arrayMinhasEscritas=array();

		$buscaEscritos=DB::findAll('escrito','titulo LIKE ? ',array($pesquisarP."%"));

		foreach ($buscaEscritos as $value) {
			if($value->id_user==$login){
				array_push($arrayMinhasEscritas,
								array(
									"id"=> $value->id,
									"titulo"=> $value->titulo
									)
								);
			}
		}

		return json_encode($arrayMinhasEscritas);
	}

}