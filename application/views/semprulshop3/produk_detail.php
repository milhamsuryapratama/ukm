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

			<?php 
			foreach ($produk->result() as $p) { ?>
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Produk Detail</h2>
						<div class="product-details"><!--product-details-->
							<div class="col-sm-5">
								<div class="view-product">
									<img src="<?=base_url()?>assets/upload/gambar_produk/<?=$p->gambar?>" alt="" />				
								</div>

							</div>
							<div class="col-sm-7">
								<div class="product-information"><!--/product-information-->
									<img src="images/product-details/new.jpg" class="newarrival" alt="" />
									<h2><?=$p->nama_produk?></h2>
									<span>
										<?php if ($p->diskon == 0) { ?>
											<span>Rp. <?=number_format($p->harga_konsumen,0)?></span>
										<?php } else { 
											$diskon = ($p->diskon/100) * $p->harga_konsumen;
											?>
											<span>Rp. <?=number_format(($p->harga_konsumen-$diskon),0)?></span>
										<?php } ?>
										<!-- <span>Rp. <?=number_format($p->harga_konsumen,0)?></span> --><br><br><br>
										<?php 
										if ($this->session->userdata('status') == 'userLoginSukses' || $this->session->userdata('sellerStatus') == 'sellerLogged') { ?>
											<form action="<?=base_url()?>produk/keranjang/#keranjang" method="post">
												<label>Quantity:</label>
												<input type="number" value="1" name="jumlah">
												<input type="hidden" name="id_produk" value="<?=$p->id_produk?>">
												<input type="hidden" name="penjual" value="<?=$p->username?>">
												<?php if ($pm > 0) { ?>
													<div class=" form-check-inline"><?php 
													foreach ($produk->result() as $pp) {
														if ($pp->stok_ukuran == 0) { ?>
														 	<input type="radio" name="ukuran" class="form-check-input" value="<?=$pp->id?>" disabled> <?=$pp->ukuran?>
														 <?php } else { ?>
														 	<input type="radio" name="ukuran" class="form-check-input" value="<?=$pp->id?>"> <?=$pp->ukuran?>
														 <?php } ?>
														
													<?php }?>
												</div>
											<?php } else {
												echo "";
											} ?>
											<button type="submit" class="btn btn-fefault cart" name="submit">
												<i class="fa fa-shopping-cart"></i>
												Add to cart
											</button>
										</form>
									<?php }else{ ?>
										<form action="<?=base_url()?>auth/login" method="post">
											<label>Quantity:</label>
											<input type="text" value="1" name="jumlah">
											<input type="hidden" name="id_produk" value="<?=$p->id_produk?>"><br>
											<div class=" form-check-inline">
												<?php if ($pm > 0) { ?>
													<div class=" form-check-inline"><?php 
													foreach ($produk->result() as $pp) { ?>
														<input type="radio" name="ukuran" class="form-check-input" value="<?=$pp->id?>"> <?=$pp->ukuran?>
													<?php }?>
												</div>
											<?php } else {
												echo "";
											} ?>
										</div>
										<button type="submit" class="btn btn-fefault cart" name="submit">
											<i class="fa fa-shopping-cart"></i>
											Add to cart
										</button>
									</form>
								<?php } break;?>									
							</span>
						</div><!--/product-information-->
					</div>
				</div><!--/product-details-->	
			</div>
		</div>
	<?php }
	?>

</div>
</div>
</section>