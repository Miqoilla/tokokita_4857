<?php
class Adminpanel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model yang dibutuhkan
        $this->load->model('Madmin');
        $this->load->model('Mbarang');
    }

    public function index() {
        $this->load->view('admin/login');
    }

    public function dashboard() {
        // Periksa apakah pengguna sudah masuk (gunakan session atau kondisi lain sesuai kebutuhan)
        if (empty($this->session->userdata('userName'))) {
            // Jika tidak ada session userName, redirect ke halaman login atau halaman sesuai kebijakan Anda
            redirect('adminpanel'); // Sesuaikan dengan halaman yang tepat
        }
    
        // Load view untuk dashboard dengan layout header, menu, dan footer
        $data['barang'] = $this->Mbarang->getAllBarang(); // Ambil data barang dari model
    
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/menu');
        $this->load->view('admin/dashboard', $data); // Kirim data barang ke view dashboard
        $this->load->view('admin/layout/footer');
    }
    

    public function login() {
        $u = $this->input->post('username');
        $p = $this->input->post('password');
        
        $cek = $this->Madmin->cek_login($u, $p);
        
        if($cek) {
            $user_data = $this->Madmin->get_user_by_username($u); // Ambil data pengguna berdasarkan username
            
            $data_session = array(
                'userName' => $u,
                'userNameDisplay' => $user_data->name, // Simpan nama pengguna di session
                'status' => 'login'
            );
            $this->session->set_userdata($data_session);
            $this->session->set_flashdata('success_message', 'Login berhasil.');
            redirect('adminpanel/dashboard');
        } else {
            $this->session->set_flashdata('error_message', 'Username atau password salah.');
            redirect('adminpanel');
        }
    }
    

    public function logout() {
        $this->session->sess_destroy();
        redirect('adminpanel');
    }

    public function register() {
        $this->load->view('admin/register');
    }

    public function register_action() {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $data = array(
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        );

        $this->Madmin->register($data);
        $this->session->set_flashdata('success_message', 'Registrasi berhasil. Silakan login.');
        redirect('adminpanel');
    }
}

?>
