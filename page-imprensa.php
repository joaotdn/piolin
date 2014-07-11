<?php get_header(); ?>

        <div class="small-6 left">
          <h1 class="page-title bg-red text-upp abs wow slideInRight" data-wow-delay=".5s" data-wow-duration="2s">Imprensa</h1>
        </div>
      </div><!-- //row -->
    </header>

    <section class="page-content row">
      
      <nav class="nav-apresentations midia small-4 columns wow slideInLeft" data-wow-duration="1s">
        <ul class="no-bullet text-upp text-right">
          <li><a href="#" title="Imprensa" class="active">Imprensa</a></li>
          <li><a href="#" title="Clipping">Clipping</a></li>
        </ul> 
      </nav>

      <article class="small-8 left wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">
        <header class="small-12 left">
          <h1 class="text-upp midia-section">Releases</h1>
        </header>

        <div class="waiting-post small-12 left text-center">
          <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="">
        </div>

        <nav class="nav-releases small-12 left">
          <?php       
            $page = get_page_by_title('Imprensa');
            $releases = get_field('releases', $page->ID); 
            foreach($releases as $release):
          ?>
          <ul class="no-bullet">
            <li>
              <h4 class="text-upp red"><?php echo $release['release_title']; ?></h4>
              <p><a href="<?php echo $release['release_file']; ?>" class="button">Baixar</a></p>
            </li>
          </ul>
          <?php 
            endforeach;
          ?>
        </nav>
        
      </article>

    </section><!-- //page content -->

<?php get_footer(); ?>
