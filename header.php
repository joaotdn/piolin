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

        <nav class="menu-home abs wow slideInDown" data-wow-delay=".5s" data-wow-duration="2s">
          <ul class="no-bullet">
            <li><a href="page-piollin.php" class="text-upp">Piollin</a></li>
            <li class="active"><a href="page-espetaculos.php" class="text-upp">Espetáculos</a></li>
            <li><a href="page-projetos.php" class="text-upp">Projetos</a></li>
            <li><a href="page-imprensa.php" class="text-upp">Imprensa</a></li>
            <li><a href="page-contato.php" class="text-upp">Contato</a></li>
          </ul>
        </nav>
    <?php endif; ?>