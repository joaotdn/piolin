<!doctype html>
<html class="no-js" lang="pt-BR">
  <!--
	Design: João Faissal (joao.faissal@gmail.com)
	Código: João Teodoro (joaotdn@gmail.com)
	https://www.facebook.com/imaginariacc
	-->
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0" />-->
    <title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/vnd.microsoft.icon"/>
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-ico"/>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.1/modernizr.min.js"></script>
    <?php wp_head(); ?>
  </head>
  <body>

  	<?php if(!is_home()): ?>
  	<header id="header" class="small-12 left rel">
      <nav class="bd-images inset abs">
        <?php imageSlider(); ?>
      </nav>

      <div class="row">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="display-block left logo" title="Página principal">
          <div class="icon-logo"></div>
        </a>
        <?php $post_type = get_post_type( get_the_ID() ); ?>
        <nav class="menu-home abs wow slideInDown" data-wow-delay=".5s" data-wow-duration="2s">
          <ul class="no-bullet">
            <?php $page = get_page_by_title('Piollin'); ?>
          <li <?php if(is_page('piollin')): echo 'class="active"'; endif; ?>><a href="<?php echo get_page_link($page->ID); ?>" class="text-upp">Piollin</a></li>
          
          <?php $espetaculos = get_post_type_archive_link('espetaculos'); ?>
          <li <?php if($post_type == 'espetaculos') { echo 'class="active"'; } ?>><a href="<?php echo $espetaculos; ?>" class="text-upp">Espetáculos</a></li>

          <?php $projetos = get_post_type_archive_link('projetos'); ?>
          <li <?php if($post_type == 'projetos') { echo 'class="active"'; } ?>><a href="<?php echo $projetos; ?>" class="text-upp">Projetos</a></li>
          
          <?php $category_id = get_cat_ID( 'Imprensa' ); $category_link = get_category_link( $category_id ); ?>
          <li <?php if(is_category('imprensa')): echo 'class="active"'; endif; ?>><a href="<?php echo esc_url( $category_link ); ?>" class="text-upp">Imprensa</a></li>

          <?php $page = get_page_by_title('Contato'); ?>
          <li <?php if(is_page('contato')): echo 'class="active"'; endif; ?>><a href="<?php echo get_page_link($page->ID); ?>" class="text-upp">Contato</a></li>
          </ul>
        </nav>
    <?php endif; ?>