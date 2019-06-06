<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blacklist extends MY_Controller {
	public $table = 'tbl_blacklist';
	public $page  = 'Blacklist';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
		}
        $this->load->model('General_model');
		$this->load->model('Blacklist_model');
        
	}
	public function index()
	{
		$template['body'] = 'Blacklist/list';
		$template['script'] = 'Blacklist/script';
		$this->load->view('template', $template);
	}
	public function get(){
		$this->load->model('Blacklist_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Blacklist_model->getCustomerTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function add(){
		$this->form_validation->set_rules('bl_domainname', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Blacklist/add';
			$template['script'] = 'Blacklist/script';
			$this->load->view('template', $template);
		}
		else {
			$datas = array(
						'bl_domainname' => $this->input->post('bl_domainname'),
						'bl_domainid' => $this->input->post('bl_domainid'),
						'bl_registrar' => $this->input->post('bl_registrar'),
						'bl_nameserver' => $this->input->post('bl_nameserver'),
						'bl_domaincreated' => $this->input->post('bl_domaincreated'),
						'bl_domainexp' => $this->input->post('bl_domainexp'),
						'bl_secure' => $this->input->post('bl_secure'),
						'bl_status' => 1,
						
						);
			$bl_id = $this->input->post('bl_id');
			if($bl_id){
				 
				$data['bl_id'] = $bl_id;
				$result = $this->General_model->update($this->table,$datas,'bl_id',$bl_id);
				$response_text = 'Blacklist details  updated';
			}
			else{
				$result = $this->General_model->add($this->table,$datas);
				$response_text = 'Blacklist details Added';
			}
			if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
	        if($this->session->userdata['user_type']=='U'){
				redirect('/Dashboard/', 'refresh');
			}
			else{
				redirect('/Blacklist/', 'refresh');
			}	
		}
	}
	public function edit($bl_id){
		$template['body'] = 'Blacklist/add';
		$template['script'] = 'Blacklist/script';
		$template['records'] = $this->General_model->get_row($this->table,'bl_id',$bl_id);
    	$this->load->view('template', $template);
	}
	public function delete(){
       
        $bl_id = $this->input->post('bl_id');
        $updateData = array('bl_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'bl_id',$bl_id);                       
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
        redirect('/Blacklist/', 'refresh');
    }
}