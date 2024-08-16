<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Logo extends CI_Controller {
	
	public function __construct() {
            parent::__construct();
            $user_id = $this->session->userdata('user_id');
            if($user_id == NULL){redirect('admin');} 
               $this->load->model('logo_model');
        }

        public function index(){        
            
            $data['m_cmpny'] = ''; 
            $data['logo'] = $this->logo_model->logo_view(); 
            $data['content'] = $this->load->view('pages/logo_form',$data,TRUE);
            $this->load->view('wrapper_main',$data);

        }

//        public function create()
//	{
//		$config['allowed_types'] = 'jpg|jpeg|png';  
//		$config['remove_spaces'] = true;
//                $d_picture= $_FILES['d_picture']['name'];
//		if (!empty($d_picture))
//                {
//                  $config['allowed_types'] = 'jpg|jpeg|png'; 
//		  $config['upload_path'] = 'assets/logo/';
//		  $this->load->library('upload', $config);
//                  
//                 if (!$this->upload->do_upload('d_picture')){
//                   $this->form_validation->set_message('image_upload', $this->upload->display_errors());
//                   $this->session->set_flashdata('error', display('onlypngjpgjpegfileselected'));
//                   redirect('logo');
//                 }   
//		  else{
//			$upload_data	= $this->upload->data();
//			$data['d_picture']	= $upload_data['file_name'];
//		  }
//		}
//                $f_picture= $_FILES['f_picture']['name'];
//		if (!empty($f_picture))
//                {
//                  $config['allowed_types'] = 'jpg|jpeg|png';
//		  $config['upload_path'] = 'assets/logo/';
//		  $this->load->library('upload', $config);
//                   if (!$this->upload->do_upload('f_picture')){
//                       
//                     $this->form_validation->set_message('image_upload', $this->upload->display_errors());
//                     $this->session->set_flashdata('error', display('onlypngjpgjpegfileselected'));
//                     redirect('logo');
//                   } 
//		  else{
//                      $upload_data	= $this->upload->data();
//		      $data['f_picture']	= $upload_data['file_name'];
//		  }
//		}
//		$this->logo_model->save($data);	
//                $this->session->set_flashdata('success', display('savesuccessfully'));
//		redirect('logo/view');
//	}
        public function view(){
            $data['m_cmpny'] = ''; 
            $data['logo'] = $this->logo_model->logo_view(); 
            $data['content'] = $this->load->view('pages/logo_view',$data,TRUE);
            $this->load->view('wrapper_main',$data);
        }
       public function edit($id)
	{
            $data['edit']	= $this->logo_model->edit($id);
            $data['content'] = $this->load->view('pages/logo_edit',$data,TRUE);
            $this->load->view('wrapper_main',$data);
		
	}
        public function update()
	{
	    
            $d_picture= $_FILES['d_picture']['name'];
                 if(!empty($d_picture)){
                     if (isset($_FILES['d_picture']['name']))
                        {
                         $config['allowed_types'] = array('jpeg','jpg','png');
                         $config['upload_path'] = 'assets/logo/';
                         $this->load->library('upload', $config);
                            
                          if (!$this->upload->do_upload('d_picture')){
                            $this->form_validation->set_message('image_upload', $this->upload->display_errors());
                            $this->session->set_flashdata('error', display('only_png_jpg_jpeg_file_selected'));
                            redirect('logo');
                          }
                          else{
                                $upload_data	= $this->upload->data();
                                $data['d_picture']	= $upload_data['file_name'];
                          }
                        }
                 }
		
                $f_picture= $_FILES['f_picture']['name'];
                if(!empty($f_picture)){
                    if (isset($_FILES['f_picture']['name']))
                    {
                      $config['allowed_types'] = array('jpeg','jpg','png');
                      $config['upload_path'] = 'assets/logo/';
                      $this->load->library('upload', $config);
                        
                      if (!$this->upload->do_upload('f_picture')){
                        $this->form_validation->set_message('image_upload', $this->upload->display_errors());
                        $this->session->set_flashdata('error', display('only_png_jpg_jpeg_file_selected'));
                        redirect('logo');
                      }
                      else{
                            $upload_data	= $this->upload->data();
                            $data['f_picture']	= $upload_data['file_name'];
                      }
                    }
                }

                $data['logo_id']		= $this->input->post('logo_id');		
		$this->logo_model->update($data);
                $this->session->set_flashdata('success', display('updatesuccessfully'));
		redirect('logo');
	}
        public function delete($id){
            $data['edit']	= $this->logo_model->delete($id);
            $this->session->set_flashdata('success', display('deletesuccessfully'));
            redirect('logo');
        }	
} 
