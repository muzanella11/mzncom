<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

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
        // $dataJson['status'] = 1;
        // $dataJson['messages'] = 'asdasd';
        // $a = json_encode($dataJson);
        // echo $a;
        // var_dump('asdas'); exit();
        var_dump(header('token')); exit();
        $api = json_decode(
            file_get_contents('http://enemlab.me/enem/api/user-get')
        );
        $get_user = $api->user_data->name;

        echo $get_user;
    }

    public function user_get()
    {
        // var_dump('asdasd');exit();
        header('Token: 123456');
        header('Enem-Secret: hahaha');
        $res = http_response_code();
        $data = array(
            'name' => 'Thor',
            'username' => 'thoree',
            'messages' => 'hahaha',
            'link' => 'http://twitter.com',
            'res' => $res,
        );
        $dataJson['status'] = 1;
        $dataJson['user_data'] = $data;
        $dataJson['messages'] = 'asdasd';
        $a = json_encode($dataJson);
        echo $a;
    }
}
