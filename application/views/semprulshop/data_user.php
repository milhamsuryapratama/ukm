	
<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner">
						<div class="item active">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>Free E-Commerce Template</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Get it now</button>
							</div>
							<div class="col-sm-6">
								<img src="<?=base_url()?>assets/images/home/girl1.jpg" class="girl img-responsive" alt="" />
								<img src="<?=base_url()?>assets/images/home/pricing.png"  class="pricing" alt="" />
							</div>
						</div>
						<div class="item">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>100% Responsive Design</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Get it now</button>
							</div>
							<div class="col-sm-6">
								<img src="<?=base_url()?>assets/images/home/girl2.jpg" class="girl img-responsive" alt="" />
								<img src="<?=base_url()?>assets/images/home/pricing.png"  class="pricing" alt="" />
							</div>
						</div>

						<div class="item">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>Free Ecommerce Template</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Get it now</button>
							</div>
							<div class="col-sm-6">
								<img src="<?=base_url()?>assets/images/home/girl3.jpg" class="girl img-responsive" alt="" />
								<img src="<?=base_url()?>assets/images/home/pricing.png" class="pricing" alt="" />
							</div>
						</div>

					</div>

					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>

			</div>
		</div>
	</div>
</section><!--/slider-->

<section id="true">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Category</h2>
					<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						<?php 
						foreach ($kategori as $k) { ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="<?=base_url()?>produk/kategori/<?=$k['kategori_slug']?>/#true"><?=$k['nama_kategori']?></a></h4>
								</div>
							</div>
						<?php } ?>
					</div><!--/category-products-->
				</div>
			</div>

			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">Register User</h2>
					<?php if ($this->session->flashdata('error')): ?>
						<div class="alert alert-danger" role="alert">
  							<?php echo $this->session->flashdata('error'); ?>
						</div>
					<?php endif ?>
					
					<form action="<?=base_url()?>auth/register" method="post">
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input type="text" class="form-control" value="<?=$user['nama_lengkap']?>" name="namaLengkap" required>
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" value="<?=$user['username']?>" name="username" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" value="<?=$user['password']?>" name="password" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" value="<?=$user['email']?>" name="email" required>
						</div>
						<div class="form-group">
							<label>Provinsi</label>
							<select class="custom-select mr-sm-2" name="province" id="province" onchange="getProvince()" required>
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
							<select class="custom-select mr-sm-2" name="kota_id" id="kota_id" required>
								<?php 
									$id = $user['kota_id'] - 1;
									$pro = $user['provinsi_id'] - 1;
									echo $provinsi['rajaongkir']['results'][$pro]['province'] .','. $kota['rajaongkir']['results'][$id]['city_name'];
									?>
								<option selected>Pilih Kota</option>
							</select>										
						</div>
						<div class="form-group">
							<label>Alamat Lengkap</label>
							<textarea id="alamat" name="alamat" required><?=$user['alamat_lengkap']?></textarea>
						</div>
						<div class="form-group">
							<label>No HP</label>
							<input type="text" class="form-control" value="<?=$user['no_hp']?>" name="noHp" required>
						</div>
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						<a href="<?=base_url()?>auth/login" class="btn btn-default">Sudah Punya Akun ?</a>
					</form>	
				</div><!--features_items-->
			</div>
		</div>
	</div>
</section>

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
				output += `<option value='${val.city_id}'>${val.city_name}</option>`
			})
			$("#kota_id").html(output);
			//console.log(response);
		})
	}   
</script>