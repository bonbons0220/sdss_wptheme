<?php while (have_posts()) : the_post(); ?>
<?php $current_page = get_post(); ?>
<article <?php post_class(); ?>>
<header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
</header>
<div class="entry-content">
<div class="row"><div class="col-xs-12 col-md-9">
<?php 
if ( function_exists( 'get_cfc_meta' ) ) $this_cfc_meta = get_cfc_meta( $current_page -> post_type.'-meta' );

if (count($this_cfc_meta)) {
	?><div class="row"><div class="col-xs-12 col-md-6"><?php 
	the_content(); 
	?></div><div class="col-xs-12 col-md-6"><div class="well"><?php 
	foreach ($this_cfc_meta[0] as $this_key => $this_value ){
		if ( strpos ( $this_key ,  "!" ) === 0 ) continue;
		echo "<strong>" . ucfirst( str_replace ( '-' , ' ' , $this_key ) ) . ": </strong>";
		echo $this_value . "<br>\n";
	}
	?></div></div></div><?php
} else {
	the_content(); 
}
?></div><div class="col-xs-12 col-md-3"><?php
$terms = get_the_terms( get_the_ID() , $current_page -> post_type.'-tags' );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
foreach ( $terms as $term ) {
	echo "<div class='h4'><div class='label'><a href=" . home_url() . '/' . $current_page -> post_type.'-tags' . '/' . sanitize_title($term->name) . ">" . $term->name . "</a></div></div>\n"; 
}
 }?>
</div></div>
<div class="row">
<div class="col-xs-12">
<ol class="breadcrumb">
  <li><a href="<?php echo home_url(); ?>">SDSS</a></li>
  <li><a href="<?php echo home_url() . '/' . $current_page -> post_type ; ?>"><?php echo ucfirst($current_page -> post_type); ?></a></li>
  <li><?php echo $current_page -> post_title; ?></li>
</ol>
</div></div></div>

<footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
</footer>
<?php comments_template('/templates/comments.php'); ?>
</article>
<?php endwhile; ?>
