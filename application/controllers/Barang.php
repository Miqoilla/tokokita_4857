<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mbarang');
    }

    public function index(){
        $data['barang'] = $this->Mbarang->getAllBarang();
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/menu');
        $this->load->view('admin/barang/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function add(){
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/menu');
        $this->load->view('admin/barang/form_add');
        $this->load->view('admin/layout/footer');
    }

    public function save() {
        // Konfigurasi upload
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2048; // 2MB
        $this->load->library('upload', $config);
    
        if ($this->upload->do_upload('gambar')) {
            $upload_data = $this->upload->data();
            $gambar = $upload_data['file_name'];
        } else {
            $gambar = NULL;
        }
    
        // Bersihkan input harga
        $harga = str_replace('.', '', $this->input->post('harga'));
    
        $data = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'deskripsi' => $this->input->post('deskripsi'),
            'harga' => $harga,
            'stok' => $this->input->post('stok'),
            'gambar' => $gambar
        );
    
        $result = $this->Mbarang->insertBarang($data);
    
        if ($result) {
            $this->session->set_flashdata('success', 'Barang berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan barang!');
        }
    
        redirect('barang/index');
    }
    

    public function edit($id){
        $data['barang'] = $this->Mbarang->getBarangById($id);

        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/menu');
        $this->load->view('admin/barang/form_edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function update(){
        $id = $this->input->post('id');

        // Konfigurasi upload
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2048; // 2MB
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            $upload_data = $this->upload->data();
            $gambar = $upload_data['file_name'];
        } else {
            $gambar = $this->input->post('gambar_lama'); // Jika tidak ada gambar baru, gunakan gambar lama
        }

        $data = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'deskripsi' => $this->input->post('deskripsi'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'gambar' => $gambar
        );

        $result = $this->Mbarang->updateBarang($id, $data);

        if ($result) {
            $this->session->set_flashdata('success', 'Barang berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui barang!');
        }

        redirect('barang/index');
    }

    public function delete($id){
        $result = $this->Mbarang->deleteBarang($id);

        if ($result) {
            $this->session->set_flashdata('success', 'Barang berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus barang!');
        }

        redirect('barang/index');
    }
}
