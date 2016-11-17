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

}