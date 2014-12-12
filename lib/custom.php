<?php
/**
 * Custom functions
 */

  add_filter('roots_wrap_base', 'roots_wrap_base_cpts'); // Add our function to the roots_wrap_base filter

  function roots_wrap_base_cpts($templates) {
    $cpt = get_post_type(); // Get the current post type
    if ($cpt) {
       array_unshift($templates, 'base-' . $cpt . '.php'); // Shift the template to the front of the array
    }
    return $templates; // Return our modified array with base-$cpt.php at the front of the queue
  }

function sdss_customizer_sections( $wp_customize ) {

	//Splash Screen
   $wp_customize->add_section( 'sdss_shortcodes' , array(
		  'title' => 'Shortcodes List',
		  'priority' => 1,
		  'description' => 'These are the shortcodes that have been created for the sdss theme and can be used in posts and pages. Copy and paste [*] into your page. ',
   ) );


	$wp_customize->add_setting( 'sdss_toc_shortcode' , array(
		'default' => 'Table of Contents',
		'sanitize_callback' => '',
		'transport' => 'refresh',
	));

	
	$wp_customize->add_control( 'sdss_toc_shortcode',
        array(
            'label'          => __( '[SDSS_TOC&nbsp;selectors="h2,h3"]', 'sdss' ),
            'section'        => 'sdss_shortcodes',
            'type'           => 'label',
        ));

	$wp_customize->add_setting( 'sdss_totop_shortcode' , array(
		'default' => 'Top of Page Arrow',
		'sanitize_callback' => '',
		'transport' => 'refresh',
	));

	
	$wp_customize->add_control( 'sdss_totop_shortcode',
        array(
            'label'          => __( '[SDSS_TOTOP]', 'sdss' ),
            'section'        => 'sdss_shortcodes',
            'type'           => 'label',
        ));

}
add_action( 'customize_register', 'sdss_customizer_sections' );
?>