<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>Online Shop</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="index, follow">
	<meta name="description" content="Menyajikan berita terbaru, tercepat, dan terpercaya seputar tunggul hitam.">
	<meta name="keywords" content="Selamat datang di CMS Swarakalibata, adalah penyempurnaan dan perbaikan dari swarakalibata sebelumnya.">
	<meta name="author" content="phpmu.com">
	<meta name="robots" content="all,index,follow">
	<meta http-equiv="Content-Language" content="id-ID">
	<meta NAME="Distribution" CONTENT="Global">
	<meta NAME="Rating" CONTENT="General">
	<link rel="canonical" href="<?=base_url()?>" />
	<link rel="shortcut icon" href="<?=base_url()?>asset/images/favicon.ico" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.xml" />
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/phpmu-tigo/background/pink/reset.css" />
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/phpmu-tigo/background/pink/main-stylesheet.css" />
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/phpmu-tigo/background/pink/shortcode.css" />
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/phpmu-tigo/background/pink/fonts.css" />
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/phpmu-tigo/background/pink/responsive.css" />
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/phpmu-tigo/background/style.css">
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/phpmu-tigo/background/bootstrap.css">
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/phpmu-tigo/background/ideaboxWeather.css">
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/phpmu-tigo/slide/slide.css">
	<!-- <link rel="stylesheet" href="<?=base_url()?>/asset/admin/plugins/datatables/dataTables.bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?=base_url()?>template/phpmu-tigo/lightbox/lightbox.css">
	<script type="text/javascript" src="<?=base_url()?>template/phpmu-tigo/jscript/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/phpmu-tigo/jscript/jquery-latest.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/phpmu-tigo/jscript/theme-scripts.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/phpmu-tigo/background/bootstrap.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/phpmu-tigo/slide/js/jssor.slider-23.1.0.mini.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/phpmu-tigo/slide/js/slide.js"></script>
	<script src="https://members.phpmu.com/asset/js/bootstrap.min.js"></script>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		$(document).ready(function() {
			$('#state').change(function() {
				var state_id = $(this).val();
				$.ajax({
					type: "POST",
					url: "<?=base_url()?>auth/city",
					data: "stat_id=" + state_id,
					success: function(response) {
						$('#city').html(response);
					}
				})
			})
		})

		$(document).ready(function() {
			$('#state_reseller').change(function() {
				var state_id = $(this).val();
				$.ajax({
					type: "POST",
					url: "<?=base_url()?>auth/city",
					data: "stat_id=" + state_id,
					success: function(response) {
						$('#city_reseller').html(response);
					}
				})
			})
		})

		function toDuit(number) {
			var number = number.toString(),
			duit = number.split('.')[0],
			duit = duit.split('').reverse().join('')
			.replace(/(\d{3}(?!$))/g, '$1,')
			.split('').reverse().join('');
			return 'Rp ' + duit;
		}
	</script>
	<style type="text/css">
		.the-menu a.active {
			color: red !important;
		}

		.produk:hover {
			background-color: #cecece;
		}
	</style>
</head>

<body>
	<div id='Back-to-top'>
		<img alt='Scroll to top' src='http://members.phpmu.com/asset/css/img/top.png' />
	</div>
	<div class="boxed">
		<div class="header">
			<div class='wrapper'>
				<div class='header-logo'>
					<a href='<?=base_url()?>'><img style='height:40px' src='<?=base_url()?>asset/logo/logo.png' /></a>
				</div>
				<div class='mainmenu hidden-xs'>
					<ul class='mainnav'>
						<li class='hassubs first'><a href='#'><span class='glyphicon glyphicon-th-list'></span>&nbsp; Kategori</a>
							<ul class='dropdown-phpmu'>
								<li class='subs hassubs'><a href='<?=base_url()?>produk/kategori/aksesoris-gadget--komputer'> Aksesoris & Komputer <span class='caret caret-right'></span></a>
									<ul class='dropdown-phpmu'>
										<li class='subs'><a href='<?=base_url()?>produk/subkategori/motherboard'>Motherboard</a></li>
										<li class='subs'><a href='<?=base_url()?>produk/subkategori/storage-external'>Storage External</a></li>
									</ul>
								</li>
								<li class='subs hassubs'><a href='<?=base_url()?>produk/kategori/fashion--busana-wanita'> Fashion & Busana Wanita <span class='caret caret-right'></span></a>
									<ul class='dropdown-phpmu'>
										<li class='subs'><a href='<?=base_url()?>produk/subkategori/kiyora-sedang'>Kiyora Sedang</a></li>
										<li class='subs'><a href='<?=base_url()?>produk/subkategori/kiyora-dalam'>Kiyora Dalam</a></li>
									</ul>
								</li>
								<li class='subs'>
									<a href='<?=base_url()?>produk/kategori/fashion--busana-pria'> <a href='<?=base_url()?>produk/kategori/fashion--busana-pria'> Fashion & Busana Pria</a></li>
									<li class='subs'>
										<a href='<?=base_url()?>produk/kategori/alat-musik--pro-audio'> <a href='<?=base_url()?>produk/kategori/alat-musik--pro-audio'> Alat Musik & Pro Audio</a></li>
										<li class='subs'>
											<a href='<?=base_url()?>produk/kategori/tas-koper--perjalanan'> <a href='<?=base_url()?>produk/kategori/tas-koper--perjalanan'> Tas, Koper & Perjalanan</a></li>
										</ul>
									</li>
								</ul>
							</div>

							<div class='header-menu'>
								<div class='header-search'>
									<form action="<?=base_url()?>produk/index" method="post" accept-charset="utf-8">

										<input type='text' placeholder='Aku Mau Belanja..' name='kata ' class='search-input ' required/>
										<input type='submit ' value='Search ' name='cari ' class='search-button '/>
									</form>
								</div>
							</div>

							<div class='header-addons '>
								<span class='city '>
									Kamis, 03 Okt 2019, <span id='jam '></span></span><br><a href='#'>Halo <?=$this->session->userdata('usernameUser');?></a> <a href='<?=base_url()?>produk/history'>History</a> &nbsp; 
									<a href='<?=base_url()?>produk/keranjang '> 
										<span class='glyphicon glyphicon glyphicon-shopping-cart ' style='font-size:19px '></span></b> 
										<span class='badge badgee '>
											<?php 
												$session = $this->session->userdata('sessionUser');
												$q = $this->db->query("SELECT * FROM order_temp WHERE id_session = '$session' AND status = 'N'");              
            									$jml = $q->num_rows(); 
            									echo $jml;
            								?>            									
										</span></a> &nbsp; 

										<?php if ($this->session->userdata('status') == 'userLoginSukses' || $this->session->userdata('sellerStatus') == 'sellerLogged') { ?>
											<a class='btn btn-xs btn-success ' style='width:60px ' href='http://localhost/semprulshop/auth/logout '>Keluar
											</a>
										<?php } else { ?>
											<a class='btn btn-xs btn-success ' style='width:60px ' href='http://localhost/semprulshop/auth/login '>Login
											</a>
											<a class='btn btn-xs btn-success ' style='width:60px ' href='http://localhost/semprulshop/auth/register '>Daftar
											</a>
										<?php } ?>

										<?php if ($this->session->userdata('sellerStatus') == 'sellerLogged') { ?>
											<a class='btn btn-xs btn-success ' style='width:60px ' href='<?=base_url()?>seller?id=<?=$this->session->userdata('sessionUser')?>' targer="blank">Jual
											</a>
										<?php } ?>

										<!-- <a class='btn btn-xs btn-default ' style='width:60px; color:#000 ' href='<?=base_url()?>auth/register '>Daftar</a> -->
									</div>
									</div>

									<div class='main-menu sticky '>	
										<div class='wrapper '><ul class='the-menu '>
											<li><a href='<?=base_url()?> ' style='background: url(<?=base_url()?>asset/images/home.png) no-repeat center; font-size:0; width:34px; '><br></a></li><li><a href='<?=base_url()?># '><span>Berita</span></a><ul><li><a href='<?=base_url()?>kategori/detail/politik '>Politik</a></li><li><a href='<?=base_url()?>kategori/detail/ekonomi '>Ekonomi</a></li><li><a href='<?=base_url()?>kategori/detail/seni--budaya '>Tutorial</a></li><li><a href='<?=base_url()?>kategori/detail/teknologi '>Teknologi</a></li><li><a href='<?=base_url()?>kategori/detail/internasional '>Internasional</a></li></ul></li><li><a href='<?=base_url()?>playlist '>Video</a></li><li><a href='<?=base_url()?>albums '>Berita Foto</a></li><li><a href='<?=base_url()?>download '>Download</a></li><li><a href='<?=base_url()?>agenda '>Agenda</a></li><li><a href='<?=base_url()?>konsultasi '>Konsultasi</a></li><li><a href='<?=base_url()?>kontributor '>Kontributor</a></li><li><a href='<?=base_url()?>testimoni '>Testimoni</a></li><li><a href='<?=base_url()?># '><span>Marketplace System</span></a><ul><li><a href='<?=base_url()?>produk '>Semua Produk</a></li><li><a href='<?=base_url()?>produk/reseller '>Semua Pelapak</a></li><li><a href='<?=base_url()?>konfirmasi/tracking '>Tracking Orders</a></li><li><a href='<?=base_url()?>konfirmasi '>Konfirmasi Orders</a></li><li><a href='<?=base_url()?>members/orders_report '>Orders Report</a></li></ul></li></ul>
										</div>
									</div>
									<div class='secondary-menu '>
										<div class='wrapper '>
											<?php if ($this->session->userdata('sellerStatus') == 'sellerLogged') { ?>
												<ul>
													<li><a href='<?=base_url()?>seller/penjualan'>Penjualan</a></li>
													<li><a href='<?=base_url()?>seller/kategori'>Kategori</a></li>
													<li><a href='<?=base_url()?>seller/produk'>Produk</a></li>
												</ul>
											<?php } else { ?>
												<ul><li><a href='<?=base_url()?>tag/detail/metropolitan '>Metropolitan</a></li><li><a href='<?=base_url()?>tag/detail/film '>Film</a></li><li><a href='<?=base_url()?>tag/detail/teknologi '>Teknologi</a></li><li><a href='<?=base_url()?>tag/detail/olahraga '>Olahraga</a></li><li><a href='<?=base_url()?>tag/detail/selebritis '>Selebritis</a></li><li><a href='<?=base_url()?>tag/detail/kesehatan '>Kesehatan</a></li><li><a href='<?=base_url()?>tag/detail/wisata '>Wisata</a></li><li><a href='<?=base_url()?>tag/detail/internasional '>Internasional</a></li><li><a href='<?=base_url()?>tag/detail/nasional '>Nasional</a></li><li><a href='<?=base_url()?>tag/detail/yahudi '>Yahudi</a></li><li><a href='<?=base_url()?>tag/detail/bola '>Bola</a></li><li><a href='<?=base_url()?>tag/detail/hiburan '>Hiburan</a></li><li><a href='<?=base_url()?>tag/detail/hukum '>Hukum</a></li><li><a href='<?=base_url()?>tag/detail/israel '>Israel</a></li></ul>
											<?php } ?>
											
										</div>
									</div>			
								</div>

