<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model 
{
    public function simpanAdmin($data)
    {
        return $this->db->insert('admin', $data);
    }

    public function cek_login($table, $where)
    {
        return $this->db->get_where($table,$where);
    }

    public function getKategori()
    {
        return $this->db->query("SELECT DISTINCT nama_kategori, kategori_slug FROM kategori_produk")->result_array();
    }

    public function getKategoriById($id = FALSE)
    {
        $query = $this->db->get_where('kategori_produk', array('id_kategori_produk' => $id));
		return $query->row_array();
    }

    public function tambahKategori($data)
    {
        return $this->db->insert('kategori_produk', $data);
    }

    public function hapusKategori($id)
    {
        return $this->db->delete('kategori_produk', array('id_kategori_produk' => $id));
    }

    public function editKategori($id, $data)
    {
        $this->db->where('id_kategori_produk', $id);
        return $this->db->update('kategori_produk', $data);
    }

    public function getProduk()
    {
        $this->db->select("*");
		$this->db->from('produk');
		$this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk = produk.id_kategori_produk');
        $this->db->order_by('id_produk', 'DESC');
		$query = $this->db->get();
		return $query->result();
    }

    public function tambahProduk($data)
    {
        return $this->db->insert('produk', $data);
    }

    public function getIdGambar($id_produk)
    {
        $this->db->from('produk');
		$this->db->where('id_produk', $id_produk);
		$result = $this->db->get('');
		if ($result->num_rows() > 0) {
			return $result->row();
		}
    }

    public function getProdukId($id_produk = FALSE)
    {
        $query = $this->db->get_where('produk', array('id_produk' => $id_produk));
		return $query->row_array();
    }

    public function hapus_produk($id_produk)
    {
        return $this->db->delete('produk', array('id_produk' => $id_produk));
    }

    public function edit_produk($id_produk,$file_name,$da)
    {
        if (!empty($file_name['file_name'])) {
            $dataProduk = array(
                'id_kategori_produk' => $this->input->post('kategori'),
                'nama_produk' => $this->input->post('nama_produk'),
                'produk_slug' => url_title($this->input->post('nama_produk'), 'dash', TRUE),
                'stok' => $this->input->post('stok'),
                'satuan' => $this->input->post('satuan'),
                'harga_modal' => $this->input->post('harga_modal'),
                'harga_reseller' => $this->input->post('harga_reseller'),
                'harga_konsumen' => $this->input->post('harga_konsumen'),
                'berat' => $this->input->post('berat'),
                'diskon' => $this->input->post('diskon'),
                'keterangan' => $this->input->post('keterangan'),
                'username' => $this->session->userdata('username'),
                'waktu_input' => date('Y-m-d H:i:s'),
                'gambar' => $file_name['file_name']
            );
            $path = 'assets/upload/gambar_produk/';
            @unlink($path.$da->gambar);
            $this->db->where('id_produk', $id_produk);
            return $this->db->update('produk', $dataProduk);
        } else {
            $dataProduk = array(
                'id_kategori_produk' => $this->input->post('kategori'),
                'nama_produk' => $this->input->post('nama_produk'),
                'produk_slug' => url_title($this->input->post('nama_produk'), 'dash', TRUE),
                'stok' => $this->input->post('stok'),
                'satuan' => $this->input->post('satuan'),
                'harga_modal' => $this->input->post('harga_modal'),
                'harga_reseller' => $this->input->post('harga_reseller'),
                'harga_konsumen' => $this->input->post('harga_konsumen'),
                'berat' => $this->input->post('berat'),
                'diskon' => $this->input->post('diskon'),
                'keterangan' => $this->input->post('keterangan'),
                'username' => $this->session->userdata('username'),
                'waktu_input' => date('Y-m-d H:i:s')
            );
            $this->db->where('id_produk', $id_produk);
            return $this->db->update('produk', $dataProduk);
        }
    }

    public function getTransaksi()
    {
        $this->db->order_by('id_transaksi', 'DESC');
        return $this->db->get('transaksi')->result_array();
        //return $this->db->query("SELECT transaksi.*, transaksi_detail.*, user.* FROM transaksi JOIN transaksi_detail ON transaksi.kode_transaksi = transaksi_detail.kode_transaksi JOIN user ON user.id_session = transaksi.id_pembeli WHERE transaksi_detail.kode_transaksi = transaksi.kode_transaksi")->result_array();
    }

    public function update_orders_status($id, $st)
    {
        $this->db->where('id_transaksi_detail', $id);
        return $this->db->update('transaksi_detail', array('status' => $st));
    }

    public function getRekening()
    {
        return $this->db->get('rekening')->result_array();
    }

    public function getUkuran2($id)
    {
        return $this->db->query("SELECT id, count(id_produk) as ids, ukuran FROM ukuran WHERE id_produk = '$id'")->row_array();
    }

    public function getSeller()
    {
        return $this->db->order_by('id_seller', 'DESC')->get('seller');
    }

    public function simpanSeller($data)
    {
        return $this->db->insert('seller', $data);
    }

    public function getSellerId($id)
    {
        return $this->db->get_where('seller', array('id_seller' => $id))->row_array();
    }

    public function editSeller($data, $id)
    {
        $this->db->where('id_seller', $id);
        return $this->db->update('seller', $data);
    }

    public function hapusSeller($id)
    {
        return $this->db->delete('seller', array('id_seller' => $id));
    }

    public function getPengembalian()
    {
        return $this->db->order_by('id')->get('pengembalian');
    }
}

?>