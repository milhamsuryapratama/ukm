<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class semprul_model extends CI_Model
{
    public function dataProduk($keyword,$perpage,$offset)
    {
        $query = $this->db->select('*')
                          ->from('produk')
                          ->join('seller', 'seller.nama = produk.username')
                          ->order_by('produk.id_produk', 'DESC')
                          ->like('produk.nama_produk', $keyword)
                          ->get('',$perpage,$offset)->result();
        return $query;
    }

    public function dataProdukByToko($session)
    {
        $query = $this->db->query("SELECT * FROM produk JOIN seller ON seller.nama = produk.username WHERE produk.username = '$session' ORDER BY produk.id_produk DESC")->result();
        return $query;
    }

    public function hitung_produk($keyword)
    {
        $query = $this->db->select('*')
                ->from('produk')   
                ->like('nama_produk', $keyword)         
                ->get('');
        return $query;
    }

    public function getProduk($prdkSlug)
    {
        $this->db->select("*");
		$this->db->from('produk');
        $this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk = produk.id_kategori_produk');
        $this->db->join('ukuran', 'ukuran.id_produk = produk.id_produk');
        $this->db->where('produk.produk_slug', $prdkSlug);
		$query = $this->db->get();						
		return $query;
    }

    public function getProdukNoUkuran($prdkSlug)
    {
        $this->db->select("*");
        $this->db->from('produk');
        $this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk = produk.id_kategori_produk');
        $this->db->where('produk.produk_slug', $prdkSlug);
        $query = $this->db->get();                      
        return $query;
    }

    public function getProdukByKategori($slug)
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk = produk.id_kategori_produk');
        $this->db->join('seller', 'seller.nama = produk.username');
        $this->db->where('kategori_produk.kategori_slug', $slug);
        $this->db->order_by('produk.id_produk', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function tambahKeranjang($data)
    {
    	return $this->db->insert('order_temp', $data);
    }

    public function getKeranjang($session)
    {
    	$this->db->select("*");
		$this->db->from('order_temp');
		$this->db->join('produk', 'order_temp.id_produk = produk.id_produk');
		$this->db->where('id_session', $session);
		$query = $this->db->get();
		return $query->result_array();
    }

    public function getKeranjangBySession($session)
    {
        $this->db->select("*");
        $this->db->from('order_temp');
        $this->db->join('produk', 'order_temp.id_produk = produk.id_produk');
        // $this->db->join('seller', 'produk.username = seller.nama');
        // $this->db->join('admin', 'produk.username = admin.username');
        $this->db->where('order_temp.id_session', $session);
        $this->db->where('order_temp.status', 'N');
        $this->db->group_by('produk.username');
        $this->db->order_by('order_temp.id_order_temp', 'DESC');
        $this->db->order_by('produk.username', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
        // return $this->db->query("SELECT DISTINCT produk.username, id_ukuran FROM produk JOIN order_temp ON produk.id_produk = order_temp.id_produk")->result_array();
    }

    public function order_checkot($session)
    {
        $this->db->select("*");
        $this->db->from('order_temp');
        $this->db->join('produk', 'order_temp.id_produk = produk.id_produk');
        $this->db->where('order_temp.id_session', $session);
        $this->db->where('order_temp.status', 'Y');
        $this->db->group_by('produk.username');
        $this->db->order_by('order_temp.id_order_temp', 'DESC');
        $this->db->order_by('produk.username', 'DESC');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function cancleCheckout($id)
    {
        return $this->db->update('order_temp', array('id_order_temp' => $id));
    }

    public function hapus_keranjang($id_order_temp)
    {
        return $this->db->delete('order_temp', array('id_order_temp' => $id_order_temp));
    }

    public function getSumKeranjang($id)
    {
        $this->db->select('total');
        $this->db->from('order_temp');
        $this->db->where('id_order_temp', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_status_keranjang($id)
    {
        $this->db->where('id_order_temp', $id);
        return $this->db->update('order_temp', array('status' => 'Y'));
    }

    public function getUser($session)
    {
        $this->db->select("*");
        $this->db->from('user');
        $this->db->where('id_session', $session);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getseller($session)
    {
        $this->db->select("*");
        $this->db->from('seller');
        $this->db->where('id_session_seller', $session);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function insertTrx($data)
    {
        return $this->db->insert('transaksi', $data);
    }

    public function deleteKeranjang_afterOrder($session)
    {
        return $this->db->delete('order_temp', array(
            'id_session' => $session,
            'status' => 'Y'
        ));
    }

    public function getTransaksiDetail($trx)
    {
        $this->db->select("*");
        $this->db->from("transaksi");
        $this->db->where("kode_transaksi", $trx);   
        $query = $this->db->get();
        return $query->row();
    }

    public function totalBayar($trx)
    {
        $total = $this->db->query("SELECT sum(total+ongkir) as total FROM transaksi_detail WHERE kode_transaksi = '".$trx."'");
        return $total->row_array();
    }

    public function update_stok($id,$jml)
    {
      
        return $this->db->query("UPDATE produk set stok = stok-'$jml' WHERE id_produk = '$id'");
    }

    public function update_stok_ukuran($id,$jml)
    {
      
        return $this->db->query("UPDATE ukuran set stok_ukuran = stok_ukuran-'$jml' WHERE id = '$id'");
    }

    public function simpanKonfirmasiBayar($data)
    {
        return $this->db->insert('konfirmasi', $data);
    }

    public function getHistoryBelanja($session,$perpage,$offset)
    {
        

        $query = $this->db->select('*')
                          ->from('transaksi')
                          ->where('id_pembeli', $session)
                          ->order_by('id_transaksi', 'DESC')
                          ->get('',$perpage,$offset);
        return $query;
    }
}

?>