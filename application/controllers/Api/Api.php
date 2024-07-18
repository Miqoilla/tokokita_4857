<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mbarang'); // Load model Mbarang
    }

    // GET /api/barang (Get all barang or specific barang by id)
    public function index_get()
    {
        // Ambil semua data barang dari model Mbarang
        $list_barang = $this->Mbarang->getAllBarang();

        // Hitung jumlah barang
        $jumlah_barang = count($list_barang);

        if ($list_barang) {
            $this->response([
                'status' => true,
                'jumlah' => $jumlah_barang,
                'list_barang' => $list_barang,
            ], 200); // Kode status HTTP_OK dapat digunakan langsung sebagai angka 200
        } else {
            $this->response([
                'status' => false,
                'pesan' => 'Data barang tidak ditemukan'
            ], 404); // Kode status HTTP_NOT_FOUND dapat digunakan langsung sebagai angka 404
        }
    }

    public function index_get_by_id_get()
    {
        // Ambil nilai 'id' dari parameter GET
        $id = $this->input->get('id');

        if (!empty($id)) {
            // Panggil model untuk mendapatkan barang berdasarkan ID
            $barang = $this->Mbarang->getBarangById($id);

            if ($barang) {
                // Jika barang ditemukan, kirim respons dengan status 200 OK
                $this->response([
                    'status' => true,
                    'data_barang' => $barang,
                ], 200);
            } else {
                // Jika barang tidak ditemukan, kirim respons dengan status 404 Not Found
                $this->response([
                    'status' => false,
                    'pesan' => 'Barang dengan ID ' . $id . ' tidak ditemukan'
                ], 404);
            }
        } else {
            // Jika parameter 'id' kosong, kirim respons dengan status 400 Bad Request
            $this->response([
                'status' => false,
                'pesan' => 'Silahkan isi parameter ID barang'
            ], 400);
        }
    }

    public function index_post()
    {
        // Memastikan field yang dibutuhkan
        $required_fields = ['nama_barang', 'harga', 'deskripsi', 'stok'];

        foreach ($required_fields as $field) {
            if (!$this->input->post($field)) {
                return [
                    'status' => false,
                    'message' => "Field '$field' is required"
                ];
            }
        }

        // Konfigurasi untuk upload gambar
        $config['upload_path'] = './uploads/';  // Sesuaikan dengan direktori tempat menyimpan gambar
        $config['allowed_types'] = 'gif|jpg|jpeg|png';  // Jenis file yang diperbolehkan
        $config['max_size'] = 2048;  // Maksimum ukuran file (dalam KB)
        $config['encrypt_name'] = true;  // Enkripsi nama file

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar')) {
            $error = array('error' => $this->upload->display_errors());
            $this->response([
                'status' => false,
                'message' => 'Failed to upload image',
                'error' => $error
            ], 400);
        } else {
            // Jika upload berhasil, dapatkan nama file yang diupload
            $upload_data = $this->upload->data();
            $gambar = $upload_data['file_name'];

            // Data untuk disimpan ke database
            $data = [
                'nama_barang' => $this->input->post('nama_barang'),
                'harga' => $this->input->post('harga'),
                'deskripsi' => $this->input->post('deskripsi'),
                'stok' => $this->input->post('stok'),
                'gambar' => $gambar  // Simpan nama file gambar
            ];

            // Memanggil model untuk menyimpan data barang
            $create = $this->Mbarang->insertBarang($data);

            if ($create) {
                $this->response([
                    'status' => true,
                    'message' => 'Barang created successfully',
                    'data' => $data
                ], 201);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Failed to create barang'
                ], 500);
            }
        }
    }

    public function index_put()
    {
        $id = $this->put('id'); // ID barang yang akan diupdate
        $data = [
            'nama_barang' => $this->put('nama_barang'),
            'deskripsi' => $this->put('deskripsi'),
            'harga' => $this->put('harga'),
            'stok' => $this->put('stok'),
            'gambar' => $this->put('gambar')
        ];

        $update = $this->Mbarang->updateBarang($id, $data);

        if ($update) {
            $this->response([
                'status' => true,
                'message' => 'Barang updated successfully'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to update barang'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id'); // Ambil ID barang dari request DELETE

        // Lakukan penghapusan berdasarkan ID menggunakan model Mbarang
        $delete = $this->Mbarang->deleteBarang($id);

        // Berikan respons berdasarkan hasil penghapusan
        if ($delete) {
            $this->response([
                'status' => true,
                'message' => 'Barang berhasil dihapus'
            ], RestController::HTTP_OK); // 200 OK
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal menghapus barang atau barang tidak ditemukan'
            ], RestController::HTTP_INTERNAL_ERROR); // 500 Internal Server Error atau HTTP_NOT_FOUND jika sesuai
        }
    }
}
