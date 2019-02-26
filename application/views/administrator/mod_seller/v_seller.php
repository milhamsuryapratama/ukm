<div class="container">
	<center><h3>Data Seller</h3></center>
	<table class="table table-striped table-bordered table-hover" id="myTable"">
		<thead>
			<tr>
				<td colspan="4"><a href="<?=base_url()?>administrator/tambah_seller" class="btn btn-primary">Tambah</a></td>
			</tr>
			<tr>
				<th>NO</th>
				<th>Nama</th>
				<th>Username</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			foreach ($seller->result_array() as $s) { ?>
				<tr>
					<td><?=$no?></td>
					<td><?=$s['nama']?></td>
					<td><?=$s['username']?></td>
					<td>
						<a href="<?=base_url()?>administrator/edit_seller/<?=$s['id_seller']?>" class="btn btn-primary">Edit</a>
						<a href="<?=base_url()?>administrator/hapus_seller/<?=$s['id_seller']?>" class="btn btn-danger">Hapus</a>
					</td>
				</tr>
			<?php $no++; } ?>
		</tbody>
	</table>
</div>

<script>
    $(document).ready(function() {
		$("#myTable").DataTable();
	});
</script>