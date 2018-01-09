<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
        $this->load->model('enem_user_model');
    }

    public function index()
    {
        // $enem_title = $this->enem_templates->enem_secret('enem');
        // var_dump($enem); exit();
        redirect('enem/user/dashboard');
    }

    public function createuser()
    {
        if($this->session->userdata('enem_token')) {

        } else {
            redirect('enem/user/signin');
        }
    }

    public function signin()
    {
        $cookie = get_cookie('enem_bot_user');

        if($cookie) {

            // $this->load->model('enem_user_model');

            $data_cookie = $this->enem_user_model->getDataTokenUserManagementByToken($cookie);
            $expired_cookie = $this->enem_templates->check_expired_time($data_cookie[0]->token_expired);

            if(!$expired_cookie) {
                redirect('enem/user/dashboard');
            }

        } else {
            $enem_title     = 'Signin Enem Apps User';
            // $enem_header     = 'layouts/enem_apps/partials/header/apps_header';
            $enem_contents  = 'main/user/signin/enem_signin';
            // $enem_footer     = 'layouts/enem_apps/partials/footer/apps_footer';
            $js             = $this->enem_js->js_signin_user();

            $info_user = $this->enem_templates->get_user_info();
            $status_log = 1;
            $user_log_status = $this->enem_templates->check_status_userlog($status_log);

            $database = array(
                'ip' => $info_user['ip'],
                'server_name' => $info_user['server_name'],
                'url' => $info_user['url'],
                'user_agent' => $info_user['user_agent'],
                'referer' => $info_user['referer'],
                'status_log' => $status_log,
                'title_log' => $user_log_status,
            );

            $this->load->model('enem_user_model');
            $this->enem_user_model->addDataUserLog($database);

            $this->load->view('layouts/enem_apps/apps_main',get_defined_vars());
        }
    }

    public function signout()
    {
        $cookie = get_cookie('enem_bot_user');

        if($cookie) {
            // delete_cookie('remember_me_fd', $_SERVER['HTTP_HOST'], '/');
            delete_cookie('enem_bot_user');
            redirect('enem/user/signin');
        } else {
            redirect('enem/user/signin');
        }
    }

    public function setcookie()
    {
        // $this->load->helper('cookie');
        if(get_cookie('hello')){
            // delete_cookie('remember_me_fd', $_SERVER['HTTP_HOST'], '/');
            delete_cookie('hello');
        }
        $dataCookie = array(
                            'name'      => 'hello',
                            'value'     => strtolower('hellooo value'),
                            'expire'    => 3600,
                            'path'      => '/',
                            // 'domain'    => $_SERVER['HTTP_HOST']
        );
        $this->input->set_cookie($dataCookie);

        echo 'success create cookie';
    }

    public function getcookie()
    {
        // $this->load->helper('cookie');

        $cookie = get_cookie('hello');
        var_dump($cookie); exit();
        echo $cookie;
    }

    public function deletecookie()
    {
        // $this->load->helper('cookie');

        if(get_cookie('hello')){
            // delete_cookie('remember_me_fd', $_SERVER['HTTP_HOST'], '/');
            delete_cookie('hello');
        }

        echo 'success delete cookie';
    }

    public function dashboard()
    {
        $cookie = get_cookie('enem_bot_user');

        if($cookie) {

            // $this->load->model('enem_user_model');

            $data_cookie = $this->enem_user_model->getDataTokenUserManagementByToken($cookie);
            $expired_cookie = $this->enem_templates->check_expired_time($data_cookie[0]->token_expired);

            if(!$expired_cookie) {
                // $log = $this->enem_templates->check_status_userlog(0);
                // var_dump($log); exit();
                // var_dump($info_user); exit();
                $enem_title     = 'Enem Dashboard';
                $enem_header    = 'layouts/enem_apps/partials/header/apps_header';
                $enem_contents  = 'main/user/dashboard/enem_dashboard';
                $enem_footer    = 'layouts/enem_apps/partials/footer/apps_footer';
                $js             = $this->enem_js->js_home_user();

                $info_user = $this->enem_templates->get_user_info();
                $status_log = 1;
                $user_log_status = $this->enem_templates->check_status_userlog($status_log);

                $database = array(
                    'ip' => $info_user['ip'],
                    'server_name' => $info_user['server_name'],
                    'url' => $info_user['url'],
                    'user_agent' => $info_user['user_agent'],
                    'referer' => $info_user['referer'],
                    'status_log' => $status_log,
                    'title_log' => $user_log_status,
                );

                $this->load->model('enem_user_model');
                $this->enem_user_model->addDataUserLog($database);

                $this->load->view('layouts/enem_apps/apps_main',get_defined_vars());
            } else {
                redirect('enem/user/signout');
            }

        } else {
            redirect('enem/user/signin');
        }
    }
}
