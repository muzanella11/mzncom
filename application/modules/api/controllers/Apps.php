<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
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

	public function signin()
	{
		$enem_title 	= 'Signin Enem Apps';
		// $enem_header 	= 'layouts/enem_apps/partials/header/apps_header';
		$enem_contents 	= 'main/apps/signin/enem_signin';
		// $enem_footer 	= 'layouts/enem_apps/partials/footer/apps_footer';
		$js				= $this->enem_js->js_signin();

		$this->load->view('layouts/enem_apps/apps_main',get_defined_vars());
	}

	public function dashboard()
	{
		$enem_title 	= 'Enem Dashboard';
		$enem_header 	= 'layouts/enem_apps/partials/header/apps_header';
		$enem_contents 	= 'main/apps/dashboard/enem_dashboard';
		$enem_footer 	= 'layouts/enem_apps/partials/footer/apps_footer';
		$js				= $this->enem_js->js_dashboard();

		$this->load->view('layouts/enem_apps/apps_main',get_defined_vars());
	}
}
