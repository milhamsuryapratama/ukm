<div class="content">
	<div class="wrapper">	
		<div class="breaking-news">
			<span class="the-title">Order Sukses</span>
		</div>

		<div class="main-content">
			<center><p class="sidebar-title text-danger produk-title"> Order Sukses!!!</p></center>
			<center><p class="sidebar-title text-danger produk-title">Kode Transaksi : <?php echo $trx->kode_transaksi; ?></p></center>
			<center><p class="sidebar-title text-danger produk-title">Total Belanja : 
						<?php 
						echo "Rp. " . number_format($total_bayar['total']);
						?></p></center>
			<center><p class="sidebar-title text-danger produk-title">Silahkan mentransferkan uang dengan total <?php echo "Rp. " . number_format($total_bayar['total']); ?> ke salah satu pilihan bank di bawah ini : </p></center>

			<table class="table table-striped">
				<tr>
					<th>No</th>
					<th>Nama Bank</th>
					<th>Nomor Rekening</th>
					<th>Atas Nama</th>
				</tr>
				<?php 
				$no = 1;
				foreach ($rekening as $rkng) { ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $rkng['nama_bank']; ?></td>
						<td><?php echo $rkng['nomor_rekening']; ?></td>
						<td><?php echo $rkng['nama_pemilik']; ?></td>
					</tr>
					<?php $no++; }
					?>
			</table>
			<center>
				<p class="sidebar-title text-danger produk-title">
					Setelah melakukan Pembayaran, silahkan konfirmasi pembayaran anda <a href="<?=base_url()?>konfirmasi/#true">disini
				</p>
			</center>
		</div>