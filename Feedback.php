<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Feedback extends MY_Controller {
	public $table = 'tbl_feedback';
	public $page  = 'Feedback';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Feedback_model');
	}
	public function index()
	{
		$template['body'] = 'Feedback/list';
		$template['script'] = 'Feedback/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('feedback_content', 'Content', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Feedback/add';
			$template['script'] = 'Feedback/script';
			$this->load->view('template', $template);
		}
		else {
			$data = array(
						'feedback_username' => $this->session->userdata['user_name'],
						'feedback_content' => $this->input->post('feedback_content'),
						'feedback_status' => 1
						);
				
				$result = $this->General_model->add($this->table,$data);
				$response_text = 'Feedback added  successfully';

				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	        redirect('/Feedback/add', 'refresh');
		}
	}

	public function get(){
		$this->load->model('Feedback_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Feedback_model->getServicesTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $feedback_id = $this->input->post('feedback_id');
        $updateData = array('feedback_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'feedback_id',$feedback_id);
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
		redirect('/Feedback/', 'refresh');
    }
	public function edit($feedback_id){
		$template['body'] = 'Feedback/add';
		$template['script'] = 'Feedback/script';
		$template['records'] = $this->General_model->get_row($this->table,'feedback_id',$feedback_id);
    	$this->load->view('template', $template);
	}
}