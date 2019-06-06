<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller{
	public $table = 'tbl_login';
    function __construct() {
        parent::__construct();
		
		$this->load->model('General_model');
        $this->load->model('Registermodel');
    }
    public function index()
	{
        $this->load->view('Register/register');
    }
	
	public function add(){
		$this->form_validation->set_rules('name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Register/register');
		}
		else {
			$datas = array(
						'name' => $this->input->post('name'),
						'user_name' => $this->input->post('username'),
						'password' => $this->input->post('password'),
						'user_type' => "U",
						'login_status' => 1,
						);
				$result = $this->General_model->add($this->table,$datas);
				$response_text = 'User Registration Successfull.. Please Login';
			if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
	        redirect('/Login/', 'refresh');
		}
	}
}
?>
