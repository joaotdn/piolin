<?php get_header(); ?>
    
    <nav class="bd-images abs">
      <?php imageSlider(); ?>
    </nav>

    <div class="small-12 left">
      <a href="index.php" class="display-block left logo" title="Página principal">
        <div class="icon-logo"></div>
      </a>

      <nav class="menu-home abs wow slideInDown" data-wow-delay=".5s" data-wow-duration="1s">
        <ul class="no-bullet">
          <?php $page = get_page_by_title('Piollin'); ?>
          <li <?php if(is_page('piollin')): echo 'class="active"'; endif; ?>><a href="<?php echo get_page_link($page->ID); ?>" class="text-upp">Piollin</a></li>
          
          <?php $espetaculos = get_post_type_archive_link('espetaculos'); ?>
          <li><a href="<?php echo $espetaculos; ?>" class="text-upp">Espetáculos</a></li>

          <?php $projetos = get_post_type_archive_link('projetos'); ?>
          <li><a href="<?php echo $projetos; ?>" class="text-upp">Projetos</a></li>

          <li><a href="page-imprensa.php" class="text-upp">Imprensa</a></li>
          <li><a href="page-contato.php" class="text-upp">Contato</a></li>
        </ul>
      </nav>
    </div><!-- //menu -->
    
<?php get_footer(); ?>
