<header id="header"><!--header-->
  <div class="header_top"><!--header_top-->
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="contactinfo">
            <ul class="nav nav-pills">
              <li><a href="#"><i class="fa fa-phone"></i> +6285 330 150 827</a></li>
              <li><a href="#"><i class="fa fa-envelope"></i> blogasayailham@gmail.com / ilhamsurya26@gmail.com</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="social-icons pull-right">
            <ul class="nav navbar-nav">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div><!--/header_top-->

  <div class="header-middle"><!--header-middle-->
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="logo pull-left">
            <a href="index.html"><img src="images/home/logo.png" alt="" /></a>
          </div>
          <div class="btn-group pull-right">
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                IDN
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="#">US</a></li>
                <li><a href="#">UK</a></li>
              </ul>
            </div>

            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                Rupiah
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="#">Dollar</a></li>
                <li><a href="#">Euro</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="shop-menu pull-right">
            <ul class="nav navbar-nav">
              <?php if ($this->session->userdata('status') == 'userLoginSukses' || $this->session->userdata('sellerStatus') == 'sellerLogged') { ?>
                <li><a href="#"><i class="fa fa-user"></i> Halo 
                  <?php if ($this->session->userdata('sellerStatus') == 'sellerLogged')  {
                        echo $this->session->userdata('usernameSeller');
                      }else {
                        echo $this->session->userdata('usernameUser');
                      } ?></a>
                </li>
                <?php if ($this->session->userdata('sellerStatus') == 'sellerLogged'): ?>
                  <li><a href="<?=base_url()?>seller/kategori"><i class="fa fa-user"></i> Kategori</a></li>
                  <li><a href="<?=base_url()?>seller/produk"><i class="fa fa-user"></i> Produk</a></li>
                  <li><a href="<?=base_url()?>seller/penjualan"><i class="fa fa-user"></i> History Penjualan</a></li>
                <?php endif ?>
                <li><a href="<?=base_url()?>auth/logout"><i class="fa fa-lock"></i> Logout </a></li>
              <?php }else { ?>
                <li><a href="<?=base_url()?>auth/register/#true"><i class="fa fa-lock"></i> Register</a></li>
                <li><a href="<?=base_url()?>produk/keranjang"><i class="fa fa-lock"></i> Keranjang (<?php echo $jmlKeranjang; ?>)</a></li>
                <li><a href="<?=base_url()?>auth/login/#true"><i class="fa fa-lock"></i> Login</a></li>
              <?php } ?>              
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div><!--/header-middle-->
  
  <div class="header-bottom"><!--header-bottom-->
    <div class="container">
      <div class="row">
        <div class="col-sm-9">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="mainmenu pull-left">
            <ul class="nav navbar-nav collapse navbar-collapse">
              <li><a href="<?=base_url()?>" class="active">Home</a></li> 
            </ul>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="search_box pull-right">
            <input type="text" placeholder="Search"/>
          </div>
        </div>
      </div>
    </div>
  </div><!--/header-bottom-->
  </header><!--/header-->