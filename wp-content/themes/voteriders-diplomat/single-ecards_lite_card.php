<?php
// Single E-Card Page
get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">
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
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
