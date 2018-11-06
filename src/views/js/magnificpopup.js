
// Lighbox text
$('.popup-text').magnificPopup({
    removalDelay: 500,
    closeBtnInside: true,
    callbacks: {
        beforeOpen: function() {
            this.st.mainClass = this.st.el.attr('data-effect');
        }
    },
    midClick: true
});

// Lightbox iframe
$('.popup-iframe').magnificPopup({
    dispableOn: 700,
    type: 'iframe',
    removalDelay: 160,
    mainClass: 'mfp-fade',
    preloader: false
});


// Lighbox gallery
$('#popup-gallery').each(function() {
    $(this).magnificPopup({
        delegate: 'a.popup-gallery-image',
        type: 'image',
        gallery: {
            enabled: true
        }
    });
});

// Lighbox gallery
$('#popup-gallery').each(function() {
    $(this).magnificPopup({
        delegate: 'a.popup-gallery-image',
        type: 'image',
        gallery: {
            enabled: true
        }
    });
});

// Lighbox image
$('.popup-image').magnificPopup({
    type: 'image'
});

$('.popup-ajax').magnificPopup({
    removalDelay: 500,
    closeBtnInside: true,
    callbacks: {
        beforeOpen: function() {
            this.st.mainClass = this.st.el.attr('data-effect');
        },
        open: function(){
            var popup = this;
            var ajax_url = this.st.el.attr('data-src');
            var target = this.st.el.attr('href');
            if ( this.content.data( 'ajax_url' ) === ajax_url ){
                this.content.addClass( 'ajax-loaded' );
                return;
            }
            this.content.children( '.row, hr, a.btn-primary' ).remove();
            this.content.html( "<i class=\"fa fa-refresh fa-spin\"><\/i>" );
            $.get( ajax_url, {
                target:target
            }, function( response ){
                popup.content.children( '.fa' ).remove();
                //popup.content.prepend( response );
                popup.content.html( $.trim(response) );
                popup.content.data( 'ajax_url', ajax_url ).addClass( 'ajax-loaded' );
                
            });
        },
        close: function(){
            this.content.removeClass( 'ajax-loaded' );
        }
    },
    midClick: true
});
