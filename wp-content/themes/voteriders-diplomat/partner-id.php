<?php
/*
 * Template Name: Partner Page
 * Description: Page template for sharing with partners
 * @package WordPress
 * @subpackage voteriders_diplomat
 */
//get_template_part('header', 'partner');
 wp_head();
echo '<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1" />'

?>
<body>
<div id="wrapper">

<main id="content">
<section id="main" class="medium-12 large-12 columns">
<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<!-- - - - - - - - - - - - Entry - - - - - - - - - - - - - - -->

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php
        the_content();        
        tmm_link_pages();
        ?>


		<div class="clear"></div>

		<?php      
		
		tmm_layout_content(get_the_ID(), 'default');

    endwhile;

endif;
?>
<!-- - - - - - - - - - - - end Entry - - - - - - - - - - - - - - -->
</section>
</main>
</div>

</body>
<?php //get_footer(); ?>
<?php wp_footer(); ?>