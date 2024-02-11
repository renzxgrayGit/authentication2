<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model
{
    function index()
    {
        $this->load->view('User');
    }

    function create_user($data)
    {
        $sql = "INSERT INTO users (first_name, last_name, email, contact_number, password, salt, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $data = array(
                    $data['first_name'],
                    $data['last_name'],
                    $data['email'],
                    $data['contact_number'],
                    $data['password'],
                    $data['salt'],
                    $data['created_at'],
                    $data['updated_at'] );

        return $this->db->query($sql, $data);
    }

    function check_email_exists($email)
    {
        $sql = "SELECT COUNT(*) AS count FROM users WHERE email = ?";
        $query = $this->db->query($sql, array($email)); 
        $row = $query->row_array();
        return $row['count'] > 0;   // Access 'count' as an array element
    }

    function check_contact_exists($contact_number)
    {
        $sql = "SELECT COUNT(*) AS count FROM users WHERE contact_number = ?";
        $query = $this->db->query($sql, array($contact_number));
        $row = $query->row_array();
        return $row['count'] > 0;
    }

    function login_user($contact_or_email, $password) 
    {
        // Run a SQL query to fetch user data based on contact number
        $sql = "SELECT * FROM users WHERE contact_number = ? OR email = ?";
        $query = $this->db->query($sql, array($contact_or_email, $contact_or_email));
        $user = $query->row();

        if ($user) // If user exist in database
        {
            // Extract stored password and salt
            $stored_password = $user->password;
            $salt = $user->salt;

            // Hash the provided password with the same salt
            $hashed_password = md5($password . $salt);

            // Compare hashed passwords
            if ($hashed_password === $stored_password) 
            {
                // Passwords match, return user data
                return $user;
            }
        }
        // If user doesn't exist or passwords don't match, return false
        return false;
    }
}