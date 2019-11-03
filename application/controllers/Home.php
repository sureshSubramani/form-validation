<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

        function __construct() {
                parent::__construct();
                $this->load->model('Validate_model', 'vm');
        }

	public function index()
	{
                //$this->load->view('includes/header')
                $this->load->view('home');
                //$this->load->view('includes/footer')
        }

        public function validation(){
                
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('subject', 'Subject', 'required');
                $this->form_validation->set_rules('message', 'Message', 'required');
                
                        if($this->form_validation->run()){                                
                                $array = array(
                                'success' => '<div class="alert alert-success">Thank you for Contact Us</div>'
                                );
                                //$this->load->view('home');
                        }
                        else
                        {
                                $array = array(
                                'error'   => true,
                                'name_error' => form_error('name'),
                                'email_error' => form_error('email'),
                                'subject_error' => form_error('subject'),
                                'message_error' => form_error('message')
                                );
                        }

                echo json_encode($array);
        }
        
        public function insert(){
                print_r($this->input->post('first_name')); exit;
                //$form_data = json_decode(trim(file_get_contents('php://input')), true);
                $form_data = json_decode(file_get_contents("php://input"));
                $data = array();
                $error = array();
                
                if(empty($form_data->first_name))
                {
                 $error["first_name"] = "First Name is required";
                 $this->load->view('dashboard', $error["first_name"]);
                }
                
                if(empty($form_data->last_name))
                {
                 $error["last_name"] = "Last Name is required";
                 $this->load->view('dashboard', $error["last_name"]);
                }
                
                if(!empty($error))
                {
                 $data["error"] = $error;
                }
                else
                {
                 $first_name = mysqli_real_escape_string($connect, $form_data->first_name); 
                 $last_name = mysqli_real_escape_string($connect, $form_data->last_name);
                 $query = "INSERT INTO tbl_user(first_name, last_name) VALUES ('$first_name', '$last_name')";
                 if(mysqli_query($connect, $query))
                 {
                  $data["message"] = "Data Inserted...";
                 }
                }
                
                echo json_encode($data);
        }
}