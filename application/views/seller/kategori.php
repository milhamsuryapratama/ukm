
<div class="container">
    <table class="table table-striped table-bordered table-hover" id="myTable">
        <thead>
            <tr>
                <td colspan="2"><a href="<?=base_url()?>seller/tambah_kategori" class="btn btn-primary">Tambah</a></td>
            </tr>
            <tr>
                <th>Nama Kategori</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($kategori as $ktgr) { ?>
                <tr>
                    <td><?php echo $ktgr['nama_kategori']?></td>
                    <td>
                        <a href="<?=base_url()?>seller/edit_kategori/<?=$ktgr['id_kategori_produk']?>" class="btn btn-primary">EDIT</a>
                        <a href="<?=base_url()?>seller/hapus_kategori/<?=$ktgr['id_kategori_produk']?>" class="btn btn-primary">HAPUS</a>
                    </td>
                </tr> 
                <?php  } ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
			$("#myTable").DataTable();
		});
</script>
