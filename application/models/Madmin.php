<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Madmin extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Metode untuk memeriksa login pengguna
    public function cek_login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        
        if($query->num_rows() > 0) {
            $result = $query->row();
            if(password_verify($password, $result->password)) {
                return true;
            }
        }
        return false;
    }

    // Metode untuk menyimpan data pengguna baru
    public function register($data) {
        $this->db->insert('user', $data);
    }

    public function get_user_by_username($username) {
        $this->db->where('username', $username);
        return $this->db->get('user')->row();
    }
    
}
?>
