<?php echo form_open('administrator/tambah_seller') ?>
<div class="container">
	<h3>Tambah Seller</h3>
	<?php if ($this->session->flashdata('namaSellerError')) { ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $this->session->flashdata('namaSellerError'); ?>
		</div>
	<?php } ?>
	<table class="table">
		<tr>
			<th>Nama Seller</th>
			<td><input type="text" name="nama_seller" class="form-control"></td>
		</tr>
		<tr>
			<th>Username</th>
			<td><input type="text" name="username" class="form-control"></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" name="password" class="form-control"></td>
		</tr>
		<tr>
			<td colspan="2">
				<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
			</td>
		</tr> 
	</table>
</div>
<?php echo form_close(); ?>