<div class="content">
	<div class="wrapper">
		<div class="breaking-news">
			<span class="the-title">Breaking News</span>
		</div>
		<div class="main-content">
			<table class="table table-striped">
				<tr>
					<th>Penjualan</th>
				</tr>
				<tr>
					<th>No</th>
					<th>Kode Transaksi</th>
					<th>Waktu Pemesanan</th>
					<th>Waktu Bayar</th>
					<th>Detail</th>
				</tr>
				<?php 
				$no = 1;
				foreach ($trx->result_array() as $t) { ?>
					<tr>
						<td><?=$no?></td>
						<td><?=$t['kode_transaksi']?></td>
						<td><?=$t['waktu_transaksi']?></td>
						<td><?php if ($t['waktu_konfirmasi'] != null) {
							echo $t['waktu_konfirmasi'];
						} else {
							echo "Belum Dibayar";
						} ?></td>	
						<td><a href="<?=base_url()?>seller/penjualan_detail/<?=$t['kode_transaksi']?>" class="btn btn-primary">Detail</a></td>
					</tr>
					<?php $no++; } ?>
				</table>
		</div>
	</div>
</div>