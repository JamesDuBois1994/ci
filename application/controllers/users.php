<?php
 class Users extends CI_Controller {
 	public function login() {
 		// Form Validation
 		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');

 		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');

 		if ($this->form_validation->run() == FALSE) {
 			$data = array(
 				'errors' => validation_errors()
 				);

 			$this->session->set_flashdata($data);
 			redirect('home');
 		}
 		else {
 			$username = $this->input->post('username');
 			$password = $this->input->post('password');

 			// Pass Username and password to the user_model
 			$user_id = $this->user_model->login_user($username, $password);


 		}



 		//echo $this->input->post('username');

 		if ($user_id) {
 			$user_data= array(
 				'user_id' => $user_id,
 				'username' => $username,
 				'logged_in' => true

 				);

 			$this->session->set_userdata($user_data);
 			$this->session->set_flashdata('login_success', 'You are now logged in');
 			redirect('home/index');
 		}
 		else {
 			$this->session->set_flashdata('login_failed', 'Sorry login was not successful');
 			redirect('home/index');
 		}

 	}


 }
