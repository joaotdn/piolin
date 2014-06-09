<?php get_header(); ?>

        <div class="small-6 left">
          <h1 class="page-title bg-green text-upp abs wow slideInRight" data-wow-delay=".5s" data-wow-duration="2s">Contato</h1>
        </div>
      </div><!-- //row -->
    </header>

    <section class="page-content row">
      <?php
          $cep = get_option('nt_cep');
          $end = get_option('nt_end');
          $city = get_option('nt_city');
          $tel1 = get_option('nt_tel1');
          $tel2 = get_option('nt_tel2');
          $email = get_option('nt_email');
      ?>
      <article class="small-8 small-push-4 left wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">
        <section class="small-6 left">
          <h2 class="text-upp">Endereço</h2>
          <h5 class="text-upp grey"><?php echo $end; ?></h4>
          <h5 class="text-upp grey"><?php echo $city; ?></h4>
          <h5 class="text-upp grey">CEP <?php echo $cep; ?></h4>
        </section>

        <section class="small-6 left">
          <h2 class="text-upp">Telefones</h2>
          <h5 class="text-upp grey"><?php echo $tel1; ?></h4>
          <h5 class="text-upp grey"><?php echo $tel2; ?></h4>
        </section>

        <section class="small-12 left">
          <header class="small-12 left">
            <h2 class="text-upp">E-mail</h2>
            <h5 class="grey"><?php echo $email; ?></h5>
          </header>

          <?php echo do_shortcode('[contact-form-7 id="45" title="Formulário de contato 1"]'); ?>

        </section>
      </article>

    </section><!-- //page content -->

<?php get_footer(); ?>
