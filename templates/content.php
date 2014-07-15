<?php if (is_singular( array ('algorithms', 'opticalspectra', 'data', 'imaging', 'infrared', 'software', 'help', 'tutorials', 'marvels', ) ) || is_post_type_archive( array ('algorithms', 'opticalspectra', 'data', 'imaging', 'infrared', 'software', 'help', 'tutorials', 'marvels' ) )): ?>
<div class="col-sm-6">
  <article <?php post_class('press'); ?>>
        <div class="content">
          <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          <div class="entry-summary">
              <?php the_excerpt(); ?>
              <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-sdss">Explore</a>
          </div>
        </div>
  </article>
</div>

 <?php else: ?>
<!--Following renders the /Press page as buckets-->
<div class="col-sm-6">
  <article <?php post_class('press'); ?>>
        <div class="press-img-content">
         <?php the_post_thumbnail('large', array('class' => 'img-responsive'));  ?>
        </div>
        <div class="content">
          <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <div class="author">
              <?php get_template_part('templates/entry-meta'); ?>
          </div>
          <div class="entry-summary">
              <?php the_excerpt(); ?>
              <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-sdss">Read More</a>
          </div>
        </div>
  </article>
</div>
 <?php endif; ?>