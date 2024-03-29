var magnified = 0;
jQuery(window).load(function()
{
    jQuery('.magnify').magnify();
    magnified = 1;
});

var magimgold = 0;
jQuery(document).ready(function()
{
    var magimg = jQuery('.magnify > img:first');
    if (magimg)
    {
        if (jQuery(magimg).prop('complete')) setTimeout(function() { jQuery(magimg).css('width', jQuery(magimg).outerWidth() + 'px'); }, 10); else jQuery(magimg).load(function() { jQuery('.magnify > img:first').css('width', jQuery('.magnify > img:first').outerWidth() + 'px'); });
    }
});

(function($)
{
    function format(str)
    {
        for (var i = 1; i < arguments.length; i++)
        {
            str = str.replace('%' + (i - 1), arguments[i]);
        }

        return str;
    }

    function magnify(jWin, opts)
    {
        var sImg = $('img', jWin);
        var img1;
        var img2;
        var $mouseTrap = null;
        var zoomDiv = null;
        var lens = null;
        var zoomImage;
        var controlTimer = 0;
        var zoomedTimer = 0;
        var filesLoaded = 0;
        var cw, ch;
        var mx, my;
        var destU = 0;
        var destV = 0;
        var currU = 0;
        var currV = 0;
        var ctx = this, zw;
        var zoomed = 0;

        var sImgOuterWidth = sImg.outerWidth();
        if ($.browser.mozilla) var sImgOuterHeight = Math.ceil(sImg[0].getBoundingClientRect().height); else var sImgOuterHeight = sImg.outerHeight();

        this.removeBits = function()
        {
            if (lens)
            {
                lens.remove();
                lens = null;
            }
        };

        this.destroy = function()
        {
            jWin.data('zoom', null);
            if ($mouseTrap)
            {
                $mouseTrap.unbind();
                $mouseTrap.remove();
                $mouseTrap = null;
            }
            if (zoomDiv)
            {
                zoomDiv.remove();
                zoomDiv = null;
            }
            this.removeBits();
        };

        this.fadedOut = function()
        {
            if (zoomDiv)
            {
                zoomDiv.remove();
                zoomDiv = null;
            }
            this.removeBits();
        };

        this.controlLoop = function()
        {
            if (lens)
            {
                var x = (mx - sImg.offset().left - (cw * 0.5)) >> 0;
                var y = (my - sImg.offset().top - (ch * 0.5)) >> 0;

                if (x < 0)
                {
                    x = 0;
                }
                else if (x > (sImgOuterWidth - cw))
                {
                    x = (sImgOuterWidth - cw);
                }
                if (y < 0)
                {
                    y = 0;
                }
                else if (y > (sImgOuterHeight - ch))
                {
                    y = (sImgOuterHeight - ch);
                }

                x = Math.round(x);
                y = Math.round(y);

                lens.css({ left: x, top: y });
                lens.css('background-position', (-x) + 'px ' + (-y) + 'px');

                destU = (((x) / sImgOuterWidth) * zoomImage.width) >> 0;
                destV = (((y) / sImgOuterHeight) * zoomImage.height) >> 0;
                currU += (destU - currU) / 3;
                currV += (destV - currV) / 3;

                currU = Math.round(currU);
                currV = Math.round(currV);

                zoomDiv.css('background-position', (-(currU >> 0) + 'px ') + (-(currV >> 0) + 'px'));
            }

            // 60 FPS
            controlTimer = setTimeout(function()
            {
                ctx.controlLoop();
            }, 16);
        };

        this.init2 = function(img, id)
        {
            filesLoaded++;
            if (id === 1) zoomImage = img;
            if (filesLoaded === 2) this.init();
        };

        this.init = function()
        {
            var sImgWidth = sImgOuterWidth;
            if (sImgWidth) $('#magnify-wrap').css('width', sImgWidth + 'px');

            if ($.browser.msie) var mtbg = 'url(\'/images/spacer.gif\')'; else var mtbg = 'none';
            $mouseTrap = jWin.parent().append(format('<div class="mousetrap" style="background-image: ' + mtbg + '; z-index: 99; position: absolute; width: %0px; height: %1px; left: %2px; top: %3px;"></div>', sImgOuterWidth, sImgOuterHeight, 0, 0)).find(':last');

            if (mobile() || tablet())
            {
                $mouseTrap.bind('touchmove', this, function(event)
                {
                    if (zoomed > 0)
                    {
                        event.preventDefault();
                    }
                    else
                    {
                        clearTimeout(controlTimer);
                        clearTimeout(zoomedTimer);
                        zoomed = 0;
                        $('#magnify-wrap').css('z-index', 1);
                        if (lens) lens.fadeOut(0);
                        zoomDiv.fadeOut(0, function()
                        {
                            ctx.fadedOut();
                        });
                    }

                    var touch = event.originalEvent.touches[0] || event.originalEvent.changedTouches[0];
                    mx = touch.pageX;
                    my = touch.pageY;
                });
            }
            else
            {
                $mouseTrap.bind('mousemove', this, function(event)
                {
                    mx = event.pageX;
                    my = event.pageY;
                });
            }

            var mouseleave = 'mouseleave';
            if (mobile() || tablet()) mouseleave = 'touchend';
            $mouseTrap.bind(mouseleave, this, function(event)
            {
                clearTimeout(controlTimer);
                clearTimeout(zoomedTimer);
                zoomed = 0;
                $('#magnify-wrap').css('z-index', 1);
                if (lens) lens.fadeOut(199);
                zoomDiv.fadeOut(200, function()
                {
                    ctx.fadedOut();
                });
            });

            var mouseenter = 'mouseenter';
            if (mobile() || tablet()) mouseenter = 'touchstart';
            $mouseTrap.bind(mouseenter, this, function(event)
            {
                zoomed = 0;
                if (mobile() || tablet())
                {
                    var touch = event.originalEvent.touches[0] || event.originalEvent.changedTouches[0];
                    mx = touch.pageX;
                    my = touch.pageY;
                }
                else
                {
                    mx = event.pageX;
                    my = event.pageY;
                }

                zw = event.data;

                if (zoomDiv)
                {
                    zoomDiv.stop(true, false);
                    zoomDiv.remove();
                }

                var siw = sImgOuterWidth;
                var sih = sImgOuterHeight;

                var w = opts.zoomWidth;
                var h = opts.zoomHeight;
                if (opts.zoomWidth == 'auto') w = siw;
                if (opts.zoomHeight == 'auto') h = sih;

                var xPos = opts.adjustX
                var yPos = opts.adjustY;

                var appendTo = jWin.parent();
                switch (opts.position)
                {
                    case 'top':
                        yPos -= h;
                        break;
                    case 'right':
                        xPos += siw;
                        break;
                    case 'bottom':
                        yPos += sih;
                        break;
                    case 'left':
                        xPos -= w;
                        break;
                    case 'inside':
                        w = siw;
                        h = sih;
                        break;
                    default:
                        appendTo = $('#' + opts.position);
                        if (!appendTo.length)
                        {
                            appendTo = jWin;
                            xPos += siw;
                            yPos += sih;
                        }
                        else
                        {
                            w = appendTo.innerWidth();
                            h = appendTo.innerHeight();
                        }
                }

                zoomDiv = appendTo.append(format('<div id="magnify-zoom" class="magnify-zoom" style="display: none; z-index: 98; position: absolute; left: %0px; top: %1px; width: %2px; height: %3px; background-image: url(\'%4\');"></div>', xPos, yPos, w, h, zoomImage.src)).find(':last');
                if (opts.position === 'inside') $('#magnify-zoom').css({ 'box-shadow': 'none', '-moz-box-shadow': 'none', '-webkit-box-shadow': 'none' });

                if (mobile() || tablet())
                {
                    zoomedTimer = setTimeout(function() { zoomed = 1; $('#magnify-wrap').css('z-index', 2); zoomDiv.fadeIn(200, function() { zoomed = 2; }); }, 200);
                }
                else
                {
                    $('#magnify-wrap').css('z-index', 2);
                    zoomDiv.fadeIn(400);
                }

                if (lens)
                {
                    lens.remove();
                    lens = null;
                }

                cw = (sImgOuterWidth / zoomImage.width) * zoomDiv.width();
                ch = (sImgOuterHeight / zoomImage.height) * zoomDiv.height();

                cw = Math.round(cw);
                ch = Math.round(ch);

                lens = jWin.append(format('<div class="magnify-lens" style="display: none; z-index: 97; position: absolute; width: %0px; height: %1px;"></div>', cw, ch)).find(':last');

                $mouseTrap.css('cursor', lens.css('cursor'));

                var noTrans = false;

                if (!noTrans) lens.css('opacity', 0.5);
                if (opts.position !== 'inside') lens.fadeIn(400);

                zw.controlLoop();
            });
        };

        img1 = new Image();
        $(img1).load(function()
        {
            ctx.init2(this, 0);
        });
        img1.src = sImg.attr('src');

        img2 = new Image();
        $(img2).load(function()
        {
            ctx.init2(this, 1);
        });
        img2.src = jWin.attr('href');
    }

    $.fn.magnify = function(options)
    {
        try { document.execCommand('BackgroundImageCache', false, true); } catch (e) {}

        this.each(function()
        {
            var opts;
            $(this).css({ 'position': 'relative', 'display': 'block' });
            $('img', $(this)).css({ 'display': 'block' });
            if ($(this).parent().attr('id') != 'magnify-wrap')
            {
                var mode = document.documentMode || 0;
                if ($.browser.msie && (($.browser.version < 8 && !mode) || mode < 8)) $('#product_images > div.p2').css({ 'position': 'relative', 'z-index': '1', 'zoom': '1' });
                var magimg = $(this).children('img:first');
                var magimgw = $(magimg).outerWidth();
                if ((magimgold) && ((magimgw < (magimgold + 10)) || (magimgw > (magimgold - 10)))) magimgw = magimgold;
                magimgold = magimgw;
                $(magimg).css('width', magimgw + 'px');
                $(this).wrap('<div id="magnify-wrap" style="z-index: 1; position: relative; width: ' + magimgw + 'px;"></div>');
                if (!mobile() || tablet()) $(this).parent('#magnify-wrap').bind('click', function() { $(this).find('a').click(); });
            }
            opts = $.extend({}, $.fn.magnify.defaults, options);
            $(this).data('zoom', new magnify($(this), opts));
        });

        return this;
    };

    if (mversion) $.fn.magnify.defaults = { zoomWidth: 'auto', zoomHeight: 'auto', adjustX: 0, adjustY: 0, position: 'inside' }; else $.fn.magnify.defaults = { zoomWidth: 'auto', zoomHeight: 'auto', adjustX: 0, adjustY: 0, position: 'inside' };
})(jQuery);