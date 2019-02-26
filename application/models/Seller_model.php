<?php 
/**
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller_model extends CI_Model
{
	public function getProdukSeller($session)
	{
		$this->db->select("*");
		$this->db->from('produk');
		$this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk = produk.id_kategori_produk');
		$this->db->where('username', $session);
        $this->db->order_by('id_produk', 'DESC');
		return $query = $this->db->get();
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

    public function tes_save($image) {
        $data = array(
            'harga_jual' => '240',
            'jumlah' => '2',
            'file' => $image
        );
        return $this->db->insert('test', $data);
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
                'harga_konsumen' => $this->input->post('harga'),
                'berat' => $this->input->post('berat'),
                'diskon' => $this->input->post('diskon'),
                'keterangan' => $this->input->post('deskripsi'),
                'username' => $this->session->userdata('usernameSeller'),
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
                'harga_konsumen' => $this->input->post('harga'),
                'berat' => $this->input->post('berat'),
                'diskon' => $this->input->post('diskon'),
                'keterangan' => $this->input->post('deskripsi'),
                'username' => $this->session->userdata('usernameSeller'),
                'waktu_input' => date('Y-m-d H:i:s')
            );
            $this->db->where('id_produk', $id_produk);
            return $this->db->update('produk', $dataProduk);
        }
    }

    public function getProdukId($id_produk = FALSE)
    {
        $query = $this->db->get_where('produk', array('id_produk' => $id_produk));
		return $query->row_array();
    }

    public function getUkuranById($id) {
        return $this->db->query("SELECT * FROM ukuran WHERE id_produk = '$id' ")->result_array();
    }

    public function hapus_produk($id_produk)
    {
        return $this->db->delete('produk', array('id_produk' => $id_produk));
    }

    public function getKategori($session)
    {
        return $this->db->get_where('kategori_produk', array('id_seller' => $session))->result_array();
    }

    public function tambahKategori($data)
    {
        return $this->db->insert('kategori_produk', $data);
    }

    public function editKategori($id, $data)
    {
        $this->db->where('id_kategori_produk', $id);
        return $this->db->update('kategori_produk', $data);
    }

    public function hapusKategori($id)
    {
        return $this->db->delete('kategori_produk', array('id_kategori_produk' => $id));
    }

    public function getMyTrx($session)
    {        
    	return $this->db->join('transaksi', 'transaksi.kode_transaksi = transaksi_detail.kode_transaksi')->join('konfirmasi', 'konfirmasi.kode_transaksi = transaksi.kode_transaksi')->get_where('transaksi_detail', array('penjual' => $session));
    }

    public function update_orders_status($id, $st)
    {
        $this->db->where('id_transaksi_detail', $id);
        return $this->db->update('transaksi_detail', array('status' => $st));
    }

    public function getUkuran2($id)
    {
        return $this->db->query("SELECT id, count(id_produk) as ids, ukuran FROM ukuran WHERE id_produk = '$id'")->row_array();
    }
}

 ?>