<?php get_header(); ?>

<div class="generic-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div><?php the_content(); ?></div>
    <?php endwhile; endif; ?>
</div>


<?php get_footer(); ?>
