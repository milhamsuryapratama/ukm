<div class="container">
	<nav>
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-produk" role="tab" aria-controls="nav-home" aria-selected="true">Produk</a>
			<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-kategori" role="tab" aria-controls="nav-profile" aria-selected="false">Kategori</a>
			<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Detail</a>
		</div>
	</nav>
	<div class="tab-content" id="nav-tabContent">
		<?php 
					foreach ($produk as $p) { ?>
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
											<?php 
											if ($p->stok == 0) { ?>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Stok Habis</a>
											<?php } else { ?>
												<a href="<?=base_url()?>produk/detail/<?=$p->produk_slug?>/#true" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											<?php } ?>
										</div>
									</div> -->
								</div>
								<div class="choose">
								<center>
									<?php if ($p->stok <= 0) { ?>
										<a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Stok Habis</a>
									<?php } else { ?>
										<a href="<?=base_url()?>produk/detail/<?=$p->produk_slug?>/#true" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									<?php } ?>
								</center>
							</div>
						</div>
					</div>
				<?php }
				?>	
		</div>

		<div class="tab-pane fade" id="nav-kategori" role="tabpanel" aria-labelledby="nav-profile-tab">
			
		</div>

		<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"></div>
	</div>
</div>