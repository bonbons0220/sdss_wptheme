<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
<?php 
// Bonnie Souter 01/20/2015
// Adding Google Tag Manager to manage Google Analytics and more without 
// constantly updating analytics scripts and includes. 
?>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-M6F94N"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M6F94N');</script>
<!-- End Google Tag Manager -->

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>

  <div class="wrap container" role="document">
    <div class="content row">
<?php 
//show secondary nav menu
$secondtier_menu = new sdss_nav_menus();

if ( $secondtier_menu->show( 'secondtier' ) ) {

	if (DEBUG) echo "<!-- " . $secondtier_menu->currentlocation . " -->";

	wp_nav_menu(array('theme_location' => $secondtier_menu->currentlocation, 'menu_class' => 'nav nav-pills nav-justified')); 

}

?>
      <main class="main <?php echo roots_main_class(); ?>" role="main">    
        <?php include roots_template_path(); ?>
      </main><!-- /.main -->
    </div><!-- /.content -->
  </div><!-- /.wrap -->
  <?php get_template_part('templates/sitemap'); ?>
  <?php get_template_part('templates/footer'); ?>
</body>
</html>
