<?php
namespace validador\Exceptions;
use Respect\Validation\Exceptions\ValidationException;

class LoginValidacaoException extends ValidationException
{
	public static $defaultTemplates=[

		self::MODE_DEFAULT=>[

			self::STANDARD =>'login/senha não conferem',

		],

	];
}