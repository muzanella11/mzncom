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

            // $info_user = $this->enem_templates->get_user_info();
            // $status_log = 1;
            // $user_log_status = $this->enem_templates->check_status_userlog($status_log);

            // $database = array(
            //     'ip' => $info_user['ip'],
            //     'server_name' => $info_user['server_name'],
            //     'url' => $info_user['url'],
            //     'user_agent' => $info_user['user_agent'],
            //     'referer' => $info_user['referer'],
            //     'status_log' => $status_log,
            //     'title_log' => $user_log_status,
            // );

            // $this->load->model('enem_user_model');
            // $this->enem_user_model->addDataUserLog($database);

            $status_log = 2;
            $dataLog = array(
                'filter' => 'status_log',
                'filter_key' => $status_log,
            );
            $this->enem_templates->add_log($dataLog);

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

    public function bot_user($enem_bot, $bot_id) {
        // var_dump($id); exit();
        // echo 'asdasd';
        ini_set('max_execution_time', 0);
        // ini_set('memory_limit', '3000M');

        $start = microtime(TRUE);

        $enem_bot       = $this->enem_templates->anti_injection(strtolower($enem_bot));
        $enem_bot_id    = $this->enem_templates->anti_injection(strtolower($bot_id));

        // var_dump($enem_bot_id); exit();

        if($enem_bot && $enem_bot_id) {
            if ($enem_bot === 'ebot') {
                $enem_title     = 'Enem Bot User';
                // $enem_header    = '';
                $enem_contents  = 'main/user/bot-user/bot';
                // var_dump($enem_bot); exit();
                // $enem_footer    = '';

                if($enem_bot_id === 'delete') {
                    // $this->load->model('enem_user_model');

                    $dataBot = $this->enem_user_model->deleteBotEnem('enem_user', 'name', 'enem');
                    $enem_last_data = count($dataBot);
                    $enem_bot_total = $enem_bot_id;

                    $end = microtime(TRUE);
                    $getRunTime = ($end-$start).' seconds';

                    $this->load->view('layouts/enem_apps/apps_main',get_defined_vars());

                } else if(is_numeric($enem_bot_id)) {

                    /** For Generate Bot User **/
                    $enem_prefix = 'enem';
                    $enem_password = $this->enem_templates->enem_secret('enem123');
                    $enem_role = 2;


                    // $this->load->model('enem_user_model');

                    $dataBot = $this->enem_user_model->checkBotEnem('enem_user', 'name', 'enem');
                    // $enem_last_data = 0;
                    $enem_last_data = count($dataBot);
                    $enem_bot_total = $enem_bot_id;
                    // var_dump(count($dataBot)); exit();

                    if($enem_last_data) {
                        $enem_bot_total_now = $enem_last_data + $enem_bot_total;
                        for ($i=$enem_last_data; $i < $enem_bot_total_now; $i++) {

                            $nomer = $i + 1;
                            $name = $enem_prefix.$nomer;
                            $username = $name;
                            $email = $name.'@enem.com';

                            $db = array(
                                'name' => $name,
                                'username' => $username,
                                'password' => $enem_password,
                                'email' => $email,
                                'role' => $enem_role,
                            );

                            $this->enem_user_model->addDataUserEnem($db);

                            $dataBot = $this->enem_user_model->checkBotEnem('enem_user', 'name', 'enem');
                        }
                    } else {
                        for ($i=0; $i < $enem_bot_total; $i++) {

                            $nomer = $i + 1;
                            $name = $enem_prefix.$nomer;
                            $username = $name;
                            $email = $name.'@enem.com';

                            $db = array(
                                'name' => $name,
                                'username' => $username,
                                'password' => $enem_password,
                                'email' => $email,
                                'role' => $enem_role,
                            );

                            $this->enem_user_model->addDataUserEnem($db);

                            $dataBot = $this->enem_user_model->checkBotEnem('enem_user', 'name', 'enem');
                        }
                    }


                    /** End Generate Bot **/

                    $end = microtime(TRUE);
                    $getRunTime = ($end-$start).' seconds';

                    $this->load->view('layouts/enem_apps/apps_main',get_defined_vars());

                } else {
                    redirect('enem/user/dashboard');
                }


            } elseif($enem_bot === 'tlbot') {
                // For Type Log Bot
                var_dump('type log bot '.$enem_bot_id); exit();
            } else {
                redirect('enem/user/dashboard');
            }
        } else {
            redirect('enem/user/dashboard');
        }

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

                $status_log = 4;
                $dataLog = array(
                    'filter' => 'status_log',
                    'filter_key' => $status_log,
                );
                $this->enem_templates->add_log($dataLog);

                //Test get type log
                // $typeLog = $this->enem_templates->check_type_log();
                // var_dump($typeLog); exit();

                //Test get add log
                $addLog = $this->enem_templates->add_log();
                // var_dump($typeLog); exit();

                // For Pagination Panel User
                $paramPagination = array(
                    'model_name' => 'enem_user_model',
                    'method' => array(
                        'name' => 'getEnemDataPagination',
                        'filter' => 'create_sql',
                        'sql' => '* FROM enem_user',
                    ),
                    'limit_data' => 10,
                    'limit_page' => 5,
                    'page_now' => 1,
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
                    'page_now' => 1,
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

                // var_dump($dataUserEnem); exit();
                // For Total Data

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
                    'page_now' => 1,
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

                // var_dump($dataUserEnem); exit();
                // For Total Data

                $this->load->view('layouts/enem_apps/apps_main',get_defined_vars());
            } else {
                redirect('enem/user/signout');
            }

        } else {
            redirect('enem/user/signin');
        }
    }
}
