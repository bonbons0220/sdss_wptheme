<div class="sdss-gallery">
<?php while (have_posts()) : the_post(); ?>
<?php $current_page = get_post(); ?>
<div class="row"><div class="col-xs-12"><div class="panel panel-primary"><div class="panel-heading">
<h1 class="panel-title"><?php the_title(); ?></h1></div>
<div class="panel-body">
<?php 
//the_content(); 
	echo "<div class='image well well-sm pull-left'>";
	echo wp_get_attachment_image( $current_page->ID , 'large' );
	the_excerpt();
	echo "</div>\n";
	echo "<div class='description pull-left'>";
	//echo wp_get_attachment_link( $current_page->ID , 'full' , true , true , 'Download' );
	the_content() ;
	echo "</div>\n";
	
?></div></div></div>
<div class="col-xs-12">
<ol class="breadcrumb">
  <li><a href="<?php echo home_url(); ?>">SDSS</a></li>
  <li><a href="/science/image-gallery/">Image Gallery</a></li>
  <li><?php echo $current_page -> post_title; ?></li>
</ol>
</div></div>
<?php endwhile; ?>
</div>
