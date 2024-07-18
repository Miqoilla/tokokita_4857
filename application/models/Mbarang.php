<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbarang extends CI_Model {

    public function getAllBarang() {
        return $this->db->get('barang')->result();
    }

    public function insertBarang($data) {
        $this->db->insert('barang', $data);
        return $this->db->insert_id(); // Mengembalikan ID dari record yang baru saja diinsert
    }

    public function getBarangById($id) {
        return $this->db->get_where('barang', ['id' => $id])->row();
    }

    public function updateBarang($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('barang', $data);
    }

    public function deleteBarang($id) {
        $this->db->where('id', $id);
        return $this->db->delete('barang');
    }
}
