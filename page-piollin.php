<?php get_header(); ?>

        <div class="small-6 left">
          <h1 class="page-title bg-red text-upp abs wow slideInRight" data-wow-delay=".5s" data-wow-duration="2s">Piollin</h1>
          <nav class="abs nav-groups">
            <ul class="no-bullet text-upp wow fadeIn" data-wow-delay="2s" data-wow-duration="1s">
            <?php 
              $page = get_page_by_title('Piollin');
              $timeline = get_page_by_title('Timeline');
              $args = array(
                'child_of'     => $page->ID,
                'sort_column'  => 'menu_order, post_title',
                'title_li'     =>'', 
                'exclude'      => $timeline->ID
              ); 
              wp_list_pages( $args );
            ?>
            </ul>
          </nav>
        </div>
      </div><!-- //row -->
    </header>

    <section class="page-content row wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">
      <header class="small-8 small-push-4 left">
        <h1 class="text-upp group-title">Grupo de Teatro</h1>
      </header>

      <article class="small-8 small-push-4 left group-content">
        <div class="waiting-post small-12 left text-center">
          <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="">
        </div>
        <?php 
          $page = get_page_by_title('Grupo de Teatro');
          echo returnContent($page->ID); 
        ?>
      </article>
    </section><!-- //page content -->

    <div class="small-12 left">
      <nav class="group-slide small-12 left">
        <ul class="small-block-grid-3 clearing-thumbs clearing-feature" data-clearing>
          <?php 
            $page = get_page_by_title('Piollin');
            $images = get_field('piollin_images', $page->ID); 
            foreach($images as $image):
              $thumb = wp_get_attachment_image_src( $image['piollin_image'], 'piollin-thumb' );
              $full = wp_get_attachment_image_src( $image['piollin_image'], 'full' );
              $thumb = $thumb['0'];
              $full = $full['0'];
          ?>
          <li>
            <figure class="small-12 left rel page-thumb">
              <a href="<?php echo $full; ?>" class="display-block small-12 left"><img src="<?php echo $thumb; ?>" alt="" class="small-12" data-caption="<?php echo $image['piollin_desc']; ?>"></a>
              <figcaption class="small-12 left"></figcaption>
            </figure>
          </li>
          <?php endforeach; ?>
        </ul>
      </nav>
    </div><!-- //fotos do grupo -->

    <section class="small-12 left timeline rel">
      <div class="tl-line small-12 abs"></div>
      <nav class="small-12 left tl-slider rel wow slideInLeft" data-wow-duration="1s">

        <div class="flowslider small-12 left" >
          <?php 
            $page = get_page_by_title('Timeline');
            $years = get_field('timeline', $page->ID); 
            foreach($years as $year):
          ?>
          <div class="time-block rel left">
            <h2 class="tl-year small-12"><?php echo $year['tl_year']; ?></h2>
            <div class="pointer"></div>
            <p><?php echo $year['tl_desc']; ?></p>
          </div>
          <?php endforeach; ?>
        </div>     
      </nav>
    </section><!-- //timeline -->

<?php get_footer(); ?>
