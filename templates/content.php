<?php if ( is_singular( array ('algorithms', 'opticalspectra', 'data', 'imaging', 'infrared', 'software', 'help', 'tutorials', 'marvels', ) ) || 
	is_post_type_archive( array ('algorithms', 'opticalspectra', 'data', 'imaging', 'infrared', 'software', 'help', 'tutorials', 'marvels' ) ) ) : ?>

<div class='col-sm-6'>
<article <?php post_class('press'); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="press-img-content">
			<?php the_post_thumbnail('large', array('class' => 'img-responsive'));  ?>
			</div>
		<?php endif ?>
        <div class="content">
          <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <div class="entry-summary">
              <?php the_excerpt(); ?>
              <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-sdss">Read More</a>
          </div>
        </div>
 </article>
</div>


 <?php else: ?>
<!--Following renders the /Press page as buckets-->
<div class='col-sm-6'>
<article <?php post_class('press'); ?> style="box-shadow: 0 0 1px #CCC;">
<?php if ( has_post_thumbnail() ) : ?>
	<div class="press-img-content">
	<?php the_post_thumbnail('large', array('class' => 'img-responsive'));  ?>
	</div>
<?php endif ?>
<div class="content">
<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<div class="entry-summary">
<?php the_excerpt(); ?>
<a href="<?php the_permalink(); ?>" class="btn btn-sm btn-sdss">Read More</a>
</div>
</div>
</article>
</div>
<?php endif; ?>