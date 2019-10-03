<div class="content">
	<div class="wrapper">	
		<div class="breaking-news">
			<span class="the-title">Detail Pembayaran</span>
		</div>

		<div class="main-content">
			<!-- <center><p class="sidebar-title text-danger produk-title"> Order Sukses!!!</p></center>
			<center><p class="sidebar-title text-danger produk-title">Kode Transaksi : <?php echo $trx->kode_transaksi; ?></p></center>
			<center><p class="sidebar-title text-danger produk-title">Total Belanja : 
						<?php 
						echo "Rp. " . number_format($total_bayar['total']);
						?></p></center>
			<center><p class="sidebar-title text-danger produk-title">Silahkan mentransferkan uang dengan total <?php echo "Rp. " . number_format($total_bayar['total']); ?> ke salah satu pilihan bank di bawah ini : </p></center> -->

			<form method="post" enctype="multipart/form-data" action="<?=base_url()?>konfirmasi/simpan">
				<table class="table table-striped">
					<tr>
						<th>Kode Transaksi</th>
						<td>
							<input type="text" name="kode_transaksi" id="kode_transaksi" class="form-control" value="<?=$query['kode_transaksi']?>" readonly>
						</td>					
					</tr>
					<tr>
						<th>Total Bayar</th>
						<td id="bayar"><input type="text" name="total" value="<?="Rp. " .number_format($query['total'],0)?>" class="form-control" readonly></td>
					</tr>
					<tr>
						<th>Pilih Rekening</th>
						<td>
							<select class="form-control" name="rekening" id="rekening" required>
								<option selected><b>Pilih Rekening</b></option>
								<?php 
								$query = $this->db->query("SELECT * FROM rekening")->result_array();
								foreach ($query as $value) {
									echo "<option value='$value[id_rekening]'> $value[nama_bank] - $value[nomor_rekening] A/n : $value[nama_pemilik]</option>";
								}?>
							</select>
						</td>
					</tr>
					<tr>
						<th>Nama Pengirim</th>
						<td>
							<?php 
							$session = $this->session->userdata('sessionUser');
							$q = $this->db->query("SELECT * FROM user JOIN transaksi WHERE id_session = '".$session."'")->row_array();
							if ($q != '') { ?>
								<input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" value="<?php echo $q['nama_lengkap'] ?>">
							<?php } else {
								$q = $this->db->query("SELECT * FROM seller JOIN transaksi WHERE id_session_seller = '".$session."'")->row_array(); ?>
								<input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" value="<?php echo $q['nama_lengkap'] ?>">
							<?php }
							?>
						</td>
					</tr>
					<tr>
						<th>Tanggal Transfer</th>
						<td><input type="date" name="tanggal_konfirmasi" id="tanggal_konfirmasi" class="form-control" value="<?php echo date('Y-m-d') ?>"></td>
					</tr>
					<tr>
						<th>Bukti Transfer</th>
						<td><input type="file" name="bukti_tf" id="bukti_tf" class="form-control" required></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="submit" value="Kirimkan" class="btn btn-primary"></td>
					</tr>
				</table>
			</form>
		</div>