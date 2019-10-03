<footer>
				<div class="footer">
					<div class='wrapper '>
	<ul class='right '><li><a href='halaman/detail/alamat-perusahaan '>Alamat Kami</a></li><li><a href='halaman/detail/tentang-kami-tunggul-news '>Tentang Kami</a></li><li><a href='hubungi '>Hubungi Kami</a></li><li><a href='berita/indeks_berita '>Index Berita</a></li></ul>
	<p class='footer '>&copy; 2019 Copyright 2019. All Rights reserved.<br/>Built with love by . <b style='color:orange '>M. ILHAM SURYA PRATAMA | blogsayailham@gmail.com | 085330150827</b></p>
</div>				</div>
			</footer>
		</div>
		<!-- Scripts -->

		<script type='text/javascript '>
		$(function() { $(window).scroll(function() {
		    if($(this).scrollTop()>400) { $('#Back-to-top ').fadeIn(); }else { $('#Back-to-top ').fadeOut();}});
		    $('#Back-to-top ').click(function() {
		        $('body,html ')
		        .animate({scrollTop:0},300)
		        .animate({scrollTop:40},200)
		        .animate({scrollTop:0},130)
		        .animate({scrollTop:15},100)
		        .animate({scrollTop:0},70);
		        });
		});

		function jam(){
			var waktu = new Date();
			var jam = waktu.getHours();
			var menit = waktu.getMinutes();
			var detik = waktu.getSeconds();

			if (jam < 10){ jam = "0" + jam; }
			if (menit < 10){ menit = "0" + menit; }
			if (detik < 10){ detik = "0" + detik; }
			var jam_div = document.getElementById('jam ');
			jam_div.innerHTML = jam + ":" + menit + ":" + detik;
			setTimeout("jam()", 1000);
		} jam();

		</script>

	<script type="text/javascript">
      (function (jQuery) {
      $.fn.ideaboxWeather = function (settings) {
      var defaults = {
      modulid   :'Swarakalibata ',
      width :'100% ',
      themecolor    :'#2582bd ',
      todaytext :'Hari Ini ',
      radius    :true,
      location  :' Jakarta ',
      daycount  :7,
      imgpath   :'img_cuaca/ ', 
      template  :'vertical ',
      lang  :'id ',
      metric    :'C ', 
      days  :["Minggu","Senin","Selasa","Rabu","Kamis","Jum'at ","Sabtu "],
      dayssmall :["Mg ","Sn ","Sl ","Rb ","Km ","Jm ","Sa "]};
      var settings = $.extend(defaults, settings);

      return this.each(function () {
      settings.modulid = "# " + $(this).attr("id ");
      $(settings.modulid).css({"width ":settings.width,"background ":settings.themecolor});

      if (settings.radius)
      $(settings.modulid).addClass("ow-border ");

      getWeather();
      resizeEvent();

      $(window).on("resize ",function(){
      resizeEvent();});

      function resizeEvent(){
      var mW=$(settings.modulid).width();

      if (mW<200){
      $(settings.modulid).addClass("ow-small ");}
      else{
      $(settings.modulid).removeClass("ow-small ");}}

      function getWeather(){$.get("http://api.openweathermap.org/data/2.5/forecast/daily?q="+settings.location+" &mode=xml&units=metric&cnt="+settings.daycount+" &lang="+settings.lang+" &appid=b318ee3082fcae85097e680e36b9c749 ", function(data) {
      var $XML = $(data);
      var sstr = " ";
      var location = $XML.find("name ").text();
      $XML.find("time ").each(function(index,element) {
      var $this = $(this);
      var d = new Date($(this).attr("day "));
      var n = d.getDay();
      var metrics = " ";
      if (settings.metric=="F "){
      metrics = Math.round($this.find("temperature ").attr("day ") * 1.8 + 32)+"°F ";}
      else{
      metrics = Math.round($this.find("temperature ").attr("day "))+"°C ";}

      if (index==0){
      if (settings.template=="vertical "){
      sstr=sstr+'<div class="ow-today ">'+
      '<span><img src="http://localhost/marketplace/asset/ '+settings.imgpath+$this.find("symbol").attr("var")+'.png "/></span>'+
      '<h2>'+metrics+'<span>'+ucFirst($this.find("symbol ").attr("name "))+'</span><b>'+location+' - '+settings.todaytext+'</b></h2>'+
      '</div>';}
      else{
      sstr=sstr+'<div class="ow-today ">'+
      '<span><img src="http://localhost/marketplace/asset/ '+settings.imgpath+$this.find("symbol").attr("var")+'.png "/></span>'+
      '<h2>'+metrics+'<span>'+ucFirst($this.find("symbol ").attr("name "))+'</span><b>'+location+' - '+settings.todaytext+'</b></h2>'+
      '</div>';}}
      else{
      if (settings.template=="vertical "){
      sstr=sstr+'<div class="ow-days ">'+
      '<span>'+settings.days[n]+'</span>'+
      '<p><img src="http://localhost/marketplace/asset/ '+settings.imgpath+$this.find("symbol").attr("var")+'.png " title=" '+ucFirst($this.find("symbol").attr("name"))+' "> <b>'+metrics+'</b></p>'+
      '</div>';}
      else{
      sstr=sstr+'<div class="ow-dayssmall " style="width: '+100/(settings.daycount-1)+'% ">'+
      '<span title='+settings.days[n]+'>'+settings.dayssmall[n]+'</span>'+
      '<p><img src="http://localhost/marketplace/asset/ '+settings.imgpath+$this.find("symbol").attr("var")+'.png " title=" '+ucFirst($this.find("symbol").attr("name"))+' "></p>'+
      '<b>'+metrics+'</b>'+
      '</div>';}}});

      $(settings.modulid).html(sstr); 
      });}

      function ucFirst(string) {
      return string.substring(0, 1).toUpperCase() + string.substring(1).toLowerCase();}});
      };
      })(jQuery);

      $(document).ready(function(){
      $('#example1').ideaboxWeather({
      location      :' Jakarta, ID'});});
    </script>

    <script>
	$(function(){
	    var url = window.location.pathname, 
	        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$ "); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
	        // now grab every link from the navigation
	        $('.the-menu a').each(function(){
	            // and test its normalized href against the url pathname regexp
	            if(urlRegExp.test(this.href.replace(/\/$/,''))){
	                $(this).addClass('active');
	            }
	        });

	});
	</script>
	<!-- <script src="<?=base_url()?>asset3/admin/plugins/datatables/jquery.dataTables.min.js "></script> -->
  <!-- <script src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="<?=base_url()?>asset3/admin/plugins/datatables/dataTables.bootstrap.min.js "></script> -->
	<script>
      $(function () { 
        $('#tb').DataTable();
      });
    </script>
</body>
</html>