	
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

<section id="keranjang">
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
					<h2 class="title text-center">Keranjang</h2>
					<section id="cart_items">
						<div class="table-responsive cart_info">
							<table class="table table-condensed">
								<thead>
									<tr class="cart_menu">
										<td></td>
										<td class="image">Item</td>
										<td class="description">Nama Produk</td>
										<td class="price">Harga</td>
										<td class="price">Diskon</td>
										<td class="quantity">Jumlah</td>
										<td class="total">Total</td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($cart as $k) { ?>
											 <tr>
												<td colspan="7"><?=$k['username']?></td>
											</tr>
											<?php 
											$q = $this->db->query("SELECT * FROM order_temp JOIN produk ON order_temp.id_produk = produk.id_produk WHERE order_temp.id_session = '".$this->session->userdata('sessionUser')."' AND produk.username = '".$k['username']."' ORDER BY order_temp.id_order_temp DESC")->result_array();
											foreach ($q as $qo) { ?>
											<!-- <tr>
												<td colspan="7"><?=$qo['username']?></td>
											</tr> -->
												<!-- <?=$qo['id_order_temp']?> -->
												<tr>
													<td class="cart_description"><input type="checkbox" name="id" value="<?=$qo['id_order_temp']?>" onclick="getSum()" checked></td>
												<td class="cart_product">
													<img src="<?=base_url()?>assets/upload/gambar_produk/<?=$qo['gambar']?>" width="50">
												</td>
												<!-- <td><?=$k['username']?></td> -->
												<td class="cart_description">
													<p><h4> <a href="<?=base_url()?>produk/detail/<?=$qo['produk_slug']?>/#true"><?=$qo['nama_produk']?></a> </h4></p> <?php if ($qo['id_ukuran'] == 0) {
														echo "";
													} else { 
														$y = $this->db->query("SELECT ukuran FROM ukuran WHERE id = '$qo[id_ukuran]' ")->row_array();
														?>
														<span>Ukuran : <?=$y['ukuran']?></span>
													<?php } ?>
												</td>
												<td class="cart_price">
													<p>Rp. <?=number_format($qo['harga_jual'],0)?></p>
												</td>
												<td class="cart_price">
													<p><?=number_format($qo['diskon'])?>%</p>
												</td>
												<td class="cart_quantity">
													<p><?=$qo['jumlah']?></p>
												</td>
												<td class="cart_total">
													<p class="cart_total_price">Rp. <?=number_format($qo['total'],0)?></p>
												</td>
												<td class="cart_delete">
													<a class="cart_quantity_delete" href="<?=base_url()?>produk/hapus_keranjang/<?=$qo['id_order_temp']?>"><i class="fa fa-times"></i></a>
												</td>
											</tr>
												</tr>
											<?php } ?>
										<?php } ?>
										<tr>
											<td colspan="4">&nbsp;</td>
											<td colspan="2">
												<table class="table table-condensed total-result">
													<tbody>
														<tr>
															<td><strong>Total</strong></td>
															<td><span id="sumTotal">
																<?php 
																$session = $this->session->userdata('sessionUser');
																$total = $this->db->query("SELECT sum(total) as total FROM order_temp WHERE id_session = '$session' AND status = 'N'")->row_array();
																?>
																Rp. <?=number_format($total['total'],0)?>
															</span></td>
														</tr>
													</tbody></table>
												</td>
											</tr>					
											<tr>
												<td colspan="7">
													<a href="<?=base_url()?>" class="btn btn-primary" style="float: right;">Lanjut Belanja</a>
													<!-- <button >Cek</button> -->
													<input type="submit" name="goCheckout" onclick="getId()" class="btn btn-primary" value="Selesai Belanja" style="float: right;">
													<!-- <button id="halo">HAY</button> -->
													<!-- <a href="<?=base_url()?>produk/checkout" class="btn btn-primary" style="float: right;">Selesai Belanja</a> -->
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</section> <!--/#cart_items-->														

						</div><!--features_items-->
					</div>
				</div>
			</div>
		</section>

		<script>
			var checkedid = [];
			var check = [];
			

			$(function(){
				$.each($("input[name='id']:checked"), function(){            
					check.push($(this).val());
				});
            	// console.log(check);
            })

			function getId(){
				
				$.each($("input[name='id']:checked"), function(){            
					checkedid.push($(this).val());
				});
            	// console.log(checkedid);

            	$.post("<?=base_url()?>produk/cek_checkout",{checkedid: checkedid}, (result)=>{
            		window.location.href="<?=base_url()?>produk/checkout/#true";
            	})
            }

            function getSum()
            {
            	var sum = [];

            	$.each($("input[name='id']:checked"), function(){            
            		sum.push($(this).val());
            	});

            	$.post("<?=base_url()?>produk/getsum", {sum: sum}, (result)=>{		   
            		$("#sumTotal").html("Rp. "+(result/1000).toFixed(3));
					//console.log(result);
				})
            }
            
        </script>