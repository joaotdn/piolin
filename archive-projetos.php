<?php get_header(); ?>

        <div class="small-6 left">
          <h1 class="page-title bg-blue text-upp abs wow slideInRight" data-wow-delay=".5s" data-wow-duration="2s">Projetos</h1>
        </div>
      </div><!-- //row -->
    </header>

    <section class="page-content row">
      
      <nav class="nav-projects small-4 columns wow slideInLeft" data-wow-duration="1s">
        <ul class="no-bullet text-upp text-right">
          <?php 
            $args = array( 'post_type' => 'projetos', 'posts_per_page' => -1, 'orderby' => 'date' ); 
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
          ?>
          <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" data-postid="<?php echo returnId(); ?>"><?php the_title(); ?></a></li>
          <?php endwhile; ?>
          <?php wp_reset_query(); ?>
        </ul>
      </nav>

      <article class="small-8 left wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">
        <div class="waiting-post small-12 left text-center">
          <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="">
        </div>
        
        <?php 
          $args = array( 'post_type' => 'projetos', 'posts_per_page' => 1, 'orderby' => 'date' ); 
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post();
        ?>
        <div class="pj-text small-12 left">
          <header class="small-12 left">
            <h1 class="text-upp"><?php the_title(); ?></h1>
          </header>
        
          <div class="text-columns small-12 left">
            <?php
              global $post, $post_id; 
              $content = get_field('pj_desc', $post->ID); 
              echo $content;
            ?>
          </div>
        </div>
        <?php endwhile; ?>
        <?php wp_reset_query(); ?>
      </article>

    </section><!-- //page content -->

<?php get_footer(); ?>
