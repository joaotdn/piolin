<?php get_header(); ?>

        <div class="small-6 left">
          <h1 class="page-title bg-violet text-upp abs wow slideInRight" data-wow-delay=".5s" data-wow-duration="2s">Espetáculos</h1>
        </div>
      </div><!-- //row -->
    </header>

    <section class="page-content row">
      
      <nav class="nav-apresentations small-4 columns wow slideInLeft" data-wow-duration="1s">
        <ul class="no-bullet text-upp text-right">
          <?php 
            $args = array( 'post_type' => 'espetaculos', 'posts_per_page' => -1, 'orderby' => 'date' ); 
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
          ?>
          <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" data-postid="<?php echo returnId(); ?>"><?php the_title(); ?></a></li>
          <?php endwhile; ?>
          <?php wp_reset_query(); ?>
        </ul>
      </nav>
      
      <article class="small-4 left wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">
        <div class="waiting-post small-12 left text-center">
          <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="">
        </div>

        <div class="esp-text small-12 left txt">
        <header class="small-12 left">
          <?php 
            $args = array( 'post_type' => 'espetaculos', 'posts_per_page' => 1, 'orderby' => 'date' ); 
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
          ?>
          <h1 class="text-upp"><?php the_title(); ?></h1>
        </header>

        <?php
          global $post, $post_id; 
          $content = get_field('esp_desc', $post->ID); 
          $ficha_tecnica = get_field('ficha_tecnica', $post->ID); 
          $apresentacoes = get_field('apresentacoes', $post->ID); 

          /*
          Descrição do espetáculo
           */
          echo $content;

          /*
          Ficha Técnica
           */
          if($ficha_tecnica) {
            ?>
            <h3 class="text-upp">Ficha Técnica</h3>
            <p>
            <?php
            foreach ($ficha_tecnica as $ficha) {
              print "<span>". $ficha['ficha_cargo'] ." - ". $ficha['responsavel'] ."</span><br>";
            }
            ?></p><?php
          }

          /*
          Apresentações
           */
          if($apresentacoes) {
            ?>
            <h3 class="text-upp">Apresentações</h3>
            <p>
            <?php
            foreach ($apresentacoes as $apresentacao) {
              print "<span>". $apresentacao['apresentacoes_ano'] ." - ". $apresentacao['apresentacoes_nome'] ." - ". $apresentacao['apresentacoes_local'] ."</span><br>";
            }
            ?></p><?php
          }
        ?>

        <?php endwhile; ?>
        <?php wp_reset_query(); ?>
        </div>
      </article>

      <div class="small-4 right">
        <nav class="group-slide vertical small-12 left">
          <ul class="no-bullet clearing-thumbs clearing-feature" data-clearing>
            <?php 
              $args = array( 'post_type' => 'espetaculos', 'posts_per_page' => 1, 'orderby' => 'date' ); 
              $loop = new WP_Query( $args );
              while ( $loop->have_posts() ) : $loop->the_post();
              global $post;
              $images = get_field('esp_fotos', $post->ID);

              if(isset($images)):

              foreach($images as $image):
                $thumb = wp_get_attachment_image_src( $image['esp_foto'], 'piollin-thumb' );
                $full = wp_get_attachment_image_src( $image['esp_foto'], 'full' );
                $thumb = $thumb['0'];
                $full = $full['0'];
            ?>
            <li>
              <figure class="small-12 left rel page-thumb">
                <a href="<?php echo $full; ?>" class="display-block small-12 left"><img src="<?php echo $thumb; ?>" alt="" class="small-12" data-caption="<?php echo $image['esp_caption']; ?>"></a>
                <figcaption class="small-12 left"></figcaption>
              </figure>
            </li>
            <?php endforeach; endif; ?>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?> 
          </ul>
        </nav>
      </div><!-- //fotos dos espetaculos -->

    </section><!-- //page content -->

<?php get_footer(); ?>
