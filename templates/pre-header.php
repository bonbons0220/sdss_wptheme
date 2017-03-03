<?php 
/*
 * Bonnie Souter 03/08/2016
 * Moved pre-header info from templates to consolidate identical function calls.
 */
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
if ( defined( 'WP_ENV' ) && 
	 defined( 'DATA_RELEASE' ) && 
	( strcmp( WP_ENV , 'development' ) === 0 ) ) : 
?>
	<div class="wrap container-fluid" role="document">
		<div class="content row">
			<div class="col-xs-12" style="background-color: yellow;"><h1><?php echo DATA_RELEASE ; ?></h1></div>
		</div>
	</div>
<?php
endif;
?>
