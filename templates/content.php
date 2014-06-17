  <?php if (is_tax()): ?> 


<article <?php post_class(); ?>>
  <section class="sdss-docs-section">
    <h2 class="entry-title" id="<?php $text=get_the_title(); $text=explode(' ',$text); echo strtolower($text[0]); ?>"><?php the_title(); ?></h2>
    <!--Remove meta data
    <?php get_template_part('templates/entry-meta'); ?>-->
    <?php the_content(); ?>
  </section>
</article>


 <?php else: ?>

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