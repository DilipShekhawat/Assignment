<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library(array('form_validation','firebase'));
        $this->load->model('user'); //print_r();

        /* cache control */

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Access-Control-Allow-Origin: *');
        $this->output->set_header("Content-type: application/json");
    	
    }

   //Add Student Detail Record
   	public function CreateStudentDetail(){
		
		$json = array();

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$this->form_validation->set_error_delimiters('', '');
			
			$this->form_validation->set_rules('first_name','First Name','required');
            $this->form_validation->set_rules('last_name','Last Name','required');
            $this->form_validation->set_rules('parent_name','Parent Name','required');
            $this->form_validation->set_rules('mobileno','Mobile No','required|min_length[10]|max_length[10]|is_unique[students.mobileno]');
            $this->form_validation->set_rules('standard','Standard','required');
            $this->form_validation->set_rules('course','Course','required');
			$this->form_validation->set_rules('email', 'Email', 'valid_email|is_unique[students.email]');
			 if (isset($_FILES['birth_certificate']['name']) && empty($_FILES['birth_certificate']['name']))
            {
                $this->form_validation->set_rules('birth_certificate', 'Document', 'required');
            }
			if ($this->form_validation->run()) {
			  	$config = array(
				'upload_path' => "uploads/",
				'allowed_types' => "jpg|png|jpeg|pdf",
                'max_size' => "2048",
				'encrypt_name' => TRUE
    			);
    			$this->load->library('upload', $config);
                $this->upload->do_upload('birth_certificate');
                $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];
                    $data['first_name'] = $this->input->post('first_name');
                    $data['last_name'] = $this->input->post('last_name');
                    $data['parent_name'] = $this->input->post('parent_name');				
    				$data['mobileno'] = $this->input->post('mobileno');
    				$data['standard'] = $this->input->post('standard');
    				$data['course'] = $this->input->post('course');
    				$data['email'] = $this->input->post('email');
                    $data['birth_certificate'] = 'uploads/'.$image;
    				$data['created_at'] = date("Y-m-d H:i:s");

		    		$student_id =	$this->user->insert($data);
				    if($student_id){		    	
				    	$json['student_id'] = $student_id;
				    	$json['message'] = "Student Record Added Successfully.";
				    	$json['status'] = true;
				    }else{
				    	$json['message'] = "Failed to add student record. Try Again!";
						$json['status'] = false;
				    }
			} else {
	        	$json['message'] = validation_errors();
	        	$json['status'] = false;
			}	
		} else {
			$json['message'] = "POST Method Required";
			$json['status'] = false;
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
    
    //Delete Perticular Student Record
	public function DeleteStudentDetail($id){
	   $json = array();
	   $student_id =	$this->user->delete($id);
       $json['message'] = "Student Record Deleted Successfully";
	   $json['status'] = true;
       return $this->output->set_content_type('application/json')->set_output(json_encode($json));
       }
       
    //Fetch All Student Detail Record
	public function GetAllStudentDetail(){
	   $json = array();
	   $json['data'] =	$this->user->getAll();
       $json['message'] = "Student List";
	   $json['status'] = true;
       return $this->output->set_content_type('application/json')->set_output(json_encode($json));
       }
	
	//Update Student Detail
	public function UpdateStudentDetail($id){
		
		$json = array();

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$this->form_validation->set_error_delimiters('', '');
			
			$this->form_validation->set_rules('first_name','First Name','trim|required');
            $this->form_validation->set_rules('last_name','Last Name','required');
            $this->form_validation->set_rules('parent_name','Parent Name','required');
            $this->form_validation->set_rules('mobileno','Mobile No','required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('standard','Standard','required');
            $this->form_validation->set_rules('course','Course','required');
			$this->form_validation->set_rules('email', 'Email', 'valid_email');
            if (isset($_FILES['birth_certificate']['name']) && empty($_FILES['birth_certificate']['name']))
            {
                $this->form_validation->set_rules('birth_certificate', 'Document', 'required');
            }
			if ($this->form_validation->run()) {
			 $config = array(
				'upload_path' => "uploads/",
				'allowed_types' => "jpg|png|jpeg|pdf",
                'max_size' => "2048",
				'encrypt_name' => TRUE
    			);
    			$this->load->library('upload', $config);
                if (isset($_FILES['birth_certificate']['name']) && !empty($_FILES['birth_certificate']['name']))
                {
                 $this->upload->do_upload('birth_certificate');    
                 $upload_data = $this->upload->data();
   		    	 $image = $upload_data['file_name'];
                 $data['birth_certificate'] = 'uploads/'.$image;
                 
    			} 
	        	$data['first_name'] = $this->input->post('first_name');
                $data['last_name'] = $this->input->post('last_name');
                $data['parent_name'] = $this->input->post('parent_name');				
				$data['mobileno'] = $this->input->post('mobileno');
				$data['standard'] = $this->input->post('standard');
				$data['course'] = $this->input->post('course');
				$data['email'] = $this->input->post('email');
				$data['created_at'] = date("Y-m-d H:i:s");
		    		$student_id =	$this->user->update($id,$data);
				    if($student_id){		    	
				    	$json['student_id'] = $student_id;
				    	$json['message'] = "Student Record Updated Successfully.";
				    	$json['status'] = true;
				    }else{
				    	$json['message'] = "Failed to update student record. Try Again!";
						$json['status'] = false;
				    }
			} else {
	        	$json['message'] = validation_errors();
	        	$json['status'] = false;
			}	
		} else {
			$json['message'] = "POST Method Required";
			$json['status'] = false;
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	
}

?>