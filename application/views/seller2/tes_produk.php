<div class="container">
	<form id="formOne" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>Gambar</th>
				<td><input type="file" name="gambar_produk" class="form-control"></td>
			</tr>
		</table>
		<hr>
		<table class="table">
			<tr>
				<th colspan="2">Data Produk</th>
			</tr>
			<tr>
				<th>Nama Produk</th>
				<td><input type="text" name="nama_produk" class="form-control"></td>
			</tr>
			<tr>
				<th>Deskripsi</th>
				<td><textarea name="deskripsi"></textarea></td>
			</tr>
			<tr>
				<th>Kategori</th>
				<td>
					<select class="form-control" name="kategori" id="kategori">
	                    <?php
	                    foreach ($kategori as $ktgr) { ?>
	                        <option value="<?php echo $ktgr['id_kategori_produk'] ?>"><?php echo $ktgr['nama_kategori'] ?></option>
	                    <?php  } ?>                                        
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
					<td><input type="text" name="harga" class="form-control"></td>
				</tr>
				<tr>
					<th>Stok</th>
					<td><input type="text" name="stok" class="form-control"></td>
				</tr>
				<tr>
					<th>Variasi</th>
					<td><input type="button" id="aktifkanVariasi" value="Aktifkan Variasi" class="btn btn-primary"></td>
				</tr>				
			</tbody>		
		</table>

		<table id="pp" class="table">
			<tbody>
				<tr>
					<th>Variasi 1</th>
					<td>
						<table class='table' id='variasiSatu'>
							<tbody id="variasiBody">
								<tr>
									<th>Nama</th>
									<td><input type='text' id='namaVarSatu' name="namaVarSatu" class='form-control'/>
									</tr>
								<tr>
									<th>Pilihan</th>
									<td id='pilihanSatu'><input type='text' name="namaVariasi" class='form-control' placeholder="Nama Variasi" />
									<td><input type='number' name='stokVariasi' class='form-control' placeholder="Stok Variasi"/></td>
								</tr>
							</tbody>
								<tr>
									<td colspan="2"><input type="button" id="tambahVariasiSatu" value="Tambah Variasi" class="btn btn-primary"> <input type="button" id="tutupVariasi" value="Tutup Variasi" class="btn btn-primary"></td>
								</tr>
						</table>
					</td>
				</tr>				
			</tbody>
		</table>

		<table class="table">
			<tr>
				<th>Berat</th>
				<td><input type="text" name="berat" class="form-control"></td>
			</tr>
			<tr>
				<th>Diskon</th>
				<td><input type="text" name="diskon" class="form-control"></td>
			</tr>
		</table>
				
				<button class="btn btn-primary" id="btn_upload" type="submit">Submit</button>
				</form>
			</div> <!-- container -->

			<script>
				$(function(){

					var variasi = false;

					$("#tutupVariasi").hide();
					$("#pp").hide();
					$("#varResult").hide();
					$("#hargarVariasiAktif").hide();

					$('#aktifkanVariasi').click(function() {
						variasi = true;
						$("#tutupVariasi").show();
						$("#bodyAk").hide();
						$("#pp").show();
						$("#varResult").show();
						$("#hargarVariasiAktif").show();
						
						$("#pp").append(
							`<tr id="hargarVariasiAktif">
								<th>Harga</th>
								<td><input type="text" name="harga" class="form-control"></td>
							</tr>`
						)
						$("#varResult").append(
							`<tr><td></td><td></td><td></td></tr>`
						)

						$("#tambahVariasiSatu").click(function() {
							$('#variasiBody').append(`
								<tr>
								<th></th>
								<td id='pilihanSatu'><input type='text' name="namaVariasi" class='form-control' placeholder="Nama Variasi" />
								<td><input type='number' name='stokVariasi' class='form-control' placeholder="Stok Variasi"/></td>
								</tr>
								`);		
							$("#varResult").append(
								`<tr><td></td><td></td><td></td></tr>`
								);

							$( "input[name='pilihanSatu']" ).each(function( i ) {	
								$(`input[name='pilihanSatu']:eq(${i})`).keyup(function() {
									// alert(i);
									let y = $("table tr.ans td").index();
									$(`#varResult tr:eq(${i+2}) td:eq(0)`).html($(this).val());
								})				
							})	
						});

						$("#setStk").click(function() {
							$("#varResult tr td").each(function(i) {
								$(`#varResult tr:eq(${i}) td:eq(1)`).html($("#stk").val());
								$(`#varResult tr:eq(${i}) td:eq(2)`).html($("#hrg").val());
							})
						})

					});

					$("#tutupVariasi").click(function() {
						variasi = false;
						$("#tutupVariasi").hide();
						$("#bodyAk").show();
						$("#hargarVariasiAktif").remove();
						$("#pp").hide();
						$('#varResult tr').slice(2).remove();
						$("#varResult").hide();
						$('#pilihanSatu').html(`
							<input type='text' name='pilihanSatu' class='form-control'/>
							`);	

						$( "input[name='pilihanSatu']" ).each(function( i ) {	
							$(`input[name='pilihanSatu']:eq(${i})`).keyup(function() {
								// alert(i);
								let y = $("table tr.ans td").index();
								$(`#varResult tr:eq(${i+2}) td:eq(0)`).html($(this).val());
							})				
						})	
					});

					$(`input[name='namaVarSatu']`).keyup(function() {
						// alert(i);
						$(`#varResult tr:eq(1) th:eq(0)`).html($(this).val());
					})	

					$( "input[name='pilihanSatu']" ).each(function( i ) {	
						$(`input[name='pilihanSatu']:eq(${i})`).keyup(function() {
							// alert(i);
							$(`#varResult tr:eq(${i+2}) td:eq(0)`).html($(this).val());
						})				
					})	

			$('#formOne').submit(function(e){				
				e.preventDefault(); 
				$.ajax({
					url:'<?=base_url()?>seller/s_produk',
					type:"post",
					data: new FormData(this),
					processData:false,
					contentType:false,
					cache:false,
					async:false,
					success: function(data){
						// alert(data);
						
						if (variasi) {
							var stkVar = [];
							var nmVar = [];
					
							$("input[name='namaVariasi']").each(function() {
			    				nmVar.push($(this).val());
							});

							$("input[name='stokVariasi']").each(function() {
			    				stkVar.push($(this).val());
							});

							$.post("<?=base_url()?>seller/s_ukuran", {stkVar: stkVar, nmVar: nmVar}, (result) => {
								console.log(result);
								window.location.href = "<?=base_url()?>seller/produk";
							})
						} else {
							console.log("VARIASI TIDAK AKTIF");
							window.location.href = "<?=base_url()?>seller/produk";
						}
					}
				});
			});  

		})

	</script>