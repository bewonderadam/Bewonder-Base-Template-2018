jQuery( document ).ready(function($) {
  // Display Menu on Smaller Screens
  $('a.menu-toggle').click( function(event) {
    event.preventDefault();
    $('nav#site-navigation').toggleClass( 'toggled' );
  });
  // Disable Links on Menu Items with children
  $('nav#site-navigation .menu-primary-menu-container ul#primary-menu li.menu-item-has-children > a').click( function(event) {
    event.preventDefault();
  });
  // Homepage Slider
  if($('body').hasClass('page-id-30')) {
    $('#homepage-slider').owlCarousel({
      items: 1,
      autoplay: true,
      loop: true,
      nav: true,
      smartSpeed: 1500,
    });
  }
  // Offer, Stores Background Image colours - *IMPORTANT* update the imgColours in stores-ajax.js also.
  var imgColours = ['#ccc','#ddd','#eee'];
  var $imgs = $('section#page-container .page-container-inner .related-information .related-offers, .single-stores .store-information, section#page-container .page-container-inner .related-information .related-stores, .single-offers, .single-jobs').find('article a, img.attachment-post-thumbnail, article a img, .store-logo'),
  imgsCount = $imgs.length,
  coloursCount = imgColours.length;
  for (var i=0; i < imgsCount; i++) {
    var rnd = Math.floor(Math.random() * coloursCount),
    color = imgColours[rnd];
    $imgs.eq(i).css({backgroundColor: color});
  }
  // Your Visit selectors
  if($('body').hasClass('page-id-141')) {
    $('.page-id-141 section#page-container .page-container-inner .your-visit-content-container article:first-child').addClass( 'active' );
    $('.page-id-141 section#page-container .page-container-inner .your-visit-options-container .your-visit-options-navigation a:first-child').addClass( 'active' );
    // Mobile
    $('.page-id-141 section#page-container .page-container-inner .your-visit-options-container select.your-visit-options').on( 'change', function(event) {
      $('.page-id-141 section#page-container .page-container-inner .your-visit-content-container article').removeClass( 'active' );
      $('.page-id-141 section#page-container .page-container-inner .your-visit-content-container article#' + $(this).val() ).addClass( 'active' );
    });
    // Desktop
    $('.page-id-141 section#page-container .page-container-inner .your-visit-options-container .your-visit-options-navigation a').click( function(event) {
      event.preventDefault();
      $('.page-id-141 section#page-container .page-container-inner .your-visit-options-container .your-visit-options-navigation a').removeClass( 'active' );
      $('.page-id-141 section#page-container .page-container-inner .your-visit-content-container article' ).removeClass( 'active' );
      $(this).addClass( 'active' );
      $('.page-id-141 section#page-container .page-container-inner .your-visit-content-container article#' + $(this).attr( 'id' ) ).addClass( 'active' );
    });
    // URL Navigation
    if( window.location.hash ) {
      var hash = window.location.hash;
      $('.page-id-141 section#page-container .page-container-inner .your-visit-options-container .your-visit-options-navigation a').removeClass( 'active' );
      $('.page-id-141 section#page-container .page-container-inner .your-visit-options-container .your-visit-options-navigation a' + hash ).addClass( 'active' );
      $('.page-id-141 section#page-container .page-container-inner .your-visit-content-container article').removeClass( 'active' );
      $('.page-id-141 section#page-container .page-container-inner .your-visit-content-container article' + hash ).addClass( 'active' );

    }
  }
});
