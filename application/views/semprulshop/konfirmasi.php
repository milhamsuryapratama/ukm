<div class="content">
	<div class="wrapper">	
		<div class="breaking-news">
			<span class="the-title">Konfirmasi Pembayaran</span>
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
					<td>Kode Transaksi</td>
					<td>
						<input type="text" name="kode_transaksi" id="kode_transaksi" class="form-control">
						<small>Bukti Pembayaran Hanya Bisa Di Kirim Satu Kali</small>
					</td>
					<td>
						<button type="submit" name="cek" class="btn btn-primary" onclick="konfirmasi_detail()">Cek</button>
					</td>
				</tr>
			</table>
			<center>
				<p class="sidebar-title text-danger produk-title">
					Setelah melakukan Pembayaran, silahkan konfirmasi pembayaran anda <a href="<?=base_url()?>konfirmasi/#true">disini
				</p>
			</center>
		</div>


		<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

		<script>
			function konfirmasi_detail() {
				let kode = $("#kode_transaksi").val();

				$.post("<?=base_url()?>konfirmasi/cek", {kode: kode}, (result)=>{
					if (result) {
						alert(result);
					}else {
						window.location.href="<?=base_url()?>konfirmasi/detail/"+`${kode}`+"/#true";
					}
				})
			}
		</script>