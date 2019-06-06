<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends MY_Controller {
	public $table = 'tbl_customer';
	public $page  = 'customer';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
		}
        $this->load->model('General_model');
		$this->load->model('Customer_model');
        
	}
	public function index()
	{
		$template['body'] = 'Customer/list';
		$template['script'] = 'Customer/script';
		$this->load->view('template', $template);
	}
	public function get(){
		$this->load->model('Customer_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Customer_model->getCustomerTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function add(){
		$this->form_validation->set_rules('cust_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Customer/add';
			$template['script'] = 'Customer/script';
			$this->load->view('template', $template);
		}
		else {
			$cust_gst = $this->input->post('cust_gst');
			if($cust_gst!=""){$cust_type="B2B";}else{$cust_type="B2C";}
			
			$datas = array(
						'cust_name' => $this->input->post('cust_name'),
						'cust_address' => $this->input->post('cust_address'),
						'cust_phone' => $this->input->post('cust_phone'),
						'cust_email' => $this->input->post('cust_email'),
						'cust_person' => $this->input->post('cust_person'),
						'cust_landmark' => $this->input->post('cust_landmark'),
						'cust_status' => 1,
						
						);
			$cust_id = $this->input->post('cust_id');
			if($cust_id){
				 
				$data['cust_id'] = $cust_id;
				$result = $this->General_model->update($this->table,$datas,'cust_id',$cust_id);
				$response_text = 'Customer details  updated';
			}
			else{
				$result = $this->General_model->add($this->table,$datas);
				$response_text = 'Customer details Added';
			}
			if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
	        redirect('/Customer/', 'refresh');
		}
	}
	public function edit($cust_id){
		$template['body'] = 'Customer/add';
		$template['script'] = 'Customer/script';
		$template['records'] = $this->General_model->get_row($this->table,'cust_id',$cust_id);
    	$this->load->view('template', $template);
	}
	public function delete(){
       
        $cust_id = $this->input->post('cust_id');
        $updateData = array('cust_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'cust_id',$cust_id);                       
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
        redirect('/Customer/', 'refresh');
    }
}