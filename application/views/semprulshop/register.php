<div class="content">
	<div class="wrapper">
		<div class="breaking-news">
			<span class="the-title">Register</span>
		</div>
		<form action="<?=base_url()?>auth/register" method="post">
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input type="text" class="form-control" name="namaLengkap" required>
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="username" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" required>
						</div>
						<div class="form-group">
							<label>Provinsi</label>
							<select class="form-control" name="province" id="province" onchange="getProvince()" required>
								<option selected>Pilih Provinsi</option>
								<?php 						
								for ($i=0; $i < count($provinsi['rajaongkir']['results']); $i++) { 
									echo "<option value='".$provinsi['rajaongkir']['results'][$i]['province_id']."'>".$provinsi['rajaongkir']['results'][$i]['province']."</option>";
								}
								?>
							</select>										
						</div>
						<div class="form-group">
							<label>Kota</label>
							<select class="form-control" name="kota_id" id="kota_id" required>
								<option selected>Pilih Kota</option>
							</select>										
						</div>
						<div class="form-group">
							<label>Alamat Lengkap</label>
							<textarea id="alamat" class="form-control" name="alamat" required></textarea>
						</div>
						<div class="form-group">
							<label>No HP</label>
							<input type="text" class="form-control" name="noHp" required>
						</div>
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						<a href="<?=base_url()?>auth/login" class="btn btn-default">Sudah Punya Akun ?</a>
					</form>	
	</div>
</div>

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
		$('#alamat').summernote({
			height: 300
		});
	});   

	function getProvince() {
		var id = $("#province").val();
		let output  = '';
		
		$.post("<?=base_url()?>auth/get_kota", {id: id}, (response)=>{
			let kota = response.rajaongkir.results;

			kota.map((val,i)=>{
				output += `<option value='${val.city_id}'>${val.type} ${val.city_name}</option>`
			})
			$("#kota_id").html(output);
			//console.log(response);
		})
	}   
</script>