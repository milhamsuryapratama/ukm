	
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
					<h2 class="title text-center">Checkout</h2>
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th colspan="2"><center><strong>Data Pembeli</strong></center></th>
						</tr>
						<?php if ($user) { ?>
							<tr>
								<th>Nama</th>
								<td><?=$user['nama_lengkap']?></td>
							</tr>
							<tr>
								<th>No HP</th>
								<td><?=$user['no_hp']?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?=$user['email']?></td>
							</tr>
							<tr>
								<th>Kota</th>
								<td>
									<?php 
									$id = $user['kota_id'] - 1;
									$pro = $user['provinsi_id'] - 1;
									echo $provinsi['rajaongkir']['results'][$pro]['province'] .','. $kota['rajaongkir']['results'][$id]['city_name'];
									?> 
									<input type="hidden" id="kotaId" value="<?=$user['kota_id']?>">
								</td>
							</tr>
							<tr>
								<th>Alamat Lengkap</th>
								<td><?=$user['alamat_lengkap']?></td>
							</tr>
						<?php } else { ?>
							<tr>
								<th>Nama</th>
								<td><?=$seller['nama']?></td>
							</tr>
							<tr>
								<th>Alamat</th>
								<td><?=$seller['alamat']?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?=$seller['email']?></td>
							</tr>
							<tr>
								<th>Kota</th>
								<td>
									<?php 
									$id = $seller['kota_id'] - 1;
									$pro = $seller['provinsi_id'] - 1;
									echo $provinsi['rajaongkir']['results'][$pro]['province'] .','. $kota['rajaongkir']['results'][$id]['city_name'];
									?> 
									<input type="hidden" id="kotaId" value="<?=$seller['kota_id']?>">
								</td>
							</tr>
						<?php } ?>
					</table>
					<section id="cart_items">
						<div class="review-payment">
							<h2>Review & Payment</h2>
						</div>

						<div class="table-responsive cart_info">
							<table class="table table-condensed">
								<thead>
									<tr class="cart_menu">
										<td class="image">Item</td>
										<td class="description">Nama Produk</td>
										<td class="price">Harga</td>
										<td class="price">Diskon</td>
										<td class="quantity">Qty</td>
										<td class="total">Berat</td>
										<td>Total</td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach ($order_check as $oc) { ?>
										<tr>
											<td colspan="7"><?=$oc['username']?></td>
										</tr>
										<?php
										$q = $this->db->query("SELECT * FROM order_temp JOIN produk ON order_temp.id_produk = produk.id_produk WHERE order_temp.id_session = '".$this->session->userdata('sessionUser')."' AND produk.username = '".$oc['username']."' AND order_temp.status = 'Y' ORDER BY order_temp.id_order_temp DESC")->result_array();
										foreach ($q as $qo) { ?>
											<tr>
												<td class="cart_product">
													<input type="hidden" class="idordertemp" value="<?=$qo['id_order_temp']?>">
													<input type="hidden" class="idprdk" value="<?=$qo['id_produk']?>">
													<input type="hidden" class="id<?=$no?>" value="<?=$qo['id_order_temp']?>">
													<?php $u = $this->db->query("SELECT kota_id FROM seller WHERE nama = '".$qo['username']."'")->row_array();
													?>
													<input type="hidden" class="seller_kota_id<?=$no?>" value="<?=$u['kota_id']?>">
													<img src="<?=base_url()?>assets/upload/gambar_produk/<?=$qo['gambar']?>" width="50">
												</td>
												<td class="cart_description">
													<p><h4><?=$qo['nama_produk']?> </h4></p>
													<?php if ($qo['id_ukuran'] == '0') {
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
												<td class="cart_quantity">
													<p><?=$qo['berat']?></p>
												</td>
												<td class="cart_total">
													<p class="ttl<?=$no?>">Rp. <?=number_format($qo['total'],0)?></p>
												</td>
												<td class="cart_delete">
													<a class="cart_quantity_delete" href="<?=base_url()?>produk/hapus_keranjang/<?=$qo['id_order_temp']?>"><i class="fa fa-times"></i></a>
												</td>
											</tr>
										<?php } ?>
											<tr>
												<td colspan="7">
													<div class="review-payment">
														<h2>Pilih Kurir</h2>
													</div>
													<div class="form-group">
														<select class="kurir" id="kurir<?=$no?>" onchange="getOngkir(<?=$no?>)">
															<option selected>PILIH KURIR</option>
															<option value="jne">JNE</option>
															<option value="pos">POS</option>
															<option value="tiki">TIKI</option>
														</select>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="7"><p id="result<?=$no?>"></p></td>
											</tr>
									<?php $no++; } ?>

									<tr>
										<td colspan="4">&nbsp;</td>
										<td colspan="2">
											<table class="table table-condensed total-result">
												<tr>
													<td>Total Berat</td>
													<td>
														<span id="total_berat">
															<?php 
															$jml_berat = $this->db->query("SELECT jumlah,sum(berat*jumlah) as berat FROM order_temp JOIN produk WHERE order_temp.id_produk = produk.id_produk AND id_session = '".$this->session->userdata('sessionUser')."' AND status = 'Y'")->row_array();
															echo $jml_berat['berat'] . '</span> <span> Kg </span>';
															?>
														</span>
													</td>
												</tr>
												<tr>
													<td>Total Bayar</td>
													<td><span>
														<?php 
														$total = $this->db->query("SELECT sum(total) as total FROM order_temp WHERE id_session = '".$this->session->userdata('sessionUser')."' AND status = 'Y'")->row_array();
														echo "<p id='total'>Rp. " .number_format($total['total'],0) ."</p>";
														?>
														<input type="hidden" name="total_bayar" id="total_bayar" value="<?=$total['total']?>">
													</td></span>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="4"></td>
										<td>
											<button id="simpan" class="btn btn-primary" onclick="proses()">Lakukan Pembayaran</button>
											<form action="<?=base_url()?>produk/cancle_checkout">
												<button type="submit" id="batal" class="btn btn-primary">Batal</button>
											</form>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</section>
					<!-- <div class="review-payment">
						<h2>Pilih Kurir</h2>
					</div>
					<div class="form-group">
						<select class="form-control" id="kurir" onchange="getOngkir()">
							<option selected>PILIH KURIR</option>
							<option value="jne">JNE</option>
							<option value="pos">POS</option>
							<option value="tiki">TIKI</option>
						</select>
					</div> -->
					<!-- <p id="result"></p>	 -->
				</div><!--features_items-->
			</div>
		</div>
	</div>
</section>

<script>

	var totalFix = '';
	var service = '';
	var ongkir = '';
	var estimasi = '';
	var idk = [];
	var idprdk = [];

	$(function(n){
		$("#simpan").hide();

		let idordertemp = $('.idordertemp');
		let prkdId = $('.idprdk');
		for (var i = 0; i < idordertemp.length; i++) {
			let id = $('.id'+i);
			idk.push($(idordertemp[i]).val());
			idprdk.push($(prkdId[i]).val());
		}
		console.log(idprdk);
	})

	function getOngkir(n)
	{
		$("#simpan").hide();

		// alert('#result${i}');
		let asal = $('.seller_kota_id'+n).val();
		let tujuan = $('#kotaId').val();
		let berat = $('#total_berat').html();
		let kurir = $('#kurir'+n).val();
		let output = '';
		let total = $('#total_bayar').val();
		// let id = $('#id').val();

		$.get("<?=base_url()?>produk/kurir/"+`${asal}/${tujuan}/${berat}/${kurir}`, {},(response)=>{
			// console.log(response);
			let biaya = response.rajaongkir.results;
			// let k = 1;

			biaya.map((val,i)=>{
				for (var i = 0; i < val.costs.length; i++) {
					let jenis_layanan = val.costs[i].service;
					let description = val.costs[i].description;
					val.costs[i].cost.map((val,i)=>{
						output += `<div id="rb"><input type="radio" name="kurir_detail${n}" class="rbdtl${n}" value="${val.value}" onchange="krClick(${n})"> ${jenis_layanan} (${description}) - Biaya :  ${val.value}  - Estimasi : ${val.etd} hari <br></div>`;
					})
					// k = k + 1;
				}
			})
			$('#total').html("Rp. "+(total/1000).toFixed(3));
			$('#result'+n).html(output);
		})
	}

	function krClick(n){
		let radioChecked = $(".rbdtl"+n+":checked");
		let radio = $(".rbdtl"+n);
		let index = radio.index(radioChecked);
		let asal = $('.seller_kota_id'+n).val();
		let tujuan = $('#kotaId').val();
		let berat = $('#total_berat').html();
		let kurir = $('#kurir'+n).val();
		let id = $('.id'+n);
		let idp = [];
		let ttl = $('.ttl'+n);

		for (var i = 0; i < id.length; i++) {
			idp.push($(id[i]).val());
		}

		// console.log(idp);

		$.get("<?=base_url()?>produk/kurir/"+`${asal}/${tujuan}/${berat}/${kurir}`, {},(response)=>{
			let biaya = response.rajaongkir.results;
			biaya.map((val,i)=>{
				for (var i = 0; i < val.costs.length; i++) {
					var pp = val.costs[index].cost[0];
					kurirR = val.code;
					serviceR = val.costs[index].service;
					etdR = val.costs[index].cost[0].etd;
					ongkirR = val.costs[index].cost[0].value;
					// output = pp.value;
					$.post("<?=base_url()?>produk/sum_total",{idp: idp, serviceR: serviceR, etdR: etdR, ongkirR: ongkirR, kurirR: kurirR},(result)=>{
						
						// totalFix = parseInt(pp.value) + parseInt(result[0].total) ;	
						service = serviceR;
						estimasi = etdR;
						ongkir = ongkirR;
						console.log(result[0].total);
						for (var j = 0; j< ttl.length; j++) {
							totalFix = parseInt(pp.value) + parseInt(result[j].total)
							$(ttl[j]).html("Rp. "+(totalFix/1000).toFixed(3));
							$('#total').html("Rp. "+(result[j].tot/1000).toFixed(3));
						}
							
						$("#simpan").show();				
					})
					break;
				}
			})			
		})
	}	

	function proses()
	{
		$.post("<?=base_url()?>produk/order_proses",{idk: idk, idprdk: idprdk},(result)=>{
			var trx = $.trim(result);
			console.log(trx);
			window.location.href="<?=base_url()?>produk/transaksi/"+`${trx}`+"/#true";
		})
	}

</script>