	
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
					<h2 class="title text-center">Orders Tracking</h2>
					<table class="table">
						<tr>
							<th colspan="2"><center>Data Order</center></th>
						</tr>
						<?php if ($rows) { ?>
							<tr>
							<th>Kode Transaksi</th>
							<td><?php echo $rows['kode_transaksi']; ?></td>
						</tr>
						<tr>
							<th>Waktu Transaksi</th>
							<td><?php echo $rows['waktu_transaksi']; ?></td>
						</tr>
						<tr>
							<th>Dealine Bayar</th>
							<td><?php echo $rows['deadline_bayar']; ?></td>
						</tr>
						<tr>
							<th>Nama</th>
							<td><?php echo $rows['nama_lengkap']; ?></td>
						</tr>
						<tr>
							<th>No HP</th>
							<td><?php echo $rows['no_hp']; ?></td>
						</tr>
						<tr>
							<th>Email</th>
							<td><?php echo $rows['email']; ?></td>
						</tr>
						<tr>
							<th>Kota</th>
							<td>
								<?php 
								$id = $rows['kota_id'] - 1; 
								$pro = $rows['provinsi_id'] - 1;
								echo $provinsi['rajaongkir']['results'][$pro]['province'] .', '. $kota['rajaongkir']['results'][$id]['city_name'];
								?>
							</td>
						</tr>
						<tr>
							<th>Alamat Lengkap</th>
							<td><?php echo $rows['alamat_lengkap']; ?></td>
						</tr>
						<tr>
							<th>Total Bayar</th>
							<td><?php echo "Rp. ".number_format($total['total_bayar'],0); ?></td>
						</tr>
						<tr>
							<th>Waktu Bayar</th>
							<td><?php if ($rows['konfirmasi'] != 0) { ?>
								<strong>Dibayar pada <?=$rows['waktu_konfirmasi']?></strong>
							<?php } else { 
								$now = date('Y-m-d H:i:s');
								if ($now > $rows['deadline_bayar'] AND $rows['konfirmasi'] == '0') {
									echo "Anda tidak bisa melakukan konfirmasi karena anda telah melewati batas waktu pembayaran";
								} else { ?>
									Belum Terkonfirmasi. <a href="<?=base_url()?>konfirmasi/#true">Konfirmasi Sekarang ?</a>
								<?php } ?>
								
							<?php } ?>
						</td>
					</tr>
						<?php } else { ?>
							<tr>
							<th>Kode Transaksi</th>
							<td><?php echo $sel['kode_transaksi']; ?></td>
						</tr>
						<tr>
							<th>Waktu Transaksi</th>
							<td><?php echo $sel['waktu_transaksi']; ?></td>
						</tr>
						<tr>
							<th>Dealine Bayar</th>
							<td><?php echo $sel['deadline_bayar']; ?></td>
						</tr>
						<tr>
							<th>Nama</th>
							<td><?php echo $sel['nama_lengkap']; ?></td>
						<!-- </tr>
						<tr>
							<th>No HP</th>
							<td><?php echo $sel['no_hp']; ?></td>
						</tr> -->
						<tr>
							<th>Email</th>
							<td><?php echo $sel['email']; ?></td>
						</tr>
						<tr>
							<th>Kota</th>
							<td>
								<?php 
								$id = $sel['kota_id'] - 1; 
								$pro = $sel['provinsi_id'] - 1;
								echo $provinsi['rajaongkir']['results'][$pro]['province'] .', '. $kota['rajaongkir']['results'][$id]['city_name'];
								?>
							</td>
						</tr>
						<tr>
							<th>Alamat Lengkap</th>
							<td><?php echo $sel['alamat']; ?></td>
						</tr>
						<tr>
							<th>Total Bayar</th>
							<td><?php echo "Rp. ".number_format($total['total_bayar'],0); ?></td>
						</tr>
						<tr>
							<th>Waktu Bayar</th>
							<td><?php if ($sel['konfirmasi'] != 0) { ?>
								<strong>Dibayar pada <?=$sel['waktu_konfirmasi']?></strong>
							<?php } else { 
								$now = date('Y-m-d H:i:s');
								if ($now > $sel['deadline_bayar'] AND $sel['konfirmasi'] == '0') {
									echo "Anda tidak bisa melakukan konfirmasi karena anda telah melewati batas waktu pembayaran";
								} else { ?>
									Belum Terkonfirmasi. <a href="<?=base_url()?>konfirmasi/#true">Konfirmasi Sekarang ?</a>
								<?php } ?>
								
							<?php } ?>
						</td>
					</tr>
						<?php } ?>
				</table>
				<table class="table">
					<tr>
						<th colspan="11"><center>Data Produk Yang Dipesan</center></th>
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
						<th>Dikirim Sebelum</th>
						<th>Status</th>>
					</tr>
					<?php $no = 1; foreach ($record as $rcd) { 
						if ($rcd['id_ukuran'] == 0) {
							$ukuran = "-";
						} else {
							$q = $this->db->query("SELECT ukuran FROM ukuran WHERE id = '$rcd[id_ukuran]' ")->row_array();
							$ukuran = $q['ukuran'];
						}
						?>
						<tr>
							<td><?=$no?></td>
							<td><?=$rcd['nama_produk'];?></td>
							<td><?=$ukuran;?></td>
							<td><?=$rcd['penjual'];?></td>
							<td><?="Rp. ".number_format($rcd['harga_jual'],0,".",",");?></td>
							<td><?=$rcd['jumlah'];?></td>
							<td><?=$rcd['diskon']?>%</td>
							<td><?=$rcd['berat'];?> Gram</td>
							<td><?="Rp. " .number_format($rcd['total'],0,".",",");?></td>
							<td><?="Rp. " .number_format($rcd['ongkir'],0,".",",")." ". "(".$rcd['kurir']."-".$rcd['service'].")" ?></td>
							<td><?php
							if ($rcd['konfirmasi'] == '0') {
								echo "-";
							}else {
								echo $rcd['deadline_pengiriman'];
							}
							?></td>
							<td><?php 
							$now = date('Y-m-d H:i:s');
							if ($now > new DateTime($rcd['deadline_bayar']) AND $rcd['konfirmasi'] == '0') {
								echo "Pending";
							}else {
								if ($now > new DateTime($rcd['deadline_pengiriman']) AND $rcd['status'] < 3) { ?>
									Batal. <a href="<?=base_url()?>pengembalian/v/<?=$rcd['kode_transaksi']?>/<?=$rcd['id_transaksi_detail']?>/<?=$this->session->userdata('sessionUser')?>/#true">Ajukan Pengembalian Dana</a>
								<?php } else {
									if ($rcd['status'] == '0') {
										echo "Pending";
									}elseif ($rcd['status'] == '1') {
										echo "Konfirmasi";
									}elseif ($rcd['status'] == '2') {
										echo "Packing";
									}elseif ($rcd['status'] == '3'){
										echo "OTW";
									}elseif ($rcd['status'] == '4') {
										echo "Sukses";
									}else {
										echo "Batal";
									}
								}
							}
							?></td>
						</tr>
						<?php $no++; } ?>
						<tr>
							<td colspan="11"><input type="button" onclick="self.history.back()" value="Kembali" class="btn btn-primary"></td>
						</tr>
					</table>
				</div><!--features_items-->
			</div>
		</div>
	</div>
</section>