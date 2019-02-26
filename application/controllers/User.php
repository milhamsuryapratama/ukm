<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class User extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function data() {
		$b = $this->uri->segment('3');	

		$data['kategori'] = $this->Admin_model->getKategori();
		$session = $this->session->userdata('sessionUser');

		$da['jmlKeranjang'] = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'")->num_rows();	
		$data['user'] = $this->db->query("SELECT * FROM user WHERE id_session = '$b' ")->row_array();

		$kota = $this->rajaongkir->city();
        $provinsi = $this->rajaongkir->province();

        $data['kota'] = json_decode($kota, true);   
        $data['provinsi'] = json_decode($provinsi, true); 

		$this->load->view('semprulshop/header_semprul', $data);
        $this->load->view('semprulshop/navbar', $da);
        $this->load->view('semprulshop/data_user', $data);
        $this->load->view('semprulshop/footer_semprul');
	}
}

 ?>