<div class="container">
    <form id="formOne" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_produk" id="id_produk" value="<?=$produk['id_produk']?>">
        <table class="table">
            <tr>
                <th>Gambar</th>
                <td><input type="file" name="gambar_produk" class="form-control">
                <small><i>Lihat gambar saat ini : <a href="<?=base_url()?>assets/upload/gambar_produk/<?=$produk['gambar']?>" target="blank">disini</a></i></small></td>
            </tr>
        </table>
        <hr>
        <table class="table">
            <tr>
                <th colspan="2">Data Produk</th>
            </tr>
            <tr>
                <th>Nama Produk</th>
                <td><input type="text" name="nama_produk" class="form-control" value="<?=$produk['nama_produk']?>"></td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td><textarea name="deskripsi"><?=$produk['keterangan']?></textarea></td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>
                    <select class="form-control" name="kategori" id="kategori">
                        <?php
                            foreach ($kat as $ktgr) {
                                    if ($ktgr['id_kategori_produk'] == $produk['id_kategori_produk']) { ?>
                                        <option value="<?=$ktgr['id_kategori_produk']?>" selected><?=$ktgr['nama_kategori']?></option>
                            <?php      } else { ?>
                                        <option value="<?=$ktgr['id_kategori_produk']?>" ><?=$ktgr['nama_kategori']?></option>
                            <?php      }   
                            } ?>                                      
                    </select>
                </td>
            </tr>
        </table>
        <hr>
        <table class="table" id="stokHarga">
            <tr>
                <th colspan="2">Stok & Harga</th>
            </tr>
            <tbody id="bodyAk">
                <tr>
                    <th>Harga</th>
                    <td><input type="text" name="harga" class="form-control" value="<?=$produk['harga_konsumen']?>"></td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td><input type="text" name="stok" id="stok" class="form-control" value="<?=$produk['stok']?>"></td>
                </tr>
                <tr>
                    <th colspan="2">Variasi</th>
                    <?php foreach ($ukuran as $u) { ?>
                        <tr>
                            <td id='pilihanSatu'><input type='hidden' class='form-control' name="id_variasi" value="<?=$u['id']?>" /> <input type='text' name="namaVariasi" class='form-control' placeholder="Nama Variasi" value="<?=$u['ukuran']?>" />
                            <td><input type='number' name='stokVariasi' class='form-control' placeholder="Stok Variasi" value="<?=$u['stok_ukuran']?>" /></td>
                        </tr>
                    <?php } ?>
                </tr>               
            </tbody>        
        </table>        

        <table class="table">
            <tr>
                <th>Berat</th>
                <td><input type="text" name="berat" class="form-control" value="<?=$produk['berat']?>"></td>
            </tr>
            <tr>
                <th>Diskon</th>
                <td><input type="text" name="diskon" class="form-control" value="<?=$produk['diskon']?>"></td>
            </tr>
        </table>

                <button class="btn btn-primary" id="btn_upload" type="submit">Edit</button>
                </form>
            </div> <!-- container -->

            <script>
                $(function(){
                    var id_produk = $("#id_produk").val();
                    var variasi = true;
                    var id_variasi = [];

                    $("input[name='id_variasi']").each(function() {
                        id_variasi.push($(this).val());
                    });

                    if (id_variasi.length != 0) {
                        $("#stok").attr("disabled", true);
                    }

                    console.log(id_variasi);

                    $("#tutupVariasi").hide();
                    $("#pp").hide();
                    $("#varResult").hide();
                    $("#hargarVariasiAktif").hide();


                $('#formOne').submit(function(e){               
                    e.preventDefault(); 
                    $.ajax({
                        url:'<?=base_url()?>seller/e_produk',
                        type:"post",
                        data: new FormData(this),
                        processData:false,
                        contentType:false,
                        cache:false,
                        async:false,
                        success: function(data){
                            // alert(data);
                            if (id_variasi.length == 0) {
                                window.location.href = "<?=base_url()?>seller/produk";
                            } else {
                                var stkVar = [];
                                var nmVar = [];
                            
                                $("input[name='namaVariasi']").each(function() {
                                    nmVar.push($(this).val());
                                });

                                $("input[name='stokVariasi']").each(function() {
                                    stkVar.push($(this).val());
                                });

                                $.post("<?=base_url()?>seller/e_ukuran", {stkVar: stkVar, id_variasi: id_variasi, id_produk: id_produk}, (result) => {
                                    console.log(result);
                                    window.location.href = "<?=base_url()?>seller/produk";
                                })
                            } 
                        }
                    });
                });  

        })

    </script>
