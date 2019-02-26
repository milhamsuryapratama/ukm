<?php 

/**
 * 
 */
class Konfirmasi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{		
		if ($this->session->userdata('status') == 'userLoginSukses' || $this->session->userdata('sellerStatus') == 'sellerLogged'){
			$data['title'] = "Konfirmasi Pembayaran";
			$session = $this->session->userdata('sessionUser');

			$q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
	        $da['jmlKeranjang'] = $q->num_rows();        
	        $data['kategori'] = $this->Admin_model->getKategori();

			$this->load->view('semprulshop/header_semprul', $data);
			$this->load->view('semprulshop/navbar', $da);
			$this->load->view('semprulshop/konfirmasi');
			$this->load->view('semprulshop/footer_semprul');
		} else {
			redirect('auth/login/#true');
		}
				
	}

	public function cek()
	{
		$kode = $this->input->post('kode');

		$q = $this->db->query("SELECT * FROM transaksi WHERE kode_transaksi = '$kode'")->row_array();

		if (count($q['kode_transaksi']) != 0) {
			$h = $this->db->query("SELECT * FROM konfirmasi WHERE kode_transaksi = '$kode'")->row_array();
			if (count($h['kode_transaksi']) != 0) {
				echo "Transaksi Telah Dikonfirmasi";
			}
		} else {
			echo "Kode Transaksi Salah";
		}
	}

	public function detail($kode)
	{
		$data['title'] = "Konfirmasi Pembayaran";
		// $kode = $this->input->post('kode');
		$session = $this->session->userdata('sessionUser');

		$q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
        $da['jmlKeranjang'] = $q->num_rows();
        $data['kategori'] = $this->Admin_model->getKategori();

		// $kode = $this->input->post('kode_transaksi');

		$data['query'] = $this->db->query("SELECT a.*, b.*, sum(b.total+b.ongkir) as total FROM `transaksi` a JOIN transaksi_detail b ON a.kode_transaksi = b.kode_transaksi WHERE a.kode_transaksi = '$kode' ")->row_array();

		$this->load->view('semprulshop/header_semprul', $data);
		$this->load->view('semprulshop/navbar', $da);
		$this->load->view('semprulshop/konfirmasi_detail', $data);
		$this->load->view('semprulshop/footer_semprul');
	}

	public function simpan()
	{		

        $kode = $this->input->post('kode_transaksi');

		$config['upload_path'] = 'assets/upload/konfirmasi';
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->do_upload('bukti_tf');
        $file_name = $this->upload->data();     

		$datakonfirmasi = array(
			'kode_transaksi' => $kode,
			'total_transfer' => $this->input->post('total'),
			'id_rekening' => $this->input->post('rekening'),
			'nama_pengirim' => $this->input->post('nama_pengirim'),
			'tanggal_transfer' => $this->input->post('tanggal_konfirmasi'),
			'bukti_transfer' => $file_name['file_name'],
			'waktu_konfirmasi' => date('Y-m-d H:i:s')
		);
		
		$query = $this->Semprul_model->simpanKonfirmasiBayar($datakonfirmasi);
		if ($query) {
			$this->db->query("UPDATE transaksi_detail SET status = '1' where kode_transaksi = '$kode'");
			$this->db->query("UPDATE transaksi SET konfirmasi = '1' where kode_transaksi = '$kode'");

			$k = $this->db->query("SELECT waktu_konfirmasi FROM konfirmasi WHERE kode_transaksi = '".$kode."'")->row_array();
			$this->db->query("UPDATE transaksi_detail SET deadline_pengiriman = '".date('Y-m-d H:i:s', strtotime('+2 day', strtotime($k['waktu_konfirmasi'])))."' WHERE kode_transaksi = '".$kode."'");
			redirect("orders/tracking/".$kode."/#true");
		}
	}
}
 ?>