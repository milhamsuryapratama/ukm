<div class="container">
	<table class="table table-striped table-bordered table-hover" id="myTable">
		<thead>
			<th>No</th>
			<th>Kode Transaksi</th>
			<th>Total</th>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			foreach ($pengembalian->result_array() as $pngmbl) { ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $pngmbl['kode_transaksi']; ?></td>
					<td><?php echo $pngmbl['total']; ?></td>
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