<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($offset=0)
	{
		$data['title'] = "WELCOME TO MY ONLINE SHOP";
		$data['kategori'] = $this->Admin_model->getKategori();
		$keyword= $this->input->get('q');
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
}
