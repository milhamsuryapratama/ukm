<div class="content">
	<div class="wrapper">	
		<div class="breaking-news">
			<span class="the-title">CheckOut</span>
		</div>

		<div class="main-content">
			<p class="sidebar-title text-danger produk-title"> Berikut Data Pesanan anda</p>
			<div class="col-md-8">

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

				<table class="table table-striped">
					<tbody>
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
						<?php $no = 1; foreach ($order_check as $k) { ?>
							<tr>
								<td colspan="8"><strong>Penjual : <?=$k['username']?>
									(
										<?php 
										$id = $k['kota_id'] - 1;
										$pro = $k['provinsi_id'] - 1;
										echo $provinsi['rajaongkir']['results'][$pro]['province'] .','. $kota['rajaongkir']['results'][$id]['city_name'];
										?>
									)</strong>
								</td>
							</tr>
							<?php 
							$q = $this->db->query("SELECT * FROM order_temp JOIN produk ON order_temp.id_produk = produk.id_produk WHERE order_temp.id_session = '".$this->session->userdata('sessionUser')."' AND produk.username = '".$k['username']."' AND order_temp.status = 'Y' ORDER BY order_temp.id_order_temp DESC")->result_array();
							foreach ($q as $qo) { ?>
								<input type="hidden" class="idordertemp" value="<?=$qo['id_order_temp']?>">
								<input type="hidden" class="idprdk" value="<?=$qo['id_produk']?>">
								<input type="hidden" class="id<?=$no?>" value="<?=$qo['id_order_temp']?>">
								<?php $u = $this->db->query("SELECT kota_id FROM seller WHERE nama = '".$qo['username']."'")->row_array();
								?>
								<input type="hidden" class="seller_kota_id<?=$no?>" value="<?=$u['kota_id']?>">
								<tr>
									<td></td>
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
									<td><p class="cart_total_price"><p class="ttl<?=$no?>">Rp. <?=number_format($qo['total'],0)?></p></td>
									<!-- <td><a class="cart_quantity_delete" href="<?=base_url()?>produk/hapus_keranjang/<?=$qo['id_order_temp']?>">Hapus</a></td> -->
								</tr>								
							<?php }
							?>		
							<tr>
									<td>
										<h2>Pilih Kurir</h2>
									</td>
									<td colspan="6">
										<select class="kurir" id="kurir<?=$no?>" onchange="getOngkir(<?=$no?>)">
											<option selected>PILIH KURIR</option>
											<option value="jne">JNE</option>
											<option value="pos">POS</option>
											<option value="tiki">TIKI</option>
										</select>
									</td>
								</tr>	
								<tr>
									<td>Pilih</td>
									<td colspan="5">
										<p id="result<?=$no?>"></p>
									</td>
								</tr>				
						<?php $no++; } ?>						

						</tbody>
					</table>

					<table class="table table-striped">
						<tbody>
							<tr>
								<td>Total</td>
								<td>
									<?php 
									$total = $this->db->query("SELECT sum(total) as total FROM order_temp WHERE id_session = '".$this->session->userdata('sessionUser')."' AND status = 'Y'")->row_array();
									echo "<p id='total'>Rp. " .number_format($total['total'],0) ."</p>";
									?>
									<input type="hidden" name="total_bayar" id="total_bayar" value="<?=$total['total']?>">
								</td>
							</tr>
							<tr>
								<td>Total Berat</td>
								<td><span id="total_berat">
									<?php 
									$jml_berat = $this->db->query("SELECT jumlah,sum(berat*jumlah) as berat FROM order_temp JOIN produk WHERE order_temp.id_produk = produk.id_produk AND id_session = '".$this->session->userdata('sessionUser')."' AND status = 'Y'")->row_array();
									echo $jml_berat['berat'] . '</span> <span> Kg </span>';
									?>
									</span>
								</td>
							</tr>
						</tbody>
					</table>

					<a class="btn btn-success btn-sm" href="<?=base_url()?>produk/cancle_checkout">Batal</a>
					<input type="submit" name="goCheckout" onclick="proses()" class="btn btn-primary" value="Lakukan Pembayaran" style="float: right;">
					<!-- <a class="btn btn-primary btn-sm" href="http://localhost/marketplace/produk/checkouts">Selesai Belanja</a><hr><br><b>Informasi dari Reseller :</b><p></p> -->
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
					<img style="width:100%" src="http://localhost/marketplace/asset/foto_pasangiklan/ekpedisi2.jpg">
					<hr>
				</div>					<div class="clear-float"></div>
			</div>
		</div>

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

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
		// let total_bayar = ("#total_bayar").val();

		for (var i = 0; i < id.length; i++) {
			idp.push($(id[i]).val());
		}

		// console.log(idp);

		$.get("<?=base_url()?>produk/kurir/"+`${asal}/${tujuan}/${berat}/${kurir}`, {},(response)=>{
			console.log(response);
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
							console.log(total);
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
