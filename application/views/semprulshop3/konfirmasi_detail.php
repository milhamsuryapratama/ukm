	
<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner">
						<div class="item active">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>Free E-Commerce Template</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Get it now</button>
							</div>
							<div class="col-sm-6">
								<img src="<?=base_url()?>assets/images/home/girl1.jpg" class="girl img-responsive" alt="" />
								<img src="<?=base_url()?>assets/images/home/pricing.png"  class="pricing" alt="" />
							</div>
						</div>
						<div class="item">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>100% Responsive Design</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Get it now</button>
							</div>
							<div class="col-sm-6">
								<img src="<?=base_url()?>assets/images/home/girl2.jpg" class="girl img-responsive" alt="" />
								<img src="<?=base_url()?>assets/images/home/pricing.png"  class="pricing" alt="" />
							</div>
						</div>

						<div class="item">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>Free Ecommerce Template</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Get it now</button>
							</div>
							<div class="col-sm-6">
								<img src="<?=base_url()?>assets/images/home/girl3.jpg" class="girl img-responsive" alt="" />
								<img src="<?=base_url()?>assets/images/home/pricing.png" class="pricing" alt="" />
							</div>
						</div>

					</div>

					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>

			</div>
		</div>
	</div>
</section><!--/slider-->

<section id="true">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Category</h2>
					<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						<?php 
						foreach ($kategori as $k) { ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="<?=base_url()?>produk/kategori/<?=$k['kategori_slug']?>/#true"><?=$k['nama_kategori']?></a></h4>
								</div>
							</div>
						<?php } ?>
					</div><!--/category-products-->
				</div>
			</div>

			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">Konfirmasi Detail</h2>
					<form method="post" enctype="multipart/form-data" action="<?=base_url()?>konfirmasi/simpan">
						<table class="table">
							<tr>
								<th>Kode Transaksi</th>
								<td><input type="text" name="kode_transaksi" id="kode_transaksi" class="form-control" value="<?=$query['kode_transaksi']?>"></td>
							</tr>
							<tr>
								<th>Total Bayar</th>
								<td id="bayar"><input type="text" name="total" value="<?="Rp. " .number_format($query['total'],0)?>" class="form-control"></td>
							</tr>
							<tr>
								<th>Pilih Rekening</th>
								<td>
									<select class="form-control" name="rekening" id="rekening" required>
										<option selected><b>Pilih Rekening</b></option>
										<?php 
										$query = $this->db->query("SELECT * FROM rekening")->result_array();
										foreach ($query as $value) {
											echo "<option value='$value[id_rekening]'> $value[nama_bank] - $value[nomor_rekening] A/n : $value[nama_pemilik]</option>";
										}?>
									</select>
								</td>
							</tr>
							<tr>
								<th>Nama Pengirim</th>
								<td>
									<?php 
									$session = $this->session->userdata('sessionUser');
									$q = $this->db->query("SELECT * FROM user JOIN transaksi WHERE id_session = '".$session."'")->row_array();
									if ($q != '') { ?>
										<input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" value="<?php echo $q['nama_lengkap'] ?>">
									<?php } else {
										$q = $this->db->query("SELECT * FROM seller JOIN transaksi WHERE id_session_seller = '".$session."'")->row_array(); ?>
										<input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" value="<?php echo $q['nama_lengkap'] ?>">
									<?php }
									?>
								</td>
							</tr>
							<tr>
								<th>Tanggal Transfer</th>
								<td><input type="date" name="tanggal_konfirmasi" id="tanggal_konfirmasi" class="form-control" value="<?php echo date('Y-m-d') ?>"></td>
							</tr>
							<tr>
								<th>Bukti Transfer</th>
								<td><input type="file" name="bukti_tf" id="bukti_tf" class="form-control" required></td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" name="submit" value="Kirimkan" class="btn btn-primary"></td>
							</tr>
						</table>
					</form>	
				</div><!--features_items-->
			</div>
		</div>
	</div>
</section>