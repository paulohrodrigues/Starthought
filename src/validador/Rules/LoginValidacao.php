<?php 
namespace validador\Rules;
use Respect\Validation\Rules\AbstractRule;
use configs\DB as DB;

class LoginValidacao extends AbstractRule
{

	private $dados;

	function __construct($dados){
		$this->dados=$dados;
	}


	public function validate($entrada)
	{
		return ($this->dados!=null) ? true : false;
	}
}