<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class V1 extends CI_Controller {

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
        // var_dump('v1'); exit();
        $x = get_headers('http://enemlab.me/api/v1/user-get', 1);
        var_dump($x['Enem-Secret']); exit();
        $api = json_decode(
            file_get_contents('http://enemlab.me/api/v1/user-get')
        );
        // $get_user = $api->user_data[0]->name;
        $get_user = $api->user_data;
        // var_dump($get_user);exit();
        foreach ($get_user as $key => $value) {
            echo $value->name.'&nbsp;'.$value->username.' messages : '.$value->messages.'<br>';
        }
        // var_dump($get_user);exit();

        // echo $get_user;
    }

    public function test_if()
    {
        // echo 'asdasd';
        // $a = true;
        // $b = false;
        // $c = false;

        // if($a || ($b && $c))


        // $umurnya = 18;

        // start;
        // input umur, set umur;

        // Soal Nomer 2 
        // function getOngkos($umur) {
        //     if ($umur <= 3) {
        //         echo 'Gratis';
        //     } elseif(($umur >= 4) && ($umur <= 10)) {
        //         echo '25000';
        //     } elseif(($umur >= 11) && ($umur <= 17)) {
        //         echo '50000';
        //     } elseif($umur > 17) {
        //         echo '75000';
        //     }
        // }

        // getOngkos($umurnya);

        function getGaji($gol, $pend)
        {
            if($gol == 'A') {
                if($pend == 'SMA') {
                    $gator = 1000000;
                } elseif($pend == 'S1') {
                    $gator = 2000000;
                } elseif($pend == 'S2') {
                    $gator = 3000000;
                }
            } elseif($gol == 'B') {
                if($pend == 'SMA') {
                    $gator = 1500000;
                } elseif($pend == 'S1') {
                    $gator = 2500000;
                } elseif($pend == 'S2') {
                    $gator = 3500000;
                }
            } else {
                echo 'Sorry not found golongan';
            }

            return $gator;
        }

        // echo getGaji('A', 'SMA');

        function hitungGaji($dataGaji) {
            $gol = $dataGaji['gol'];
            $pend = $dataGaji['pend'];
            // Get Gaji
            $gaji = getGaji($gol, $pend);
            $tunjangan = $gaji * 0.1;
            $pajak = $gaji * 0.05;

            $gator = $gaji + $tunjangan;
            $gaber = $gator - $pajak;

            return $gaber;
        }

        $daji = array(
            'gol' => 'a',
            'pend' => 'SMA',
        );

        $myGaji = hitungGaji($daji);

        echo 'Gaji saya sekarang adalah Rp.'.$myGaji;

        // var_dump(4 / 15); exit();
    }

    public function user_get()
    {
        // var_dump('asdasd');exit();
        header('Token: 123456');
        header('Enem-Secret: hahaha');

        $res = http_response_code();
        $data1 = array(
            'id' => 1,
            'name' => 'Thor',
            'username' => 'thoree',
            'messages' => 'hahaha',
            'link' => 'http://twitter.com',
            'res' => $res,
        );
        $data2 = array(
            'id' => 2,
            'name' => 'Daniel',
            'username' => 'ombre',
            'messages' => 'hehehe',
            'link' => 'http://twitter.com',
            'res' => $res,
        );
        $data = array($data1, $data2);
        $dataJson['status'] = 1;
        $dataJson['user_data'] = $data;
        $dataJson['messages'] = 'asdasd';
        $a = json_encode($dataJson);
        echo $a;
    }

    public function tabungan ($request = null) 
    {
        if (!$request) {
            echo "Sorry not found content";
        } else {
            $this->getTabungan();
            echo 'apa <br>';
            echo $this->uri->total_segments();
            echo '<br>';
            var_dump($request); exit();
        }
    }

    private function getTabungan () 
    {
        echo "ada <br>";
    }

    public function anu () 
    {   
        $jsonArray = json_decode(file_get_contents('php://input'), TRUE);
        var_dump($this->input->method(), '');
        var_dump($jsonArray, '');
        var_dump(getallheaders());
        var_dump('sss'); exit();
        var_dump($this->input->post('name')); exit();
        echo 'anu';
    }
}
