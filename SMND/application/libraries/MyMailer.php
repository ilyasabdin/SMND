<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\POP3;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exeption;

require (dirname(__dir__, 2).'/vendor/autoload.php' );

/**
* 
*/
class Mymailer extends PHPMailer
{
	
	function __construct()
	{
		parent::__construct();

		$CI =& get_instance();
	}
}
