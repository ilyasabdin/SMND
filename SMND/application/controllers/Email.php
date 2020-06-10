<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    function index(){
        $this->load->library('email');

        foreach ($this->user_model->get('user')->result() as $user){
            $this->email->from('your@example.com', 'Your Name');
            $this->email->to('imandidikr@gmail.com');
            $this->email->cc('another@another-example.com');
            $this->email->bcc('them@their-example.com');

            $this->email->subject('Email Test');
            $this->email->message('Testing the email class.');
            $this->email->send();
        }
    }
}
?>
