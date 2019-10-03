<div class="content">
	<div class="wrapper">	
		<div class="breaking-news">
			<span class="the-title">Breaking News</span>

		</div>

		<div class="main-content">
			<div class="col-md-12">
				<div class="col-md-9" style="padding:0px">
					<?php foreach ($produk->result() as $p) { ?>
						<div class="col-md-3" style="padding:0px">
							<a target="_BLANK" href="http://localhost/marketplace/asset/foto_produk/gamis11.jpg">
								<img class="" style="width:100%; border:1px solid #cecece" src="<?=base_url()?>assets/upload/gambar_produk/<?=$p->gambar?>">
							</a>
							<center style="margin-top:5px"></center>
							<div style="clear:both"></div>
							<center style="color:green;"><i>Klik untuk lihat ukuran besar.</i></center>
						</div>

						<div class="col-md-9" style="padding:0px">
							<div style="margin-left:10px">
								<h1><?=$p->nama_produk?></h1>

								<?php 
									if ($this->session->userdata('status') == 'userLoginSukses' || $this->session->userdata('sellerStatus') == 'sellerLogged') { ?>
										<form action="<?=base_url()?>produk/keranjang/" method="POST">
									<?php } else { ?>
										<form action="<?=base_url()?>auth/login" method="POST">
									<?php }
								 ?>								
									<table class="table table-condensed" style="margin-bottom:0px">
										<tbody>
											<tr>
												<td colspan="2" style="color:red;"><del style="color:#8a8a8a"></del><br>
													<h1 style="display:inline-block">
														<?php if ($p->diskon == 0) { ?>
															<span>Rp. <?=number_format($p->harga_konsumen,0)?></span>
														<?php } else { 
															$diskon = ($p->diskon/100) * $p->harga_konsumen;
															?>
															<span>Rp. <?=number_format(($p->harga_konsumen-$diskon),0)?></span>
														<?php } ?>
													</h1> / pcs 
													<a target="_BLANK" style="border-radius:15px 0px 0px 15px" class="btn btn-danger btn-sm pull-right" href="https://api.whatsapp.com/send?phone=681267771355&amp;text=Gamis Green Filosifi Oxorcities TG-3452,... Apakah%20produk%20Ini%20bisa%20Nego?...">Coba Nego Pelapak</a>
												</td>			
											</tr>
											<tr>
												<td>Jumlah : </td>
												<td>
													<input type="number" value="1" name="jumlah">
													<input type="hidden" name="id_produk" value="<?=$p->id_produk?>">
													<input type="hidden" name="penjual" value="<?=$p->username?>">
												</td>	
											</tr>
											<tr>
												<td style="font-weight:bold; width:90px">Ukuran</td>
												<td>
													<?php if ($pm > 0) {
														foreach ($produk->result() as $pp) {
															if ($pp->stok_ukuran == 0) { ?>
																<input type="radio" name="ukuran" class="form-check-input" value="<?=$pp->id?>" disabled> <?=$pp->ukuran?>
															<?php } else { ?>
																<input type="radio" name="ukuran" class="form-check-input" value="<?=$pp->id?>"> <?=$pp->ukuran?>
															<?php }
														}
													} ?>
												</td>
											</tr>
											<tr>
												<th>Stok</th>
												<th><?=$p->stok?></th>
											</tr>
										</tbody>
									</table>


									<div class="alert alert-warning" style="border-radius:0px">
										<span style="color:orange" class="glyphicon glyphicon-ok"></span>
										<b>Jaminan 100% Aman</b><br>
										Uang pasti kembali. Sistem pembayaran bebas penipuan.<br>
										Barang tidak sesuai pesanan? Ikuti langkah retur barang di sini.
									</div>									

									<center><button name="submit" type="submit" class="btn btn-success btn-block btn-lg">Beli Sekarang</button></center>

								</form><br><a target="_BLANK" class="btn btn-default btn-sm" href="https://api.whatsapp.com/send?phone=681267771355&amp;text=Gamis Green Filosifi Oxorcities TG-3452,... Apakah%20Stok%20Masih%20ada?..."><span class="glyphicon glyphicon-comment"></span>  Apakah Stok Masih ada?</a> 
									<a target="_BLANK" class="btn btn-default btn-sm" href="https://api.whatsapp.com/send?phone=681267771355&amp;text=Gamis Green Filosifi Oxorcities TG-3452,... Saya%20Pesan%20Sekarang%20ya!"><span class="glyphicon glyphicon-comment"></span> Saya Pesan Sekarang ya!</a>
									<a target="_BLANK" class="btn btn-default btn-sm" href="https://api.whatsapp.com/send?phone=681267771355&amp;text=Assalam,%20Haloo!%20Umar Lapakers,%20Saya%20Mau%20Order%20Produknya..."><span style="color:green" class="glyphicon glyphicon-certificate"></span> Chat dengan Pelapak.</a>
								</div>
							</div>


						</div>
					<?php break;} ?>					
				</div>
				<div style="clear:both"><br></div>					
				<div class="clear-float"></div>
			</div>
		</div>
	</div>