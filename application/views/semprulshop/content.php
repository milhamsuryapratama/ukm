<div class="content">
	<div class="wrapper">
		<div class="breaking-news">
			<span class="the-title">Breaking News</span>
		</div>
		<div class="main-content">
			<div class="paragraph-row hidden-xs">
				<div class="column6">
					<a target="_BLANK" href="#"><img src="<?=base_url()?>asset3/foto_iklanatas/1.jpg" style="width:100%"></a>
				</div>
				<div class="column4" style="margin-left: 1%">
					<div class="paragraph-row">
						<div class="column12">
							<a target="_BLANK" href="#"><img src="<?=base_url()?>asset3/foto_iklanatas/2.jpg" style="width:100%; height: 190px;"></a>
						</div>
					</div>
					<div class="paragraph-row">
						<div class="column6" style="margin-top:10px">
							<a target="_BLANK" href="#"><img src="<?=base_url()?>asset3/foto_iklanatas/3.jpg" style="width:100%; height: 180px;"></a>
						</div>
						<div class="column6" style="margin-top:10px">
							<a target="_BLANK" href="#"><img src="<?=base_url()?>asset3/foto_iklanatas/4.jpg" style="width:100%; height: 180px;"></a>
						</div>
					</div>
				</div>
				<div class="column2" style="margin-left: 1%">
					<a target="_BLANK" href="#"><img src="<?=base_url()?>asset3/foto_iklanatas/5.jpg" style="width:100%; min-height: 380px;"></a>
				</div>
			</div>
			<br>
			<div class="container">
				<p class="sidebar-title text-danger produk-title">-- MONGGO DIPILIH -- </p>
				<?php foreach ($produk as $p) { ?>
					<div class="produk col-md-2 col-xs-6">
						<center>

							<div style="height:140px; overflow:hidden">
								<a title="<?=$p->nama_produk?>" href="<?=base_url()?>produk/detail/<?=$p->produk_slug?>"><img style=" min-height:140px; width:100%" src="<?=base_url()?>assets/upload/gambar_produk/<?=$p->gambar?>"></a>

							</div>
							<br>
							<h4 class="produk-title"><a title="<?=$p->nama_produk?>" href="<?=base_url()?>produk/detail/<?=$p->produk_slug?>"><strong><?=$p->nama_produk?></strong></a></h4>
							<span class="harga">
								<?php if ($p->diskon == 0) { ?>
											<h2>Rp. <?=number_format($p->harga_konsumen,0)?></h2>
										<?php } else { 
											$diskon = ($p->diskon/100) * $p->harga_konsumen;
											?>
											<h2><strike>Rp. <?=number_format($p->harga_konsumen,0)?></strike> <br>Rp. <?=number_format(($p->harga_konsumen-$diskon),0)?></h2>
										<?php } ?>
							</span>
							<!-- <i><span style="color:green">Stok 11 pcs</span></i> -->
							<!-- <br><small>Padang Panjang</small> -->
							<p><b>Penjual : <a href="<?=base_url()?>seller/detail/<?=$p->seller_slug?>"><?=$p->nama?></a></b></p>
							<?php if ($p->stok <= 0) { ?>
										<a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Stok Habis</a>
									<?php } else { 
										if ($p->diskon == 0) { ?>
											<br>
											<a href="<?=base_url()?>produk/detail/<?=$p->produk_slug?>/#true" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										<?php } else { ?>
											<a href="<?=base_url()?>produk/detail/<?=$p->produk_slug?>/#true" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>	
										<?php } ?>
										
									<?php } ?>
						</center>
					</div>
				<?php } ?>

			</div>

		</div>
	</div>
</div>