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

                $status_log = 3;
                $dataLog = array(
                    'filter' => 'status_log',
                    'filter_key' => $status_log,
                );
                $this->enem_templates->add_log($dataLog);

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
            } elseif($enem_modal_id === 'modaladdrole') {
                // var_dump('asdasddad'); exit();
                $this->load->view('main/user/modal/modal_add_role');
            } elseif($enem_modal_id === 'modaladdlog') {
                // var_dump('asdasddad'); exit();
                $this->load->view('main/user/modal/modal_type_log');
            } elseif($enem_modal_id === 'modaleditlog') {
                // var_dump('asdasddad'); exit();
                $this->load->view('main/user/modal/modal_type_log');
            }
        } else {
            redirect('enem/user/dashboard');
        }
    }

    public function add_enem_user()
    {
        if($this->input->is_ajax_request()) {
            $enem_name = $this->enem_templates->anti_injection(ucfirst(strtolower($this->input->post('name'))));
            $enem_email = $this->enem_templates->anti_injection(strtolower($this->input->post('email')));
            $enem_username = $this->enem_templates->anti_injection(strtolower($this->input->post('username')));
            $enem_password = $this->enem_templates->enem_secret($this->enem_templates->anti_injection(strtolower($this->input->post('password'))));
            $enem_role = $this->enem_templates->anti_injection(strtolower($this->input->post('role')));

            // Check Role
            $role = $this->enem_templates->check_user_role($enem_role);
            $flagRole = $role['flag'];
            $descRole = $role['role'];
            // var_dump($enem_firstname); exit();

            $digit_patt = '/([0-9])/';
            $alpha_patt = '/([a-zA-Z])/';
            $spch_patt  = '/([\-\_?!*%&^@#$`~,.<>;\':"\\/\/[\]\|{}()=+])/';

            if($this->enem_templates->length($enem_name) == 0) {
                $dataJson['t'] = 0;
                $dataJson['id'] = 'name';
                $dataJson['message'] = 'Please insert name';
            }
            elseif(preg_match($digit_patt,$enem_name)) {
                $dataJson['t']          = "0";
                $dataJson['id']         = "name";
                $dataJson['message']    = "Your name is invalid";
            }
            elseif(preg_match($spch_patt,$enem_name)) {
                $dataJson['t']          = "0";
                $dataJson['id']         = "name";
                $dataJson['message']    = "Your name is invalid";
            }
            elseif($this->enem_templates->length($enem_name) < 3) {
                $dataJson['t']          = "0";
                $dataJson['id']         = "name";
                $dataJson['message']    = "Your name too short";
            }
            elseif($this->enem_templates->length($enem_name) > 50) {
                $dataJson['t']          = "0";
                $dataJson['id']         = "name";
                $dataJson['message']    = "Your name too long";
            }
            elseif($this->enem_templates->length($enem_email) == 0) {
                $dataJson['t']          = "0";
                $dataJson['id']         = "email";
                $dataJson['message']    = "Please insert email";
            }
            elseif($this->enem_templates->length($enem_email) > 50) {
                $dataJson['t']          = "0";
                $dataJson['id']         = "email";
                $dataJson['message']    = "Your email too long";
            }
            elseif(!filter_var($enem_email, FILTER_VALIDATE_EMAIL)) {
                $dataJson['t']          = "0";
                $dataJson['id']         = "email";
                $dataJson['message']    = "Email is not valid";
            }
            elseif($this->enem_templates->length($enem_username) == 0) {
                $dataJson['t']          = "0";
                $dataJson['id']         = "username";
                $dataJson['message']    = "Please insert username";
            }
            elseif($this->enem_templates->length($enem_username) > 50) {
                $dataJson['t']          = "0";
                $dataJson['id']         = "username";
                $dataJson['message']    = "Your username too long";
            }
            elseif($this->enem_templates->length($enem_password) == 0) {
                $dataJson['t']          = "0";
                $dataJson['id']         = "password";
                $dataJson['message']    = "Please insert password";
            }
            elseif($this->enem_templates->length($enem_password) > 50) {
                $dataJson['t']          = "0";
                $dataJson['id']         = "password";
                $dataJson['message']    = "Your password is too long";
            } elseif($flagRole === false) {
                $dataJson['t']          = "0";
                $dataJson['id']         = "role";
                $dataJson['message']    = "Undefined role";
            } else {
                $dataJson['t'] = 1;
            }

            if($dataJson['t'] == 1) {
                $this->load->model('enem_user_model');

                // $user_info = $this->enem_templates->get_user_info();
                // // var_dump($user_info['ip']); exit();
                // $ip = $user_info['ip'];

                $db = array(
                    'name' => $enem_name,
                    'username' => $enem_username,
                    'password' => $enem_password,
                    'email' => $enem_email,
                    'role' => $enem_role,
                );

                $this->enem_user_model->addDataUserEnem($db);

                // Add Log

                $info_user = $this->enem_templates->get_user_info();
                $status_log = 3;
                $user_log_status = $this->enem_templates->check_status_userlog($status_log);

                $dbLog = array(
                    'ip' => $info_user['ip'],
                    'server_name' => $info_user['server_name'],
                    'url' => $info_user['url'],
                    'user_agent' => $info_user['user_agent'],
                    'referer' => $info_user['referer'],
                    'status_log' => $status_log,
                    'title_log' => $user_log_status,
                );

                $this->enem_user_model->addDataUserLog($dbLog);

            }

            echo json_encode($dataJson);
        } else {
            redirect('');
        }
    }

    public function add_enem_role()
    {
        if($this->input->is_ajax_request()) {
            $enem_name = $this->enem_templates->anti_injection(strtolower($this->input->post('name')));
            $enem_role = $this->enem_templates->anti_injection(strtolower($this->input->post('role')));

            $digit_patt = '/([0-9])/';
            $alpha_patt = '/([a-zA-Z])/';
            $spch_patt  = '/([\-\_?!*%&^@#$`~,.<>;\':"\\/\/[\]\|{}()=+])/';

            if($this->enem_templates->length($enem_name) == 0) {
                $dataJson['t'] = 0;
                $dataJson['id'] = 'name';
                $dataJson['message'] = 'Please insert name';
            }
            elseif(preg_match($digit_patt,$enem_name)) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "name";
                $dataJson['message']    = "Your name is invalid";
            }
            elseif(preg_match($spch_patt,$enem_name)) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "name";
                $dataJson['message']    = "Your name is invalid";
            }
            elseif($this->enem_templates->length($enem_name) < 3) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "name";
                $dataJson['message']    = "Your name too short";
            }
            elseif($this->enem_templates->length($enem_name) > 50) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "name";
                $dataJson['message']    = "Your name too long";
            }
            elseif($this->enem_templates->length($enem_role) == 0) {
                $dataJson['t'] = 0;
                $dataJson['id'] = 'role';
                $dataJson['message'] = 'Please insert role';
            }
            elseif($this->enem_templates->length($enem_role) > 50) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "role";
                $dataJson['message']    = "Your role too long";
            }
            elseif(!is_numeric($enem_role)) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "role";
                $dataJson['message']    = "Must number";
            } else {
                $dataJson['t']          = 1;
            }

            if($dataJson['t'] == 1) {
                $this->load->model('enem_user_model');

                $db = array(
                    'name' => $enem_name,
                    'status_role' => $enem_role,
                );

                $this->enem_user_model->addUserRoleEnem($db);

                // Add Log

                $info_user = $this->enem_templates->get_user_info();
                $status_log = 5;
                $user_log_status = $this->enem_templates->check_status_userlog($status_log);

                $dbLog = array(
                    'ip' => $info_user['ip'],
                    'server_name' => $info_user['server_name'],
                    'url' => $info_user['url'],
                    'user_agent' => $info_user['user_agent'],
                    'referer' => $info_user['referer'],
                    'status_log' => $status_log,
                    'title_log' => $user_log_status,
                );

                $this->enem_user_model->addDataUserLog($dbLog);
            }

            echo json_encode($dataJson);

        } else {
            redirect('');
        }
    }

    public function add_enem_type_log()
    {
        if($this->input->is_ajax_request()) {
            $enem_name = $this->enem_templates->anti_injection(ucfirst(strtolower($this->input->post('name'))));
            $enem_log = $this->enem_templates->anti_injection(strtolower($this->input->post('log')));

            // $digit_patt = '/([0-9])/';
            $digit_patt = '/([0-9])/';
            $alpha_patt = '/([a-zA-Z])/';
            // $spch_patt  = '/([\-\_?!*%&^@#$`~,.<>;\':"\\/\/[\]\|{}()=+])/';
            $spch_patt  = '/([\-\_?!*%&^@#$`~,.<>;\':"\\/\/[\]\|{}=+])/';

            $this->load->model('enem_user_model');
            // Check Name Log
            $dataCheckName = array(
                'filter' => 'name',
                'filter_key' => $enem_name,
            );
            $check_name = $this->enem_templates->check_type_log($dataCheckName);
            // Check Status Log
            $dataCheckLog = array(
                'filter' => 'status_log',
                'filter_key' => $enem_log,
            );
            $check_log = $this->enem_templates->check_type_log($dataCheckLog);

            if($this->enem_templates->length($enem_name) == 0) {
                $dataJson['t'] = 0;
                $dataJson['id'] = 'name';
                $dataJson['message'] = 'Please insert name';
            }
            elseif(preg_match($digit_patt,$enem_name)) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "name";
                $dataJson['message']    = "Your name is invalid";
            }
            elseif(preg_match($spch_patt,$enem_name)) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "name";
                $dataJson['message']    = "Your name is invalid";
            }
            elseif($this->enem_templates->length($enem_name) < 3) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "name";
                $dataJson['message']    = "Your name too short";
            }
            elseif($this->enem_templates->length($enem_name) > 50) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "name";
                $dataJson['message']    = "Your name too long";
            }
            elseif($check_name) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "name";
                $dataJson['message']    = "Duplicate data";
            }
            elseif($this->enem_templates->length($enem_log) == 0) {
                $dataJson['t'] = 0;
                $dataJson['id'] = 'log';
                $dataJson['message'] = 'Please insert log';
            }
            elseif($this->enem_templates->length($enem_log) > 50) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "log";
                $dataJson['message']    = "Your log too long";
            }
            elseif(!is_numeric($enem_log)) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "log";
                $dataJson['message']    = "Must number";
            }
            elseif($check_log) {
                $dataJson['t']          = 0;
                $dataJson['id']         = "log";
                $dataJson['message']    = "Duplicate data";
            } else {
                $dataJson['t']          = 1;
            }

            if($dataJson['t'] == 1) {
                $db = array(
                    'name' => $enem_name,
                    'status_log' => $enem_log,
                );

                $this->enem_user_model->addTypeLog($db);
            }

            echo json_encode($dataJson);

        } else {
            redirect('');
        }
    }

    public function enem_type_log($action = NULL)
    {
        if($this->input->is_ajax_request()) {
            // var_dump($action); exit();
            if(isset($action)) {

                if($action == 'add') {
                    $enem_name = $this->enem_templates->anti_injection(ucfirst(strtolower($this->input->post('name'))));
                    $enem_log = $this->enem_templates->anti_injection(strtolower($this->input->post('log')));

                    // $digit_patt = '/([0-9])/';
                    $digit_patt = '/([0-9])/';
                    $alpha_patt = '/([a-zA-Z])/';
                    // $spch_patt  = '/([\-\_?!*%&^@#$`~,.<>;\':"\\/\/[\]\|{}()=+])/';
                    $spch_patt  = '/([\-\_?!*%&^@#$`~,.<>;\':"\\/\/[\]\|{}=+])/';

                    $this->load->model('enem_user_model');
                    // Check Name Log
                    $dataCheckName = array(
                        'filter' => 'name',
                        'filter_key' => $enem_name,
                    );
                    $check_name = $this->enem_templates->check_type_log($dataCheckName);
                    // Check Status Log
                    $dataCheckLog = array(
                        'filter' => 'status_log',
                        'filter_key' => $enem_log,
                    );
                    $check_log = $this->enem_templates->check_type_log($dataCheckLog);

                    if($this->enem_templates->length($enem_name) == 0) {
                        $dataJson['t'] = 0;
                        $dataJson['id'] = 'name';
                        $dataJson['message'] = 'Please insert name';
                    }
                    elseif(preg_match($digit_patt,$enem_name)) {
                        $dataJson['t']          = 0;
                        $dataJson['id']         = "name";
                        $dataJson['message']    = "Your name is invalid";
                    }
                    elseif(preg_match($spch_patt,$enem_name)) {
                        $dataJson['t']          = 0;
                        $dataJson['id']         = "name";
                        $dataJson['message']    = "Your name is invalid";
                    }
                    elseif($this->enem_templates->length($enem_name) < 3) {
                        $dataJson['t']          = 0;
                        $dataJson['id']         = "name";
                        $dataJson['message']    = "Your name too short";
                    }
                    elseif($this->enem_templates->length($enem_name) > 50) {
                        $dataJson['t']          = 0;
                        $dataJson['id']         = "name";
                        $dataJson['message']    = "Your name too long";
                    }
                    elseif($check_name) {
                        $dataJson['t']          = 0;
                        $dataJson['id']         = "name";
                        $dataJson['message']    = "Duplicate data";
                    }
                    elseif($this->enem_templates->length($enem_log) == 0) {
                        $dataJson['t'] = 0;
                        $dataJson['id'] = 'log';
                        $dataJson['message'] = 'Please insert log';
                    }
                    elseif($this->enem_templates->length($enem_log) > 50) {
                        $dataJson['t']          = 0;
                        $dataJson['id']         = "log";
                        $dataJson['message']    = "Your log too long";
                    }
                    elseif(!is_numeric($enem_log)) {
                        $dataJson['t']          = 0;
                        $dataJson['id']         = "log";
                        $dataJson['message']    = "Must number";
                    }
                    elseif($check_log) {
                        $dataJson['t']          = 0;
                        $dataJson['id']         = "log";
                        $dataJson['message']    = "Duplicate data";
                    } else {
                        $dataJson['t']          = 1;
                    }

                    if($dataJson['t'] == 1) {
                        $db = array(
                            'name' => $enem_name,
                            'status_log' => $enem_log,
                        );

                        $this->enem_user_model->addTypeLog($db);
                    }

                    echo json_encode($dataJson);

                } elseif($action == 'edit') {
                    var_dump('edit'); exit();
                } else {
                    $dataJson = array(
                        'status' => 'error',
                        'message' => 'Wrong action',
                    );
                    echo json_encode($dataJson);
                }

            } else {
                throw new Exception("Error Type Log. No action", 0);
            }

        } else {
            redirect('');
        }
    }

    public function pagination()
    {
        if($this->input->is_ajax_request()) {
            $enem_pagination_name = $this->enem_templates->anti_injection($this->input->post('pagination_name'));
            $enem_pagination_key = $this->enem_templates->anti_injection($this->input->post('pagination_key'));
            $enem_page = $this->enem_templates->anti_injection($this->input->post('page'));

            if($enem_pagination_key == 'enem') {

                $this->load->model('enem_user_model');

                if($enem_pagination_name == $this->enem_templates->enem_secret('user') && !empty($enem_page)) {
                    // For Pagination
                    $paramPagination = array(
                        'model_name' => 'enem_user_model',
                        'method' => array(
                            'name' => 'getEnemDataPagination',
                            'filter' => 'create_sql',
                            'sql' => '* FROM enem_user',
                        ),
                        'limit_data' => 10,
                        'limit_page' => 5,
                        'page_now' => $enem_page,
                    );
                    $dataPaginationUser = $this->enem_templates->create_pagination($paramPagination);
                    $dataPanelUser = $dataPaginationUser['dataQuery'];
                    $totalDataAllUser = $dataPaginationUser['totalDataAll'];
                    $totalPageUser = $dataPaginationUser['totalPage'];
                    $limitDataUser = $dataPaginationUser['limitData'];
                    $limitPageUser = $dataPaginationUser['limitPage'];
                    $startLimitUser = $dataPaginationUser['startLimit'];
                    $pageNowUser = $dataPaginationUser['pageNow'];
                    $prevUser = $dataPaginationUser['prev'];
                    $startPaginationUser = $dataPaginationUser['startPagination'];
                    $endPaginationUser = $dataPaginationUser['endPagination'];
                    $nextUser = $dataPaginationUser['next'];
                    // var_dump($dataPaginationUser); exit();

                    $dataUserEnem = $dataPanelUser;
                    $paginationUser = $this->enem_templates->enem_secret('user');

                    //render table user
                    $this->load->view('main/user/dashboard/partials/tbl_user', get_defined_vars());
                } elseif($enem_pagination_name == $this->enem_templates->enem_secret('type_log') && !empty($enem_page)) {
                    // For Pagination Panel Type Log
                    $paramPaginationTypeLog = array(
                        'model_name' => 'enem_user_model',
                        'method' => array(
                            'name' => 'getEnemDataPagination',
                            'filter' => 'create_sql',
                            'sql' => '* FROM enem_type_log ORDER BY status_log ASC',
                        ),
                        'limit_data' => 10,
                        'limit_page' => 5,
                        'page_now' => $enem_page,
                    );
                    $dataPaginationTypeLog = $this->enem_templates->create_pagination($paramPaginationTypeLog);
                    $dataPanelTypeLog = $dataPaginationTypeLog['dataQuery'];
                    $totalDataAllTypeLog = $dataPaginationTypeLog['totalDataAll'];
                    $totalPageTypeLog = $dataPaginationTypeLog['totalPage'];
                    $limitDataTypeLog = $dataPaginationTypeLog['limitData'];
                    $limitPageTypeLog = $dataPaginationTypeLog['limitPage'];
                    $startLimitTypeLog = $dataPaginationTypeLog['startLimit'];
                    $pageNowTypeLog = $dataPaginationTypeLog['pageNow'];
                    $prevTypeLog = $dataPaginationTypeLog['prev'];
                    $startPaginationTypeLog = $dataPaginationTypeLog['startPagination'];
                    $endPaginationTypeLog = $dataPaginationTypeLog['endPagination'];
                    $nextTypeLog = $dataPaginationTypeLog['next'];
                    // var_dump($dataPaginationUser); exit();

                    $dataTypeLogEnem = $dataPanelTypeLog;
                    $paginationTypeLog = $this->enem_templates->enem_secret('type_log');

                    //render table type log
                    $this->load->view('main/user/dashboard/partials/tbl_type_log', get_defined_vars());
                } elseif($enem_pagination_name == $this->enem_templates->enem_secret('role') && !empty($enem_page)) {
                    // For Pagination Panel Role
                    $paramPaginationRole = array(
                        'model_name' => 'enem_user_model',
                        'method' => array(
                            'name' => 'getEnemDataPagination',
                            'filter' => 'create_sql',
                            'sql' => '* FROM enem_user_role ORDER BY status_role ASC',
                        ),
                        'limit_data' => 10,
                        'limit_page' => 5,
                        'page_now' => $enem_page,
                    );
                    $dataPaginationRole = $this->enem_templates->create_pagination($paramPaginationRole);
                    $dataPanelRole = $dataPaginationRole['dataQuery'];
                    $totalDataAllRole = $dataPaginationRole['totalDataAll'];
                    $totalPageRole = $dataPaginationRole['totalPage'];
                    $limitDataRole = $dataPaginationRole['limitData'];
                    $limitPageRole = $dataPaginationRole['limitPage'];
                    $startLimitRole = $dataPaginationRole['startLimit'];
                    $pageNowRole = $dataPaginationRole['pageNow'];
                    $prevRole = $dataPaginationRole['prev'];
                    $startPaginationRole = $dataPaginationRole['startPagination'];
                    $endPaginationRole = $dataPaginationRole['endPagination'];
                    $nextRole = $dataPaginationRole['next'];
                    // var_dump($dataPaginationUser); exit();

                    $dataRoleEnem = $dataPanelRole;
                    $paginationRole = $this->enem_templates->enem_secret('role');

                    //render table type log
                    $this->load->view('main/user/dashboard/partials/tbl_role', get_defined_vars());
                } else {
                    echo '<div class="text-center">Pagination name tidak di temukan</div>';
                }
            } else {
                echo '<div class="text-center">Wrong pagination key</div>';
            }

        } else {
            redirect('');
        }
    }

    public function upload()
    {
        // $anu = $_POST;
        // $anu = json_decode(file_get_contents('php://input'));
        // var_dump($anu); exit();
        // echo "anuu upload ".$anu;
        $date = date('YmdHis');
        $config['upload_path']="./uploads/".$date;
        $config['allowed_types']='gif|jpg|png';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $this->load->library('upload',$config);
        // var_dump($this->input); exit();
        if($this->upload->do_upload('file')){
            $data = array('upload_data' => $this->upload->data());
            $data1 = array(
            'menu_id' => $this->input->post('selectmenuid'),
            'submenu_id' => $this->input->post('selectsubmenu'),
            'imagetitle' => $this->input->post('imagetitle'),
            'imgpath' => $data['upload_data']['file_name']
            );  
            var_dump($data1); exit();
            // $result= $this->Admin_model->save_imagepath($data1);
            // if ($result == TRUE) {
            //     echo "true";
            // }
        }
        echo $this->input->post('imagetitle');
    }

}
