<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller 
{
 	function index()
	{
		$this->load->model('User');
		$this->load->view('signup_login');
	}

	function signup()
	{
		$this->load->model('User');
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required|min_length[10]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');

		if ($this->form_validation->run() === FALSE) 
        {
           	// Validation failed, reload the signup form with validation errors
			$data['error'] = 'Validation failed. Please check your input.';
			$this->load->view('signup_login', $data);
			return; // Stop further execution
        }
        else
        {
			$this->load->model('User');
			date_default_timezone_set('Asia/Manila');

			// Encrypt the password using md5
			$password = ($this->input->post('password'));
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$encrypted_password = md5($password . '' . $salt);

			// Check if email or contact number already exists
			$email_exists = $this->User->check_email_exists($this->input->post('email'));
			$contact_exists = $this->User->check_contact_exists($this->input->post('contact_number'));

			if ($email_exists || $contact_exists) 
			{
				// If email or contact number already exists, display error message
				$data['error'] = "Email or contact number already exists.";
				$this->load->view('signup_login', $data);
				return; 
			} 
			else 
			{
				// If email and contact number are unique, proceed with user creation
				$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'contact_number' => $this->input->post('contact_number'),
				'password' => $encrypted_password,
				'salt'=> $salt,
				'created_at' => date('Y-m-d h:i:a'),
				'updated_at' => date('Y-m-d h:i:a') );
			}

			$this->User->create_user($data);

			// Pass success message to the view
			$data['success'] = "Registration successful! You can now login.";
			$this->load->view('signup_login', $data);
			/* redirect('users'); */
		}
	}	

	function login()
	{
		// Load the User model
		$this->load->model('User');

		$contact_or_email = $this->input->post('contact_or_email');
		$password = $this->input->post('password');

		// Check if the user exists with the provided credentials
		$user = $this->User->login_user($contact_or_email, $password);

		if ($user) 
		{
			// If login is successful, load the user profile view and pass user data
			$data['user'] = $user;
			$this->load->view('users_profile', $data);
		} 
		else 
		{
			// If login fails, redirect back to login page with an error message
			$data['error'] = "Invalid credentials. Please try again.";
			$this->load->view('signup_login', $data);
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('users');
	}
}