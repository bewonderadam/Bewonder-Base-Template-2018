<?php
get_header(); ?>
<section id="page-header-container">
  <div class="page-header-inner">
    <div class="title-container">
      <div class="title-inner">
        <h1><?php the_title(); ?></h1>
      </div>
    </div>
  </div>
</section>
<section id="page-container">
  <div class="page-container-inner">
    <?php $myOffers = simplexml_load_file('http://localhost/base_template_2018/promotions.xml');
    foreach( $myOffers->work as $dataFeed ) :
      foreach( $dataFeed->prod as $product ) :

      endforeach;
    endforeach; ?>
    <pre>
      <?php print_r( $myOffers ); ?>
    </pre>
  </div>
</section>
<?php get_footer(); ?>
