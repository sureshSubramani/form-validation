<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_records extends CI_Controller {


	public function index()
	{
        //$this->load->view('includes/header')
        $this->load->view('dashboard');
       // $this->load->view('includes/footer')
    }
    
    public insert(){
            $form_data = json_decode(file_get_contents("php://input"));
            $data = array();
            $error = array();
            
            if(empty($form_data->first_name))
            {
             $error["first_name"] = "First Name is required";
             $this->load->view('dashboard',$error);
            }
            
            if(empty($form_data->last_name))
            {
             $error["last_name"] = "Last Name is required";
             $this->load->view('dashboard', $error);
            }
            
            if(!empty($error))
            {
             $data["error"] = $error;
            }
            else
            {
             $first_name = mysqli_real_escape_string($connect, $form_data->first_name); 
             $last_name = mysqli_real_escape_string($connect, $form_data->last_name);
             $query = "
              INSERT INTO tbl_user(first_name, last_name) VALUES ('$first_name', '$last_name')
             ";
             if(mysqli_query($connect, $query))
             {
              $data["message"] = "Data Inserted...";
             }
            }
            
            echo json_encode($data);
    }
}
