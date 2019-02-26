<?php echo form_open('administrator/edit_seller') ?>
	<div class="container">
		<h3>Tambah Seller</h3>
		<table class="table">
			<input type="hidden" name="id_seller" value="<?=$seller['id_seller']?>">
			<tr>
				<th>Nama Seller</th>
				<td><input type="text" name="nama_seller" class="form-control" value="<?=$seller['nama']?>"></td>
			</tr>
			<tr>
				<th>Username</th>
				<td><input type="text" name="username" class="form-control" value="<?=$seller['username']?>"></td>
			</tr>
			<tr>
				<td colspan="2">
					<button type="submit" name="edit" class="btn btn-primary">Edit</button>
				</td>
			</tr> 
		</table>
	</div>
<?php echo form_close(); ?>