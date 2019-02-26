<div class="container">
  <?php echo form_open('seller/edit_kategori'); ?>
  <input type="hidden" name="id_kategori" value="<?=$kategori['id_kategori_produk']?>">
    <div class="form-group">
      <label for="kategori">Nama Kategori</label>
      <input type="text" class="form-control" id="kategori" value="<?=$kategori['nama_kategori']?>" name="kategori">
    </div>
    <button type="submit" name="edit" class="btn btn-primary">Edit</button> <button type="button" onclick="self.history.back()" class="btn btn-primary">Kembali</button>
  <?php echo form_close(); ?>
</div>