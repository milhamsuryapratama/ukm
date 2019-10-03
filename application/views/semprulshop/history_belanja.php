<div class="content">
	<div class="wrapper">	
		<div class="breaking-news">
			<span class="the-title">History Belanja</span>
		</div>

		<div class="main-content">

			<table class="table table-striped" id="tb">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Transaksi</th>
						<th>Total</th>
						<th>Tracking</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no = 1;
						if ($history->num_rows() == '0') { ?>
							<tr>
								<td colspan="4"><center><strong>Anda Tidak Memiliki History Belanja</strong></center></td>
							</tr>
						<?php }else {
							foreach ($history->result_array() as $hstr) { 
								$total = $this->db->query("SELECT a.*, b.*, sum(b.total+b.ongkir) as total FROM `transaksi` a JOIN transaksi_detail b ON a.kode_transaksi = b.kode_transaksi WHERE a.kode_transaksi = '$hstr[kode_transaksi]' ORDER BY a.kode_transaksi DESC")->row_array();
								?>
								<tr>
									<td><?=$no?></td>
									<td><?=$hstr['kode_transaksi']?></td>
									<td><?="Rp. ". number_format($total['total'])?></td>
									<td><a href="<?=base_url()?>orders/tracking/<?=$hstr['kode_transaksi']?>/#true" class="btn btn-primary">Tracking</a></td>
								</tr>
								<?php $no++; } 
							} ?>
				</tbody>
			</table>
		</div>

		<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

  <!-- <script src="<?=base_url()?>asset3/admin/plugins/datatables/jquery.dataTables.min.js "></script>
    <script src="<?=base_url()?>asset3/admin/plugins/datatables/dataTables.bootstrap.min.js "></script>
	<script>
      $(function () { 
        $('#example2').DataTable({
          "paging ": true,
          "lengthChange ": false,
          "searching ": true,
          "ordering ": true,
          "info ": true,
          "autoWidth ": false,
          "scrollX ": true,
          "lengthMenu ": [[30, 55, 70, -1], [30, 55, 70, "All "]]
        });
      });
    </script> -->