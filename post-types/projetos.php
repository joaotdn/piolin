<?php
/**
 * Post type : Projetos
 */
function projetos_init() {
  $labels = array(
    'name'               => 'Projetos',
    'singular_name'      => 'Projeto',
    'add_new'            => 'Adicionar Novo',
    'add_new_item'       => 'Adicionar novo Projeto',
    'edit_item'          => 'Editar Projeto',
    'new_item'           => 'Novo Projeto',
    'all_items'          => 'Todos os Projetos',
    'view_item'          => 'Ver Projeto',
    'search_items'       => 'Buscar Projeto',
    'not_found'          => 'N�o encontrado',
    'not_found_in_trash' => 'N�o encontrado',
    'parent_item_colon'  => '',
    'menu_name'          => 'Projetos'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'projetos' ),
    //'menu_icon'           => get_stylesheet_directory_uri() . '/images/works.png',
    'capability_type'    => 'post',
    'menu_position'      => 1,
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title','thumbnail' )
  );

  register_post_type( 'projetos', $args );
}
add_action( 'init', 'projetos_init' );
?>