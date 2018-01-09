<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function __construct(){
        parent::__construct();
        // $this->data = new StdClass;
        // $this->load->library('enem_templates');
        // $this->load->model('user_model');
        // $this->load->library('session');
        // $this->load->helper('url');
    }
    public function index()
    {
        // $enem_title = $this->enem_templates->enem_secret('enem');
        // var_dump($enem); exit();
        redirect('enem/apps/dashboard');
    }

    public function ucsignin()
    {
        if($this->input->is_ajax_request()) {
            /*$username = "enem_apps";
            $password = "create123";*/
            $enem_username_default = "30b1571322023198ae3932d5ad4ec7d0";
            $enem_password_default = "befdfed1abc261a2e232ace743acacc7";
            $username = $this->enem_templates->anti_injection($this->input->post('username'));
            $password = $this->enem_templates->anti_injection($this->input->post('password'));

            // var_dump(time()); exit();

            if($this->enem_templates->length($username) == 0) {
                $dataJson['t'] = 0;
                $dataJson['id'] = 'username';
                $dataJson['message'] = 'Please insert username';
            }
            elseif($this->enem_templates->enem_secret($username) != $enem_username_default) {
                $dataJson['t'] = 0;
                $dataJson['id'] = 'username';
                $dataJson['message'] = 'Wrong username';
            }
            elseif($password == '') {
                $dataJson['t'] = 0;
                $dataJson['id'] = 'password';
                $dataJson['message'] = 'Please insert password';
            }
            elseif($this->enem_templates->enem_secret($password) != $enem_password_default) {
                $dataJson['t'] = 0;
                $dataJson['id'] = 'password';
                $dataJson['message'] = 'Wrong password';
            }
            else {
                $dataJson['t'] = 1;
            }

            if($dataJson['t'] == 1) {
                $length = 11;
                $token = $this->enem_templates->get_random_string($length);
                // var_dump($token); exit();

                $this->load->model('enem_user_model');

                $database = array(
                    'enem_token' => $token
                );

                $this->enem_user_model->addEnemTokenUserManagement($database); //set token to database

                $data_token = $this->enem_user_model->getDataTokenUserManagementByToken($token); //get token

                $setting_expired = array(
                    'timeby' => 'hours',
                    'value' => 1, // di set 1 jam expired nya
                );
                $token_expired = $this->enem_templates->create_expired_time($data_token[0]->date_created, $setting_expired); // create token expired after 1 hours

                $data_expired = array(
                    'enem_token' => $token,
                    'enem_token_expired' => $token_expired
                );

                $this->enem_user_model->updateEnemTokenExpired($data_expired); // update token expired

                // $data_token = $this->enem_user_model->getDataTokenUserManagementByToken($token); //get token all with token expired

                // $dataSession = array(
                //     'first_name' => 'enem',
                //     'last_name' => 'bot',
                //     'username' => 'enem',
                // );
                // // var_dump(time($token_expired)); exit();
                // $this->session->set_userdata($dataSession);

                if(get_cookie('enem_bot_user')) {
                    delete_cookie('enem_bot_user');
                }
                $dataCookie = array(
                                    'name'      => 'enem_bot_user',
                                    'value'     => $token,
                                    'expire'    => 3600, // cookie di setnya 1 jam juga. samain sama di db //
                                    'path'      => '/',
                                    // 'domain'    => $_SERVER['HTTP_HOST']
                );
                set_cookie($dataCookie);

                // $token_expired = $this->enem_templates->check_expired_time($data_token[0]->token_expired); //for check expired token
                // var_dump($token_expired); exit();


                // $this->load->model('user_model');
                // $token_status = 1;
                // //die($token);
                // $database = array(
                //     'enem_token' => $token,
                //     'enem_token_status' => $token_status
                // );
                // $this->user_model->addEnemTokenUserManagement($database);

                // $data = $this->user_model->getDataTokenUserManagementByToken($token);
                // //die(var_dump($data[0]->enem_token));
                // $enem_token = $data[0]->enem_token;

                // $data_session = array(
                //     'enem_token' => $enem_token
                // );
                // $this->session->set_userdata($data_session);
            }

            echo json_encode($dataJson);
        } else {
            redirect('enem/user/dashboard');
        }
        // var_dump('asdasdasd'); exit();
    }

    public function modal()
    {
        if($this->input->is_ajax_request()) {
            $enem_modal_id = $this->enem_templates->anti_injection(strtolower($this->input->post('enem_modal_id')));

            if($enem_modal_id === 'modaladduser') {
                // var_dump('asdasddad'); exit();
                $this->load->view('main/user/modal/modal_add_user');
            }
        } else {
            redirect('enem/user/dashboard');
        }
    }

    public function add_enem_user()
    {
        if($this->input->is_ajax_request()) {
            $enem_firstname = $this->enem_templates->anti_injection(strtolower($this->input->post('firstname')));
            var_dump($enem_firstname); exit();
        } else {
            redirect('');
        }
    }

}
