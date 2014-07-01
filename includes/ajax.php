<?php
//Requisitar sub-paginas Piollin
add_action( 'wp_ajax_nopriv_request_child_piollin', 'request_child_piollin' );
add_action( 'wp_ajax_request_child_piollin', 'request_child_piollin' );

function request_child_piollin() {
  
  $page_name = $_GET['page_name'];
  if($page_name != '') {
    $page = get_page_by_title($page_name);
  } else {
    die('Ocorreu algum erro interno. Tente novamente');
  }

  echo returnContent($page->ID);
  
  exit();
}

//Requisitar espetaculos
add_action( 'wp_ajax_nopriv_request_espetaculo', 'request_espetaculo' );
add_action( 'wp_ajax_request_espetaculo', 'request_espetaculo' );

function request_espetaculo() {

  $postid = $_GET['postid'];

  ?>
  <header class="small-12 left">
    <h1 class="text-upp"><?php echo get_the_title($postid); ?></h1>
  </header>

  <?php
    $content = get_field('esp_desc', $postid);
    $ficha_tecnica = get_field('ficha_tecnica', $postid); 
    $apresentacoes = get_field('apresentacoes', $postid);  
    
    /*
    Descrição
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

  <?php
  
  exit();
}

add_action( 'wp_ajax_nopriv_request_espetaculo_images', 'request_espetaculo_images' );
add_action( 'wp_ajax_request_espetaculo_images', 'request_espetaculo_images' );

function request_espetaculo_images() {
  $postid = $_GET['postid'];
  ?>
  <ul class="no-bullet clearing-thumbs clearing-feature" data-clearing>
    <?php
    $images = get_field('esp_fotos', $postid);
    $i = 0;
    if(isset($images)):
      foreach($images as $image):
        $thumb = wp_get_attachment_image_src( $image['esp_foto'], 'piollin-thumb' );
        $full = wp_get_attachment_image_src( $image['esp_foto'], 'full' );
        $thumb = $thumb['0'];
        $full = $full['0'];
        $i++;
    ?>
    
    <li <?php if($i <= 3): echo 'class="clearing-featured-img"'; endif; ?>>
      <figure class="small-12 left rel page-thumb">
        <a href="<?php echo $full; ?>" class="display-block small-12 left"><img src="<?php echo $thumb; ?>" alt="" class="small-12" data-caption="<?php echo $image['esp_caption']; ?>"></a>
        <figcaption class="small-12 left"></figcaption>
      </figure>
    </li>

    <?php
      endforeach; 
    endif;
    ?>
  </ul>
  <?php
  
  exit();
}

//Projetos
//textos
add_action( 'wp_ajax_nopriv_request_projeto', 'request_projeto' );
add_action( 'wp_ajax_request_projeto', 'request_projeto' );

function request_projeto() {

  $postid = $_GET['postid'];

  ?>
  <header class="small-12 left">
    <h1 class="text-upp"><?php echo get_the_title($postid); ?></h1>
  </header>
  <div class="text-columns small-12 left">
  <?php
    $content = get_field('pj_desc', $postid); 
    echo $content;
  ?>
  </div>  
  <?php
  
  exit();
}
//imagens
add_action( 'wp_ajax_nopriv_request_projeto_images', 'request_projeto_images' );
add_action( 'wp_ajax_request_projeto_images', 'request_projeto_images' );

function request_projeto_images() {

  $postid = $_GET['postid'];

  ?>
    <ul class="small-block-grid-3 clearing-thumbs clearing-feature" data-clearing>
        <?php 
        $images = get_field('pj_images', $postid); 
        $i = 0;

        if($images):
            
        foreach($images as $image):
          $thumb = wp_get_attachment_image_src( $image['pj_image'], 'piollin-thumb' );
          $full = wp_get_attachment_image_src( $image['pj_image'], 'full' );
          $thumb = $thumb['0'];
          $full = $full['0'];

          $i++;
      ?>
      <li <?php if($i <= 3): echo 'class="clearing-featured-img"'; endif; ?>>
        <figure class="small-12 left rel page-thumb">
          <a href="<?php echo $full; ?>" class="display-block small-12 left"><img src="<?php echo $thumb; ?>" alt="" class="small-12" data-caption="<?php echo $image['pj_description']; ?>"></a>
          <figcaption class="small-12 left"></figcaption>
        </figure>
      </li>
      <?php endforeach; endif; ?>
    </ul>
  <?php
  
  exit();
}

?>