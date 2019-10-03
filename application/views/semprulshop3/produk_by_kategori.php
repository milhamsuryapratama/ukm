	
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
					<?php 
					foreach ($produkbykategori as $p) { ?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?=base_url()?>assets/upload/gambar_produk/<?=$p->gambar?>" style="width:  200px; height: 200px;"/>
										<?php if ($p->diskon == 0) { ?>
											<h2>Rp. <?=number_format($p->harga_konsumen,0)?></h2>
										<?php } else { 
											$diskon = ($p->diskon/100) * $p->harga_konsumen;
											?>
											<h2><strike>Rp. <?=number_format($p->harga_konsumen,0)?></strike> <br>Rp. <?=number_format(($p->harga_konsumen-$diskon),0)?></h2>
										<?php } ?>
										<p><?=$p->nama_produk?></p>
										<p><b>Penjual : <a href="<?=base_url()?>seller/detail/<?=$p->seller_slug?>"><?=$p->nama?></a></b></p>
										
									</div>
									<!-- <div class="product-overlay">
										<div class="overlay-content">
											<?php if ($p->diskon == 0) { ?>
												<h2>Rp. <?=number_format($p->harga_konsumen,0)?></h2>
											<?php } else { 
												$diskon = ($p->diskon/100) * $p->harga_konsumen;
												?>
												<h2>Rp. <?=number_format(($p->harga_konsumen-$diskon),0)?></h2>
											<?php } ?>
											<p><?=$p->nama_produk?></p>
											<a href="<?=base_url()?>produk/detail/<?=$p->produk_slug?>/#true" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div> -->
								</div>
								<div class="choose">
									<center><a href="<?=base_url()?>produk/detail/<?=$p->produk_slug?>/#true" class="btn btn-primary add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></center>
								</div>
							</div>
						</div>
					<?php }
					?>	
				</div><!--features_items-->
				<!-- <?php echo $halaman; ?> -->
			</div>
		</div>
	</div>
</section>