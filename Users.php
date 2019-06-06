<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends MY_Controller {
	public $table = 'tbl_login';
	public $page  = 'Users';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
		}
        $this->load->model('General_model');
		$this->load->model('Users_model');
        
	}
	public function index()
	{
		$template['body'] = 'Users/list';
		$template['script'] = 'Users/script';
		$this->load->view('template', $template);
	}
	public function get(){
		$this->load->model('Users_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Users_model->getCustomerTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
       
        $id = $this->input->post('id');
        $updateData = array('login_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'id',$id);                       
        if($data) {
            $response['text'] = 'Deleted successfully';
            $response['type'] = 'success';
        }
        else{
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;
        //redirect('/Users/', 'refresh');
    }
}