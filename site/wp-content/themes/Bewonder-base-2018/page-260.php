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
    <?php if( get_field( 'display_products_on_store_pages', 'option' ) ) :
      $myOffers = simplexml_load_file('http://localhost/base_template_2018/datafeed.xml');
      $numberOfProducts = get_field( 'number_of_products_per_page', 'option' );
      $pageTitle = 'Superdrug';
      $i = 0; ?>
      <section id="affiliate-products-container" class="owl-carousel">
        <?php foreach( $myOffers->datafeed as $dataFeed ) :
          if( $dataFeed->attributes()->merchantName == $pageTitle ) :
            foreach( $dataFeed->prod as $product ) :
              $title = $product->text->name;
              $desc = $product->text->desc;
              $awTrack = $product->uri->awTrack;
              $awImage = $product->uri->awImage;
              $mImage = $product->uri->mImage;
              $price = $product->price->buynow; ?>

              <article class="product">
                <?php if( $awTrack ) : ?>
                  <a href="<?php echo $awTrack; ?>" rel="nofollow" target="_blank">
                <?php endif; ?>
                  <?php if( $awImage ) : ?>
                    <img src="<?php echo $awImage; ?>" />
                  <?php endif; ?>
                  <?php if( $title ) : ?>
                    <div class="title-container">
                      <h3><?php echo $title; ?></h3>
                      <span>£<?php echo $price; ?></span>
                    </div>
                  <?php endif; ?>
                <?php if( $awTrack ) : ?>
                  </a>
                <?php endif; ?>
                <?php $i++;
                if($i == $numberOfProducts):
                  break;
                endif; ?>
              </article>
            <?php endforeach;
          endif;
        endforeach; ?>
      </section>
    <?php endif; ?>
  </div>
</section>
<?php get_footer(); ?>
