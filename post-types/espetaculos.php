<?php
/**
 * Post type : Espetaculos
 */
function espetaculos_init() {
  $labels = array(
    'name'               => 'Espet&aacute;culos',
    'singular_name'      => 'espet&aacute;culo',
    'add_new'            => 'Adicionar Novo',
    'add_new_item'       => 'Adicionar novo espet&aacute;culo',
    'edit_item'          => 'Editar espetáculo',
    'new_item'           => 'Novo espetáculo',
    'all_items'          => 'Todos os espet&aacute;culos',
    'view_item'          => 'Ver espet&aacute;culo',
    'search_items'       => 'Buscar Espet&aacute;culos',
    'not_found'          => 'N�o encontrado',
    'not_found_in_trash' => 'N�o encontrado',
    'parent_item_colon'  => '',
    'menu_name'          => 'Espet&aacute;culos'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'espetaculos' ),
    //'menu_icon'           => get_stylesheet_directory_uri() . '/images/works.png',
    'capability_type'    => 'post',
    'menu_position'      => 1,
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title','thumbnail' )
  );

  register_post_type( 'espetaculos', $args );
}
add_action( 'init', 'espetaculos_init' );
?>