	
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
					<h2 class="title text-center">Lastest Product</h2>
					<div class="alert alert-success" role="alert" align="center">
						Order Sukses
					</div>
					<p align="center">Kode Transaksi : <?php echo $trx->kode_transaksi; ?></p>
					<p align="center">Total Belanja : 
						<?php 
						echo "Rp. " . number_format($total_bayar['total']);
						?>
					</p>
					<br>
					<br>
					<p align="center">Silahkan mentransferkan uang dengan total <?php echo "Rp. " . number_format($total_bayar['total']); ?> ke salah satu pilihan bank di bawah ini : </p>
					<br>
					<table class="table table-striped table-bordered table-hover" id="myTable">
						<thead>
							<th>No</th>
							<th>Nama Bank</th>
							<th>Nomor Rekening</th>
							<th>Atas Nama</th>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							foreach ($rekening as $rkng) { ?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $rkng['nama_bank']; ?></td>
									<td><?php echo $rkng['nomor_rekening']; ?></td>
									<td><?php echo $rkng['nama_pemilik']; ?></td>
								</tr>
								<?php $no++; }
								?>
							</tbody>
						</table>
						<br>
						<p align="center">Setelah melakukan Pembayaran, silahkan konfirmasi pembayaran anda <a href="<?=base_url()?>konfirmasi/#true">disini</a>.
						Dan silahkan Menunggu info selanjutnya dari kami, salam,..</p>
					</div>
				</div><!--features_items-->
			</div>
		</div>
	</div>
</section>