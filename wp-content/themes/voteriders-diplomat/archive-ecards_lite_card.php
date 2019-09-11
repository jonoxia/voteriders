<?php
// archive for eCards
get_header(); ?>
  <div class="row">
    <div class="small-12 large-8 columns" role="main">
      <article id="post-" class="">
        <header class="page-header">
          <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
        </header>

        <div class="entry-content">
          <main id="main" class="site-main" role="main">
            <?php  while ( have_posts() ) : the_post(); ?>
              <div style="float:left; margin: 10px">
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
      </article>
    </div>
    <?php get_sidebar(); ?>
  </div>
<?php get_footer(); ?>
