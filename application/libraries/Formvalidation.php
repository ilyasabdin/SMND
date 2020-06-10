<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Formvalidation extends CI_Form_validation
{
		protected $CI;

		public function __construct() {
				parent::__construct();
				// reference to the CodeIgniter super object
				$this->CI =& get_instance();
		}
		public function regex_check($str){
			return TRUE;
		}

		public function catatan($string) {
				$template = '{"ops":[{"attributes":{"bold":true},"insert":"Catatan : "},{"attributes":{"header":4},"insert":"\n"},{"attributes":{"list":"ordered"},"insert":"\n\n\n\n\n"},{"attributes":{"bold":true},"insert":"Dokumentasi : "},{"attributes":{"header":4},"insert":"\n"},{"attributes":{"list":"ordered"},"insert":"\n\n\n\n\n"}]}';
				$this->CI->formvalidation->set_message('catatan','catatan wajib di isi');
				return ($template !== $string) && $string;
		}
}
