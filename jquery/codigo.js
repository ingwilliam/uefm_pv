$(document).ready(function()
{
    $('#slider').nivoSlider({
                controlNav:false
            });

    $('#subBannerHome').tinycarousel({ display: 1 });

    $( "form.niceform" ).submit(function(){
        retrunform = true;
        var validar = $( this ).find( ".validar" ).get();
        for( var i = 0 ; i < validar.length ; i++ )
        {
            if( $( validar[i] ).val() == "" )
            {
                $( validar[i] ).css( "border" , "2px solid red")
                retrunform = false;
            }
            else
            {
                if ($(validar[i]).hasClass("email"))
                {
                    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($(validar[i]).val()))
                    {
                        $( validar[i] ).css( "border" , "2px solid red");
                        retrunform = false;
                    }
                    else
                        $( validar[i] ).css( "border" , "")
                }
                else
                {
                    if ($(validar[i]).hasClass("alfanumerico"))
                    {
                        if (!/^[A-Za-z0-9 .]+$/i.test($(validar[i]).val()))
                        {
                            $( validar[i] ).css( "border" , "2px solid red");
                            retrunform = false;
                        }
                        else
                            $( validar[i] ).css( "border" , "")
                    }
                    else
                    {
                        if ($(validar[i]).hasClass("numerico"))
                        {
                            if (!/^(?:\+|-)?\d+$/.test($(validar[i]).val()))
                            {
                                $( validar[i] ).css( "border" , "2px solid red");
                                retrunform = false;
                            }
                            else
                                $( validar[i] ).css( "border" , "")
                        }
                        else
                            $( validar[i] ).css( "border" , "")
                    }
                }
            }
        }

        return retrunform;

    });

    $("a[rel='galeriaInterna']").colorbox();
    
    
    // We only want these styles applied when javascript is enabled
    $('div.navigation').css({'width' : '300px', 'float' : 'left'});
    $('div.content').css('display', 'block');

    // Initially set opacity on thumbs and add
    // additional styling for hover effect on thumbs
    var onMouseOutOpacity = 0.67;
    $('#thumbs ul.thumbs li').opacityrollover({
            mouseOutOpacity:   onMouseOutOpacity,
            mouseOverOpacity:  1.0,
            fadeSpeed:         'fast',
            exemptionSelector: '.selected'
    });

    // Initialize Advanced Galleriffic Gallery
    var gallery = $('#thumbs').galleriffic({
            delay:                     2500,
            numThumbs:                 21,
            preloadAhead:              10,
            enableBottomPager:         true,
            maxPagesToShow:            7,
            imageContainerSel:         '#slideshow',
            controlsContainerSel:      '#controls',
            captionContainerSel:       '#caption',
            loadingContainerSel:       '#loading',
            renderSSControls:          true,
            renderNavControls:         true,
            playLinkText:              '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
            pauseLinkText:             '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
            prevLinkText:              '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
            nextLinkText:              '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
            nextPageLinkText:          'Siguiente',
            prevPageLinkText:          'Anterior',
            enableHistory:             false,
            autoStart:                 false,
            syncTransitions:           true,
            defaultTransitionDuration: 900,
            onSlideChange:             function(prevIndex, nextIndex) {
                    // 'this' refers to the gallery, which is an extension of $('#thumbs')
                    this.find('ul.thumbs').children()
                            .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
                            .eq(nextIndex).fadeTo('fast', 1.0);
            },
            onPageTransitionOut:       function(callback) {
                    this.fadeTo('fast', 0.0, callback);
            },
            onPageTransitionIn:        function() {
                    this.fadeTo('fast', 1.0);
            }
    });   
});

