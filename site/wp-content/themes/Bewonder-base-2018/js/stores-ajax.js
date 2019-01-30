jQuery(document).ready( function($) {
	if( $('body').hasClass( 'post-type-archive' ) || $('body').hasClass( 'tax-store_categories' ) ) {
		// Stores Pagination
		var ppp = -1; // Post per page
		var pageNumber = 1;
		var postType = 'stores';
	}

	if( $('body').hasClass( 'post-type-archive-stores' ) || $('body').hasClass( 'tax-store_categories' ) ) {
		// Stores search
		function storesSearch(t) {
	    // do the ajax request for stores search
	    $.ajax({
	      type: 'post',
				url: storesAjax.ajaxurl, // the localized name of your file
				data: {
	  	    action: 'stores_search', // the wp_ajax_ hook name
	        search: t,
					ppp: ppp
			  },
	      success: function( result ) {
	  	    // if the ajax call returns no results
					if( result === 'error' ) {
	  		    // set the html of the element with the class to no results
						$( 'section#page-container .page-container-inner' ).html( 'No stores match this criteria.' );
			    } else {
	  		    // we have results to display
				    // populate the results markup in the element with the class of ajax-results
				    $( 'section#page-container .page-container-inner' ).html( result );
			    }
		    }
	    });
	  }
	  var thread = null;
		// when the keyboard press is relased in the input with the class ajax-search
		$('section#store-filters-container .store-filters-inner .store-search input').keyup(function() {
	    // clear our timeout variable - to start the timer again
			clearTimeout(thread);
	    // set a variable to reference our current element ajax-search
			var $this = $(this);
	    // set a timeout to wait for a second before running the dosearch function
			thread = setTimeout( function() {
	  		storesSearch($this.val())
		  }, 1000 );
	  });

		function filterStores(t) {
	    // do the ajax request for filtering stores search
	    $.ajax({
	      type: 'post',
				url: storesAjax.ajaxurl, // the localized name of your file
				data: {
	  	    action: 'filter_stores', // the wp_ajax_ hook name
					taxonomy: t,
					ppp: ppp
			  },
	      success: function( result ) {
	  	    $( 'section#page-container .page-container-inner' ).html( result );
		    },
	    });
		}
		$('section#store-filters-container .store-filters-inner .category-filter select').on('change', function() {
		  filterStores( $(this).val() );
		})
	}

})
