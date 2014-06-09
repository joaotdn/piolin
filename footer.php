  <?php if(!is_home()): ?>
    <footer id="footer" class="row rel wow fadeInUp" data-wow-duration="1s">
      <section class="small-4 abs small-push-4">
        <figure class="left">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Página principal" class="display-block icon-logo-footer"></a>
        </figure>
        <nav class="left">
          <?php 
            $fb = get_option('nt_fb');
            $tw = get_option('nt_tw');
          ?>
          <?php if($fb != ''): ?>
          <a href="<?php echo $fb; ?>" class="display-block left icon-facebook" title="Siga-nos no Facebook"></a>
          <?php endif; ?>
          <?php if($tw != ''): ?>
          <a href="http://twitter.com/<?php echo $tw; ?>" class="display-block left icon-twitter" title="Siga-nos no Twitter"></a>
          <?php endif; ?>
        </nav>
      </section>
    </footer><!-- //footer -->   
  <?php endif; ?> 
    
    <div id="jpreContent">
      <div class="icon-logo-loader"></div>
    </div><!-- preloader -->
    <script>
      //<![CDATA[
      var getData = {
        'urlDir':'<?php bloginfo('template_directory'); ?>/',
        'ajaxDir':'<?php echo stripslashes(get_admin_url()).'admin-ajax.php'; ?>'
      }
      //]]>
    </script>
    <script src="<?php echo get_template_directory_uri(); ?>/scripts.js"></script>
    <?php wp_footer(); ?>
  </body>
</html>