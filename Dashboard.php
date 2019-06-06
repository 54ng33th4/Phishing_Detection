<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Controller {
	public $page  = 'Dashboard';
	public $table_info = 'tbl_companyinfo';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
		
        }
        
        $this->load->model('General_model');
		$this->load->model('Dashboard_model');
		$this->load->model('Fetch_data');
		$this->load->model('Blacklist_model');
        
	}
	public function index()
	{
		$template['body'] = 'Dashboard/list';
		$template['script'] = 'Dashboard/script';
		$this->load->view('template', $template);
	}
	
	public function get(){
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$start_date =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
        $end_date =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		if($start_date){
            $start_date = str_replace('/', '-', $start_date);
            $param['start_date'] =  date("Y-m-d",strtotime($start_date));
        }
       
        if($end_date){
            $end_date = str_replace('/', '-', $end_date);
            $param['end_date'] =  date("Y-m-d",strtotime($end_date));
        }
		
		$data = $this->Companyinfo_model->getCompanyinfoTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function view(){
					
		$template['body'] = 'Dashboard/list';
		$template['script'] = 'Dashboard/script';
		//$template['bl_domainname']  = $this->Blacklist_model->view_by();
		$this->load->view('template', $template);
			
		}
	public function bl_data(){
		$bl_domainname = $this->input->post('domainname');
		$result=$this->Fetch_data->blacklist($bl_domainname);
		echo json_encode($result);
	}
	}