<div class="content">
	<div class="wrapper">	
		<div class="breaking-news">
			<span class="the-title">Keranjang</span>
		</div>

		<div class="main-content">
			<p class="sidebar-title text-danger produk-title"> Berikut Data Pesanan anda</p>
			<div class="col-md-8">

				<table class="table table-striped">
					<tbody>
						<?php if ($this->session->userdata('status') == 'userLoginSukses' || $this->session->userdata('sellerStatus') == 'sellerLogged') { ?>
							<tr>
							<td></td>
							<td>Barang</td>
							<td>Nama</td>
							<td>Harga</td>
							<td>Diskon</td>
							<td>Qty</td>
							<td>Total</td>
							<td>Action</td>
						</tr>
						<?php foreach ($cart as $k) { ?>
							<tr>
								<td colspan="8"><?=$k['username']?></td>
							</tr>
							<?php 
							$q = $this->db->query("SELECT * FROM order_temp JOIN produk ON order_temp.id_produk = produk.id_produk WHERE order_temp.id_session = '".$this->session->userdata('sessionUser')."' AND produk.username = '".$k['username']."' ORDER BY order_temp.id_order_temp DESC")->result_array();
							foreach ($q as $qo) { ?>
								<tr>
									<td><input type="checkbox" name="id" value="<?=$qo['id_order_temp']?>" onclick="getSum()" checked></td>
									<td><img src="<?=base_url()?>assets/upload/gambar_produk/<?=$qo['gambar']?>" width="50"></td>
									<td>
										<p><h4> <a href="<?=base_url()?>produk/detail/<?=$qo['produk_slug']?>/#true"><?=$qo['nama_produk']?></a> </h4></p> 
										<?php if ($qo['id_ukuran'] == 0) {
											echo "";
										} else { 
											$y = $this->db->query("SELECT ukuran FROM ukuran WHERE id = '$qo[id_ukuran]' ")->row_array();
											?>
											<span>Ukuran : <?=$y['ukuran']?></span>
										<?php } ?>
									</td>
									<td><p>Rp. <?=number_format($qo['harga_jual'],0)?></p></td>
									<td><p><?=number_format($qo['diskon'])?>%</p></td>
									<td><p><?=$qo['jumlah']?></p></td>
									<td><p class="cart_total_price">Rp. <?=number_format($qo['total'],0)?></p></td>
									<td><a class="cart_quantity_delete" href="<?=base_url()?>produk/hapus_keranjang/<?=$qo['id_order_temp']?>">Hapus</a></td>
								</tr>
							<?php }
							?>							
						<?php } ?>						

						</tbody>
					</table>

					<table class="table table-striped">
						<tbody>
							<tr>
								<td>Total</td>
								<td id="sumTotal">
									<?php 
									$session = $this->session->userdata('sessionUser');
									$total = $this->db->query("SELECT sum(total) as total FROM order_temp WHERE id_session = '$session' AND status = 'N'")->row_array();
									?>
									Rp. <?=number_format($total['total'],0)?>
								</td>
							</tr>
						</tbody>
					</table>
						<?php } else {
							echo "LOGIN SEK";
						} ?>						

					<a class="btn btn-success btn-sm" href="<?=base_url()?>">Lanjut Belanja</a>
					<input type="submit" name="goCheckout" onclick="getId()" class="btn btn-primary" value="Selesai Belanja" style="float: right;">
					<!-- <a class="btn btn-primary btn-sm" href="http://localhost/marketplace/produk/checkouts">Selesai Belanja</a> -->
					<hr><br><b>Informasi dari Reseller :</b><p></p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque condimentum mattis. Suspendisse potenti. Proin vitae elementum nisi. Aliquam eu pretium risus. Nam varius efficitur consectetur. Aenean vestibulum felis sed mollis faucibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin venenatis est sit amet eleifend vehicula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer id nunc eu odio ultrices pulvinar non feugiat felis.&nbsp; dfsdfsdf</p><p>Duis consequat urna sapien, porta gravida diam venenatis at. Duis at ornare enim, ac accumsan eros. Sed in finibus metus. Etiam blandit tristique orci, sit amet congue dui facilisis id. Donec fermentum diam at orci viverra placerat. Sed nunc lorem, cursus nec vestibulum hendrerit, tempus et libero. ertert</p></div>

				</div>
				<div class="col-sm-4 colom44">
					<!-- <table class="table table-condensed">
						<tbody>
							<tr class="alert alert-info"><th scope="row" style="width:90px">Pengirim</th> <td>Syarii Sentral</td></tr>
							<tr><th scope="row">Email</th> <td>reseller.padang@gmail.com</td></tr>

							<tr><th scope="row">Alamat</th> <td>Jl. Ulak Karang Raya, No 165, Padang Panjang, Sumatera Barat</td></tr>
							<tr><th scope="row">Keterangan</th> <td>Kami merupakan perusahaan yang bergerak dalam bidang kecantikan. Produk yang kami hasilkan secara ilmiah terbukti bermanfaat.  Harapan perusahaan kami adalah, menciptakan produk kecantikan produksi Indonesia yang berstandar internasional.</td></tr>
						</tbody>
					</table> -->
					<img style="width:100%" src="<?=base_url()?>asset3/foto_pasangiklan/ekpedisi2.jpg">
					<hr>
				</div>					<div class="clear-float"></div>
			</div>
		</div>

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

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
