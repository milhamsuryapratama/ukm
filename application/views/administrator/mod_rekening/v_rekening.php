<div class="container">
	<table class="table table-striped table-bordered table-hover" id="myTable">
		<thead>
			<th>No</th>
			<th>Nama Bank</th>
			<th>Nomor Rekening</th>
			<th>Atas Nama</th>
		</thead>
		<tbody>
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
		</tbody>
	</table>
</div>

<script>
    $(document).ready(function() {
		$("#myTable").DataTable();
	});
</script>