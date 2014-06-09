<?php
/**
 * Post type : Slider
 */
function slider_init() {
  $labels = array(
    'name'               => 'Slider',
    'singular_name'      => 'slide',
    'add_new'            => 'Adicionar Novo',
    'add_new_item'       => 'Adicionar nova imagem',
    'edit_item'          => 'Editar slide',
    'new_item'           => 'Novo slide',
    'all_items'          => 'Todos as imagens',
    'view_item'          => 'Ver slide',
    'search_items'       => 'Buscar Slider',
    'not_found'          => 'N�o encontrado',
    'not_found_in_trash' => 'N�o encontrado',
    'parent_item_colon'  => '',
    'menu_name'          => 'Slider'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'slider' ),
    //'menu_icon'           => get_stylesheet_directory_uri() . '/images/works.png',
    'capability_type'    => 'post',
    'menu_position'      => 1,
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title','thumbnail' )
  );

  register_post_type( 'slider', $args );
}
add_action( 'init', 'slider_init' );
?>