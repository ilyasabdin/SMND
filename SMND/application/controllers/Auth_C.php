<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_C extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->load->model('user_model');
    }
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('User_C');
        }
        $this->form_validation->set_rules('email','Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password','Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Login';
            $this->load->view('templates/Auth_header',$data);
            $this->load->view('Auth/Login');
            $this->load->view('templates/Auth_footer');
        }else{
            $this->login();
        }

    }

    private function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if($user['is_active'] ==1){
                if(password_verify($password, $user['password'])){

                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'id' => $user['id'] ,
                        'nama'=>$user['nama'],
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('Admin_C');
                    }
                    if ($user['role_id'] == 3) {
                        redirect('Ketua_C');
                    }
                    if ($user['role_id'] == 4) {
                        redirect('Sekertaris_C');
                    }
                    else{
                        redirect('User_C');
                    }

                }else
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password tidak Sesuai!</div>');
                redirect('Auth_C');

            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Akun Belum Aktif!</div>');
                redirect('Auth_C');
            }

        }else{
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Akun Belum Terdaftar!</div>');
            redirect('Auth_C');
        }
    }

    public function Register()
    {

        $this->form_validation->set_rules('nama','Nama', 'required|trim');
        $this->form_validation->set_rules('email','Email', 'required|trim|is_unique[user.email]',[
            'is_unique' => 'Email Sudah Digunakan!'
        ]);
        $this->form_validation->set_rules('password1','Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password Dont Match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2','Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Register';
            $this->load->view('templates/Auth_header', $data);
            $this->load->view('Auth/Register');
            $this->load->view('templates/Auth_footer');
        }else{
            $email = $this->input->post('email',true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama',true)),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            // $this->user_model->simpan($data);
            //token
            $token = md5(uniqid(rand(), true));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()

            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);


            $this->_sendEmail($token,'verify');

            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Akun Berhasil Ditambahkan! Segera Aktivasi Akun (Tidak Lebih Dari 24 Jam)</div>');
            redirect('Auth_C');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'jonlenonn182@gmail.com',
            'smtp_pass' => 'ilyasabdi13',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"

        ];

        $this->email->initialize($config);

        $this->email->from('jonlenonn182@gmail.com', 'Ilyas Abdi Nugraha');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Tekan Link Ini Untuk Verifikasi Akun : <a href="'. base_url() .'Auth_C/verify?email=' . $this->input->post('email') . '&token=' . $token . '">Aktivasi</a>');

        }else if ($type == 'forgot'){
            $this->email->subject('Reset Password');
            $this->email->message('Tekan Link Ini Untuk Reset Password : <a href="'. base_url() .'Auth_C/resetpassword?email=' . $this->input->post('email') . '&token=' . $token . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        }else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token',['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)){
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">'.$email.'Aktivasi Berhasil Silahkan Login</div>');
                    redirect('Auth_C');
                }else{
                    $this->db->delete('user',['email' => $email]);
                    $this->db->delete('user_token',['email' => $email]);
                }

            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Aktivasi Gagal Karena Token Salah</div>');
                redirect('Auth_C');
            }

        }else{
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Aktivasi Gagal Karena Email Salah</div>');
            redirect('Auth_C');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Andah berhasil Logout</div>');
        redirect('Auth_C');

    }

    public function Block()
    {
        $this->load->view('Auth/Block');
    }
    public function lupaPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Lupa Password';
            $this->load->view('templates/Auth_header', $data);
            $this->load->view('Auth/lupaPassword');
            $this->load->view('templates/Auth_footer');
        }else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            if ($user) {
                $token = md5(uniqid(rand(), true));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()

                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Cek Email Untuk Reset Password!</div>');
                redirect('Auth_C/lupaPassword');


            }else {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email Tidak Terdaftar Atau Belum Teraktivasi</div>');
                redirect('Auth_C/lupaPassword');
            }
        }
    }
    public function resetpassword (){
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();

            }else {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset Email Gagal! Token Salah </div>');
                redirect('Auth_C');
            }
        }else{
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset Email Gagal! Email Salah </div>');
            redirect('Auth_C');
        }
    }
    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('Auth_C');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[4]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[4]|matches[password1]');

        if ($this->form_validation->run()== false){
            $data['title'] = 'Ubah Password';
            $this->load->view('templates/Auth_header', $data);
            $this->load->view('Auth/UbahPassword');
            $this->load->view('templates/Auth_footer');
        }else {
            $password = password_hash($this->input->post('password1'),PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password berhasil diubah! Silahkan Login</div>');
            redirect('Auth_C');
        }
    }
}
