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
          <li><a href="<?php echo get_page_link($page->ID); ?>" class="text-upp">Piollin</a></li>
          
          <?php $espetaculos = get_post_type_archive_link('espetaculos'); ?>
          <li><a href="<?php echo $espetaculos; ?>" class="text-upp">Espetáculos</a></li>

          <?php $projetos = get_post_type_archive_link('projetos'); ?>
          <li><a href="<?php echo $projetos; ?>" class="text-upp">Projetos</a></li>
          
          <?php $category_id = get_cat_ID( 'Imprensa' ); $category_link = get_category_link( $category_id ); ?>
          <li><a href="<?php echo esc_url( $category_link ); ?>" class="text-upp">Imprensa</a></li>

          <?php $page = get_page_by_title('Contato'); ?>
          <li><a href="<?php echo get_page_link($page->ID); ?>" class="text-upp">Contato</a></li>
          </ul>
      </nav>
    </div><!-- //menu -->
    
<?php get_footer(); ?>
