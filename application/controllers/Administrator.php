<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('statusAdmin') != 'login'){
           redirect('login');
       }
   }

   public function v_dashboard()
   {
    $data['title'] = "Dashboard";
    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/footer');
}

public function kategori()
{
    $data['kategori'] = $this->Admin_model->getKategori();
    $data['title'] = "Kategori";

    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/mod_kategori/v_kategori', $data);
    $this->load->view('administrator/footer');
}

public function tambah_kategori()
{   
    $data['title'] = "Tambah Kategori";

    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/mod_kategori/tambah_kategori');
    $this->load->view('administrator/footer');
    
    if (isset($_POST['submit'])) {
        $dataKategori = array(
            'nama_kategori' => $this->input->post('kategori'),
            'kategori_slug' => url_title($this->input->post('kategori'), 'dash', TRUE)
        );

        $query = $this->Admin_model->tambahKategori($dataKategori);
        if ($query) {
            redirect('administrator/kategori');
        }
    }
}

public function hapus_kategori($id)
{
    $this->Admin_model->hapusKategori($id);

    redirect('administrator/kategori');
}

public function edit_kategori($id)
{
    $data['kategori'] = $this->Admin_model->getKategoriById($id);
    $data['title'] = "Edit Kategori";

    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/mod_kategori/e_kategori', $data);
    $this->load->view('administrator/footer');

    if (isset($_POST['edit'])) {
        $idt = $this->input->post('id_kategori');
        $dataEditKategori = array(
            'nama_kategori' => $this->input->post('kategori'),
            'kategori_slug' => url_title($this->input->post('kategori'), 'dash', TRUE)
        );

        $query = $this->Admin_model->editKategori($idt,$dataEditKategori);
        if ($query) {
            redirect('administrator/kategori');
        }
    }
}

public function produk()
{
    $sess = $this->session->userdata('username');
    $data['produk'] = $this->Admin_model->getProduk();
    $data['title'] = "Produk";

    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/mod_produk/v_produk', $data);
    $this->load->view('administrator/footer');
}

public function tambah_produk()
{
    $data['kategori'] = $this->Admin_model->getKategori(); 
    $data['title'] = "Tambah Produk";

    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/mod_produk/t_produk', $data);
    $this->load->view('administrator/footer');

    if (isset($_POST['simpan_produk'])) {            

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

        $query = $this->Admin_model->tambahProduk($dataProduk);
        
        if ($query) {
            $maxId = $this->db->query("SELECT max(id_produk) as id FROM produk")->row_array();
            $countUkuran = str_word_count($this->input->post('ukuran'));
            $u = str_word_count($this->input->post('ukuran'),1);
                // echo $u;

            $ukuran = array();

            for ($j=0; $j < $countUkuran; $j++) { 
                array_push($ukuran, array(
                    'id_produk' => $maxId['id'],
                    'ukuran' => $u[$j]
                ));
            }
            $this->db->insert_batch('ukuran', $ukuran);

            redirect('administrator/produk');
        }
    }
}

public function hapus_produk($id_produk)
{
    $data = $this->Admin_model->getIdGambar($id_produk);
    $path = 'assets/upload/gambar_produk/';
    @unlink($path.$data->gambar);
    if ($this->Admin_model->hapus_produk($id_produk) == TRUE) {
        redirect('administrator/produk');
    }
}

public function edit_produk($id_produk)
{        
    $data['produk'] = $this->Admin_model->getProdukId($id_produk);
    $data['kat'] = $this->Admin_model->getKategori();
    $data['title'] = "Edit Produk";

    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/mod_produk/e_produk', $data);
    $this->load->view('administrator/footer');

    if (isset($_POST['edit_produk'])) {
        $id_prdk = $this->input->post('id_produk');
        $config['upload_path'] = 'assets/upload/gambar_produk';
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar_produk');
        $file_name = $this->upload->data();
        $data = array('gambar'=>$file_name['file_name']);

        
        $da = $this->Admin_model->getIdGambar($id_prdk);            

        $query = $this->Admin_model->edit_produk($id_prdk,$file_name,$da);
        if ($query) {

                // $maxId = $this->db->query("SELECT max(id_produk) as id FROM produk")->row_array();
            $countUkuran = str_word_count($this->input->post('ukuran'));
            $u = str_word_count($this->input->post('ukuran'),1);
                // echo $u;

            $ukuran = array();

            for ($j=0; $j < $countUkuran; $j++) { 
                array_push($ukuran, array(
                    'id_produk' => $id_prdk,
                    'ukuran' => $u[$j]
                ));
            }
            $this->db->delete('ukuran', array('id_produk' => $id_prdk));
            $this->db->insert_batch('ukuran', $ukuran);

            redirect('administrator/produk');
        }
    }            
}

public function transaksi()
{
    $data['transaksi'] = $this->Admin_model->getTransaksi();
    $data['title'] = "Transaksi";

    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/mod_transaksi/v_transaksi', $data);
    $this->load->view('administrator/footer');
}

public function orders_status($kode,$id,$st)
{
    $this->Admin_model->update_orders_status($id,$st);
    redirect("administrator/tracking/".$kode);
}

public function tracking($kode)
{
    $c = $this->db->query("SELECT kode_transaksi FROM konfirmasi WHERE kode_transaksi = '".$kode."'")->num_rows();
    if ($c > 0) {
        $data['rows'] = $this->db->query("SELECT * FROM transaksi a JOIN user b ON a.id_pembeli = b.id_session JOIN konfirmasi c ON a.kode_transaksi = c.kode_transaksi WHERE a.kode_transaksi = '$kode'")->row_array();
        $data['sel'] = $this->db->query("SELECT * FROM transaksi a JOIN seller b ON a.id_pembeli = b.id_session_seller JOIN konfirmasi c ON a.kode_transaksi = c.kode_transaksi WHERE a.kode_transaksi = '$kode'")->row_array();
    }else {
        $data['rows'] = $this->db->query("SELECT * FROM transaksi a JOIN user b ON a.id_pembeli = b.id_session WHERE a.kode_transaksi = '$kode'")->row_array(); 
        $data['sel'] = $this->db->query("SELECT * FROM transaksi a JOIN seller b ON a.id_pembeli = b.id_session_seller WHERE a.kode_transaksi = '$kode'")->row_array();
    }
    
    $data['title'] = "Tracking";

    $curl = curl_init();    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
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

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $provinsi = $this->rajaongkir->province();

    $data['kota'] = json_decode($response, true);
    $data['provinsi'] = json_decode($provinsi, true); 

    $data['record'] = $this->db->query("SELECT a.*, b.*, c.nama_produk, c.berat, c.produk_slug FROM `transaksi` a JOIN transaksi_detail b ON a.kode_transaksi=b.kode_transaksi JOIN produk c ON b.id_produk=c.id_produk WHERE a.kode_transaksi='".$kode."'")->result_array();

    $data['total'] = $this->db->query("SELECT a.*, b.*, sum(b.total+b.ongkir) as total_bayar FROM `transaksi` a JOIN transaksi_detail b ON a.kode_transaksi=b.kode_transaksi WHERE a.kode_transaksi='".$kode."'")->row_array();

    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/mod_transaksi/v_tracking', $data);
    $this->load->view('administrator/footer');
}

public function rekening()
{
    $data['rekening'] = $this->Admin_model->getRekening();
    $data['title'] = "Rekening";
    
    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/mod_rekening/v_rekening',$data);
    $this->load->view('administrator/footer');
}

public function get_ukuran()
{
    $id = $this->input->post('id');

    $uo = $this->Admin_model->getUkuran2($id);

    $ar = array();

    for ($i=0; $i < $uo['ids']; $i++) { 
        array_push($ar, $uo['ukuran']);
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($ar));
}

public function seller()
{
    $data['title'] = "SELLER";

    $data['seller'] = $this->Admin_model->getSeller();

    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/mod_seller/v_seller', $data);
    $this->load->view('administrator/footer');
}

public function tambah_seller()
{
    $data['title'] = "TAMBAH SELLER";

    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/mod_seller/t_seller');
    $this->load->view('administrator/footer');

    if (isset($_POST['simpan'])) {

        $getSeller = $this->db->query("SELECT nama FROM seller WHERE nama = '".$this->input->post('nama_seller')."'")->num_rows();

        if ($getSeller > 0 ) {
            $this->session->set_flashdata('namaSellerError','Nama Toko Telah Dipakai Orang Lain.');
            redirect('administrator/tambah_seller');
        }else {
            $data_seller = array(
                'nama' => $this->input->post('nama_seller'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'id_session_seller' => md5($this->input->post('username'))
            );

            $query = $this->Admin_model->simpanSeller($data_seller);

            if ($query) {
                redirect('administrator/seller');
            }
        }
    }
}

public function edit_seller($id)
{
    $data['title'] = "EDIT SELLER";

    $data['seller'] = $this->Admin_model->getSellerId($id);

    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/mod_seller/e_seller', $data);
    $this->load->view('administrator/footer');

    if (isset($_POST['edit'])) {
        $idsel = $this->input->post('id_seller');
        $data_seller = array(
            'nama' => $this->input->post('nama_seller'),
            'username' => $this->input->post('username')
        );

        $query = $this->Admin_model->editSeller($data_seller,$idsel);

        if ($query) {
            redirect('administrator/seller');
        }
    }
}

public function hapus_seller($id)
{
    $this->Admin_model->hapusSeller($id);

    redirect('administrator/seller');
}

public function pengembalian()
{
    $data['title'] = "PENGEMBALIAN";

    $data['pengembalian'] = $this->Admin_model->getPengembalian();

    $this->load->view('administrator/header', $data);
    $this->load->view('administrator/dashboard');
    $this->load->view('administrator/mod_pengembalian/v_pengembalian', $data);
    $this->load->view('administrator/footer');
}
}

?>