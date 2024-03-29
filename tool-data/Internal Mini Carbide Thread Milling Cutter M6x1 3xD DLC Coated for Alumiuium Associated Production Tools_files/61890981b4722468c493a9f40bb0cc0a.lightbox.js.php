jQuery(document).ready(function()
{
    jQuery('a[rel^=lightbox], button.quickview').lightBox();
});

(function($)
{
    $.fn.lightBox = function(settings)
    {
        // Configuration
        settings = jQuery.extend({
            // Theme
            theme:                '',
            // Overlay
            overlayBgColor:       '#000000',
            overlayOpacity:       0.8,
            // Navigation
            fixedNavigation:      false,
            // Images
            imageLoading:         '/images/lightbox_loading.gif',
            imageBtnPrev:         '/images/lightbox_prevlabel.gif',
            imageBtnNext:         '/images/lightbox_nextlabel.gif',
            imageBtnClose:        '/images/lightbox_closelabel.gif',
            imageBlank:           '/images/lightbox_blank.gif',
            // Image container
            containerBorderSize:  10,
            containerResizeSpeed: 400,
            // Info text
            txtImage:             'Image',
            txtOf:                'of',
            // Keyboard navigation
            keyToClose:           'c',
            keyToPrev:            'p',
            keyToNext:            'n',
            // Don't change
            imageArray:           [],
            activeImage:          0
        }, settings);
        // Cache jQuery object with all elements matched
        var jQueryMatchedObj = this;
        function _initialize()
        {
            _start(this, jQueryMatchedObj);
            return false;
        }
        function _start(objClicked, jQueryMatchedObj)
        {
            // Hide elements
            // $('embed, object, select').css({ 'visibility': 'hidden' });
            $('.ui-dialog').remove();
            // Set theme
            if ((objClicked.getAttribute('href').indexOf('youtube') == -1) && (objClicked.getAttribute('href').indexOf('vimeo') == -1))
            {
                settings.theme = '';
                settings.imageLoading = '/images/lightbox_loading.gif';
                settings.imageBtnPrev = '/images/lightbox_prevlabel.gif';
                settings.imageBtnNext = '/images/lightbox_nextlabel.gif';
                settings.imageBtnClose = '/images/lightbox_closelabel.gif';
            }
            else
            {
                settings.theme = '-dark';
                settings.imageLoading = '/images/lightbox_blank.gif';
                settings.imageBtnPrev = '/images/lightbox_prevlabel_dark.gif';
                settings.imageBtnNext = '/images/lightbox_nextlabel_dark.gif';
                settings.imageBtnClose = '/images/lightbox_closelabel_dark.gif';
            }
            // Create structure
            _set_interface();
            // Unset image info
            settings.imageArray.length = 0;
            settings.activeImage = 0;
            // Remove duplicate images
            if (jQueryMatchedObj.length > 1)
            {
                var duplicates = new Array();
                for (var i = jQueryMatchedObj.length - 1; i > -1; i--)
                {
                    if ($.inArray(jQueryMatchedObj[i].getAttribute('href').replace(window.location.protocol + '//' + window.location.hostname, ''), duplicates) == -1)
                        duplicates.push(jQueryMatchedObj[i].getAttribute('href').replace(window.location.protocol + '//' + window.location.hostname, ''));
                    else
                        jQueryMatchedObj.splice(i, 1);
                }
            }
            var thishref = objClicked.getAttribute('href').replace(window.location.protocol + '//' + window.location.hostname, '');
            var mode = document.documentMode || 0;
            if ($.browser.msie && (($.browser.version < 8 && !mode) || mode < 8)) thishref = thishref.replace('%20', ' ');
            if ((typeof zoom3 != 'undefined') && ($.inArray(thishref, zoom3) != -1))
            {
                // Additional images
                for (var i = 0; i < zoom3.length; i++)
                {
                    if ($.browser.msie && (($.browser.version < 8 && !mode) || mode < 8)) thishref = zoom3[i].replace(' ', '%20'); else thishref = zoom3[i];
                    if (thishref) settings.imageArray.push(new Array(thishref, objClicked.getAttribute('title')));
                }
            }
            else if ((jQueryMatchedObj.length == 1) || (objClicked.getAttribute('rel') == "lightbox"))
            {
                // Single image
                thishref = objClicked.getAttribute('href').replace(window.location.protocol + '//' + window.location.hostname, '');
                if (objClicked.tagName == 'BUTTON')
                {
                    if (thishref.indexOf('?') == -1) thishref += '?quickview=1'; else thishref += '&quickview=1';
                }
                if ($.browser.msie && (($.browser.version < 8 && !mode) || mode < 8)) thishref = thishref.replace('%20', ' ');
                settings.imageArray.push(new Array(thishref, objClicked.getAttribute('title')));
            }
            else
            {
                // Image set
                for (var i = 0; i < jQueryMatchedObj.length; i++)
                {
                    thishref = jQueryMatchedObj[i].getAttribute('href').replace(window.location.protocol + '//' + window.location.hostname, '');
                    if (objClicked.tagName == 'BUTTON')
                    {
                        if (thishref.indexOf('?') == -1) thishref += '?quickview=1'; else thishref += '&quickview=1';
                    }
                    if ($.browser.msie && (($.browser.version < 8 && !mode) || mode < 8)) thishref = thishref.replace('%20', ' ');
                    settings.imageArray.push(new Array(thishref, jQueryMatchedObj[i].getAttribute('title')));
                }
            }
            thishref = objClicked.getAttribute('href').replace(window.location.protocol + '//' + window.location.hostname, '');
            if (objClicked.tagName == 'BUTTON')
            {
                if (thishref.indexOf('?') == -1) thishref += '?quickview=1'; else thishref += '&quickview=1';
            }
            if ($.browser.msie && (($.browser.version < 8 && !mode) || mode < 8)) thishref = thishref.replace('%20', ' ');
            while (settings.imageArray[settings.activeImage][0] != thishref)
            {
                settings.activeImage++;
            }
            // Prepare image
            _set_image_to_view();
        }
        function _set_interface()
        {
            // Add HTML
            $('body').append('<div id="jquery-overlay"></div><div id="jquery-lightbox"><div id="lightbox-container-image-box' + settings.theme + '"><div id="lightbox-container-image"><img id="lightbox-image"><div style="" id="lightbox-nav"><a href="#" id="lightbox-nav-btnPrev"></a><a href="#" id="lightbox-nav-btnNext"></a></div><div id="lightbox-loading"><a href="#" id="lightbox-loading-link"><img src="' + settings.imageLoading + '"></a></div></div></div><div id="lightbox-container-image-data-box' + settings.theme + '"><div id="lightbox-container-image-data"><div id="lightbox-image-details"><span id="lightbox-image-details-caption"></span><span id="lightbox-image-details-currentNumber"></span></div><div id="lightbox-secNav"><a href="#" id="lightbox-secNav-btnClose"><img src="' + settings.imageBtnClose + '"></a></div></div></div></div>');
            // Get page sizes
            var arrPageSizes = calcPageSize();
            // Style overlay and display
            $('#jquery-overlay').css({
                backgroundColor: settings.overlayBgColor,
                opacity:         settings.overlayOpacity,
                width:           arrPageSizes[0],
                height:          arrPageSizes[1],
                minWidth:        '100%',
                minHeight:       '100%',
                display:         'none'
            }).fadeIn('fast');
            // Get page scroll
            var arrPageScroll = calcPageScroll();
            // Calculate top and left offset for jquery-lightbox and display
            var top = arrPageSizes[3] / 10;
            if (top > 100) top = 100;
            $('#jquery-lightbox').css({
                top:  arrPageScroll[1] + top,
                left: arrPageScroll[0]
            }).show();
            // Assign click events to elements to close
            $('#jquery-overlay, #jquery-lightbox').click(function()
            {
                _finish();
            });
            // Assign _finish function to lightbox-loading-link and lightbox-secNav-btnClose
            $('#lightbox-loading-link, #lightbox-secNav-btnClose').click(function()
            {
                _finish();
                return false;
            });
            // If window was resized, calculate new overlay dimensions
            $(window).resize(function()
            {
                // Get page sizes
                var arrPageSizes = calcPageSize();
                // Style overlay and display
                $('#jquery-overlay').css({
                    width:     arrPageSizes[0],
                    height:    arrPageSizes[1],
                    minWidth:  '100%',
                    minHeight: '100%'
                });
                // Get page scroll
                var arrPageScroll = calcPageScroll();
                // Calculate top and left offset for jquery-lightbox and display
                var top = arrPageSizes[3] / 10;
                if (top > 100) top = 100;
                $('#jquery-lightbox').css({
                    top:  arrPageScroll[1] + top,
                    left: arrPageScroll[0]
                });
            });
        }
        function _set_image_to_view()
        {
            $('#lightbox-loading').show();
            if (settings.fixedNavigation)
            {
                $('#lightbox-image, #lightbox-container-image-data-box' + settings.theme + ', #lightbox-image-details-currentNumber').hide();
            }
            else
            {
                $('#lightbox-image, #lightbox-nav, #lightbox-nav-btnPrev, #lightbox-nav-btnNext, #lightbox-container-image-data-box' + settings.theme + ', #lightbox-image-details-currentNumber').hide();
            }
            if ((settings.imageArray[settings.activeImage][0].indexOf('youtube') == -1) && (settings.imageArray[settings.activeImage][0].indexOf('vimeo') == -1) && (settings.imageArray[settings.activeImage][0].indexOf('quickview') == -1))
            {
                // Preload image
                var objImagePreloader = new Image();
                objImagePreloader.onload = function()
                {
                    $('#lightbox-image').attr('src', settings.imageArray[settings.activeImage][0]);
                    _resize_container_image_box(objImagePreloader.width, objImagePreloader.height);
                    objImagePreloader.onload=function(){};
                };
                objImagePreloader.src = settings.imageArray[settings.activeImage][0];
            }
            else if ((settings.imageArray[settings.activeImage][0].indexOf('youtube') == -1) && (settings.imageArray[settings.activeImage][0].indexOf('vimeo') == -1))
            {
                // Display page
                $('#lightbox-image').replaceWith('<div id="lightbox-image" style="width: 900px; height: 600px; display: none;"><iframe id="qvplayer" type="text/html" width="900" height="600" src="' + settings.imageArray[settings.activeImage][0] + '" frameborder="0"></div>');
                $('#lightbox-nav').hide();
                _resize_container_image_box(900, 600);
            }
            else
            {
                // Display video
                $('#lightbox-image').replaceWith('<div id="lightbox-image" style="width: 854px; height: 480px; display: none;"><iframe id="ytplayer" type="text/html" width="854" height="480" src="' + settings.imageArray[settings.activeImage][0] + '?autoplay=1&modestbranding=1&origin=' + window.location.protocol + '//' + window.location.hostname + '&rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></div>');
                $('#lightbox-nav').hide();
                _resize_container_image_box(854, 480);
            }
        };
        function _resize_container_image_box(intImageWidth, intImageHeight)
        {
            // Adjust image size
            var arrPageSizes = calcPageSize();
            var top = arrPageSizes[3] / 10;
            if (top > 100) top = 100;
            if (intImageWidth < 180) intImageWidth = 180;
            var oldImageHeight = intImageHeight;
            var dataBoxHeight = 32;
            if (settings.imageArray.length > 1) dataBoxHeight = 46;
            var maxImageHeight = (arrPageSizes[1] - parseInt($('#jquery-lightbox').css('top'))) - top - (settings.containerBorderSize * 2) - dataBoxHeight;
            if (oldImageHeight > maxImageHeight)
            {
                intImageHeight = maxImageHeight;
                intImageWidth = intImageWidth * (intImageHeight / oldImageHeight);
                intImageWidth = Math.round(intImageWidth);
                $('#lightbox-image').css({ width: intImageWidth, height: intImageHeight });
            }
            else
            {
                $('#lightbox-image').css({ width: 'auto', height: 'auto' });
            }
            // Get current width and height
            var intCurrentWidth = $('#lightbox-container-image-box' + settings.theme).width();
            var intCurrentHeight = $('#lightbox-container-image-box' + settings.theme).height();
            // Get the width and height of selected image plus padding
            var intWidth = (intImageWidth + (settings.containerBorderSize * 2));
            var intHeight = (intImageHeight + (settings.containerBorderSize * 2));
            // Calculate differences
            var intDiffW = intCurrentWidth - intWidth;
            var intDiffH = intCurrentHeight - intHeight;
            // Create effect
            var resizeSpeed = settings.containerResizeSpeed;
            if (settings.imageArray[settings.activeImage][0].indexOf('quickview') != -1) resizeSpeed = 0;
            $('#lightbox-container-image-box' + settings.theme).animate({ width: intWidth, height: intHeight }, resizeSpeed, function() { _show_image(); });
            if ((intDiffW == 0) && (intDiffH == 0))
            {
                if ($.browser.msie)
                {
                    ___pause(250);
                }
                else
                {
                    ___pause(100);
                }
            }
            $('#lightbox-container-image-data-box' + settings.theme).css({ width: intImageWidth + (settings.containerBorderSize * 2) });
            $('#lightbox-nav-btnPrev, #lightbox-nav-btnNext').css({ height: intImageHeight + (settings.containerBorderSize * 2) });
        };
        function _show_image()
        {
            $('#lightbox-loading').hide();
            var resizeSpeed = 600;
            if (settings.imageArray[settings.activeImage][0].indexOf('quickview') != -1) resizeSpeed = 0;
            $('#lightbox-image').fadeIn(resizeSpeed, function()
            {
                _show_image_data();
                if ((settings.imageArray[settings.activeImage][0].indexOf('youtube') == -1) && (settings.imageArray[settings.activeImage][0].indexOf('vimeo') == -1) && (settings.imageArray[settings.activeImage][0].indexOf('quickview') == -1)) _set_navigation();
            });
            _preload_neighbor_images();
        };
        function _show_image_data()
        {
            $('#lightbox-image-details-caption').hide();
            if (settings.imageArray[settings.activeImage][1])
            {
                $('#lightbox-image-details-caption').html(settings.imageArray[settings.activeImage][1]).show();
            }
            // Image set?
            if ((settings.imageArray.length > 1) && (settings.imageArray[settings.activeImage][0].indexOf('youtube') == -1) && (settings.imageArray[settings.activeImage][0].indexOf('vimeo') == -1) && (settings.imageArray[settings.activeImage][0].indexOf('quickview') == -1))
            {
                $('#lightbox-image-details-currentNumber').html(settings.txtImage + ' ' + (settings.activeImage + 1) + ' ' + settings.txtOf + ' ' + settings.imageArray.length).show();
            }
            $('#lightbox-container-image-box' + settings.theme).css({ 'border-bottom-left-radius': '0px' , 'border-bottom-right-radius': '0px' });
            var resizeSpeed = 400;
            if (settings.imageArray[settings.activeImage][0].indexOf('quickview') != -1) resizeSpeed = 0;
            $('#lightbox-container-image-data-box' + settings.theme).slideDown(resizeSpeed);
        }
        function _set_navigation()
        {
            $('#lightbox-nav').show();
            $('#lightbox-nav-btnPrev, #lightbox-nav-btnNext').css({ 'background': 'transparent url(' + settings.imageBlank + ') no-repeat' });
            if (settings.activeImage != 0)
            {
                if (settings.fixedNavigation)
                {
                    $('#lightbox-nav-btnPrev').css({ 'background': 'url(' + settings.imageBtnPrev + ') left 15% no-repeat' })
                        .unbind()
                        .bind('click', function()
                        {
                            settings.activeImage = settings.activeImage - 1;
                            _set_image_to_view();
                            return false;
                        });
                }
                else
                {
                    $('#lightbox-nav-btnPrev').unbind().hover(function()
                    {
                        $(this).css({ 'background': 'url(' + settings.imageBtnPrev + ') left 15% no-repeat' });
                    }, function()
                    {
                        $(this).css({ 'background': 'transparent url(' + settings.imageBlank + ') no-repeat' });
                    }).show().bind('click', function()
                    {
                        settings.activeImage = settings.activeImage - 1;
                        _set_image_to_view();
                        return false;
                    });
                }
            }
            if (settings.activeImage != (settings.imageArray.length - 1))
            {
                if (settings.fixedNavigation)
                {
                    $('#lightbox-nav-btnNext').css({ 'background': 'url(' + settings.imageBtnNext + ') right 15% no-repeat' })
                        .unbind()
                        .bind('click', function()
                        {
                            settings.activeImage = settings.activeImage + 1;
                            _set_image_to_view();
                            return false;
                        });
                }
                else
                {
                    $('#lightbox-nav-btnNext').unbind().hover(function()
                    {
                        $(this).css({ 'background': 'url(' + settings.imageBtnNext + ') right 15% no-repeat' });
                    }, function()
                    {
                        $(this).css({ 'background': 'transparent url(' + settings.imageBlank + ') no-repeat' });
                    }).show().bind('click', function()
                    {
                        settings.activeImage = settings.activeImage + 1;
                        _set_image_to_view();
                        return false;
                    });
                }
            }
            _enable_keyboard_navigation();
        }
        function _enable_keyboard_navigation()
        {
            $(document).keydown(function(objEvent)
            {
                _keyboard_action(objEvent);
            });
        }
        function _disable_keyboard_navigation()
        {
            $(document).unbind();
        }
        function _keyboard_action(objEvent)
        {
            keycode = objEvent.keyCode;
            escapeKey = objEvent.DOM_VK_ESCAPE || 27;
            key = String.fromCharCode(keycode).toLowerCase();
            if ((key == settings.keyToClose) || (key == 'x') || (keycode == escapeKey))
            {
                _finish();
            }
            if ((key == settings.keyToPrev) || (keycode == 37))
            {
                if (settings.activeImage != 0)
                {
                    settings.activeImage = settings.activeImage - 1;
                    _set_image_to_view();
                    _disable_keyboard_navigation();
                }
            }
            if ((key == settings.keyToNext) || (keycode == 39))
            {
                if (settings.activeImage != (settings.imageArray.length - 1))
                {
                    settings.activeImage = settings.activeImage + 1;
                    _set_image_to_view();
                    _disable_keyboard_navigation();
                }
            }
        }
        function _preload_neighbor_images()
        {
            if ((settings.imageArray.length - 1) > settings.activeImage)
            {
                objNext = new Image();
                objNext.src = settings.imageArray[settings.activeImage + 1][0];
            }
            if (settings.activeImage > 0)
            {
                objPrev = new Image();
                objPrev.src = settings.imageArray[settings.activeImage - 1][0];
            }
        }
        function _finish()
        {
            $('#lightbox-image').hide();
            $('#jquery-lightbox').remove();
            $('#jquery-overlay').fadeOut('', function() { $('#jquery-overlay').remove(); });
            // $('embed, object, select').css({ 'visibility': 'visible' });
        }
        function ___pause(ms)
        {
            var date = new Date();
            curDate = null;
            do { var curDate = new Date(); }
            while (curDate - date < ms);
        };
        return this.unbind('click').click(_initialize);
    };
})(jQuery);