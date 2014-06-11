  <?php if (is_tax()): ?> 


<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-title"><?php the_title(); ?></h2>
    <!--Remove meta data
    <?php get_template_part('templates/entry-meta'); ?>-->
  </header>
  <section>
  <div class="entry-summary">
    <?php the_content(); ?>
  </div>
</section>
</article>


 <?php else: ?>

<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>

 <?php endif; ?>