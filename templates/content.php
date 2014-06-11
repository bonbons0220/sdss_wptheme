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