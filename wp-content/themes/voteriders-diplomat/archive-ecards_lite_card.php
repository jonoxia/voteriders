<?php
// archive for eCards
get_header(); ?>
    <div class="wrap">
        <header class="page-header">
            <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
        </header>

        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php  while ( have_posts() ) : the_post(); ?>
                    <div style="float:left">
                        <a href="<?php the_permalink(); ?>">
                <?php
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
                echo('<img src="' . $image[0] . '" alt="">');
                ?>
                        </a>
                    </div>
                <?php endwhile; ?>
            <br clear="all"><br><br>
            </main>
        </div>
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>
