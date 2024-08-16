<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Admin extends CI_Controller {
	
	function __construct(){
        parent::__construct();
		$this->load->model('admin_model');
        }

	public function index()
	{	
		redirect('admin/login');
	}
	public function login()
	{	   
		$this->load->view('wrapper_admin'); 
	}
	public function ck_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$type     = $this->input->post('type');
		$result   = $this->admin_model->user($username,$password,$type); 
		$appSetting = $this->admin_model->app_setting();
		if($result)
		{ 
			$sdata = array(
				'user_id'     =>  $result->id,
				'fullname'    =>  $result->fullname,
				'username'    =>  $result->username,
				'password'    =>  $result->password,
				'user_type'   =>  $result->type,
				'isLogin'     =>	TRUE,
				'title'       =>  (!empty($appSetting->title)?$appSetting->title:null),
				'address'     =>  (!empty($appSetting->address)?$appSetting->address:null),
				'footer_text' => (!empty($appSetting->footer_text)?$appSetting->footer_text:null),
			); 

			$this->session->set_userdata($sdata);
                       // $data['user_view'] = $this->admin_model->user_view();
			$this->admin_model->update(array('id'=>$result->id,'last_log_date' => date("Y-m-d h:i:s")));
			redirect('dashboard',$sdata) ;
		}
		else{
			$sdata['exception']='Username/Password Incorrect!';
			$this->session->set_userdata($sdata);
			redirect('admin');
		} 
	} 
	public function user_add(){ 
		if($this->session->userdata('isLogin') == FALSE || $this->session->userdata('user_type')!=9){
			redirect('admin');
		}
		#
		$this->form_validation->set_rules('fullname','Full Name','required|trim|max_length[50]');
		$this->form_validation->set_rules('username','Username','required|trim|is_unique[user.username]');
		$this->form_validation->set_rules('password','Password','required|trim|md5');
                $this->form_validation->set_rules('re_password', 'Repeat Password', 'required|md5|matches[password]');
		$this->form_validation->set_rules('type','User Type','required|trim');
		if($this->form_validation->run()==TRUE){
			$data = array(
				'fullname' => $this->input->post('fullname'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'type' => $this->input->post('type'),
				'last_log_date' => date("Y-m-d h:i:s")
				); 
			$this->admin_model->save($data); 
                        $this->session->set_flashdata('success', display('savesuccessfully'));
			redirect('admin/user_view');
		}
                else{ 
			$data['content'] = $this->load->view('pages/user_add','',TRUE);
			$this->load->view('wrapper_main',$data);
		}
	}

	public function user_view(){ 
		if($this->session->userdata('isLogin') == FALSE)
                {
                 redirect('admin');  
                } 
		#
		$data['user_view'] = $this->admin_model->user_view();
		$data['content'] = $this->load->view('pages/user_view',$data,TRUE);
		$this->load->view('wrapper_main',$data);
	}

	public function user_edit(){ 
		if($this->session->userdata('isLogin') == FALSE) {redirect('admin');}
		#  
		$this->form_validation->set_rules('fullname','Full Name','required|trim|max_length[50]');
		$this->form_validation->set_rules('old_password','Old Password','required|trim|md5|callback_old_password');
		$this->form_validation->set_rules('new_password','New Password','required|trim|md5');
		$this->form_validation->set_rules('re_password','Repeat Password','required|matches[new_password]|md5|trim');
		if($this->form_validation->run()==TRUE){
			$data = array(
				'id'       		=> $this->session->userdata('user_id'),
				'fullname' 		=> $this->input->post('fullname'), 
				'username' 		=> $this->input->post('username'), 
				'password' 		=> $this->input->post('re_password'), 
				'last_log_date' => date("Y-m-d h:i:s")
				); 
			$this->admin_model->update($data); 
                        $this->session->set_flashdata('success', display('updatesuccessfully'));
			redirect('admin/user_edit'); 
		} else{
			$data['user_info'] = $this->admin_model->user_by_id($this->session->userdata('user_id'));
			$data['content'] = $this->load->view('pages/user_edit',$data,TRUE);
			$this->load->view('wrapper_main',$data);			
		}
	} 

	public function old_password($password){ 
		$row = $this->db->where('password',$password)
					->where('id',$this->session->userdata('user_id'))
					->get('user')
					->num_rows(); 
		if($row == 1){  
			return TRUE;
		}else{
			$this->form_validation->set_message('old_password', 'The %s field does not match');
			return FALSE;
		} 
	}

	public function user_delete(){ 
		if($this->session->userdata('isLogin') == FALSE 
			|| $this->session->userdata('user_type')!=9) {
			redirect('admin');
		}
		#
		$data = array(
			'id'	=>	$this->uri->segment(3),
			'active'	=>	2,
			);
		$this->admin_model->update($data);
                $this->session->set_flashdata('success', display('deletesuccessfully'));
		redirect('admin/user_view');
	}

	public function active(){ 
		if($this->session->userdata('isLogin') == FALSE 
			|| $this->session->userdata('user_type')!=9) {
			redirect('admin');
		}
		#
		$data = array(
			'id'	=>	$this->uri->segment(3),
			'active'	=>	1,
			);
		$this->admin_model->update($data);
		redirect('admin/user_view');
	}

	public function inactive(){ 
		if($this->session->userdata('isLogin') == FALSE 
			|| $this->session->userdata('user_type')!=9) {
			redirect('admin');
		}
		#
		$data = array(
			'id'	=>	$this->uri->segment(3),
			'active'	=>	0,
			);
		$this->admin_model->update($data);
		redirect('admin/user_view');
	}

	public function logout(){ 
		$sdata = array(
			'user_id'   =>  '',
			'fullname'  =>  '',
			'username'  =>  '',
			'password'  =>  '',
			'user_type' =>  '',
			'isLogin'	=>	FALSE
			); 
		$this->session->set_userdata($sdata);
	    $this->session->sess_destroy();
	    redirect('admin');
	} 


	public function app_setting()
	{
		$this->form_validation->set_rules('title','Title','required');
		$this->form_validation->set_rules('address','Address','required');
		$this->form_validation->set_rules('footer_text','Footer Text','required');

		if($this->form_validation->run())
		{ 
			$this->admin_model->app_setting_update(array(
				'id' 		    => $this->input->post('id'), 
				'title' 		=> $this->input->post('title'), 
				'address' 		=> $this->input->post('address'), 
				'footer_text'   => $this->input->post('footer_text'), 
			)); 

			$appSetting = $this->admin_model->app_setting();
			$sdata = array(
				'title'     =>  (!empty($appSetting->title)?$appSetting->title:null),
				'address'   =>  (!empty($appSetting->address)?$appSetting->address:null),
				'footer_text' => (!empty($appSetting->footer_text)?$appSetting->footer_text:null),
			); 
			$this->session->set_userdata($sdata);
                        $this->session->set_flashdata('success', display('updatesuccessfully'));
			redirect('admin/app_setting'); 
		} 
		else
		{ 
			$data['apps']    = $this->admin_model->app_setting();
			$data['content'] = $this->load->view('pages/app_setting', $data, true);
			$this->load->view('wrapper_main',$data);			
		}
	}
} 
