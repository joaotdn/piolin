<?php get_header(); ?>

        <div class="small-6 left">
          <h1 class="page-title bg-red text-upp abs wow slideInRight" data-wow-delay=".5s" data-wow-duration="2s">Imprensa</h1>
        </div>
      </div><!-- //row -->
    </header>

    <section class="page-content row">
      
      <nav class="nav-apresentations small-4 columns wow slideInLeft" data-wow-duration="1s">
        <ul class="no-bullet text-upp text-right">
          <?php 
            $category_id = get_cat_ID( 'Imprensa' );
            $categories = get_categories('hide_empty=0&child_of='.$category_id); 
            foreach ($categories as $category):
          ?>
          <li><a href="#" title="<?php echo $category->cat_name; ?>" data-catid="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></a></li>
          <?php endforeach; ?>
        </ul>
      </nav>

      <article class="small-8 left wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">
        <header class="small-12 left">
          <h1 class="text-upp">Clipping</h1>
        </header>

        <?php       
          query_posts('showposts=20&category_name=clipping'); 
          if (have_posts()): while (have_posts()) : the_post();

          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(returnId()), 'clipping' );
          $thumb = $thumb['0'];

          $full = wp_get_attachment_image_src( get_post_thumbnail_id(returnId()), 'full' );
          $full = $full['0'];
        ?>
  
        <nav class="nav-clipping small-12 left">
          <article class="small-12 left">
            <header class="small-12 left">
              <h2 class="text-upp"><?php the_title(); ?></h2>
            </header>
            <figure class="small-12 left">
              <a href="<?php echo $full; ?>" title="<?php the_title(); ?>" class="display-block" data-lightbox="clipping" data-title="<?php the_title(); ?>">
                <img src="<?php echo $thumb; ?>" alt="">
              </a>
            </figure>
          </article>

          <?php endwhile; else: endif; wp_reset_query(); ?>
        </nav>
        
      </article>

    </section><!-- //page content -->

<?php get_footer(); ?>
