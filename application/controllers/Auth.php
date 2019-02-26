<?php 
/**
 * 
 */
class Auth extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function register()
	{
		$data['title'] = "Register User";
		$data['kategori'] = $this->Admin_model->getKategori();
		$session = $this->session->userdata('sessionUser');

		$da['jmlKeranjang'] = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'")->num_rows();

		$curlone = curl_init();	
		curl_setopt_array($curlone, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: c506cdfc35a33e3d47fb068b799c0630"
			),
		));

		$response1 = curl_exec($curlone);
		$err1 = curl_error($curlone);

		curl_close($curlone);

		$data['provinsi'] = json_decode($response1, true);

		$this->load->view('semprulshop/header_semprul', $data);
		$this->load->view('semprulshop/navbar', $da);
		$this->load->view('semprulshop/register', $data);
		$this->load->view('semprulshop/footer_semprul');

		if (isset($_POST['submit'])) {
			$user = strtolower($this->input->post('username'));
			$q = $this->db->query("SELECT * FROM user WHERE username = '$user'")->num_rows();

			if ($q > 0) {
				$this->session->set_flashdata('error','Username Telah Dipakai');
				redirect('auth/register/#true');
			}else{
				$dataRegister = array(
					'nama_lengkap' => ucwords($this->input->post('namaLengkap')),
					'username' => strtolower($this->input->post('username')),
					'password' => md5($this->input->post('password')),
					'email' => $this->input->post('email'),
					'provinsi_id' => $this->input->post('province'),
					'kota_id' => $this->input->post('kota_id'),
					'no_hp' => $this->input->post('noHp'),
					'alamat_lengkap' => $this->input->post('alamat'),
					'waktu_daftar' => date('Y-m-d H:i:s'),
					'id_session' => md5($this->input->post('username'))
				);

				$config = [
					'mailtype'  => 'html',
					'charset'   => 'utf-8',
					'protocol'  => 'smtp',
					'smtp_host' => 'ssl://smtp.gmail.com',
					'smtp_user' => 'myolshop.confirm@gmail.com',
					'smtp_pass' => 'kokrehnyobaataohmakpolabisa', 
					'smtp_port' => 465,
					'crlf'      => "\r\n",
					'newline'   => "\r\n"
				];

				$this->load->library('email', $config);
				$this->email->from('myolshop.confirm@gmail.com', 'ILHAM SURYA PRATAMA');
				$this->email->to($this->input->post('email')); 
				$this->email->subject('ILHAM SURYA PRATAMA | semprulshop');
				$this->email->message("Halo '".$this->input->post('namaLengkap')."'. Selamat Datang di Online Shop Kami.");
				$this->email->send();

				$query = $this->Auth_model->tambahUser($dataRegister);

				if ($query) {
					redirect('auth/register_sukses/#true');
				}
			}
		}
	}

	public function get_province()
	{
		$provinsi = $this->rajaongkir->province();
		echo $provinsi;
	}

	public function get_kota() {
		$id = $this->input->post('id');

		$kota = $this->rajaongkir->city($id);

		$this->output->set_content_type('application/json')->set_output($kota);
	}

	public function register_sukses()
	{
		$data['title'] = "Register Sukses";
		$data['kategori'] = $this->Admin_model->getKategori();
		$session = $this->session->userdata('sessionUser');

		$da['jmlKeranjang'] = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'")->num_rows();

		$this->load->view('semprulshop/header_semprul', $data);
		$this->load->view('semprulshop/navbar', $da);
		$this->load->view('semprulshop/register_sukses');
		$this->load->view('semprulshop/footer_semprul');
	}

	public function login()
	{
		$session = $this->session->userdata('sessionUser');
		$data['title'] = "User Login";
		$data['kategori'] = $this->Admin_model->getKategori();
		$q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
		$da['jmlKeranjang'] = $q->num_rows();

		$this->load->view('semprulshop/header_semprul',$data);
		$this->load->view('semprulshop/navbar', $da);
		$this->load->view('semprulshop/login');
		$this->load->view('semprulshop/footer_semprul');

		if (isset($_POST['submit'])) {
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$where = array(
				'username' => $username,
				'password' => $password
			);

			$cek = $this->Auth_model->user_login('user',$where)->num_rows();
			$cek1 = $this->Auth_model->seller_login('seller',$where)->num_rows();

			if ($cek > 0) {
				$idSession = $this->db->query("SELECT * FROM user where username = '$username'")->row();

				$data_session = array(
					'usernameUser' => $idSession->nama_lengkap,
					'status' => "userLoginSukses",
					'sessionUser' => $idSession->id_session
				);
				$this->session->set_userdata($data_session);
				redirect(base_url());
            // $this->load->view('administrator/dashboard');
			} else if ($cek1 > 0) {
				$sessionSeller = $this->db->query("SELECT * FROM seller where username = '$username'")->row();

				$data_session_seller = array(
					'usernameSeller' => $sessionSeller->nama,
					'sellerStatus' => "sellerLogged",
					'sessionUser' => $sessionSeller->id_session_seller,
					'id_seller' => $sessionSeller->id_seller
				);
				$this->session->set_userdata($data_session_seller);
				redirect(base_url());
			} else {
				$this->session->set_flashdata('LoginError','Login Salah. Silahkan periksa data login anda.');
				redirect('auth/login/#true');
			} 
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function tes()
	{
		// Konfigurasi email
		$config = [
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'myolshop.confirm@gmail.com',    // Ganti dengan email gmail kamu
               'smtp_pass' => 'kokrehnyobaataohmakpolabisa',      // Password gmail kamu
               'smtp_port' => 465,
               'crlf'      => "\r\n",
               'newline'   => "\r\n"
           ];

        // Load library email dan konfigurasinya
           $this->load->library('email', $config);

        // Email dan nama pengirim
           $this->email->from('myolshop.confirm@gmail.com', 'MasRud.com | M. Rudianto');

        // Email penerima
        $this->email->to('blogsayailham@gmail.com'); // Ganti dengan email tujuan kamu

        // // Lampiran email, isi dengan url/path file
        // $this->email->attach('https://masrud.com/themes/masrud_v1/img/default.png');

        // Subject email
        $this->email->subject('Kirim Email dengan SMTP Gmail | MasRud.com');

        // Isi email
        $this->email->message("Ini adalah contoh email CodeIgniter yang dikirim menggunakan SMTP email Google (Gmail).<br><br> Klik <strong><a href='https://masrud.com/post/kirim-email-dengan-smtp-gmail' target='_blank' rel='noopener'>disini</a></strong> untuk melihat tutorialnya.");

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
        	echo 'Sukses! email berhasil dikirim.';
        } else {
        	echo 'Error! email tidak dapat dikirim.';
        }
    }
}
?>