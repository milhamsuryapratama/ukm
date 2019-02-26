<br>
<div class="container">
	<div class="row">
		<div class="col-8">
			<table class="table">
				<?php if ($rows) { ?>
					<tr>
						<th>Kode Transaksi</th>
						<td><?php echo $rows['kode_transaksi']; ?></td>
					</tr>
					<tr>
						<th>Waktu Transaksi</th>
						<td><?php echo $rows['waktu_transaksi']; ?></td>
					</tr>
					<tr>
						<th>Dealine Bayar</th>
						<td><?php echo $rows['deadline_bayar']; ?></td>
					</tr>
					<tr>
						<th>Nama</th>
						<td><?php echo $rows['nama_lengkap']; ?></td>
					</tr>
					<tr>
						<th>No HP</th>
						<td><?php echo $rows['no_hp']; ?></td>
					</tr>
					<tr>
						<th>Email</th>
						<td><?php echo $rows['email']; ?></td>
					</tr>
					<tr>
						<th>Kota</th>
						<td>
							<?php 
							$id = $rows['kota_id'] - 1; 
							$pro = $rows['provinsi_id'] - 1;
							echo $provinsi['rajaongkir']['results'][$pro]['province'] .', '. $kota['rajaongkir']['results'][$id]['city_name'];
							?>
						</td>
					</tr>
					<tr>
						<th>Alamat Lengkap</th>
						<td><?php echo $rows['alamat_lengkap']; ?></td>
					</tr>
					<tr>
						<th>Total Bayar</th>
						<td><?php echo "Rp. ".number_format($total['total_bayar'],0); ?></td>
					</tr>
					<tr>
						<th>Waktu Bayar</th>
						<td><?php if ($rows['konfirmasi'] != 0) { ?>
							<strong>Dibayar pada <?=$rows['waktu_konfirmasi']?></strong> <a href="<?=base_url()?>assets/upload/konfirmasi/<?=$rows['bukti_transfer']?>">Disini</a>
						<?php } else { 
							$now = date('Y-m-d H:i:s');
							if ($now > $rows['deadline_bayar'] AND $rows['konfirmasi'] == '0') {
								echo "Anda tidak bisa melakukan konfirmasi karena anda telah melewati batas waktu pembayaran";
							} else { ?>
								Belum Terkonfirmasi. <a href="<?=base_url()?>konfirmasi/#true">Konfirmasi Sekarang ?</a>
							<?php } ?>

						<?php } ?>
					</td>
				</tr>
			<?php } else { ?>
				<tr>
					<th>Kode Transaksi</th>
					<td><?php echo $sel['kode_transaksi']; ?></td>
				</tr>
				<tr>
					<th>Waktu Transaksi</th>
					<td><?php echo $sel['waktu_transaksi']; ?></td>
				</tr>
				<tr>
					<th>Dealine Bayar</th>
					<td><?php echo $sel['deadline_bayar']; ?></td>
				</tr>
				<tr>
					<th>Nama</th>
					<td><?php echo $sel['nama_lengkap']; ?></td>
						<!-- </tr>
						<tr>
							<th>No HP</th>
							<td><?php echo $sel['no_hp']; ?></td>
						</tr> -->
						<tr>
							<th>Email</th>
							<td><?php echo $sel['email']; ?></td>
						</tr>
						<tr>
							<th>Kota</th>
							<td>
								<?php 
								$id = $sel['kota_id'] - 1; 
								$pro = $sel['provinsi_id'] - 1;
								echo $provinsi['rajaongkir']['results'][$pro]['province'] .', '. $kota['rajaongkir']['results'][$id]['city_name'];
								?>
							</td>
						</tr>
						<tr>
							<th>Alamat Lengkap</th>
							<td><?php echo $sel['alamat']; ?></td>
						</tr>
						<tr>
							<th>Total Bayar</th>
							<td><?php echo "Rp. ".number_format($total['total_bayar'],0); ?></td>
						</tr>
						<tr>
							<th>Waktu Bayar</th>
							<td><?php if ($sel['konfirmasi'] != 0) { ?>
								<strong>Dibayar pada <?=$sel['waktu_konfirmasi']?></strong> <a href="<?=base_url()?>assets/upload/konfirmasi/<?=$sel['bukti_transfer']?>">Disini</a>
							<?php } else { 
								$now = date('Y-m-d H:i:s');
								if ($now > $sel['deadline_bayar'] AND $sel['konfirmasi'] == '0') {
									echo "Anda tidak bisa melakukan konfirmasi karena anda telah melewati batas waktu pembayaran";
								} else { ?>
									Belum Terkonfirmasi. <a href="<?=base_url()?>konfirmasi/#true">Konfirmasi Sekarang ?</a>
								<?php } ?>
								
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<div class="col-4">
			<div class="card">
				<h5 class="card-header">Total Bayar</h5>
				<div class="card-body">
					<p class="card-text">
						<?php echo "Rp. ".number_format($total['total_bayar'],0,".",","); ?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="col-12">
		<table class="table">
			<tr>
				<th>No</th>
				<th>Nama Produk</th>
				<th>Ukuran</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Berat</th>
				<th>Total</th>
				<th>Ongkir</th>
				<th>Dikirim Sebelum</th>
				<th>Status</th>
			</tr>
			<?php $no = 1; foreach ($record as $rcd) { 
				$now = date('Y-m-d H:i:s');
				if ($now > $rcd['deadline_bayar'] AND $rcd['konfirmasi'] == '0') {

					$status = '<i class="text-success">Pending</i>';
					$color = 'danger';
					$text = 'Batal';
				} else {
					if ($rcd['status'] == "0") {
						$status = '<i class="text-danger">Pending</i>';
						$color = 'danger';
						$text = 'Pending';
					}else if ($rcd['status'] == "1") {
						$status = '<i class="text-warning">Pending</i>';
						$color = 'warning';
						$text = 'Konfirmasi';
					}else if ($rcd['status'] == "2") {
						$status = '<i class="text-info">Pending</i>';
						$color = 'info';
						$text = 'Packing';
					}else if ($rcd['status'] == "3"){
						$status = '<i class="text-success">Pending</i>';
						$color = 'success';
						$text = 'OTW';
					}else if ($rcd['status'] == "4") {
						$status = '<i class="text-success">Pending</i>';
						$color = 'success';
						$text = 'Sukses';
					}
				}

				if ($rcd['id_ukuran'] == 0) {
					$ukuran = "-";
				} else {
					$q = $this->db->query("SELECT ukuran FROM ukuran WHERE id = '$rcd[id_ukuran]' ")->row_array();
					$ukuran = $q['ukuran'];
				}
				?>
				<tr>
					<td><?=$no?></td>
					<td><?=$rcd['nama_produk'];?></td>
					<td><?=$ukuran;?></td>
					<td><?="Rp. ".number_format($rcd['harga_jual'],0,".",",");?></td>
					<td><?=$rcd['jumlah'];?></td>
					<td><?=$rcd['berat'];?></td>
					<td><?="Rp. " .number_format($rcd['total'],0,".",",");?></td>
					<td><?="Rp. " .number_format($rcd['ongkir'],0,".",",")." ". "(".$rcd['kurir']."-".$rcd['service'].")" ?></td>
					<td><?php
					if ($rcd['konfirmasi'] == '0') {
						echo "-";
					}else {
						echo $rcd['deadline_pengiriman'];
					}
					?></td>
					<td><!-- Example split danger button -->
						<div class="btn-group">
							<button type="button" class="btn btn-<?=$color?>"><?=$text?></button>
							<button type="button" class="btn btn-<?=$color?> dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?=base_url()?>administrator/orders_status/<?=$rcd['kode_transaksi']?>/<?=$rcd['id_transaksi_detail']?>/0">Pending</a>
								<a class="dropdown-item" href="<?=base_url()?>administrator/orders_status/<?=$rcd['kode_transaksi']?>/<?=$rcd['id_transaksi_detail']?>/1">Konfirmasi</a>
								<a class="dropdown-item" href="<?=base_url()?>administrator/orders_status/<?=$rcd['kode_transaksi']?>/<?=$rcd['id_transaksi_detail']?>/2">Packing</a>
								<a class="dropdown-item" href="<?=base_url()?>administrator/orders_status/<?=$rcd['kode_transaksi']?>/<?=$rcd['id_transaksi_detail']?>/3">OTW</a>
								<a class="dropdown-item" href="<?=base_url()?>administrator/orders_status/<?=$rcd['kode_transaksi']?>/<?=$rcd['id_transaksi_detail']?>/4">Sukses</a>
							</div>
						</div></td>
					</tr>
					<?php $no++; } ?>
				</table>
			</div>
		</div>