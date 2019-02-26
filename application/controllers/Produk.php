    <?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Produk extends CI_Controller 
    {
        public function __construct()
        {
            parent::__construct();
            // $this->set_timezone();
        }

        public function index($offset=0)
        {
            $data['title'] = "WELCOME TO MY ONLINE SHOP";
            $keyword= $this->input->get('q');
            $data['kategori'] = $this->Admin_model->getKategori();
            
            $session = $this->session->userdata('sessionUser');

            $da['jmlKeranjang'] = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'")->num_rows();
            
            $data['offset']=$offset;
            $config['total_rows'] = $this->Semprul_model->hitung_produk($keyword)->num_rows();
            $config['base_url'] = base_url().'produk/index';
            $config['per_page'] = 3;
            $config['full_tag_open']="<ul class='pagination'>";
            $config['full_tag_close']="</ul>";
            $config['num_tag_open']="<li>";
            $config['num_tag_close']="</li>";
            $config['next_tag_open']="<li>";
            $config['next_tag_close']="</li>";
            $config['prev_tag_open']="<li>";
            $config['prev_tag_close']="</li>";
            $config['first_tag_open']="<li>";
            $config['first_tag_close']="</li>";
            $config['last_tag_open']="<li>";
            $config['last_tag_close']="</li>";
            $config['cur_tag_open']="<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close']="</a></li>";

            $this->pagination->initialize($config);
            $data['halaman'] = $this->pagination->create_links();

            $data['produk'] = $this->Semprul_model->dataProduk($keyword,$config['per_page'],$offset);

            $this->load->view('semprulshop/header_semprul',$data);
            $this->load->view('semprulshop/navbar', $da);
            $this->load->view('welcome_message', $data);
            $this->load->view('semprulshop/footer_semprul');
        }

        public function detail($prdkSlug)
        {
            $data['kategori'] = $this->Admin_model->getKategori();

            $data['pm'] = $this->db->query("SELECT * FROM produk JOIN ukuran ON produk.id_produk = ukuran.id_produk WHERE produk.produk_slug = '".$prdkSlug."'")->num_rows();

            if ($data['pm'] > 0) {
                $data['produk'] = $this->Semprul_model->getProduk($prdkSlug);
            } else {
                $data['produk'] = $this->Semprul_model->getProdukNoUkuran($prdkSlug);
            }
            

            $data['title'] = "Produk Detail";

            $session = $this->session->userdata('sessionUser');

            $q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
            $da['jmlKeranjang'] = $q->num_rows();

            $this->load->view('semprulshop/header_semprul',$data);
            $this->load->view('semprulshop/navbar', $da);
            $this->load->view('semprulshop/produk_detail', $data);
            $this->load->view('semprulshop/footer_semprul');
        }

        public function kategori($slug)
        {
            $data['title'] = "Produk Detail";
            $data['kategori'] = $this->Admin_model->getKategori();
            $session = $this->session->userdata('sessionUser');

            $q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
            $da['jmlKeranjang'] = $q->num_rows();
            $data['produkbykategori'] = $this->Semprul_model->getProdukByKategori($slug);

            $this->load->view('semprulshop/header_semprul',$data);
            $this->load->view('semprulshop/navbar', $da);
            $this->load->view('semprulshop/produk_by_kategori', $data);
            $this->load->view('semprulshop/footer_semprul');
        }

        public function keranjang()
        {
            if (isset($_POST['submit'])) {
                $id_produk = $this->input->post('id_produk');
                $pr = $this->db->query("SELECT * FROM produk where id_produk = '$id_produk'")->row();
                
                if ($pr->diskon == 0 ) {
                    $diskon = 0;
                    $total = $pr->harga_konsumen * $this->input->post('jumlah');
                }else{
                    $diskon = $pr->diskon;
                    $total = ($pr->harga_konsumen * $this->input->post('jumlah')) - (($pr->diskon/100) * $pr->harga_konsumen) * $this->input->post('jumlah');
                }

                $cekUkuran = $this->db->query("SELECT id_produk FROM ukuran WHERE id_produk = '".$id_produk."'")->num_rows();

                if ($cekUkuran > 0) {
                    $dataKeranjang = array(
                        'id_session' => $this->session->userdata('sessionUser'),
                        'id_produk' => $id_produk,
                        'id_ukuran' => $this->input->post('ukuran'),
                        'jumlah' => $this->input->post('jumlah'),
                        'harga_jual' => $pr->harga_konsumen,
                        'diskon' => $diskon,
                        'total' => $total,
                        'satuan' => $pr->satuan,
                        'status' => 'N',
                        'waktu_order_temp' => date('Y-m-d H:i:s')
                    );
                }else {
                    $dataKeranjang = array(
                        'id_session' => $this->session->userdata('sessionUser'),
                        'id_produk' => $id_produk,
                        'jumlah' => $this->input->post('jumlah'),
                        'harga_jual' => $pr->harga_konsumen,
                        'diskon' => $diskon,
                        'total' => $total,
                        'satuan' => $pr->satuan,
                        'status' => 'N',
                        'waktu_order_temp' => date('Y-m-d H:i:s')
                    );
                }

                $query = $this->Semprul_model->tambahKeranjang($dataKeranjang);
                
                if ($query) {
                    $session = $this->session->userdata('sessionUser');
                    $data['kategori'] = $this->Admin_model->getKategori();
                    
                    $data['cart'] = $this->Semprul_model->getKeranjangBySession($session);  

                    $data['title'] = "Keranjang";
                    $q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
                    $da['jmlKeranjang'] = $q->num_rows();

                    $this->load->view('semprulshop/header_semprul', $data);
                    $this->load->view('semprulshop/navbar', $da);
                    $this->load->view('semprulshop/keranjang', $data);
                    $this->load->view('semprulshop/footer_semprul');
                }            
            } else {
                if ($this->session->userdata('status') == 'userLoginSukses' || $this->session->userdata('sellerStatus') == 'sellerLogged') {
                    $data['title'] = "KERANJANG";
                    $session = $this->session->userdata('sessionUser');
                    $data['kategori'] = $this->Admin_model->getKategori();
                    $data['cart'] = $this->Semprul_model->getKeranjangBySession($session);

                    $q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
                    $da['jmlKeranjang'] = $q->num_rows();

                    $this->load->view('semprulshop/header_semprul',$data);
                    $this->load->view('semprulshop/navbar', $da);
                    $this->load->view('semprulshop/keranjang', $data);
                    $this->load->view('semprulshop/footer_semprul');
                    
                } else {
                    redirect('auth/login/#true');
                }
            }        
        }

        public function getsum()
        {
            $sum = $this->input->post('sum');
            $arr = array();
            for ($i=0; $i < count($sum) ; $i++) { 
                $sumTotal = $this->Semprul_model->getSumKeranjang($sum[$i]);
                array_push($arr, $sumTotal['total']);
            }
            $sumArr = array_sum($arr);
            print_r($sumArr);
        }

        public function hapus_keranjang($id_order_temp)
        {
            $this->Semprul_model->hapus_keranjang($id_order_temp);

            redirect('produk/keranjang/#keranjang');
        }

        public function cek_checkout()
        {
            if ($this->session->userdata('status') == 'userLoginSukses' || $this->session->userdata('sellerStatus') == 'sellerLogged') {
                $checkedid = $this->input->post('checkedid');
                $data['title'] = "CheckOut";
                $session = $this->session->userdata('sessionUser'); 

                for ($i=0; $i < count($checkedid) ; $i++) { 
                   $this->Semprul_model->update_status_keranjang($checkedid[$i]);
               }
            }
        }

        public function checkout()
        {
            if ($this->session->userdata('status') == 'userLoginSukses' || $this->session->userdata('sellerStatus') == 'sellerLogged') {

               $session = $this->session->userdata('sessionUser');
               $q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
               $da['jmlKeranjang'] = $q->num_rows();
                // $data['keranjang'] = $this->Semprul_model->getKeranjang($this->session->userdata('sessionUser'));                

               $data['user'] = $this->Semprul_model->getUser($session);
               $data['seller'] = $this->Semprul_model->getseller($session);

               $kota = $this->rajaongkir->city();
               $provinsi = $this->rajaongkir->province();

               $data['kota'] = json_decode($kota, true);   
               $data['provinsi'] = json_decode($provinsi, true);  
               $data['kategori'] = $this->Admin_model->getKategori();
               $data['order_check'] = $this->Semprul_model->order_checkot($session);

               $this->load->view('semprulshop/header_semprul', $data);
               $this->load->view('semprulshop/navbar', $da);
               $this->load->view('semprulshop/checkout', $data);
               $this->load->view('semprulshop/footer_semprul');

           } else {
            redirect('auth/login');
        }        
    }

    public function cancle_checkout()    
    {
        $session = $this->session->userdata('sessionUser');

        $this->db->query("UPDATE order_temp SET status = 'N', kurir = '', service = '', etd = '', ongkir = '' WHERE id_session = '$session'");

        redirect('produk/keranjang/#keranjang');
    }

    public function kurir($asal,$tujuan,$berat,$kurir)
    {
        $ongkir = $this->rajaongkir->cost($asal,$tujuan,$berat,$kurir);
        $this->output->set_content_type('application/json')->set_output($ongkir);
    }

    public function sum_total()
    {
        $id = $this->input->post('idp');
        $service = $this->input->post('serviceR');
        $kurir = $this->input->post('kurirR');
        $etd = $this->input->post('etdR');
        $ongkir = $this->input->post('ongkirR');
        $arrId = array();
        for ($i=0; $i < count($id); $i++) { 
            $total = $this->db->query("SELECT total FROM order_temp WHERE id_order_temp = '".$id[$i]."' AND status = 'Y'")->row_array();
            $up = $this->db->query("UPDATE order_temp SET service = '".$service."', kurir = '".$kurir."', ongkir = '".$ongkir."', etd = '".$etd."' WHERE id_order_temp = '".$id[$i]."' AND status = 'Y'");
            $sumTot = $this->db->query("SELECT sum(total+ongkir) as tot FROM order_temp WHERE id_session = '".$this->session->userdata('sessionUser')."' AND status = 'Y'")->row_array();
            array_push($arrId, array(
                'total' => $total['total'],
                'tot' => $sumTot['tot']
            ));
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($arrId));
    }    

    public function order_proses()
    {
        $idk = $this->input->post('idk');
        $idprdk = $this->input->post('idprdk');
        $id_ukuran = array();
        
        $kodeTrx = "trx-".time();
        $session = $this->session->userdata('sessionUser');
        $now = date('Y-m-d H:i:s');
        $deadline_bayar = date('Y-m-d H:i:s', strtotime('+2 day', strtotime($now)));
        // $deadline_bayar->modify('2');
        // $deadline_fix = $deadline_bayar->format('Y-m-d H:i:s');

        $dataTrx = array(
            'kode_transaksi' => $kodeTrx,
            'id_pembeli' => $session,
            'waktu_transaksi' => $now,
            'deadline_bayar' => $deadline_bayar,
            'konfirmasi' => '0'
        );
        
        $query = $this->Semprul_model->insertTrx($dataTrx);

        if ($query) {
            $data = array();                  

            for ($i=0; $i < count($idk); $i++) { 
                $queryO = $this->db->query("SELECT * FROM order_temp JOIN produk ON order_temp.id_produk = produk.id_produk WHERE id_order_temp = '".$idk[$i]."'")->row_array();

                $queryA = $this->db->query("SELECT * FROM transaksi WHERE kode_transaksi = '".$kodeTrx."'")->row_array();

                if ($queryO['diskon'] == 0) {
                    $t = $queryO['jumlah'] * $queryO['harga_jual'];
                }else{
                    $t = ($queryO['harga_jual'] * $queryO['jumlah']) - ($queryO['diskon']/100 * $queryO['harga_jual']) * $queryO['jumlah'];
                }

                array_push($data, array(
                    "kode_transaksi" => $queryA['kode_transaksi'],
                    "id_produk" => $queryO['id_produk'],
                    "id_ukuran" => $queryO['id_ukuran'],
                    "penjual" => $queryO['username'],
                    "jumlah" => $queryO['jumlah'],
                    "harga_jual"=> $queryO['harga_jual'],
                    "diskon" => $queryO['diskon'],
                    "total" => $t,
                    "satuan"=>$queryO['satuan'],
                    'kurir' => $queryO['kurir'],
                    'service' => $queryO['service'],
                    'ongkir' => $queryO['ongkir'],
                    'etd' => $queryO['etd'],
                    'status' => '0'
                )); 

                array_push($id_ukuran, $queryO['id_ukuran']);
            }

            $this->db->insert_batch('transaksi_detail', $data);
            $queryHapus = $this->Semprul_model->deleteKeranjang_afterOrder($session);
            if ($queryHapus) {
                $jmlArray = array();
                for ($j=0; $j < count($idprdk); $j++) { 
                    $trxDetail = $this->db->query("SELECT * FROM transaksi_detail WHERE kode_transaksi = '".$kodeTrx."' AND id_produk = '".$idprdk[$j]."'")->row_array();     
                    
                    array_push($jmlArray, $trxDetail['jumlah']);
                    $this->Semprul_model->update_stok($idprdk[$j],$jmlArray[$j]);
                    $this->Semprul_model->update_stok_ukuran($id_ukuran[$j],$jmlArray[$j]);
                }   
                echo $kodeTrx; 
            }          
        }            
    }

    public function transaksi($trx)
    {
        $data['title'] = "CheckOut Sukses";
        $session = $this->session->userdata('sessionUser');
        $q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
        $da['jmlKeranjang'] = $q->num_rows();
        $data['kategori'] = $this->Admin_model->getKategori();
        $data['trx'] = $this->Semprul_model->getTransaksiDetail($trx);
        $data['total_bayar'] = $this->Semprul_model->totalBayar($trx);
        $data['rekening'] = $this->Admin_model->getRekening();

        $trxId = $this->db->query("SELECT * FROM transaksi JOIN user ON user.id_session = transaksi.id_pembeli WHERE transaksi.kode_transaksi = '".$trx."'")->row_array();
        if ($trxId == '') {
            $trxId = $this->db->query("SELECT * FROM transaksi JOIN seller ON seller.id_session_seller = transaksi.id_pembeli WHERE transaksi.kode_transaksi = '".$trx."'")->row_array();
        }

        $pesan = "<html><body>Halo ".$trxId['nama_lengkap'].". Terima Kasih telah berbelanja di toko kami. Pesanan anda telah kami terima dengan detail seperti dibawah ini. 
        <table class='table'>
            <tr>
            <th colspan='11'><center>Data Produk Yang Dipesan</center></th>
            </tr>
            <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Ukuran</th>
            <th>Penjual</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Diskon</th>
            <th>Berat</th>
            <th>Total</th>
            <th>Ongkir</th>
            <th>Status</th>
            </tr>";

        $no = 1;
        $dataTrxDetail = $this->db->query("SELECT a.*, b.*, c.* FROM `transaksi` a JOIN transaksi_detail b ON a.kode_transaksi=b.kode_transaksi JOIN produk c ON b.id_produk=c.id_produk WHERE a.kode_transaksi='".$trx."' ")->result_array();

        foreach ($dataTrxDetail as $rcd) {
            $now = date('Y-m-d H:i:s');
            if ($now > new DateTime($rcd['deadline_bayar']) AND $rcd['konfirmasi'] == '0') {
                $st = "Pending";
            }else {
                if ($rcd['status'] == '0') {
                    $st = "Pending";
                }elseif ($rcd['status'] == '1') {
                    $st = "Konfirmasi";
                }elseif ($rcd['status'] == '2') {
                    $st = "Packing";
                }elseif ($rcd['status'] == '3'){
                    $st = "OTW";
                }elseif ($rcd['status'] == '4') {
                    $st = "Sukses";
                }else {
                    $st = "Batal";
                }
            }

            if ($rcd['id_ukuran'] == 0) {
                $ukuran = "-";
            } else {
                $q = $this->db->query("SELECT ukuran FROM ukuran WHERE id = '$rcd[id_ukuran]' ")->row_array();
                $ukuran = $q['ukuran'];
            }

            $pesan .= "<tr><td>$no</td>
                        <td>$rcd[nama_produk]</td>
                        <td>$ukuran</td>
                        <td>$rcd[penjual]</td>
                        <td>Rp. ".number_format($rcd['total'],0)."</td>
                        <td>$rcd[jumlah]</td>
                        <td>$rcd[diskon]</td>
                        <td>$rcd[berat]</td>
                        <td>Rp ".number_format($rcd['total'],0)."</td>
                        <td>Rp ".number_format($rcd['ongkir'],0)."</td>
                        <td>$st</td>
                        </tr>";
        $no++; }

        $pesan .= "</table></body></html>";

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
        $this->email->to($trxId['email']); 
        $this->email->subject('ILHAM SURYA PRATAMA | semprulshop');
        $this->email->message($pesan);
        $this->email->send();

        $this->load->view('semprulshop/header_semprul', $data);
        $this->load->view('semprulshop/navbar', $da);
        $this->load->view('semprulshop/checkout_sukses', $data);
        $this->load->view('semprulshop/footer_semprul');
    }

    public function history($offset=0)
    {
        $data['title'] = "History Belanja";
        $session = $this->session->userdata('sessionUser');
        $data['kategori'] = $this->Admin_model->getKategori();
        $q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
        $da['jmlKeranjang'] = $q->num_rows();

        $data['offset']=$offset;
            $config['total_rows'] = $this->db->query("SELECT * FROM transaksi WHERE id_pembeli = '$session' ")->num_rows();
            $config['base_url'] = base_url().'produk/history';
            $config['per_page'] = 3;
            $config['full_tag_open']="<ul class='pagination'>";
            $config['full_tag_close']="</ul>";
            $config['num_tag_open']="<li>";
            $config['num_tag_close']="</li>";
            $config['next_tag_open']="<li>";
            $config['next_tag_close']="</li>";
            $config['prev_tag_open']="<li>";
            $config['prev_tag_close']="</li>";
            $config['first_tag_open']="<li>";
            $config['first_tag_close']="</li>";
            $config['last_tag_open']="<li>";
            $config['last_tag_close']="</li>";
            $config['cur_tag_open']="<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close']="</a></li>";

            $this->pagination->initialize($config);
            $data['halaman'] = $this->pagination->create_links();

        $data['history'] = $this->Semprul_model->getHistoryBelanja($session,$config['per_page'],$offset);

        $this->load->view('semprulshop/header_semprul', $data);
        $this->load->view('semprulshop/navbar', $da);
        $this->load->view('semprulshop/history_belanja', $data);
        $this->load->view('semprulshop/footer_semprul');
    }
}

?>