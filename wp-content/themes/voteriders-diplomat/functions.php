<?php


function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a>';

function extend_date_archives_flush_rewrite_rules(){
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}
add_action('init', 'extend_date_archives_flush_rewrite_rules');

function extend_date_archives_add_rewrite_rules($wp_rewrite){
	$rules = array();
	$structures = array(
		$wp_rewrite->get_category_permastruct() . $wp_rewrite->get_date_permastruct(),
		$wp_rewrite->get_category_permastruct() . $wp_rewrite->get_month_permastruct(),
		$wp_rewrite->get_category_permastruct() . $wp_rewrite->get_year_permastruct(),
	);
	foreach( $structures as $s ){
		$rules += $wp_rewrite->generate_rewrite_rules($s);
	}
	$wp_rewrite->rules = $rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'extend_date_archives_add_rewrite_rules');


add_filter('xmlrpc_enabled', '__return_false');

function my_theme_enqueue_styles() {

    $parent_style = 'diplomat-style'; // This is diplomat style' for the Diplomat theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'voteriders-diplomat-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

}
add_filter( 'excerpt_more', 'new_excerpt_more' );

//debugging 
//remove_filter( 'the_content', 'wpautop' );
//remove_filter( 'the_excerpt', 'wpautop' );


register_nav_menus( array(
	'secondary' => __('Footer Navigation', 'voteriders-diplomat')  
) );