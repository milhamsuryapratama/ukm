<?php 

/**
 * 
 */
class Orders extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
    }

    public function tracking($kode)
    {
        $data['title'] = "Tracking";
        $session = $this->session->userdata('sessionUser');

        $q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
        $da['jmlKeranjang'] = $q->num_rows();
        $data['kategori'] = $this->Admin_model->getKategori();

        $kfrm = $this->db->query("SELECT * FROM konfirmasi WHERE kode_transaksi = '$kode'")->num_rows();
        if ($kfrm > 0) {
            $data['rows'] = $this->db->query("SELECT * FROM transaksi a JOIN user b ON a.id_pembeli = b.id_session JOIN konfirmasi c ON a.kode_transaksi = c.kode_transaksi WHERE a.kode_transaksi = '$kode'")->row_array();
            $data['sel'] = $this->db->query("SELECT * FROM transaksi a JOIN seller b ON a.id_pembeli = b.id_session_seller JOIN konfirmasi c ON a.kode_transaksi = c.kode_transaksi WHERE a.kode_transaksi = '$kode'")->row_array();
        } else {
            $data['rows'] = $this->db->query("SELECT * FROM transaksi a JOIN user b ON a.id_pembeli = b.id_session WHERE a.kode_transaksi = '$kode'")->row_array();
            $data['sel'] = $this->db->query("SELECT * FROM transaksi a JOIN seller b ON a.id_pembeli = b.id_session_seller WHERE a.kode_transaksi = '$kode'")->row_array();
        }

        $kota = $this->rajaongkir->city();
        $provinsi = $this->rajaongkir->province();

        $data['kota'] = json_decode($kota, true);   
        $data['provinsi'] = json_decode($provinsi, true); 

        $data['record'] = $this->db->query("SELECT a.*, b.*, c.* FROM `transaksi` a JOIN transaksi_detail b ON a.kode_transaksi=b.kode_transaksi JOIN produk c ON b.id_produk=c.id_produk WHERE a.kode_transaksi='".$kode."'")->result_array();

        $data['total'] = $this->db->query("SELECT a.*, b.*, sum(b.total+b.ongkir) as total_bayar FROM `transaksi` a JOIN transaksi_detail b ON a.kode_transaksi=b.kode_transaksi WHERE a.kode_transaksi='".$kode."'")->row_array();

        $this->load->view('semprulshop/header_semprul', $data);
        $this->load->view('semprulshop/navbar', $da);
        $this->load->view('semprulshop/orders_tracking', $data);
        $this->load->view('semprulshop/footer_semprul');
    }
}
 ?>