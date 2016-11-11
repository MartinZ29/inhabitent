<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package RED_Starter_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function red_starter_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'red_starter_body_classes' );

function my_login_logo(){  ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/inhabitent-logo-text-dark.svg);
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


function my_style_methor(){
	if(!is_page_template('page-about.php')){
		return;
	}

	$url = CFS()->get('#about_image');
	$custom_css = ".about-hero-banner{bakcground-image:url({$url});}";
	wp_add_inline_style('red-starter-style',$cunstom_css);
	
}
add_action('wp_enqueue_scripts','my_style_method');


function get_all_product_posts($query){
    if(is_post_type_archive('product') && !is_admin() && $query->is_main_query() ){
        $query->set('posts_per_page','16');
        $query->set('orderby','title');
        $query->set('order','ASC');
        return;
    }
}
add_action('pre_get_posts','get_all_product_posts');