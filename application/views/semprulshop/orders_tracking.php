<div class="content">
	<div class="wrapper">	
		<div class="breaking-news">
			<span class="the-title">Status Pesanan</span>
		</div>

		<div class="main-content">
			<!-- <center><p class="sidebar-title text-danger produk-title"> Order Sukses!!!</p></center>
			<center><p class="sidebar-title text-danger produk-title">Kode Transaksi : <?php echo $trx->kode_transaksi; ?></p></center>
			<center><p class="sidebar-title text-danger produk-title">Total Belanja : 
						<?php 
						echo "Rp. " . number_format($total_bayar['total']);
						?></p></center>
			<center><p class="sidebar-title text-danger produk-title">Silahkan mentransferkan uang dengan total <?php echo "Rp. " . number_format($total_bayar['total']); ?> ke salah satu pilihan bank di bawah ini : </p></center> -->

			<table class="table table-striped">
				<tr>
					<th>No</th>
					<th>Nama Produk</th>
					<th>Ukuran</th>
					<th>Penjual</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Diskon</th>
					<th>Berat</th>
					<th>Total</th>
					<th>Ongkir</th>
					<th>Dikirim Sebelum</th>
					<th>Status</th>
				</tr>
				<?php $no = 1; foreach ($record as $rcd) { 
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
							<td><?=$rcd['penjual'];?></td>
							<td><?="Rp. ".number_format($rcd['harga_jual'],0,".",",");?></td>
							<td><?=$rcd['jumlah'];?></td>
							<td><?=$rcd['diskon']?>%</td>
							<td><?=$rcd['berat'];?> Gram</td>
							<td><?="Rp. " .number_format($rcd['total'],0,".",",");?></td>
							<td><?="Rp. " .number_format($rcd['ongkir'],0,".",",")." ". "(".$rcd['kurir']."-".$rcd['service'].")" ?></td>
							<td><?php
							if ($rcd['konfirmasi'] == '0') {
								echo "-";
							}else {
								echo $rcd['deadline_pengiriman'];
							}
							?></td>
							<td><?php 
							$now = date('Y-m-d H:i:s');
							if ($now > new DateTime($rcd['deadline_bayar']) AND $rcd['konfirmasi'] == '0') {
								echo "Pending";
							}else {
								if ($now > new DateTime($rcd['deadline_pengiriman']) AND $rcd['status'] < 3) { ?>
									Batal. <a href="<?=base_url()?>pengembalian/v/<?=$rcd['kode_transaksi']?>/<?=$rcd['id_transaksi_detail']?>/<?=$this->session->userdata('sessionUser')?>/#true">Ajukan Pengembalian Dana</a>
								<?php } else {
									if ($rcd['status'] == '0') {
										echo "Pending";
									}elseif ($rcd['status'] == '1') {
										echo "Konfirmasi";
									}elseif ($rcd['status'] == '2') {
										echo "Packing";
									}elseif ($rcd['status'] == '3'){
										echo "OTW";
									}elseif ($rcd['status'] == '4') {
										echo "Sukses";
									}else {
										echo "Batal";
									}
								}
							}
							?></td>
						</tr>
						<?php $no++; } ?>
			</table>
		</div>