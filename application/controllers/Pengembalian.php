<?php 

/**
 * 
 */
class Pengembalian extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function v($kode,$id,$session)
	{
		$data['title'] = "Ajukan Pengembalian";
		// $session = $this->session->userdata('sessionUser');

		$q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
	    $da['jmlKeranjang'] = $q->num_rows();  
	    $data['kategori'] = $this->Admin_model->getKategori();
	    $data['trxDetail'] = $this->db->query("SELECT * FROM transaksi_detail JOIN produk ON produk.id_produk = transaksi_detail.id_produk WHERE id_transaksi_detail = '".$id."'")->row_array();

		$this->load->view('semprulshop/header_semprul', $data);
        $this->load->view('semprulshop/navbar', $da);
        $this->load->view('semprulshop/pengembalian_dana', $data);
        $this->load->view('semprulshop/footer_semprul');
	}

	public function kirim() {
		$data['title'] = "Pengembalian Sukses";
		$session = $this->session->userdata('sessionUser');
		$id = $this->input->post('id');
		$noRek = $this->input->post('norek');
		$dataTrxDetail = $this->db->query("SELECT kode_transaksi,total,ongkir FROM transaksi_detail WHERE id_transaksi_detail = '".$id."' ")->row_array();
		$q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
	    $da['jmlKeranjang'] = $q->num_rows();  
	    $data['kategori'] = $this->Admin_model->getKategori();

	    if ($dataTrxDetail['id_transaksi_detail'] != '') {
	    	$data = array(
				'id_transaksi_detail' => $id,
				'kode_transaksi' => $dataTrxDetail['kode_transaksi'],
				'id_session' => $session,
				'no_rek' => $noRek,
				'total' => $dataTrxDetail['total'] + $dataTrxDetail['ongkir'],
				'waktu_pengajuan' => date('Y-m-d H:i:s'),
				'status_pengembalian' => '0'
			);
			$query = $this->db->insert('pengembalian', $data);

			if ($query) {
				redirect('pengembalian/sukses/#true');
			}
	    }else {
	    	echo '<script language="javascript">';
			echo 'alert("TRAKSAKSI INI TELAH MENGAJUKAN PENGEMBALIAN")';
			echo '</script>';
			redirect('pengembalian/v/'.$dataTrxDetail['kode_transaksi'].'/'.$id.'/'.$session.'/#true');
	    }
	}

	public function sukses()
	{
		$data['title'] = "Pengembalian Sukses";
		$session = $this->session->userdata('sessionUser');
		$q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
	    $da['jmlKeranjang'] = $q->num_rows();  
	    $data['kategori'] = $this->Admin_model->getKategori();

		$this->load->view('semprulshop/header_semprul', $data);
        $this->load->view('semprulshop/navbar', $da);
        $this->load->view('semprulshop/pengembalian_sukses', $data);
        $this->load->view('semprulshop/footer_semprul');
	}
}
 ?>