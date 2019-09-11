<?php
// Single E-Card Page
get_header(); ?>

<div class="row">
  <div class="small-12 large-8 columns" role="main">
    <article id="post-" class="">
      <div class="entry-content">
        <main id="main" class="site-main" role="main">
            <?php  while ( have_posts() ) : the_post(); ?>
                <?php
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                echo('<p><img src="' . $image[0] . '" alt=""></p>');
                ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </main>
      </div>
    </article>
  </div>
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
