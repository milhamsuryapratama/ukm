<?php 

    /**
     * 
     */
    class Seller extends CI_Controller
    {
    	
    	function __construct()
    	{
    		parent::__construct();
    	}

    	public function index()
    	{
    		$data['title'] = "WELCOME SELLER";
    		$session_id = $_GET['id'];

    		$session = $this->session->userdata('sessionUser');

    		$da['jmlKeranjang'] = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'")->num_rows();
    		
    		$this->load->view('semprulshop/header_semprul', $data);
            $this->load->view('seller/navbar');
            $this->load->view('semprulshop/footer_semprul');
        }

        public function produk()
        {
            $session = $this->session->userdata('usernameSeller');
            $data['produk'] = $this->Seller_model->getProdukSeller($session);
            $data['title'] = "Produk";

            $this->load->view('semprulshop/header_semprul', $data);
            $this->load->view('seller/navbar');
            $this->load->view('seller/v_produk_seller', $data);
            $this->load->view('semprulshop/footer_semprul');
        }

        public function tambah_produk()
        {
          $data['title'] = "SELLER - TAMBAH PRODUK";
          $session = $this->session->userdata('id_seller');
          $data['kategori'] = $this->Seller_model->getKategori($session);

          $this->load->view('semprulshop/header_semprul', $data);
          $this->load->view('seller/navbar');
          $this->load->view('seller/t_produk', $data);
          $this->load->view('semprulshop/footer_semprul');
      }

      public function s_produk()
      {
        $config['upload_path'] = 'assets/upload/gambar_produk';
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar_produk');
        $file_name = $this->upload->data();

        $dataProduk = array(
            'id_kategori_produk' => $this->input->post('kategori'),
            'nama_produk' => $this->input->post('nama_produk'),
            'produk_slug' => url_title($this->input->post('nama_produk'), 'dash', TRUE),
            'stok' => $this->input->post('stok'),
            'harga_konsumen' => $this->input->post('harga'),
            'berat' => $this->input->post('berat'),
            'diskon' => $this->input->post('diskon'),
            'keterangan' => $this->input->post('deskripsi'),
            'username' => $this->session->userdata('usernameSeller'),
            'waktu_input' => date('Y-m-d H:i:s'),
            'gambar' => $file_name['file_name']
        );

        $query = $this->Seller_model->tambahProduk($dataProduk);

        if ($query) {
           echo "SUKSES";
        }

      }

      public function e_produk()
      {
        $id_prdk = $this->input->post('id_produk');

        $config['upload_path'] = 'assets/upload/gambar_produk';
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar_produk');
        $file_name = $this->upload->data();
        $data = array('gambar'=>$file_name['file_name']);

        $da = $this->Seller_model->getIdGambar($id_prdk); 
        $query = $this->Seller_model->edit_produk($id_prdk,$file_name,$da);

        if ($query) {
           echo "SUKSES";
        }

      }

      public function s_ukuran() {
        $namaUkuran = $this->input->post('nmVar');
        $stokUkuran = $this->input->post('stkVar');

        $maxId = $this->db->query("SELECT max(id_produk) as id FROM produk")->row_array();

        $ukuran = array();

        for ($j=0; $j < count($namaUkuran); $j++) { 
            array_push($ukuran, array(
                'id_produk' => $maxId['id'],
                'ukuran' => $namaUkuran[$j],
                'stok_ukuran' => $stokUkuran[$j]
            ));
        }

        $totalStok = array_sum($stokUkuran);

        $this->db->insert_batch('ukuran', $ukuran);

        $this->db->query("UPDATE produk set stok = '$totalStok' WHERE id_produk = '".$maxId['id']."' ");

        $this->output->set_content_type('application/json')->set_output(json_encode($ukuran));
      }

      public function e_ukuran() {
        $idVar = $this->input->post('id_variasi');
        $stokUkuran = $this->input->post('stkVar');
        $id_produk = $this->input->post('id_produk');

        $q = $this->db->query("SELECT id_produk FROM ukuran WHERE id_produk = '$id_produk' ")->num_rows();
        $totalStok = array_sum($stokUkuran);

        for ($i=0; $i < count($stokUkuran); $i++) { 
            $this->db->query("UPDATE ukuran SET stok_ukuran = '".$stokUkuran[$i]."' WHERE id = '".$idVar[$i]."' ");
        }

        $this->db->query("UPDATE produk set stok = '$totalStok' WHERE id_produk = '".$id_produk."' ");

        $this->output->set_content_type('application/json')->set_output(json_encode($idVar));
      }
    

    public function edit_produk($id_produk)
    {
        $data['produk'] = $this->Seller_model->getProdukId($id_produk);
        $session = $this->session->userdata('id_seller');
        $data['kat'] = $this->Seller_model->getKategori($session);
        $data['ukuran'] = $this->Seller_model->getUkuranById($id_produk);
        $data['title'] = "Edit Produk";

        $this->load->view('semprulshop/header_semprul', $data);
        $this->load->view('seller/navbar');
        $this->load->view('seller/e_produk_seller', $data);
        $this->load->view('semprulshop/footer_semprul');

        if (isset($_POST['edit_produk'])) {
            $id_prdk = $this->input->post('id_produk');
                // $session = $this->session->userdata('usernameSeller');

            $config['upload_path'] = 'assets/upload/gambar_produk';
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar_produk');
            $file_name = $this->upload->data();
            $data = array('gambar'=>$file_name['file_name']);


            $da = $this->Seller_model->getIdGambar($id_prdk);            

            $query = $this->Seller_model->edit_produk($id_prdk,$file_name,$da);
            if ($query) {
                    // $maxId = $this->db->query("SELECT max(id_produk) as id FROM produk")->row_array();
                // $countUkuran = str_word_count($this->input->post('ukuran'));
                // $u = str_word_count($this->input->post('ukuran'),1);
                //     // echo $u;

                // $ukuran = array();

                // for ($j=0; $j < $countUkuran; $j++) { 
                //     array_push($ukuran, array(
                //         'id_produk' => $id_prdk,
                //         'ukuran' => $u[$j]
                //     ));
                // }
                // $this->db->delete('ukuran', array('id_produk' => $id_prdk));
                // $this->db->insert_batch('ukuran', $ukuran);

                redirect('seller/produk');
            }
        }
    }

    public function hapus_produk($id_produk)
    {
        $data = $this->Seller_model->getIdGambar($id_produk);
        $path = 'assets/upload/gambar_produk/';
        @unlink($path.$data->gambar);
        if ($this->Seller_model->hapus_produk($id_produk) == TRUE) {
            redirect('seller/produk');
        }
    }

    public function kategori() 
    {
        $session = $this->session->userdata('id_seller');
        $data['kategori'] = $this->Seller_model->getKategori($session);
        $data['title'] = "Kategori";

        $this->load->view('semprulshop/header_semprul', $data);
        $this->load->view('seller/navbar');
        $this->load->view('seller/kategori', $data);
        $this->load->view('semprulshop/footer_semprul');
    }

    public function tambah_kategori()
    {   
        $data['title'] = "Tambah Kategori";
        $session = $this->session->userdata('id_seller');

        $this->load->view('semprulshop/header_semprul', $data);
        $this->load->view('seller/navbar');
        $this->load->view('seller/t_kategori', $data);
        $this->load->view('semprulshop/footer_semprul');
        
        if (isset($_POST['submit'])) {
            $dataKategori = array(
                'nama_kategori' => $this->input->post('kategori'),
                'kategori_slug' => url_title($this->input->post('kategori'), 'dash', TRUE),
                'id_seller' => $session
            );

            $query = $this->Seller_model->tambahKategori($dataKategori);
            if ($query) {
                redirect('seller/kategori');
            }
        }
    }

    public function edit_kategori($id)
    {
        $data['kategori'] = $this->Admin_model->getKategoriById($id);
        $data['title'] = "Edit Kategori";
        $session = $this->session->userdata('id_seller');

        $this->load->view('semprulshop/header_semprul', $data);
        $this->load->view('seller/navbar');
        $this->load->view('seller/e_kategori', $data);
        $this->load->view('semprulshop/footer_semprul');

        if (isset($_POST['edit'])) {
            $idt = $this->input->post('id_kategori');
            $dataEditKategori = array(
                'nama_kategori' => $this->input->post('kategori'),
                'kategori_slug' => url_title($this->input->post('kategori'), 'dash', TRUE),
                'id_seller' => $session
            );

            $query = $this->Seller_model->editKategori($idt,$dataEditKategori);
            if ($query) {
                redirect('seller/kategori');
            }
        }
    }

    public function hapus_kategori($id)
    {
        $this->Seller_model->hapusKategori($id);

        redirect('seller/kategori');
    }

    public function penjualan()
    {
        $session = $this->session->userdata('usernameSeller');
        $data['trx'] = $this->Seller_model->getMyTrx($session);

        $this->load->view('semprulshop/header_semprul', $data);
        $this->load->view('seller/navbar');
        $this->load->view('seller/penjualan', $data);
        $this->load->view('semprulshop/footer_semprul');
    }

    public function penjualan_detail($kode)
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

        $data['record'] = $this->db->query("SELECT a.*, b.*, c.* FROM `transaksi` a JOIN transaksi_detail b ON a.kode_transaksi=b.kode_transaksi JOIN produk c ON b.id_produk=c.id_produk WHERE a.kode_transaksi='".$kode."' AND penjual = '".$this->session->userdata('usernameSeller')."'")->result_array();

        $data['total'] = $this->db->query("SELECT a.*, b.*, sum(b.total+b.ongkir) as total_bayar FROM `transaksi` a JOIN transaksi_detail b ON a.kode_transaksi=b.kode_transaksi WHERE a.kode_transaksi='".$kode."'")->row_array();

        $this->load->view('semprulshop/header_semprul', $data);
        $this->load->view('seller/navbar', $da);
        $this->load->view('seller/detail_penjualan', $data);
        $this->load->view('semprulshop/footer_semprul');
    }

    public function orders_status($kode,$id,$st)
    {
        $this->Seller_model->update_orders_status($id,$st);

            //email konfirmasi
            // $config = [
            //     'mailtype'  => 'html',
            //     'charset'   => 'utf-8',
            //     'protocol'  => 'smtp',
            //     'smtp_host' => 'ssl://smtp.gmail.com',
            //     'smtp_user' => 'myolshop.confirm@gmail.com',
            //     'smtp_pass' => 'kokrehnyobaataohmakpolabisa', 
            //     'smtp_port' => 465,
            //     'crlf'      => "\r\n",
            //     'newline'   => "\r\n"
            // ];

            // $this->load->library('email', $config);
            // $this->email->from('myolshop.confirm@gmail.com', 'ILHAM SURYA PRATAMA');
            // $this->email->to($trxId['email']); 
            // $this->email->subject('ILHAM SURYA PRATAMA | semprulshop');
            // $this->email->message($pesan);
            // $this->email->send();

        redirect("seller/penjualan_detail/".$kode);
    }

    public function get_ukuran()
    {
        $id = $this->input->post('id');

        $uo = $this->Seller_model->getUkuran2($id);

        $ar = array();

        for ($i=0; $i < $uo['ids']; $i++) { 
            array_push($ar, $uo['ukuran']);
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($ar));
    }

    public function simpan_ukuran() 
    {
        $ukuran = $this->input->post('uku');

        echo $ukuran;
    }

    public function detail($slug) 
    {
        $session = $this->session->userdata('sessionUser');

        $da['jmlKeranjang'] = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'")->num_rows();

        $sel = $this->db->query("SELECT * FROM seller WHERE seller_slug = '$slug'")->row_array();



        $data['produk'] = $this->Semprul_model->dataProdukByToko($sel['nama']);

        $this->load->view('semprulshop/header_semprul');
        $this->load->view('semprulshop/navbar', $da);
        $this->load->view('semprulshop/seller_detail', $data);
        $this->load->view('semprulshop/footer_semprul');
    }

    public function tes_produk()
    {
        $session = $this->session->userdata('id_seller');
        $data['kategori'] = $this->Seller_model->getKategori($session);

        $this->load->view('semprulshop/header_semprul');
        $this->load->view('seller/navbar');
        $this->load->view('seller/tes_produk', $data);
        $this->load->view('semprulshop/footer_semprul');
    }
}
?>