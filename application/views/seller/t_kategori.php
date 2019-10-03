<div class="content">
	<div class="wrapper">
		<?php echo form_open('seller/tambah_kategori') ?>
    <div class="form-group">
      <label for="kategori">Nama Kategori</label>
      <input type="text" class="form-control" id="kategori" name="kategori" aria-describedby="emailHelp" placeholder="Enter kategori">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button> <button type="button" onclick="self.history.back()" class="btn btn-primary">Kembali</button>
  <?php echo form_close(); ?>
	</div>
</div>