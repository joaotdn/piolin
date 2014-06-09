<?php 
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
}

//Get new images formats
if ( function_exists( 'add_image_size' ) ) { 
  add_image_size( 'piollin-thumb', 400, 400, true );
}

add_filter( 'jpeg_quality', 'tgm_image_full_quality' );
add_filter( 'wp_editor_set_quality', 'tgm_image_full_quality' );
/**
 * Filters the image quality for thumbnails to be at the highest ratio possible.
 *
 * Supports the new 'wp_editor_set_quality' filter added in WP 3.5.
 *
 * @since 1.0.0
 *
 * @param int $quality The default quality (90)
 * @return int $quality Amended quality (100)
 */
function tgm_image_full_quality( $quality ) {
 
    return 100;
 
}

//Get jQuery
function my_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}

add_action('wp_enqueue_scripts', 'my_scripts_method');

function returnId() {
  global $post, $post_id;
  return $post->ID;
}

function returnContent($pid) {
  $my_postid =  $pid; //This is page id or post id
  $content_post = get_post($my_postid);
  $content = $content_post->post_content;
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

function get_excerpt($l) {
  $e = substr(get_the_excerpt(), 0,$l);
  return $e;
}

function wpb_list_child_pages() { 

  global $post; 

  if ( is_page() && $post->post_parent )

    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
  else
    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );

  if ( $childpages ) {
    
    $string =  $childpages ;

  }

  return $string;

}

add_shortcode('wpb_childpages', 'wpb_list_child_pages');

/**
 * Custom Post Types
 */

//Slider de imagens
require_once ( get_stylesheet_directory() . '/post-types/slider.php' );

function imageSlider() {
  $args = array( 'post_type' => 'slider', 'posts_per_page' => 15, 'orderby' => 'rand' ); 
  $loop = new WP_Query( $args );
  while ( $loop->have_posts() ) : $loop->the_post();

  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(returnId()), 'full' );
  $thumb = $thumb['0']; //Return thumbnail URI
  ?>
    <figure style="background-image: url(<?php echo $thumb; ?>);"></figure>
  <?php
  endwhile;
  wp_reset_query();
}

//Espetáculos
require_once ( get_stylesheet_directory() . '/post-types/espetaculos.php' );

//Projetos
require_once ( get_stylesheet_directory() . '/post-types/projetos.php' );

//Ajax
require_once ( get_stylesheet_directory() . '/includes/ajax.php' );


?>