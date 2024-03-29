// Config

var aconsole = 0;
var mversion = 0;
var abcurve = 1;
var autocomp = 1;
var aclaid = 2;
var acusid = 3280;
var addajax = 1;
var ga4 = 1;

// Action

function doAction(page, action, extra)
{
    var split = extra.split('|');
    extra = split[0];
    var qty = split[1];
    if (!qty) qty = 1;
    if (page.indexOf('/') < 0)
    {
        page = page.replace(/ /g, '/');
        if (page.charAt(0) != '/') page = '/' + page;
        extra = extra.replace(/ /g, '/');
        if ((extra.charAt(extra.length - 1) != '/') && (extra.indexOf('?') < 0) && (extra.indexOf('#') < 0)) extra += '/';
        if (action != 'page') var actionurl = page + '/action/' + action + '/' + extra; else var actionurl = page + '/page/' + extra + '/';
        actionurl = actionurl.replace(/\/\//g, '/');
    }
    else
    {
        actionurl = page + extra;
    }
    if (((typeof addajax != 'undefined') && (action == 'add')) || (action == 'mod'))
    {
        doBasket(actionurl, 'addajax=' + qty);
    }
    else if (action == 'view')
    {
        doBasket(actionurl, 'addajax=v');
    }
    else
    {
        window.location.href = actionurl;
    }
}

function doBasket(actionurl, data)
{
    jQuery.post(actionurl, data, function(response)
    {
        if (response.substr(0, 4) != 'http')
        {
            var responses = response.split(/\-\=\-\=\-/);
            for (var i = 0; i < responses.length; i++)
            {
                if (responses[i] == '!') responses[i] = '';
            }
            if ((responses[0]) && (responses[1]) && (actionurl.indexOf('silent=1') < 0))
            {
                jQuery('#dialog-basket').html(responses[0]);
                eval(responses[1]);
            }
            else if (jQuery('#dialog-basket').dialog('isOpen'))
            {
                jQuery('#dialog-basket').dialog('close');
            }
            if (jQuery('.block_added').length || jQuery('.block_basket').length || jQuery('.block_viewed').length || jQuery('.block_welcome').length)
            {
                jQuery('.block_added').html(responses[2]);
                if (responses[2]) jQuery('.block_added').removeClass('hideblock').show(); else jQuery('.block_added').addClass('hideblock').hide();
                jQuery('.block_basket').html(responses[3]);
                if (responses[3]) jQuery('.block_basket').removeClass('hideblock').show(); else jQuery('.block_basket').addClass('hideblock').hide();
                jQuery('.block_viewed').html(responses[4]);
                if (responses[4]) jQuery('.block_viewed').removeClass('hideblock').show(); else jQuery('.block_viewed').addClass('hideblock').hide();
                jQuery('.block_welcome').html(responses[5]);
                if (responses[5]) jQuery('.block_welcome').removeClass('hideblock').show(); else jQuery('.block_welcome').addClass('hideblock').hide();
                jQuery('.cb_divider:not(.norem), .lb_divider:not(.norem), .rb_divider:not(.norem)').remove();
                jQuery('#center div.isblock:not(:last):not(.hideblock)').append('<div class="cb_divider"></div>');
                jQuery('#left div.isblock:not(:last):not(.hideblock)').append('<div class="lb_divider"></div>');
                jQuery('#right div.isblock:not(:last):not(.hideblock)').append('<div class="rb_divider"></div>');
            }
            jQuery('.basket_totalitems').html(responses[6]);
            jQuery('.basket_viewitems').html(responses[7]);
            jQuery('.basket_items').html(responses[8]);
            if (responses[8] != '0') jQuery('.icon_items').html(responses[8]); else jQuery('.icon_items').html('');
            jQuery('.basket_total').html(responses[9]);
            jQuery('.basket_totalex').html(responses[10]);
            jQuery('.basket_subtotal').html(responses[11]);
            jQuery('.basket_subtotalex').html(responses[12]);
            if (typeof hookBasket == 'function') hookBasket();
            if (responses[13]) jQuery('#basket_page').html(responses[13]);
            if (responses[14]) alertDialog('dialog-alert', 0.4, responses[14]);
            if (responses[15]) jQuery('#delivery').replaceWith(responses[15]);
            if (jQuery('#delivery_date').length)
            {
                if (responses[16])
                {
                    jQuery('#delivery_date').html(responses[16]);
                    jQuery('.s_date').show();
                    eval(responses[17]);
                }
                else
                {
                    jQuery('#delivery_date').html('');
                    jQuery('.s_date').hide();
                }
            }
            if (responses[18]) alertDialog('dialog-alert', 0.4, responses[18]);
            if (responses[19] == '1')
            {
                jQuery('.s_message').show();
                if (responses[20]) jQuery('.s_message_i').show(); else jQuery('.s_message_i').hide();
                jQuery('.s_message_i .subtext').html('<i>' + responses[20] + '</i>');
                maxlength = parseInt(responses[21]);
                var messagetext = jQuery('.s_message textarea').val();
                if ((maxlength) && (messagetext.length > maxlength)) jQuery('.s_message textarea').val(messagetext.substring(0, maxlength));
                jQuery('#message_disabled').val(0);
            }
            else
            {
                jQuery('.s_message, .s_message_i').hide();
                jQuery('#message_disabled').val(1);
            }
            if (responses[35])
            {
                jQuery('.s_duties').show();
                jQuery('#s_duties').html(responses[35]);
                jQuery('#s_duties_c').html(responses[36]);
            }
            else
            {
                jQuery('.s_duties').hide();
            }
            if ((responses[22] == '1') && (responses[26]) && (typeof gtag != 'undefined'))
            {
                if (typeof ga4 != 'undefined')
                {
                    gtag('event', 'add_to_cart',
                    {
                        'value': responses[28] * responses[27],
                        'currency': responses[30],
                        'items':
                        [{
                            'item_id': responses[26],
                            'item_name': responses[29],
                            'item_variant': responses[31],
                            'item_brand': responses[32],
                            'quantity': responses[27],
                            'price': responses[28]
                        }]
                    });
                }
                else
                {
                    gtag('event', 'add_to_cart',
                    {
                        'items':
                        [{
                            'id': responses[26],
                            'name': responses[29],
                            'variant': responses[31],
                            'brand': responses[32],
                            'quantity': responses[27],
                            'price': responses[28]
                        }]
                    });
                }
            }
            if ((responses[23] == '1') && (responses[26]) && (typeof fbq != 'undefined'))
            {
                fbq('track', 'AddToCart',
                {
                    'value': responses[28],
                    'currency': responses[30],
                    'content_name': responses[29],
                    'content_type': 'product',
                    'contents':
                    [{
                        'id': responses[26],
                        'quantity': responses[27]
                    }]
                });
            }
            if ((responses[24] == '1') && (responses[26]) && (typeof pintrk != 'undefined'))
            {
                pintrk('track', 'addtocart',
                {
                    'value': responses[28],
                    'order_quantity': responses[27],
                    'currency': responses[30],
                    'line_items':
                    [{
                        'product_id': responses[26],
                        'product_name': responses[29],
                        'product_quantity': responses[27],
                        'product_price': responses[28]
                    }]
                });
            }
            if ((responses[25] == '1') && (responses[26]) && (typeof _learnq != 'undefined'))
            {
                klaviyo.push(['track', 'Added to Cart',
                {
                    '$value': responses[28] * responses[27],
                    'AddedItemPrice': responses[28],
                    'AddedItemQuantity': responses[27],
                    'AddedItemProductName': responses[29],
                    'AddedItemSKU': responses[26],
                    'Items':
                    [{
                        'SKU': responses[26],
                        'ProductName': responses[29],
                        'Quantity': responses[27],
                        'ItemPrice': responses[28],
                        'RowTotal': responses[28] * responses[27]
                    }]
                }]);
            }
            if ((responses[33]) && (actionurl.indexOf('delivery=') < 0))
            {
                jQuery('.addressdef, .addresslist').remove();
                jQuery('#pre_address').after(responses[33]);
                if (!responses[34]) selectdelivery();
            }
            if ((responses[34]) && (actionurl.indexOf('delivery=') < 0))
            {
                jQuery('.addressdef_shipping, .addresslist_shipping').remove();
                jQuery('#pre_address_shipping').after(responses[34]);
                selectdelivery();
            }
            redraw(1);
            if (data.indexOf('quickview=1') >= 0)
            {
                window.parent.doBasket(window.parent.location.href, 'addajax=v');
                jQuery('#lightbox-image, #jquery-lightbox', window.parent.document).hide();
                jQuery('#jquery-overlay', window.parent.document).fadeOut('', function() { jQuery('#jquery-overlay', window.parent.document).remove(); jQuery('#jquery-lightbox', window.parent.document).remove(); });
            }
            if (typeof easyedit != 'undefined')
            {
                if (easyedit == 1) bindings();
            }
        }
        else
        {
            window.location.href = response;
        }
    });
}


// Calculation

function calcPageSize()
{
    var xScroll, yScroll;
    var mode = document.documentMode || 0;
    if (jQuery.browser.msie && ((jQuery.browser.version < 8 && !mode) || mode < 8))
    {
        xScroll = document.body.scrollWidth;
        yScroll = document.body.scrollHeight;
    }
    else if (window.innerHeight && window.scrollMaxY)
    {
        xScroll = window.innerWidth + window.scrollMaxX;
        yScroll = window.innerHeight + window.scrollMaxY;
    }
    else if (document.body.scrollHeight > document.body.offsetHeight)
    {
        xScroll = document.body.scrollWidth;
        yScroll = document.body.scrollHeight;
    }
    else
    {
        xScroll = document.body.offsetWidth;
        yScroll = document.body.offsetHeight;
    }
    var windowWidth, windowHeight;
    if (self.innerHeight)
    {
        if (document.documentElement.clientWidth)
        {
            windowWidth = document.documentElement.clientWidth;
        }
        else
        {
            windowWidth = self.innerWidth;
        }
        windowHeight = self.innerHeight;
    }
    else if (document.documentElement && document.documentElement.clientHeight)
    {
        windowWidth = document.documentElement.clientWidth;
        windowHeight = document.documentElement.clientHeight;
    }
    else if (document.body)
    {
        windowWidth = document.body.clientWidth;
        windowHeight = document.body.clientHeight;
    }
    if (yScroll < windowHeight)
    {
        pageHeight = windowHeight;
    }
    else
    {
        pageHeight = yScroll;
    }
    if (xScroll < windowWidth)
    {
        pageWidth = xScroll;
    }
    else
    {
        pageWidth = windowWidth;
    }
    arrayPageSize = new Array(pageWidth, pageHeight, windowWidth, windowHeight);
    return arrayPageSize;
}

function calcPageScroll()
{
    var xScroll, yScroll;
    if (self.pageYOffset)
    {
        yScroll = self.pageYOffset;
        xScroll = self.pageXOffset;
    }
    else if (document.documentElement && document.documentElement.scrollTop)
    {
        yScroll = document.documentElement.scrollTop;
        xScroll = document.documentElement.scrollLeft;
    }
    else if (document.body)
    {
        yScroll = document.body.scrollTop;
        xScroll = document.body.scrollLeft;
    }
    arrayPageScroll = new Array(xScroll, yScroll);
    return arrayPageScroll;
};


// Caps Lock

var warningGiven = 0;
if (mobile() || tablet()) warningGiven = 1;

function capsLock(e)
{
    if (!e) e = window.event;
    if (!e) return;
    if (warningGiven == 1) return;
    var theKey = 0;
    if (e.which)
    {
        theKey = e.which;
    }
    else if (e.keyCode)
    {
        theKey = e.keyCode;
    }
    else if (e.charCode)
    {
        theKey = e.charCode;
    }
    var theShift = false;
    if (e.shiftKey)
    {
        theShift = e.shiftKey;
    }
    else if (e.modifiers)
    {
        if (e.modifiers & 4)
        {
            theShift = true;
        }
    }
    if ((theKey > 64 && theKey < 91 && !theShift) || (theKey > 96 && theKey < 123 && theShift))
    {
        alert('Caps Lock is on, passwords are case-sensitive');
        warningGiven = 1;
    }
}


// Change

function changeField(obj)
{
    if (jQuery(obj).hasClass('errorfield') || jQuery(obj).hasClass('upload_text'))
    {
        jQuery(obj).removeClass('errorfield');
        if (jQuery(obj).closest('form').find('.errorfield').length == 0)
        {
            jQuery('[id^=jspacer]').slideUp(100, function() { jQuery('[id^=jerror]').slideUp(100); });
            jQuery(obj).closest('form').find('.error_field').removeClass('error_field');
        }
    }
}

function checkLength(obj, max, e, message)
{
    var modKey = 0;
    var theKey = 0;
    if (!e) e = window.event;
    if (e)
    {
        if (e.ctrlKey || e.metaKey) modKey = 1;
        if (e.which)
        {
            theKey = e.which;
        }
        else if (e.keyCode)
        {
            theKey = e.keyCode;
        }
        else if (e.charCode)
        {
            theKey = e.charCode;
        }
    }

    if ((max) && (jQuery(obj).val().replace(/\r\n/g, ' ').replace(/\n/g, ' ').length >= max) && (!modKey) && (theKey != 8) && (theKey != 16) && (theKey != 17) && (theKey != 18) && (theKey != 20) && (theKey != 37) && (theKey != 38) && (theKey != 39) && (theKey != 40) && (theKey != 46) && (theKey != 224)) alert(message);
}

function showRow(obj)
{
    document.getElementById(obj).style.display = "";
}

function hideRow(obj)
{
    document.getElementById(obj).style.display = "none";
}

function toggleRow(obj)
{
    if (document.getElementById(obj).style.display == "none")
    {
        showRow(obj);
    }
    else
    {
        hideRow(obj);
    }
}

function toggleRows()
{
    if (document.getElementById('alternate').checked)
    {
        jQuery('.altrow').show();
        if (document.getElementById('afind'))
        {
            if (document.getElementById('afind').checked)
            {
                hideRow('aukrow1');
                hideRow('aukrow2');
                hideRow('apcrow');
            }
            else
            {
                hideRow('aparow1');
                hideRow('aparow2');
                hideRow('aparow3');
            }
        }
    }
    else
    {
        jQuery('.altrow').hide();
    }
}


// Dialog

function alertDialog(obj, opa, con)
{
    if (jQuery('#' + obj).length && !mobile())
    {
        con = String(con).replace(/\n/g, '<br>');
        if (opa) grayOut(true, opa);
        jQuery('#' + obj).dialog({ autoOpen: false, closeOnEscape: false, resizable: false, width: 400, height: 'auto', minHeight: false, title: 'Attention', buttons: { 'OK': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); } } }).html(con).dialog('open');
    }
    else
    {
        con = String(con).replace(/<b>/g, '').replace(/<\/b>/g, '');
        alert(con);
    }
}

function alert2Dialog(obj, opa, con, wid)
{
    if (jQuery('#' + obj).length && !mobile())
    {
        con = String(con).replace(/\n/g, '<br>');
        if (opa) grayOut(true, opa);
        jQuery('#' + obj).dialog({ autoOpen: false, closeOnEscape: false, resizable: false, width: wid, height: 'auto', minHeight: false, title: 'Attention', buttons: { 'OK': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); } } }).html(con).dialog('open');
    }
    else
    {
        con = String(con).replace(/<b>/g, '').replace(/<\/b>/g, '');
        alert(con);
    }
}

function confirmDialog(obj, opa, lin, con)
{
    if (jQuery('#' + obj).length && !mobile())
    {
        con = String(con).replace(/\n/g, '<br>');
        if (opa) grayOut(true, opa);
        jQuery('#' + obj).dialog({ autoOpen: false, closeOnEscape: false, resizable: false, width: 400, height: 'auto', minHeight: false, title: 'Confirmation Required', buttons: { 'OK': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); if (typeof lin.href != 'undefined') window.location.href = lin.href; else window.location.href = lin; }, 'Cancel': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); } } }).html(con).dialog('open');
    }
    else
    {
        if (confirm(con)) return true;
    }

    return false;
}

function confirm2Dialog(obj, opa, lin, lin2, con)
{
    if (jQuery('#' + obj).length && !mobile())
    {
        con = String(con).replace(/\n/g, '<br>');
        if (opa) grayOut(true, opa);
        jQuery('#' + obj).dialog({ autoOpen: false, closeOnEscape: false, resizable: false, width: 400, height: 'auto', minHeight: false, title: 'Confirmation Required', buttons: { 'OK': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); window.location.href = lin.href + lin2; }, 'Cancel': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); } } }).html(con).dialog('open');
    }
    else
    {
        if (confirm(con)) return true;
    }

    return false;
}

function confirm3Dialog(obj, opa, lin, lin2, con)
{
    if (jQuery('#' + obj).length && !mobile())
    {
        con = String(con).replace(/\n/g, '<br>');
        if (opa) grayOut(true, opa);
        jQuery('#' + obj).dialog({ autoOpen: false, closeOnEscape: false, resizable: false, width: 400, height: 'auto', minHeight: false, title: 'Confirmation Required', buttons: { 'OK': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); window.location.href = lin.href + lin2; }, 'Cancel': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); window.location.href = lin.href; } } }).html(con).dialog('open');
    }
    else
    {
        if (confirm(con)) return true;
    }

    return false;
}

function confirm4Dialog(obj, opa, but, con)
{
    if (jQuery('#' + obj).length && !mobile())
    {
        con = String(con).replace(/\n/g, '<br>');
        if (opa) grayOut(true, opa);
        jQuery('#' + obj).dialog({ autoOpen: false, closeOnEscape: false, resizable: false, width: 400, height: 'auto', minHeight: false, title: 'Confirmation Required', buttons: { 'OK': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); jQuery(but).attr('onclick', '').unbind('click').click(); }, 'Cancel': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); } } }).html(con).dialog('open');
    }
    else
    {
        if (confirm(con)) return true;
    }

    return false;
}

function confirm5Dialog(obj, opa, but, act, con)
{
    if (jQuery('#' + obj).length && !mobile())
    {
        con = String(con).replace(/\n/g, '<br>');
        if (opa) grayOut(true, opa);
        jQuery('#' + obj).dialog({ autoOpen: false, closeOnEscape: false, resizable: false, width: 400, height: 'auto', minHeight: false, title: 'Confirmation Required', buttons: { 'OK': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); but.form.action.value = act; jQuery(but).attr('onclick', '').unbind('click').click(); }, 'Cancel': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); } } }).html(con).dialog('open');
    }
    else
    {
        if (confirm(con)) return true;
    }

    return false;
}

function confirm6Dialog(obj, opa, box, act, con)
{
    if (jQuery('#' + obj).length && !mobile())
    {
        con = String(con).replace(/\n/g, '<br>');
        if (opa) grayOut(true, opa);
        jQuery('#' + obj).dialog({ autoOpen: false, closeOnEscape: false, resizable: false, width: 400, height: 'auto', minHeight: false, title: 'Confirmation Required', buttons: { 'OK': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); box.checked = true; eval(act); }, 'Cancel': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); } } }).html(con).dialog('open');
    }
    else
    {
        if (confirm(con)) return true;
    }

    return false;
}

function confirm7Dialog(obj, opa, box, con)
{
    if (jQuery('#' + obj).length && !mobile())
    {
        con = String(con).replace(/\n/g, '<br>');
        if (opa) grayOut(true, opa);
        jQuery('#' + obj).dialog({ autoOpen: false, closeOnEscape: false, resizable: false, width: 400, height: 'auto', minHeight: false, title: 'Confirmation Required', buttons: { 'OK': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); box.checked = true; }, 'Cancel': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); } } }).html(con).dialog('open');
    }
    else
    {
        if (confirm(con)) return true;
    }

    return false;
}

function confirm8Dialog(obj, opa, lis, con)
{
    if (jQuery('#' + obj).length && !mobile())
    {
        con = String(con).replace(/\n/g, '<br>');
        if (opa) grayOut(true, opa);
        jQuery('#' + obj).dialog({ autoOpen: false, closeOnEscape: false, resizable: false, width: 400, height: 'auto', minHeight: false, title: 'Confirmation Required', buttons: { 'OK': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); document.forms['withselected'].elements['selected'].value = lis; document.forms['withselected'].submit(); }, 'Cancel': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); } } }).html(con).dialog('open');
    }
    else
    {
        if (confirm(con)) return true;
    }

    return false;
}

function confirm9Dialog(obj, opa, act, con)
{
    if (jQuery('#' + obj).length && !mobile())
    {
        con = String(con).replace(/\n/g, '<br>');
        if (opa) grayOut(true, opa);
        jQuery('#' + obj).dialog({ autoOpen: false, closeOnEscape: false, resizable: false, width: 400, height: 'auto', minHeight: false, title: 'Confirmation Required', buttons: { 'OK': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); eval(act); }, 'Cancel': function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); } } }).html(con).dialog('open');
    }
    else
    {
        if (confirm(String(con).replace(/<u>/g, '').replace(/<\/u>/g, ''))) eval(act);
    }

    return false;
}

function contentDialog(obj, opa, tit, but1, but2, act1, act2, wid, hei, pos, off, sci, fad)
{
    var mode = document.documentMode || 0;
    if (opa) grayOut(true, opa);
    var buttons = {};
    if (but1) buttons[but1] = function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); if (act1) window.location.href = act1; };
    if (but2) buttons[but2] = function() { jQuery(this).dialog('close'); if (opa) grayOut(false, 0); if (act2) window.location.href = act2; };
    var of = window;
    if (mobile())
    {
        pos = 'top';
        of = document;
        if (mversion)
        {
            wid = jQuery(window).width() - 60;
            off = '0 ' + (jQuery(window).scrollTop() + 20);
        }
        else
        {
            off = '0 ' + (jQuery(window).scrollTop() + 100);
        }
    }
    jQuery('#' + obj).dialog({ autoOpen: false, closeOnEscape: false, resizable: false, width: wid, height: 'auto', minHeight: false, position: { my: pos, at: pos, of: of, offset: off }, dragStop: function(event, ui) { jQuery.post('/includes/position.php', { positionx: jQuery('#' + obj).dialog('option', 'position')[0], positiony: jQuery('#' + obj).dialog('option', 'position')[1] }); }, title: tit, buttons: buttons }).dialog('open');
    if (fad)
    {
        if (but1 || but2)
        {
            var fad2 = fad / 2;
            if (fad2 < 1) fad2 = 1;
            jQuery('#' + obj).parent('.ui-dialog').hover(function() { jQuery.doTimeout(obj + 'Fade'); }, function() { timeOut(obj, fad2); });
        }
        timeOut(obj, fad);
    }
    if (jQuery('#dialog-basket-list').length)
    {
        if (jQuery('#dialog-basket-list').height() > (hei + 5))
        {
            var width = jQuery('#dialog-basket-list').width() - 20;
            jQuery('#dialog-basket-list').css('padding-right', '10px').css('height', hei + 'px').css('overflow-y', 'scroll');
            jQuery('#' + obj).dialog('option', 'height', 'auto');
            if (pos == 'center') jQuery('#' + obj).dialog('option', 'position', 'center');
            if (!jQuery.browser.msie || ((jQuery.browser.version >= 9 && !mode) || mode >= 9))
            {
                jQuery('#dialog-basket-shadow-top').css('width', width + 'px');
                jQuery('#dialog-basket-shadow-bottom').css('width', width + 'px');
                if (sci > 0) jQuery('#dialog-basket-shadow-top').show(); if ((jQuery('#dialog-basket-list')[0].scrollHeight - sci) != jQuery('#dialog-basket-list').outerHeight()) jQuery('#dialog-basket-shadow-bottom').show();
                jQuery('#dialog-basket-list').scroll(function() { if (jQuery(this).scrollTop() > 0) { if (jQuery('#dialog-basket-shadow-top').css('display') == 'none') jQuery('#dialog-basket-shadow-top').fadeIn(); } else { jQuery('#dialog-basket-shadow-top').fadeOut(); } if ((jQuery(this)[0].scrollHeight - jQuery(this).scrollTop()) != jQuery(this).outerHeight()) { if (jQuery('#dialog-basket-shadow-bottom').css('display') == 'none') jQuery('#dialog-basket-shadow-bottom').fadeIn(); } else { jQuery('#dialog-basket-shadow-bottom').fadeOut(); } });
            }
        }
    }
}

function scrollCheck()
{
    jQuery('#dialog-basket-list').bind('scrollstop', function() { jQuery.post('/includes/position.php', { scrolli: jQuery('#dialog-basket-list').scrollTop() }); });
}

function scrollSet(sci)
{
    jQuery('#dialog-basket-list').scrollTop(sci);
}

function grayOut(vis, opa)
{
    var arrPageSizes = calcPageSize();
    var dark = document.getElementById('darkenScreenObject');

    if (!dark)
    {
        var tbody = document.getElementsByTagName('body')[0];
        var tnode = document.createElement('div');
        tnode.id = 'darkenScreenObject';
        tnode.style.position = 'absolute';
        tnode.style.top = '0px';
        tnode.style.left = '0px';
        tnode.style.zIndex = 100;
        tnode.style.cursor = 'not-allowed';
        tnode.style.display = 'none';
        tnode.style.overflow = 'hidden';
        tbody.appendChild(tnode);
        dark = document.getElementById('darkenScreenObject');
    }

    if (vis)
    {
        var opacity = opa * 100;
        dark.style.backgroundColor = '#000000';
        dark.style.opacity = opa;
        dark.style.MozOpacity = opa;
        dark.style.filter = 'alpha(opacity=' + opacity + ')';
        dark.style.width = arrPageSizes[0] + 'px';
        dark.style.height = arrPageSizes[1] + 'px';
        dark.style.minWidth = '100%';
        dark.style.minHeight = '100%';
        dark.style.display = 'none';
        jQuery(dark).show();
    }
    else
    {
        jQuery(dark).hide();
    }
}

function grayOutSize()
{
    var dark = document.getElementById('darkenScreenObject');

    if (dark)
    {
        if (dark.style.display != 'none')
        {
            jQuery(dark).hide();
            var arrPageSizes = calcPageSize();
            jQuery(dark).show();
            dark.style.width = arrPageSizes[0] + 'px';
            dark.style.height = arrPageSizes[1] + 'px';
            dark.style.minWidth = '100%';
            dark.style.minHeight = '100%';
        }
    }
}

function grayOutSpin()
{
    grayOut(true, 0.8);
    var dark = document.getElementById('darkenScreenObject');

    if (dark)
    {
        var tnode = document.createElement('div');
        tnode.id = 'darkenScreenSpinner';
        tnode.style.position = 'absolute';
        if (mobile() || tablet()) tnode.style.top = '200px'; else tnode.style.top = '50%';
        tnode.style.left = '50%';
        if (mobile() || tablet()) tnode.style.marginTop = '0px'; else tnode.style.marginTop = '-50px';
        tnode.style.marginLeft = '-50px';
        tnode.style.padding = '10px';
        tnode.style.width = '100px';
        tnode.style.height = '100px';
        tnode.style.backgroundColor = '#FFFFFF';
        tnode.style.borderRadius = '50px';
        tnode.style.zIndex = 101;
        tnode.style.cursor = 'not-allowed';
        dark.appendChild(tnode);
        spinner = document.getElementById('darkenScreenSpinner');
        tnode = document.createElement('img');
        tnode.src = '/images/spinner.gif';
        tnode.style.width = '80px';
        tnode.style.height = '80px';
        spinner.appendChild(tnode);
    }
}

function timeOut(obj, fad)
{
    jQuery.doTimeout(obj + 'Fade', fad * 1000, function() { jQuery('#' + obj).parent('.ui-dialog').fadeOut('slow', function() { jQuery('#' + obj).dialog('close'); }); });
}

// Facebook

var fbLoggedIn = 0;
var fbLoggingOut = 0;

function fbStatusChange(response)
{
    if ((response.status == 'connected') && (fbLoggingOut == 0))
    {
        FB.api('/me?fields=id,email,gender,first_name,last_name,location,locale,birthday', function(response) { if (typeof response.id != 'undefined') jQuery.post('/includes/fb_login.php', { id: response.id, email: response.email, gender: response.gender, first_name: response.first_name, last_name: response.last_name, location: response.location.name, locale: response.locale, birthday: response.birthday }, function(response) { response = jQuery.parseJSON(response); if (response.email) { if (!jQuery('#email_old').length) jQuery('#email').val(response.email); if (jQuery('#gender').val() == 0) jQuery('#gender').val(response.gender); if (response.first_name && !jQuery('#firstname').val()) jQuery('#firstname').val(response.first_name); if (response.last_name && !jQuery('#lastname').val()) jQuery('#lastname').val(response.last_name); if (!jQuery('#towncity').val() && !jQuery('#county').val()) { if (response.location) { jQuery('#towncity').val(response.location); jQuery('#county').val(response.location2); } if (response.locale) jQuery('#country').val(response.locale); } if (response.birthday && !jQuery('#dob').val()) jQuery('#dob').val(response.birthday); } jQuery('#fb-logout').attr('disabled', false).attr('checked', true).show(); }); else alert('Unavailable'); });
        fbLoggedIn = 1;
    }
    else if (response.status == 'unknown')
    {
        jQuery('#fb-logout').hide();
        fbLoggedIn = 0;
        fbLoggingOut = 0;
    }
}

function fbLogout()
{
    fbLoggingOut = 1;
    jQuery('#fb-logout').attr('disabled', true);
    jQuery.post('/includes/fb_login.php', { logout: 1 });
    if (fbLoggedIn == 0) FB.getLoginStatus(function(response) { if (response.status != 'unknown') { FB.logout(); } else { jQuery('#fb-logout').hide(); fbLoggedIn = 0; fbLoggingOut = 0; } }); else FB.logout();
}


// Mobile

function mobile()
{
    if ((navigator.userAgent.match(/mobile/i) && !navigator.userAgent.match(/ipad/i)) || (mversion)) return true; else return false;
}

function tablet()
{
    if ((navigator.userAgent.match(/ipad/i)) || ((navigator.userAgent.match(/touch/i) || navigator.userAgent.match(/android/i)) && (!mobile())))
    {
        return true;
    }
    else if (navigator.userAgent.match(/safari/i) && !navigator.userAgent.match(/chrome/i))
    {
        if ('ontouchstart' in window) return true; else return false;
    }
    else
    {
        return false;
    }
}


// Redraw

var gotop = 0;
var navpad = 0;
var navwas = '';

if (!aconsole) jQuery(document).ready(function()
{
    redraw(0);
    resize(0);

    jQuery('input[placeholder], textarea[placeholder]').placeholder();

    if (typeof autocomp != 'undefined')
    {
        if (typeof aclaid == 'undefined') aclaid = 0;
        if (typeof accuid == 'undefined') accuid = 0;
        if (typeof acusid == 'undefined') acusid = 0;
        jQuery('input[name=for]').autocomplete({ source: function(request, response) { jQuery.ajax({ url: '/includes/autocomplete.php', dataType: 'json', data: { term: request.term, langid: aclaid, currid: accuid, userid: acusid }, success: function(data) { response(data); } }); }, open: function(event, ui) { var field = this; jQuery('.ui-autocomplete').each(function() { var spanwidth = 0; jQuery(this).find('span').each(function() { if (jQuery(this).outerWidth() > spanwidth) spanwidth = jQuery(this).outerWidth(); }); var imgwidth = 0; if (jQuery(this).find('img').length) imgwidth = 34; var totalwidth = spanwidth + imgwidth + 10; var maxwidth = jQuery(window).width() - jQuery(this).offset().left; if (totalwidth <= (jQuery(field).outerWidth())) { jQuery(this).css('width', jQuery(field).outerWidth()); } else if (totalwidth <= maxwidth) { jQuery(this).css('width', totalwidth); } else { jQuery(this).css('width', totalwidth).position({ of: jQuery(field), my: 'right top', at: 'right bottom' }); } }); }, focus: function(event, ui) { if (ui.item.value != ui.item.label.replace('<span>', '').replace('</span>', '')) return false; }, select: function(event, ui) { if (ui.item.value == 'ALLRESULTS') { jQuery(this).val(jQuery(this).val() + '...'); jQuery(this).closest('form').submit(); return false; } else if (ui.item.value != ui.item.label.replace('<span>', '').replace('</span>', '')) { window.location.href = '/products/' + ui.item.value + '.html?search=1'; return false; } else if (ui.item.value) { jQuery(this).val(ui.item.value); jQuery(this).closest('form').submit(); return false; } }, delay: 200, minLength: 2 });
        jQuery.ui.autocomplete.prototype._renderItem = function(ul, item)
        {
            if (item.value != 'ALLRESULTS')
            {
                var offset = item.label.indexOf('<img');
                if (offset > -1) offset = item.label.indexOf('>') + 1; else offset = 0;
                var offset2 = item.label.indexOf('<span', offset);
                if (offset2 > -1) offset2 = item.label.indexOf('>', offset2) + 1; else offset2 = 0;
                if (offset2 > offset) offset = offset2;
                offset2 = item.label.indexOf('&nbsp;&nbsp;', offset);
                if (offset2 > -1) offset = offset2 + 12;
                var re = new RegExp(this.term.replace(/"/g, '').replace(/\s+$/, ''), 'i');
                var t = item.label.substr(0, offset) + item.label.substr(offset).replace(re, '¬');
                var rep = item.label.substr(t.indexOf('¬'), this.term.replace(/"/g, '').replace(/\s+$/, '').length);
                t = t.replace(/¬/, '<b>' + rep + '</b>');
                return jQuery('<li></li>').data('item.autocomplete', item).append('<a>' + t + '</a>').appendTo(ul);
            }
            else
            {
                return jQuery('<li></li>').data('item.autocomplete', item).append('<a class="ui-autocomplete-all">' + item.label + '</a>').appendTo(ul);
            }
        };
    }

    if (window.location.pathname.substr(1, 8) == 'checkout') jQuery(document).bind('contextmenu', function(e) { return false; });

    if (mversion)
    {
        jQuery(window).bind('scrollstop2', function() { if (jQuery(window).scrollTop() >= jQuery('#nav_bottom').offset().top) { if (!gotop) jQuery('div.gotop').fadeTo('fast', 0.5, function() { gotop = 1; }); } else { if (gotop) jQuery('div.gotop').fadeOut('fast', function() { gotop = 0; }); } });

        window.addEventListener('resize', function()
        {
            resize(1);
            setTimeout(function() { jQuery("div[id^='slideshow']").each(function() { var id = jQuery(this).attr('id').replace('slideshow', ''); jQuery('#nextss' + id + ', #prevss' + id).css('top', ((jQuery('#slides' + id).outerHeight() - 20) / 2) + 'px'); }); }, 1000);
        }, false);
    }
    else
    {
        window.addEventListener('resize', function()
        {
            resize(1);
        }, false);
    }
});

function redraw(rtype)
{
    if (typeof rtype == 'undefined') rtype = 0;

    var mode = document.documentMode || 0;

    if (!rtype)
    {
        if (jQuery('#product_images').length && jQuery('#product_details').length)
        {
            var piw = jQuery('#product_images').innerWidth();
            var pdw = jQuery('#product_details').innerWidth();
            if (piw && pdw)
            {
                piw = piw - parseInt(jQuery('#product_images').css('padding-left'), 10) - parseInt(jQuery('#product_images').css('padding-right'), 10);
                pdw = pdw - parseInt(jQuery('#product_details').css('padding-left'), 10) - parseInt(jQuery('#product_details').css('padding-right'), 10);
                jQuery('#product_images').css('width', piw + 'px');
                jQuery('#product_details').css('width', pdw + 'px');
            }
        }
    }
    else
    {
        if (jQuery.isFunction(jQuery.fn.lightBox)) jQuery('a[rel^=lightbox]').lightBox();
        if (jQuery.isFunction(jQuery.fn.magnify) && magnified) jQuery('.magnify').magnify();
    }

    jQuery('#product_tabs').tabs({ select: function(event, ui) { jQuery.post('/includes/tab.php', { sku: jQuery(this).attr('rel'), tab: ui.panel.id }); } });

    if (typeof abcurve != 'undefined')
    {
        var abcsize = '8px';
        if (abcurve == 2) abcsize = '6px'; else if (abcurve == 3) abcsize = '4px'; else if (abcurve == 4) abcsize = '2px';
        if (jQuery.browser.msie && ((jQuery.browser.version < 8 && !mode) || mode < 8)) jQuery('form[name=details] .alternate').uncorner().corner(abcsize);
        jQuery('.basket, .alternate, .alternateb, .alternatet').not(':has(.jquery-corner)').each(function()
        {
            jQuery(this).attr('cellspacing', 0).css('border-collapse', 'separate').css('background-color', 'transparent');
            if (jQuery(this).not(':has(tr:first hr)').length && this.className != 'alternateb')
            {
                jQuery(this).children('tbody:first').children('tr:first').removeClass('alt').children('td').addClass('alt');
                jQuery(this).children('tbody:first').children('tr:first').children('td:first').corner('tl ' + abcsize);
                jQuery(this).children('tbody:first').children('tr:first').children('td:last').corner('tr ' + abcsize);
            }
            if (jQuery(this).not(':has(tr:last hr)').length && this.className != 'alternatet')
            {
                jQuery(this).children('tbody:last').children('tr:last').removeClass('alt').children('td').addClass('alt');
                jQuery(this).children('tbody:last').children('tr:last').children('td:first').corner('bl ' + abcsize);
                jQuery(this).children('tbody:last').children('tr:last').children('td:last').corner('br ' + abcsize);
            }
        });
        jQuery('.i_form:has(tr.alt)').not(':has(.jquery-corner)').each(function()
        {
            jQuery(this).attr('cellspacing', 0).css('border-collapse', 'separate').css('background-color', 'transparent');
            jQuery(this).find('tr.alt').each(function()
            {
                jQuery(this).removeClass('alt').children('td').addClass('alt');
                jQuery(this).children('td:first').corner('tl ' + abcsize);
                jQuery(this).children('td:last').corner('tr ' + abcsize);
            });
        });
    }
}

function resize(rtype)
{
    if (navigator.userAgent.toLowerCase().indexOf('wkhtmlto') > -1) return;

    if (typeof rtype == 'undefined') rtype = 0;

    var mode = document.documentMode || 0;

    if (rtype) resizeall();

    if (!jQuery.browser.msie || ((jQuery.browser.version >= 8 && !mode) || mode >= 8)) jQuery('.gridp').each(function()
    {
        jQuery(this).children('tbody:first').children('tr').each(function()
        {
            resizerow(rtype, this);
        });
    });
}

function resizeall()
{
    jQuery('div#nav').css('overflow', 'visible');
    if (navwas) jQuery('div#nav > table:first a, div#nav > table:first span, div#nav > table:first td').not(jQuery('.child a, .child span, .child td')).css('font-size', navwas);
    var navis = jQuery('div#nav > table:first a:first').not(jQuery('.child a')).css('font-size');
    var navis2 = jQuery('div#nav > table:first a:last').not(jQuery('.child a')).css('font-size');
    if ((navis) && (navis == navis2))
    {
        if (!navwas) navwas = navis;
        var navfont = parseInt(navis.replace(/[^0-9\.]/g, ''));
        if ((!isNaN(navfont)) && (navfont > 0) && (navis.indexOf('px') > 0))
        {
            var navwidth = jQuery('div#nav').innerWidth();
            var navwidth2 = jQuery('div#nav > table:first').outerWidth();
            var navwidth3 = navwidth2;
            var navabort = 0;
            if ((navwidth2 > navwidth) && (!navpad))
            {
                var navpadl = jQuery('div#nav > table:first td:first').css('padding-left');
                var navpadr = jQuery('div#nav > table:first td:first').css('padding-right');
                if (navpadl == navpadr)
                {
                    var navpadunit = parseInt(navpadl.replace(/[^0-9\.]/g, ''));
                    if ((!isNaN(navpadunit)) && (navpadunit > 0) && (navpadl.indexOf('px') > 0))
                    {
                        var navpadem = Math.round((navpadunit / navfont) * 1000) / 1000;
                        if (navpadem > 0)
                        {
                            jQuery('div#nav > table:first td').css({ 'padding-left': navpadem + 'em', 'padding-right': navpadem + 'em' });
                            navpad = 1;
                        }
                    }
                }
            }
            while ((navwidth2 > navwidth) && (!navabort))
            {
                navfont--;
                jQuery('div#nav > table:first a, div#nav > table:first span, div#nav > table:first td').not(jQuery('.child a, .child span, .child td')).css('font-size', navfont + 'px');
                navwidth2 = jQuery('div#nav > table:first').outerWidth();
                if (navwidth2 >= navwidth3)
                {
                    navfont++;
                    jQuery('div#nav > table:first a, div#nav > table:first span, div#nav > table:first td').not(jQuery('.child a, .child span, .child td')).css('font-size', navfont + 'px');
                    navabort = 1;
                }
                else
                {
                    if (navfont > 8) navwidth3 = navwidth2; else navabort = 1;
                }
            }
        }
    }

    var buttonheight = jQuery('td.b_basket.b_small:first > button').parent('td').innerHeight();
    if (buttonheight)
    {
        jQuery('td.b_basket.b_small input[type=text], td.b_basket.b_small select').css('display', 'inline');
        jQuery('td.b_basket.b_small').css({ 'white-space': 'normal', 'padding-left': '10px' });
        var buttonheight2 = jQuery('td.b_basket.b_small:first').innerHeight();
        if (buttonheight2 > buttonheight)
        {
            jQuery('td.b_basket.b_small input[type=text], td.b_basket.b_small select').css('display', 'none');
            jQuery('td.b_basket.b_small').css({ 'white-space': 'nowrap', 'padding-left': '0px' });
        }
        else
        {
            jQuery('td.b_basket.b_small').css('white-space', 'nowrap');
        }
    }
}

function resizerow(rtype, row)
{
    var prti = 0;
    jQuery(row).children('td').find('.prti').each(function()
    {
        if (rtype) var prtiw = jQuery(this).height('auto').height(); else var prtiw = jQuery(this).height();
        if (prtiw > prti) prti = prtiw;
    });
    if (prti) jQuery(row).children('td').find('.prti').height(prti).css('padding', '0px');
    if (rtype)
    {
        var prim = 0;
        jQuery(row).children('td').find('.prim').each(function()
        {
            var primw = jQuery(this).height('auto').height();
            if (primw > prim) prim = primw;
        });
        if (prim) jQuery(row).children('td').find('.prim').height(prim).css('padding', '0px');
    }
}


// Refine

function minmax(box)
{
    var speed = 200;
    if (box == 'aa')
    {
        speed = 0;
        box = 'a';
    }
    jQuery.post('/blocks/refinefields.php', { name: 'minmax-' + box, value: jQuery('#group-' + box).css('display') });
    if (jQuery('#group-' + box).css('display') == 'none')
    {
        if (box == 'a')
        {
            if (!speed) jQuery('html, body').animate({ scrollTop: jQuery('#product_list').offset().top - 10 }, speed); else jQuery('html, body').animate({ scrollTop: jQuery('#product_refiner').offset().top - 10 }, speed);
            jQuery('#group-a').slideDown(speed);
            jQuery('#minmax-a').html('<span class="bp-icon-minus bp-icon-grey"></span>');
            jQuery('#clear-a').hide();
            jQuery('.gotop').css('right', '-40px');
            jQuery('.refineyes, .refineno').fadeTo(speed, 0.95);
        }
        else if (box == 'p')
        {
            jQuery('#group-p').slideDown('fast');
            jQuery('#minmax-p').html('&#8211;').attr('title', minimise);
            jQuery('#minmaxt-p').attr('title', minimise);
        }
        else
        {
            if (jQuery('#sp-' + box).css('display') != 'none') jQuery('#hr-' + box).show();
            jQuery('#group-' + box).slideDown('fast', function() { if (jQuery('#sp-' + box).css('display') != 'none') jQuery(this).css('overflow-y', 'scroll'); });
            jQuery('#minmax-' + box).html('&#8211;').attr('title', minimise);
            jQuery('#minmaxt-' + box).attr('title', minimise);
        }
    }
    else
    {
        if (box == 'a')
        {
            if (!speed) jQuery('html, body').animate({ scrollTop: jQuery('#product_list').offset().top - 10 }, speed);
            jQuery('#group-a').slideUp(speed);
            jQuery('#minmax-a').html('<span class="bp-icon-plus bp-icon-grey"></span>');
            jQuery('#clear-a').show();
            jQuery('.gotop').css('right', '0px');
            jQuery('.refineyes, .refineno').fadeOut(speed);
        }
        else if (box == 'p')
        {
            jQuery('#group-p').slideUp('fast');
            jQuery('#minmax-p').html('+').attr('title', maximise);
            jQuery('#minmaxt-p').attr('title', maximise);
        }
        else
        {
            jQuery('#group-' + box).slideUp('fast');
            jQuery('#minmax-' + box).html('+').attr('title', maximise);
            jQuery('#minmaxt-' + box).attr('title', maximise);
            jQuery('#hr-' + box).hide();
        }
    }
}

function refinefields(name, value, column, brandlabel, inbrand, inprice, checkboxes, iscrollable, iname, iminprice, imaxprice, message)
{
    if ((typeof scrollpos != 'undefined') && (value != 'clear') && (value != 'range'))
    {
        if (jQuery('#sp-' + iname).css('display') != 'none') { scrollpos = document.getElementById('group-' + iname).scrollTop; scrollbox = 'group-' + iname; }
    }
    jQuery('#product_refine input, #product_refine label').removeAttr('onclick');
    jQuery('#product_list_outer').prepend('<div class=\'refining\'><\/div>').find('a').click(function() { return false; });
    jQuery('#product_list_inner .prla').each(function() { jQuery(this).replaceWith(jQuery(this).find('img')); });
    jQuery('#product_list_inner').fadeTo(100, 0.25);
    jQuery.post('/blocks/refinefields.php', { name: name, value: value, column: column, brandlabel: brandlabel, inbrand: inbrand, inprice: inprice, checkboxes: checkboxes, scrollable: iscrollable }, function(response)
    {
        var responses = response.split(/\-\=\-\=\-/);
        jQuery('#product_list_inner').html('&nbsp;').css('opacity', 1);
        if (responses[0])
        {
            jQuery('#product_list').html(responses[0]);
        }
        else
        {
            window.location.href = window.location.href;
            return;
        }
        jQuery('#product_refine').html(responses[1]);
        if (typeof easyedit != 'undefined')
        {
            if (easyedit == 1) bindings();
        }
        redraw(1);
        var innerimages = jQuery("#product_list_inner img");
        var totalimages = innerimages.length;
        var loadedimages = 0;
        innerimages.each(function() { jQuery(this).on('load', function() { loadedimages++; if (loadedimages == totalimages) resize(1); }); });
        if (mobile() || tablet()) var threshold = 1000; else var threshold = 100;
        if (responses[0].indexOf('class="lazyp"') >= 0) jQuery('img.lazyp').lazyload({ skip_invisible: false, threshold: threshold, load: function() { var mode = document.documentMode || 0; if (!jQuery.browser.msie || ((jQuery.browser.version >= 8 && !mode) || mode >= 8)) resizerow(1, jQuery(this).closest('tr')); } });
        if (responses[0].indexOf('class="quickview') >= 0) jQuery('#product_list_inner').find('button.quickview').lightBox();
        if (typeof scrollpos != 'undefined')
        {
            scrollable(iscrollable, scrollpos, scrollbox);
        }
        if (typeof pricereset != 'undefined')
        {
            pricerange();
        }
        if ((value == 'range') && (responses[2] == 'NONE'))
        {
            pricereset = 1;
            jQuery('#slider-range').slider('values', 0, iminprice);
            jQuery('#slider-range').slider('values', 1, imaxprice);
            pricereset = 0;
            alertDialog('dialog-alert', 0.4, message);
        }
    });
}

function refinesort(order, filter, brandlabel)
{
    if (!order) jQuery('#product_filter a, #product_filter span').removeAttr('onclick');
    jQuery('#product_list_outer').prepend('<div class=\'refining\'><\/div>').find('a').click(function() { return false; });
    jQuery('#product_list_inner .prla').each(function() { jQuery(this).replaceWith(jQuery(this).find('img')); });
    jQuery('#product_list_inner').fadeTo(100, 0.25);
    jQuery.post('/blocks/refinefields.php', { order: order, filter: filter, brandlabel: brandlabel }, function(response)
    {
        var responses = response.split(/\-\=\-\=\-/);
        jQuery('#product_list_inner').html('&nbsp;').css('opacity', 1);
        if (responses[0])
        {
            jQuery('#product_list').html(responses[0]);
        }
        else
        {
            window.location.href = window.location.href;
            return;
        }
        if (order && mversion) jQuery('#product_refine').html(responses[1]); else if (filter) jQuery('#product_filter').html(responses[1]);
        if (typeof easyedit != 'undefined')
        {
            if (easyedit == 1) bindings();
        }
        redraw(1);
        var innerimages = jQuery("#product_list_inner img");
        var totalimages = innerimages.length;
        var loadedimages = 0;
        innerimages.each(function() { jQuery(this).on('load', function() { loadedimages++; if (loadedimages == totalimages) resize(1); }); });
        if (mobile() || tablet()) var threshold = 1000; else var threshold = 100;
        if (responses[0].indexOf('class="lazyp"') >= 0) jQuery('img.lazyp').lazyload({ skip_invisible: false, threshold: threshold, load: function() { var mode = document.documentMode || 0; if (!jQuery.browser.msie || ((jQuery.browser.version >= 8 && !mode) || mode >= 8)) resizerow(1, jQuery(this).closest('tr')); } });
        if (responses[0].indexOf('class="quickview') >= 0) jQuery('#product_list_inner').find('button.quickview').lightBox();
    });
}

function scrollable(val, pos, box)
{
    jQuery('.scrollable').each(function()
    {
        var grp = jQuery(this).attr('id').split('-');
        if (jQuery(this).innerHeight() > val)
        {
            jQuery(this).css('height', val + 'px').css('overflow-y', 'scroll');
            jQuery('#sp-' + grp[1]).show();
            if (jQuery(this).css('display') != 'none') jQuery('#hr-' + grp[1]).show();
            if ((pos) && (jQuery(this).attr('id') == box)) jQuery(this).scrollTop(pos);
        }
    });
}

function comma(val)
{
    return String(val).split('').reverse().join('').replace(/(.{3}\B)/g, '$1,').split('').reverse().join('');
}

function filesize(val)
{
    if (val < 1048576) return comma(Math.round(val / 1024)) + ' KB'; else return comma(Math.round(val / 1048576)) + ' MB';
}


// Select

function selectfields(item, product, oid, sequence, strict)
{
    jQuery.post('/includes/selectfields.php', jQuery('.selectfield_' + item + '_' + product).serialize() + '&item=' + item + '&product=' + product + '&oid=' + oid + '&sequence=' + sequence + '&strict=' + strict, function(response)
    {
        if (sequence)
        {
            var responses = response.split(/\-\=\-\=\-/);
            var selectcount = 0;
            jQuery('.selectfield_' + item + '_' + product).each(function()
            {
                jQuery(this).html(responses[selectcount]);
                selectcount++;
            });
            if (sequence == 2) optionChange(oid, 1);
        }
        else
        {
            if (response == '0')
            {
                alertDialog('dialog-alert', 0.4, 'This item is unavailable for purchase');
                jQuery('.selectfield_' + item + '_' + product).each(function()
                {
                    jQuery(this).val(jQuery('input[name=' + jQuery(this).attr('name') + '_old]').val());
                });
            }
            else
            {
                if (strict == 2)
                {
                    jQuery('.selectfield_' + item + '_' + product).each(function()
                    {
                        jQuery('input[name=' + jQuery(this).attr('name') + '_old]').val(jQuery(this).val());
                    });
                    if (response != '1')
                    {
                        if (mversion) var nbsp = ''; else nbsp = '&nbsp; ';
                        if (response) jQuery('#selectprice_' + item + '_' + product).html(nbsp + '<b>+&nbsp;' + response + '</b>'); else jQuery('#selectprice_' + item + '_' + product).html('');
                    }
                }
                else if (strict == 1)
                {
                    submitfields(item, product);
                }
                else
                {
                    wishlist.submit();
                }
            }
        }
    });
}

function submitfields(item, product)
{
    var url = 'bid=' + item + '&pid=' + product + '&' + jQuery('.selectfield_' + item + '_' + product).serialize();
    doAction('/index/action/basket/', 'mod', '?' + url + '&silent=1');
}

function submitadditions(item, addition)
{
    var url = 'bid=' + item + '&aid=' + addition + '&' + jQuery('input[name^=addition], textarea[name^=addition], select[name^=addition]').serialize();
    doAction('/index/action/basket/', 'mod', '?' + url + '&silent=1');
}

function getdelivery()
{
    var url = 'delivery=' + jQuery('#delivery').val() + '&country=' + jQuery('#country').val() + '&county=' + jQuery('#county').val() + '&postcode=' + jQuery('#postcode').val();
    if (jQuery('#postcode_pa').length) url += '&postcode_pa=' + jQuery('#postcode_pa').val();
    if (jQuery('#alternate').length)
    {
        url += '&alt_country=' + jQuery('#alt_country').val() + '&alt_county=' + jQuery('#alt_county').val() + '&alt_postcode=' + jQuery('#alt_postcode').val();
        if (jQuery('#alt_postcode_pa').length) url += '&alt_postcode_pa=' + jQuery('#alt_postcode_pa').val();
        if ((jQuery('#alternate').is(':checked')) || (jQuery('#alternate').attr('type') == 'hidden')) url += '&alternate=1'; else url += '&alternate=0';
    }
    if (jQuery('#shipping_date').length) url += '&shipping_date=' + jQuery('#shipping_date').val();

    return url;
}

function selectdelivery()
{
    if (jQuery('#delivery').length)
    {
        var url = getdelivery();
        doAction('/checkout.html', 'mod', '?' + url + '&silent=1');
    }
}

function selectaddress(url)
{
    doAction('/checkout.html', 'mod', '?' + url + '&silent=1');
}

function selectduties(url)
{
    if (jQuery('#delivery').length) url += '&' + getdelivery();
    doAction('/checkout.html', 'mod', '?' + url + '&silent=1');
}


// Size

if (!aconsole) jQuery(window).load(function()
{
    if (navigator.userAgent.toLowerCase().indexOf('wkhtmlto') > -1) return;

    if (jQuery('.left_column').length)
    {
        var leftHeight = jQuery('.left_column').innerHeight() - parseInt(jQuery('.left_column').css('padding-top'), 10) - parseInt(jQuery('.left_column').css('padding-bottom'), 10);
        jQuery('#inner td.left').html('<img src="/images/spacer.gif" width="1" height="' + leftHeight  + '">');
    }
    else if (jQuery.browser.msie && jQuery('#centertop').length)
    {
        var leftColumn = jQuery('#left').length;
        var rightColumn = jQuery('#right').length;
        if (leftColumn || rightColumn)
        {
            jQuery('#centertop').hide();
            if (leftColumn) var leftWidth = jQuery('#left').innerWidth() - parseInt(jQuery('#left').css('padding-left'), 10) - parseInt(jQuery('#left').css('padding-right'), 10); else var leftWidth = 0;
            if (rightColumn) var rightWidth = jQuery('#right').innerWidth() - parseInt(jQuery('#right').css('padding-right'), 10) - parseInt(jQuery('#right').css('padding-right'), 10); else var rightWidth = 0;
            var centerWidth = jQuery('#center').innerWidth() - parseInt(jQuery('#center').css('padding-left'), 10) - parseInt(jQuery('#center').css('padding-right'), 10);
            jQuery('#centertop').show();
            if (leftColumn) jQuery('#left').append('<img src="/images/spacer.gif" width="' + leftWidth  + '" height="1">');
            if (rightColumn) jQuery('#right').append('<img src="/images/spacer.gif" width="' + rightWidth  + '" height="1">');
            jQuery('#center').append('<img src="/images/spacer.gif" width="' + centerWidth + '" height="1">');
            if ((leftColumn) && (jQuery('#left').attr('rowspan') == 2))
            {
                var leftHeight = jQuery('#left').innerHeight() - parseInt(jQuery('#left').css('padding-top'), 10) - parseInt(jQuery('#left').css('padding-bottom'), 10) - jQuery('#centertopcon').innerHeight();
                jQuery('#center').css('height', leftHeight + 'px');
            }
            else if ((rightColumn) && (jQuery('#right').attr('rowspan') == 2))
            {
                var rightHeight = jQuery('#right').innerHeight() - parseInt(jQuery('#right').css('padding-top'), 10) - parseInt(jQuery('#right').css('padding-bottom'), 10) - jQuery('#centertopcon').innerHeight();
                jQuery('#center').css('height', rightHeight + 'px');
            }
        }
    }

    setTimeout(function() { jQuery('span.IN-widget button').prop('type', 'button'); }, 1000);

    resize(1);
    setTimeout(grayOutSize, 10);
});

if (aconsole) jQuery(window).load(function()
{
    setTimeout(grayOutSize, 10);
});


// Corner

(function($){var style=document.createElement('div').style;var moz=style['MozBorderRadius']!==undefined;var webkit=style['WebkitBorderRadius']!==undefined;var radius=style['borderRadius']!==undefined||style['BorderRadius']!==undefined;var mode=document.documentMode||0;var noBottomFold=$.browser.msie&&(($.browser.version<8&&!mode)||mode<8);var expr=$.browser.msie&&(function(){var div=document.createElement('div');try{div.style.setExpression('width','0+0');div.style.removeExpression('width')}catch(e){return false}return true})();function sz(el,p){return parseInt($.css(el,p))||0};function hex2(s){var s=parseInt(s).toString(16);return(s.length<2)?'0'+s:s};function gpc(node){while(node){var v=$.css(node,'backgroundColor');if(v&&v!='transparent'&&v!='rgba(0, 0, 0, 0)'){if(v.indexOf('rgb')>=0){var rgb=v.match(/\d+/g);return'#'+hex2(rgb[0])+hex2(rgb[1])+hex2(rgb[2])}return v}node=node.parentNode}return'#ffffff'};function getWidth(fx,i,width){switch(fx){case'round':return Math.round(width*(1-Math.cos(Math.asin(i/width))));case'cool':return Math.round(width*(1+Math.cos(Math.asin(i/width))));case'sharp':return Math.round(width*(1-Math.cos(Math.acos(i/width))));case'bite':return Math.round(width*(Math.cos(Math.asin((width-i-1)/width))));case'slide':return Math.round(width*(Math.atan2(i,width/i)));case'jut':return Math.round(width*(Math.atan2(width,(width-i-1))));case'curl':return Math.round(width*(Math.atan(i)));case'tear':return Math.round(width*(Math.cos(i)));case'wicked':return Math.round(width*(Math.tan(i)));case'long':return Math.round(width*(Math.sqrt(i)));case'sculpt':return Math.round(width*(Math.log((width-i-1),width)));case'dogfold':case'dog':return(i&1)?(i+1):width;case'dog2':return(i&2)?(i+1):width;case'dog3':return(i&3)?(i+1):width;case'fray':return(i%2)*width;case'notch':return width;case'bevelfold':case'bevel':return i+1}};$.fn.corner=function(options){if(this.length==0){if(!$.isReady&&this.selector){var s=this.selector,c=this.context;$(function(){$(s,c).corner(options)})}return this}return this.each(function(index){var $this=$(this);var o=[$this.attr($.fn.corner.defaults.metaAttr)||'',options||''].join(' ').toLowerCase();var keep=/keep/.test(o);var cc=((o.match(/cc:(#[0-9a-f]+)/)||[])[1]);var sc=((o.match(/sc:(#[0-9a-f]+)/)||[])[1]);var width=parseInt((o.match(/(\d+)px/)||[])[1])||10;var re=/round|bevelfold|bevel|notch|bite|cool|sharp|slide|jut|curl|tear|fray|wicked|sculpt|long|dog3|dog2|dogfold|dog/;var fx=((o.match(re)||['round'])[0]);var fold=/dogfold|bevelfold/.test(o);var edges={T:0,B:1};var opts={TL:/top|tl|left/.test(o),TR:/top|tr|right/.test(o),BL:/bottom|bl|left/.test(o),BR:/bottom|br|right/.test(o)};if(!opts.TL&&!opts.TR&&!opts.BL&&!opts.BR)opts={TL:1,TR:1,BL:1,BR:1};if($.fn.corner.defaults.useNative&&fx=='round'&&(radius||moz||webkit)&&!cc&&!sc){if(opts.TL)$this.css(radius?'border-top-left-radius':moz?'-moz-border-radius-topleft':'-webkit-border-top-left-radius',width+'px');if(opts.TR)$this.css(radius?'border-top-right-radius':moz?'-moz-border-radius-topright':'-webkit-border-top-right-radius',width+'px');if(opts.BL)$this.css(radius?'border-bottom-left-radius':moz?'-moz-border-radius-bottomleft':'-webkit-border-bottom-left-radius',width+'px');if(opts.BR)$this.css(radius?'border-bottom-right-radius':moz?'-moz-border-radius-bottomright':'-webkit-border-bottom-right-radius',width+'px');return}var strip=document.createElement('div');$(strip).css({overflow:'hidden',height:'1px',minHeight:'1px',fontSize:'1px',backgroundColor:sc||'transparent',borderStyle:'solid'});var pad={T:parseInt($.css(this,'paddingTop'))||0,R:parseInt($.css(this,'paddingRight'))||0,B:parseInt($.css(this,'paddingBottom'))||0,L:parseInt($.css(this,'paddingLeft'))||0};if(typeof this.style.zoom!=undefined)this.style.zoom=1;if(!keep)this.style.border='none';strip.style.borderColor=cc||gpc(this.parentNode);var cssHeight=$(this).outerHeight();for(var j in edges){var bot=edges[j];if((bot&&(opts.BL||opts.BR))||(!bot&&(opts.TL||opts.TR))){strip.style.borderStyle='none '+(opts[j+'R']?'solid':'none')+' none '+(opts[j+'L']?'solid':'none');var d=document.createElement('div');$(d).addClass('jquery-corner');var ds=d.style;bot?this.appendChild(d):this.insertBefore(d,this.firstChild);if(bot&&cssHeight!='auto'){if($.css(this,'position')=='static')this.style.position='relative';ds.position='absolute';ds.bottom=ds.left=ds.padding=ds.margin='0';if(expr)ds.setExpression('width','this.parentNode.offsetWidth');else ds.width='100%'}else if(!bot&&$.browser.msie){if($.css(this,'position')=='static')this.style.position='relative';ds.position='absolute';ds.top=ds.left=ds.right=ds.padding=ds.margin='0';if(expr){var bw=sz(this,'borderLeftWidth')+sz(this,'borderRightWidth');ds.setExpression('width','this.parentNode.offsetWidth - '+bw+'+ "px"')}else ds.width='100%'}else{ds.position='relative';ds.margin=!bot?'-'+pad.T+'px -'+pad.R+'px '+(pad.T-width)+'px -'+pad.L+'px':(pad.B-width)+'px -'+pad.R+'px -'+pad.B+'px -'+pad.L+'px'}for(var i=0;i<width;i++){var w=Math.max(0,getWidth(fx,i,width));var e=strip.cloneNode(false);e.style.borderWidth='0 '+(opts[j+'R']?w:0)+'px 0 '+(opts[j+'L']?w:0)+'px';bot?d.appendChild(e):d.insertBefore(e,d.firstChild)}if(fold&&$.support.boxModel){if(bot&&noBottomFold)continue;for(var c in opts){if(!opts[c])continue;if(bot&&(c=='TL'||c=='TR'))continue;if(!bot&&(c=='BL'||c=='BR'))continue;var common={position:'absolute',border:'none',margin:0,padding:0,overflow:'hidden',backgroundColor:strip.style.borderColor};var $horz=$('<div/>').css(common).css({width:width+'px',height:'1px'});switch(c){case'TL':$horz.css({bottom:0,left:0});break;case'TR':$horz.css({bottom:0,right:0});break;case'BL':$horz.css({top:0,left:0});break;case'BR':$horz.css({top:0,right:0});break}d.appendChild($horz[0]);var $vert=$('<div/>').css(common).css({top:0,bottom:0,width:'1px',height:width+'px'});switch(c){case'TL':$vert.css({left:width});break;case'TR':$vert.css({right:width});break;case'BL':$vert.css({left:width});break;case'BR':$vert.css({right:width});break}d.appendChild($vert[0])}}}}})};$.fn.uncorner=function(){if(radius||moz||webkit)this.css(radius?'border-radius':moz?'-moz-border-radius':'-webkit-border-radius',0);$('div.jquery-corner',this).remove();return this};$.fn.corner.defaults={useNative:true,metaAttr:'data-corner'}})(jQuery);


// Cycle

// [> img] = [> *]
// [maxZ:100] = [maxZ:38]
(function(e){"use strict";function t(e){return(e||"").toLowerCase()}var i="20130409";e.fn.cycle=function(i){var n;return 0!==this.length||e.isReady?this.each(function(){var n,s,o,c,r=e(this),l=e.fn.cycle.log;if(!r.data("cycle.opts")){(r.data("cycle-log")===!1||i&&i.log===!1||s&&s.log===!1)&&(l=e.noop),l("--c2 init--"),n=r.data();for(var a in n)n.hasOwnProperty(a)&&/^cycle[A-Z]+/.test(a)&&(c=n[a],o=a.match(/^cycle(.*)/)[1].replace(/^[A-Z]/,t),l(o+":",c,"("+typeof c+")"),n[o]=c);s=e.extend({},e.fn.cycle.defaults,n,i||{}),s.timeoutId=0,s.paused=s.paused||!1,s.container=r,s._maxZ=s.maxZ,s.API=e.extend({_container:r},e.fn.cycle.API),s.API.log=l,s.API.trigger=function(e,t){return s.container.trigger(e,t),s.API},r.data("cycle.opts",s),r.data("cycle.API",s.API),s.API.trigger("cycle-bootstrap",[s,s.API]),s.API.addInitialSlides(),s.API.preInitSlideshow(),s.slides.length&&s.API.initSlideshow()}}):(n={s:this.selector,c:this.context},e.fn.cycle.log("requeuing slideshow (dom not ready)"),e(function(){e(n.s,n.c).cycle(i)}),this)},e.fn.cycle.API={opts:function(){return this._container.data("cycle.opts")},addInitialSlides:function(){var t=this.opts(),i=t.slides;t.slideCount=0,t.slides=e(),i=i.jquery?i:t.container.find(i),t.random&&i.sort(function(){return Math.random()-.5}),t.API.add(i)},preInitSlideshow:function(){var t=this.opts();t.API.trigger("cycle-pre-initialize",[t]);var i=e.fn.cycle.transitions[t.fx];i&&e.isFunction(i.preInit)&&i.preInit(t),t._preInitialized=!0},postInitSlideshow:function(){var t=this.opts();t.API.trigger("cycle-post-initialize",[t]);var i=e.fn.cycle.transitions[t.fx];i&&e.isFunction(i.postInit)&&i.postInit(t)},initSlideshow:function(){var t,i=this.opts(),n=i.container;i.API.calcFirstSlide(),"static"==i.container.css("position")&&i.container.css("position","relative"),e(i.slides[i.currSlide]).css("opacity",1).show(),i.API.stackSlides(i.slides[i.currSlide],i.slides[i.nextSlide],!i.reverse),i.pauseOnHover&&(i.pauseOnHover!==!0&&(n=e(i.pauseOnHover)),n.hover(function(){i.API.pause(!0)},function(){i.API.resume(!0)})),i.timeout&&(t=i.API.getSlideOpts(i.nextSlide),i.API.queueTransition(t,t.timeout+i.delay)),i._initialized=!0,i.API.updateView(!0),i.API.trigger("cycle-initialized",[i]),i.API.postInitSlideshow()},pause:function(t){var i=this.opts(),n=i.API.getSlideOpts(),s=i.hoverPaused||i.paused;t?i.hoverPaused=!0:i.paused=!0,s||(i.container.addClass("cycle-paused"),i.API.trigger("cycle-paused",[i]).log("cycle-paused"),n.timeout&&(clearTimeout(i.timeoutId),i.timeoutId=0,i._remainingTimeout-=e.now()-i._lastQueue,(0>i._remainingTimeout||isNaN(i._remainingTimeout))&&(i._remainingTimeout=void 0)))},resume:function(e){var t=this.opts(),i=!t.hoverPaused&&!t.paused;e?t.hoverPaused=!1:t.paused=!1,i||(t.container.removeClass("cycle-paused"),t.API.queueTransition(t.API.getSlideOpts(),t._remainingTimeout),t.API.trigger("cycle-resumed",[t,t._remainingTimeout]).log("cycle-resumed"))},add:function(t,i){var n,s=this.opts(),o=s.slideCount,c=!1;"string"==e.type(t)&&(t=e.trim(t)),e(t).each(function(){var t,n=e(this);i?s.container.prepend(n):s.container.append(n),s.slideCount++,t=s.API.buildSlideOpts(n),s.slides=i?e(n).add(s.slides):s.slides.add(n),s.API.initSlide(t,n,--s._maxZ),n.data("cycle.opts",t),s.API.trigger("cycle-slide-added",[s,t,n])}),s.API.updateView(!0),c=s._preInitialized&&2>o&&s.slideCount>=1,c&&(s._initialized?s.timeout&&(n=s.slides.length,s.nextSlide=s.reverse?n-1:1,s.timeoutId||s.API.queueTransition(s)):s.API.initSlideshow())},calcFirstSlide:function(){var e,t=this.opts();e=parseInt(t.startingSlide||0,10),(e>=t.slides.length||0>e)&&(e=0),t.currSlide=e,t.reverse?(t.nextSlide=e-1,0>t.nextSlide&&(t.nextSlide=t.slides.length-1)):(t.nextSlide=e+1,t.nextSlide==t.slides.length&&(t.nextSlide=0))},calcNextSlide:function(){var e,t=this.opts();t.reverse?(e=0>t.nextSlide-1,t.nextSlide=e?t.slideCount-1:t.nextSlide-1,t.currSlide=e?0:t.nextSlide+1):(e=t.nextSlide+1==t.slides.length,t.nextSlide=e?0:t.nextSlide+1,t.currSlide=e?t.slides.length-1:t.nextSlide-1)},calcTx:function(t,i){var n,s=t;return i&&s.manualFx&&(n=e.fn.cycle.transitions[s.manualFx]),n||(n=e.fn.cycle.transitions[s.fx]),n||(n=e.fn.cycle.transitions.fade,s.API.log('Transition "'+s.fx+'" not found.  Using fade.')),n},prepareTx:function(e,t){var i,n,s,o,c,r=this.opts();return 2>r.slideCount?(r.timeoutId=0,void 0):(!e||r.busy&&!r.manualTrump||(r.API.stopTransition(),r.busy=!1,clearTimeout(r.timeoutId),r.timeoutId=0),r.busy||(0!==r.timeoutId||e)&&(n=r.slides[r.currSlide],s=r.slides[r.nextSlide],o=r.API.getSlideOpts(r.nextSlide),c=r.API.calcTx(o,e),r._tx=c,e&&void 0!==o.manualSpeed&&(o.speed=o.manualSpeed),r.nextSlide!=r.currSlide&&(e||!r.paused&&!r.hoverPaused&&r.timeout)?(r.API.trigger("cycle-before",[o,n,s,t]),c.before&&c.before(o,n,s,t),i=function(){r.busy=!1,r.container.data("cycle.opts")&&(c.after&&c.after(o,n,s,t),r.API.trigger("cycle-after",[o,n,s,t]),r.API.queueTransition(o),r.API.updateView(!0))},r.busy=!0,c.transition?c.transition(o,n,s,t,i):r.API.doTransition(o,n,s,t,i),r.API.calcNextSlide(),r.API.updateView()):r.API.queueTransition(o)),void 0)},doTransition:function(t,i,n,s,o){var c=t,r=e(i),l=e(n),a=function(){l.animate(c.animIn||{opacity:1},c.speed,c.easeIn||c.easing,o)};l.css(c.cssBefore||{}),r.animate(c.animOut||{},c.speed,c.easeOut||c.easing,function(){r.css(c.cssAfter||{}),c.sync||a()}),c.sync&&a()},queueTransition:function(t,i){var n=this.opts(),s=void 0!==i?i:t.timeout;return 0===n.nextSlide&&0===--n.loop?(n.API.log("terminating; loop=0"),n.timeout=0,s?setTimeout(function(){n.API.trigger("cycle-finished",[n])},s):n.API.trigger("cycle-finished",[n]),n.nextSlide=n.currSlide,void 0):(s&&(n._lastQueue=e.now(),void 0===i&&(n._remainingTimeout=t.timeout),n.paused||n.hoverPaused||(n.timeoutId=setTimeout(function(){n.API.prepareTx(!1,!n.reverse)},s))),void 0)},stopTransition:function(){var e=this.opts();e.slides.filter(":animated").length&&(e.slides.stop(!1,!0),e.API.trigger("cycle-transition-stopped",[e])),e._tx&&e._tx.stopTransition&&e._tx.stopTransition(e)},advanceSlide:function(e){var t=this.opts();return clearTimeout(t.timeoutId),t.timeoutId=0,t.nextSlide=t.currSlide+e,0>t.nextSlide?t.nextSlide=t.slides.length-1:t.nextSlide>=t.slides.length&&(t.nextSlide=0),t.API.prepareTx(!0,e>=0),!1},buildSlideOpts:function(i){var n,s,o=this.opts(),c=i.data()||{};for(var r in c)c.hasOwnProperty(r)&&/^cycle[A-Z]+/.test(r)&&(n=c[r],s=r.match(/^cycle(.*)/)[1].replace(/^[A-Z]/,t),o.API.log("["+(o.slideCount-1)+"]",s+":",n,"("+typeof n+")"),c[s]=n);c=e.extend({},e.fn.cycle.defaults,o,c),c.slideNum=o.slideCount;try{delete c.API,delete c.slideCount,delete c.currSlide,delete c.nextSlide,delete c.slides}catch(l){}return c},getSlideOpts:function(t){var i=this.opts();void 0===t&&(t=i.currSlide);var n=i.slides[t],s=e(n).data("cycle.opts");return e.extend({},i,s)},initSlide:function(t,i,n){var s=this.opts();i.css(t.slideCss||{}),n>0&&i.css("zIndex",n),isNaN(t.speed)&&(t.speed=e.fx.speeds[t.speed]||e.fx.speeds._default),t.sync||(t.speed=t.speed/2),i.addClass(s.slideClass)},updateView:function(e){var t=this.opts();if(t._initialized){var i=t.API.getSlideOpts(),n=t.slides[t.currSlide];!e&&(t.API.trigger("cycle-update-view-before",[t,i,n]),0>t.updateView)||(t.slideActiveClass&&t.slides.removeClass(t.slideActiveClass).eq(t.currSlide).addClass(t.slideActiveClass),e&&t.hideNonActive&&t.slides.filter(":not(."+t.slideActiveClass+")").hide(),t.API.trigger("cycle-update-view",[t,i,n,e]),t.API.trigger("cycle-update-view-after",[t,i,n]))}},getComponent:function(t){var i=this.opts(),n=i[t];return"string"==typeof n?/^\s*[\>|\+|~]/.test(n)?i.container.find(n):e(n):n.jquery?n:e(n)},stackSlides:function(t,i,n){var s=this.opts();t||(t=s.slides[s.currSlide],i=s.slides[s.nextSlide],n=!s.reverse),e(t).css("zIndex",s.maxZ);var o,c=s.maxZ-2,r=s.slideCount;if(n){for(o=s.currSlide+1;r>o;o++)e(s.slides[o]).css("zIndex",c--);for(o=0;s.currSlide>o;o++)e(s.slides[o]).css("zIndex",c--)}else{for(o=s.currSlide-1;o>=0;o--)e(s.slides[o]).css("zIndex",c--);for(o=r-1;o>s.currSlide;o--)e(s.slides[o]).css("zIndex",c--)}e(i).css("zIndex",s.maxZ-1)},getSlideIndex:function(e){return this.opts().slides.index(e)}},e.fn.cycle.log=function(){window.console&&console.log&&console.log("[cycle2] "+Array.prototype.join.call(arguments," "))},e.fn.cycle.version=function(){return"Cycle2: "+i},e.fn.cycle.transitions={custom:{},none:{before:function(e,t,i,n){e.API.stackSlides(i,t,n),e.cssBefore={opacity:1,display:"block"}}},fade:{before:function(t,i,n,s){var o=t.API.getSlideOpts(t.nextSlide).slideCss||{};t.API.stackSlides(i,n,s),t.cssBefore=e.extend(o,{opacity:0,display:"block"}),t.animIn={opacity:1},t.animOut={opacity:0}}},fadeout:{before:function(t,i,n,s){var o=t.API.getSlideOpts(t.nextSlide).slideCss||{};t.API.stackSlides(i,n,s),t.cssBefore=e.extend(o,{opacity:1,display:"block"}),t.animOut={opacity:0}}},scrollHorz:{before:function(e,t,i,n){e.API.stackSlides(t,i,n);var s=e.container.css("overflow","hidden").width();e.cssBefore={left:n?s:-s,top:0,opacity:1,display:"block"},e.cssAfter={zIndex:e._maxZ-2,left:0},e.animIn={left:0},e.animOut={left:n?-s:s}}}},e.fn.cycle.defaults={allowWrap:!0,autoSelector:".cycle-slideshow[data-cycle-auto-init!=false]",delay:0,easing:null,fx:"fade",hideNonActive:!0,loop:0,manualFx:void 0,manualSpeed:void 0,manualTrump:!0,maxZ:38,pauseOnHover:!1,reverse:!1,slideActiveClass:"cycle-slide-active",slideClass:"cycle-slide",slideCss:{position:"absolute",top:0,left:0},slides:"> *",speed:500,startingSlide:0,sync:!0,timeout:4e3,updateView:-1},e(document).ready(function(){e(e.fn.cycle.defaults.autoSelector).cycle()})})(jQuery),function(e){"use strict";function t(t,n){var s,o,c,r=n.autoHeight;if("container"==r)o=e(n.slides[n.currSlide]).outerHeight(),n.container.height(o);else if(n._autoHeightRatio)n.container.height(n.container.width()/n._autoHeightRatio);else if("calc"===r||"number"==e.type(r)&&r>=0){if(c="calc"===r?i(t,n):r>=n.slides.length?0:r,c==n._sentinelIndex)return;n._sentinelIndex=c,n._sentinel&&n._sentinel.remove(),s=e(n.slides[c].cloneNode(!0)),s.removeAttr("id name rel").find("[id],[name],[rel]").removeAttr("id name rel"),s.css({position:"static",visibility:"hidden",display:"block"}).prependTo(n.container).addClass("cycle-sentinel cycle-slide").removeClass("cycle-slide-active"),s.find("*").css("visibility","hidden"),n._sentinel=s}}function i(t,i){var n=0,s=-1;return i.slides.each(function(t){var i=e(this).height();i>s&&(s=i,n=t)}),n}function n(t,i,n,s){var o=e(s).outerHeight(),c=i.sync?i.speed/2:i.speed;i.container.animate({height:o},c)}function s(i,o){o._autoHeightOnResize&&(e(window).off("resize orientationchange",o._autoHeightOnResize),o._autoHeightOnResize=null),o.container.off("cycle-slide-added cycle-slide-removed",t),o.container.off("cycle-destroyed",s),o.container.off("cycle-before",n),o._sentinel&&(o._sentinel.remove(),o._sentinel=null)}e.extend(e.fn.cycle.defaults,{autoHeight:0}),e(document).on("cycle-initialized",function(i,o){function c(){t(i,o)}var r,l=o.autoHeight,a=e.type(l),d=null;("string"===a||"number"===a)&&(o.container.on("cycle-slide-added cycle-slide-removed",t),o.container.on("cycle-destroyed",s),"container"==l?o.container.on("cycle-before",n):"string"===a&&/\d+\:\d+/.test(l)&&(r=l.match(/(\d+)\:(\d+)/),r=r[1]/r[2],o._autoHeightRatio=r),"number"!==a&&(o._autoHeightOnResize=function(){clearTimeout(d),d=setTimeout(c,50)},e(window).on("resize orientationchange",o._autoHeightOnResize)),setTimeout(c,30))})}(jQuery),function(e){"use strict";e.extend(e.fn.cycle.defaults,{caption:"> .cycle-caption",captionTemplate:"{{slideNum}} / {{slideCount}}",overlay:"> .cycle-overlay",overlayTemplate:"<div>{{title}}</div><div>{{desc}}</div>",captionModule:"caption"}),e(document).on("cycle-update-view",function(t,i,n,s){"caption"===i.captionModule&&e.each(["caption","overlay"],function(){var e=this,t=n[e+"Template"],o=i.API.getComponent(e);o.length&&t?(o.html(i.API.tmpl(t,n,i,s)),o.show()):o.hide()})}),e(document).on("cycle-destroyed",function(t,i){var n;e.each(["caption","overlay"],function(){var e=this,t=i[e+"Template"];i[e]&&t&&(n=i.API.getComponent("caption"),n.empty())})})}(jQuery),function(e){"use strict";var t=e.fn.cycle;e.fn.cycle=function(i){var n,s,o,c=e.makeArray(arguments);return"number"==e.type(i)?this.cycle("goto",i):"string"==e.type(i)?this.each(function(){var r;return n=i,o=e(this).data("cycle.opts"),void 0===o?(t.log('slideshow must be initialized before sending commands; "'+n+'" ignored'),void 0):(n="goto"==n?"jump":n,s=o.API[n],e.isFunction(s)?(r=e.makeArray(c),r.shift(),s.apply(o.API,r)):(t.log("unknown command: ",n),void 0))}):t.apply(this,arguments)},e.extend(e.fn.cycle,t),e.extend(t.API,{next:function(){var e=this.opts();if(!e.busy||e.manualTrump){var t=e.reverse?-1:1;e.allowWrap===!1&&e.currSlide+t>=e.slideCount||(e.API.advanceSlide(t),e.API.trigger("cycle-next",[e]).log("cycle-next"))}},prev:function(){var e=this.opts();if(!e.busy||e.manualTrump){var t=e.reverse?1:-1;e.allowWrap===!1&&0>e.currSlide+t||(e.API.advanceSlide(t),e.API.trigger("cycle-prev",[e]).log("cycle-prev"))}},destroy:function(){this.stop();var t=this.opts(),i=e.isFunction(e._data)?e._data:e.noop;clearTimeout(t.timeoutId),t.timeoutId=0,t.API.stop(),t.API.trigger("cycle-destroyed",[t]).log("cycle-destroyed"),t.container.removeData(),i(t.container[0],"parsedAttrs",!1),t.retainStylesOnDestroy||(t.container.removeAttr("style"),t.slides.removeAttr("style"),t.slides.removeClass("cycle-slide-active")),t.slides.each(function(){e(this).removeData(),i(this,"parsedAttrs",!1)})},jump:function(e){var t,i=this.opts();if(!i.busy||i.manualTrump){var n=parseInt(e,10);if(isNaN(n)||0>n||n>=i.slides.length)return i.API.log("goto: invalid slide index: "+n),void 0;if(n==i.currSlide)return i.API.log("goto: skipping, already on slide",n),void 0;i.nextSlide=n,clearTimeout(i.timeoutId),i.timeoutId=0,i.API.log("goto: ",n," (zero-index)"),t=i.currSlide<i.nextSlide,i.API.prepareTx(!0,t)}},stop:function(){var t=this.opts(),i=t.container;clearTimeout(t.timeoutId),t.timeoutId=0,t.API.stopTransition(),t.pauseOnHover&&(t.pauseOnHover!==!0&&(i=e(t.pauseOnHover)),i.off("mouseenter mouseleave")),t.API.trigger("cycle-stopped",[t]).log("cycle-stopped")},reinit:function(){var e=this.opts();e.API.destroy(),e.container.cycle()},remove:function(t){for(var i,n,s=this.opts(),o=[],c=1,r=0;s.slides.length>r;r++)i=s.slides[r],r==t?n=i:(o.push(i),e(i).data("cycle.opts").slideNum=c,c++);n&&(s.slides=e(o),s.slideCount--,e(n).remove(),t==s.currSlide&&s.API.advanceSlide(1),s.API.trigger("cycle-slide-removed",[s,t,n]).log("cycle-slide-removed"),s.API.updateView())}}),e(document).on("click.cycle","[data-cycle-cmd]",function(t){t.preventDefault();var i=e(this),n=i.data("cycle-cmd"),s=i.data("cycle-context")||".cycle-slideshow";e(s).cycle(n,i.data("cycle-arg"))})}(jQuery),function(e){"use strict";function t(t,i){var n;return t._hashFence?(t._hashFence=!1,void 0):(n=window.location.hash.substring(1),t.slides.each(function(s){return e(this).data("cycle-hash")==n?(i===!0?t.startingSlide=s:(t.nextSlide=s,t.API.prepareTx(!0,!1)),!1):void 0}),void 0)}e(document).on("cycle-pre-initialize",function(i,n){t(n,!0),n._onHashChange=function(){t(n,!1)},e(window).on("hashchange",n._onHashChange)}),e(document).on("cycle-update-view",function(e,t,i){i.hash&&(t._hashFence=!0,window.location.hash=i.hash)}),e(document).on("cycle-destroyed",function(t,i){i._onHashChange&&e(window).off("hashchange",i._onHashChange)})}(jQuery),function(e){"use strict";e.extend(e.fn.cycle.defaults,{loader:!1}),e(document).on("cycle-bootstrap",function(t,i){function n(t,n){function o(t){var o;"wait"==i.loader?(r.push(t),0===a&&(r.sort(c),s.apply(i.API,[r,n]),i.container.removeClass("cycle-loading"))):(o=e(i.slides[i.currSlide]),s.apply(i.API,[t,n]),o.show(),i.container.removeClass("cycle-loading"))}function c(e,t){return e.data("index")-t.data("index")}var r=[];if("string"==e.type(t))t=e.trim(t);else if("array"===e.type(t))for(var l=0;t.length>l;l++)t[l]=e(t[l])[0];t=e(t);var a=t.length;a&&(t.hide().appendTo("body").each(function(t){function c(){0===--l&&(--a,o(d))}var l=0,d=e(this),u=d.is("img")?d:d.find("img");return d.data("index",t),u=u.filter(":not(.cycle-loader-ignore)").filter(':not([src=""])'),u.length?(l=u.length,u.each(function(){this.complete?c():e(this).load(function(){c()}).error(function(){0===--l&&(i.API.log("slide skipped; img not loaded:",this.src),0===--a&&"wait"==i.loader&&s.apply(i.API,[r,n]))})}),void 0):(--a,r.push(d),void 0)}),a&&i.container.addClass("cycle-loading"))}var s;i.loader&&(s=i.API.add,i.API.add=n)})}(jQuery),function(e){"use strict";function t(t,i,n){var s,o=t.API.getComponent("pager");o.each(function(){var o=e(this);if(i.pagerTemplate){var c=t.API.tmpl(i.pagerTemplate,i,t,n[0]);s=e(c).appendTo(o)}else s=o.children().eq(t.slideCount-1);s.on(t.pagerEvent,function(e){e.preventDefault(),t.API.page(o,e.currentTarget)})})}function i(e,t){var i=this.opts();if(!i.busy||i.manualTrump){var n=e.children().index(t),s=n,o=s>i.currSlide;i.currSlide!=s&&(i.nextSlide=s,i.API.prepareTx(!0,o),i.API.trigger("cycle-pager-activated",[i,e,t]))}}e.extend(e.fn.cycle.defaults,{pager:"> .cycle-pager",pagerActiveClass:"cycle-pager-active",pagerEvent:"click.cycle",pagerTemplate:"<span>&bull;</span>"}),e(document).on("cycle-bootstrap",function(e,i,n){n.buildPagerLink=t}),e(document).on("cycle-slide-added",function(e,t,n,s){t.pager&&(t.API.buildPagerLink(t,n,s),t.API.page=i)}),e(document).on("cycle-slide-removed",function(t,i,n){if(i.pager){var s=i.API.getComponent("pager");s.each(function(){var t=e(this);e(t.children()[n]).remove()})}}),e(document).on("cycle-update-view",function(t,i){var n;i.pager&&(n=i.API.getComponent("pager"),n.each(function(){e(this).children().removeClass(i.pagerActiveClass).eq(i.currSlide).addClass(i.pagerActiveClass)}))}),e(document).on("cycle-destroyed",function(e,t){var i=t.API.getComponent("pager");i&&(i.children().off(t.pagerEvent),t.pagerTemplate&&i.empty())})}(jQuery),function(e){"use strict";e.extend(e.fn.cycle.defaults,{next:"> .cycle-next",nextEvent:"click.cycle",disabledClass:"disabled",prev:"> .cycle-prev",prevEvent:"click.cycle",swipe:!1}),e(document).on("cycle-initialized",function(e,t){if(t.API.getComponent("next").on(t.nextEvent,function(e){e.preventDefault(),t.API.next()}),t.API.getComponent("prev").on(t.prevEvent,function(e){e.preventDefault(),t.API.prev()}),t.swipe){var i=t.swipeVert?"swipeUp.cycle":"swipeLeft.cycle swipeleft.cycle",n=t.swipeVert?"swipeDown.cycle":"swipeRight.cycle swiperight.cycle";t.container.on(i,function(){t.API.next()}),t.container.on(n,function(){t.API.prev()})}}),e(document).on("cycle-update-view",function(e,t){if(!t.allowWrap){var i=t.disabledClass,n=t.API.getComponent("next"),s=t.API.getComponent("prev"),o=t._prevBoundry||0,c=t._nextBoundry||t.slideCount-1;t.currSlide==c?n.addClass(i).prop("disabled",!0):n.removeClass(i).prop("disabled",!1),t.currSlide===o?s.addClass(i).prop("disabled",!0):s.removeClass(i).prop("disabled",!1)}}),e(document).on("cycle-destroyed",function(e,t){t.API.getComponent("prev").off(t.nextEvent),t.API.getComponent("next").off(t.prevEvent),t.container.off("swipeleft.cycle swiperight.cycle swipeLeft.cycle swipeRight.cycle swipeUp.cycle swipeDown.cycle")})}(jQuery),function(e){"use strict";e.extend(e.fn.cycle.defaults,{progressive:!1}),e(document).on("cycle-pre-initialize",function(t,i){if(i.progressive){var n,s,o=i.API,c=o.next,r=o.prev,l=o.prepareTx,a=e.type(i.progressive);if("array"==a)n=i.progressive;else if(e.isFunction(i.progressive))n=i.progressive(i);else if("string"==a){if(s=e(i.progressive),n=e.trim(s.html()),!n)return;if(/^(\[)/.test(n))try{n=e.parseJSON(n)}catch(d){return o.log("error parsing progressive slides",d),void 0}else n=n.split(RegExp(s.data("cycle-split")||"\n")),n[n.length-1]||n.pop()}l&&(o.prepareTx=function(e,t){var s,o;return e||0===n.length?(l.apply(i.API,[e,t]),void 0):(t&&i.currSlide==i.slideCount-1?(o=n[0],n=n.slice(1),i.container.one("cycle-slide-added",function(e,t){setTimeout(function(){t.API.advanceSlide(1)},50)}),i.API.add(o)):t||0!==i.currSlide?l.apply(i.API,[e,t]):(s=n.length-1,o=n[s],n=n.slice(0,s),i.container.one("cycle-slide-added",function(e,t){setTimeout(function(){t.currSlide=1,t.API.advanceSlide(-1)},50)}),i.API.add(o,!0)),void 0)}),c&&(o.next=function(){var e=this.opts();if(n.length&&e.currSlide==e.slideCount-1){var t=n[0];n=n.slice(1),e.container.one("cycle-slide-added",function(e,t){c.apply(t.API),t.container.removeClass("cycle-loading")}),e.container.addClass("cycle-loading"),e.API.add(t)}else c.apply(e.API)}),r&&(o.prev=function(){var e=this.opts();if(n.length&&0===e.currSlide){var t=n.length-1,i=n[t];n=n.slice(0,t),e.container.one("cycle-slide-added",function(e,t){t.currSlide=1,t.API.advanceSlide(-1),t.container.removeClass("cycle-loading")}),e.container.addClass("cycle-loading"),e.API.add(i,!0)}else r.apply(e.API)})}})}(jQuery),function(e){"use strict";e.extend(e.fn.cycle.defaults,{tmplRegex:"{{((.)?.*?)}}"}),e.extend(e.fn.cycle.API,{tmpl:function(t,i){var n=RegExp(i.tmplRegex||e.fn.cycle.defaults.tmplRegex,"g"),s=e.makeArray(arguments);return s.shift(),t.replace(n,function(t,i){var n,o,c,r,l=i.split(".");for(n=0;s.length>n;n++)if(c=s[n]){if(l.length>1)for(r=c,o=0;l.length>o;o++)c=r,r=r[l[o]]||i;else r=c[i];if(e.isFunction(r))return r.apply(c,s);if(void 0!==r&&null!==r&&r!=i)return r}return i})}})}(jQuery);
(function(a){"use strict",a.fn.cycle.transitions.scrollVert={before:function(a,b,c,d){a.API.stackSlides(a,b,c,d);var e=a.container.css("overflow","hidden").height();a.cssBefore={top:d?-e:e,left:0,opacity:1,display:"block"},a.animIn={top:0},a.animOut={top:d?e:-e}}}})(jQuery);
(function(a){"use strict",a.extend(a.fn.cycle.defaults,{centerHorz:!1,centerVert:!1}),a(document).on("cycle-pre-initialize",function(b,c){function f(){clearTimeout(d),d=setTimeout(i,50)}function g(b,c){clearTimeout(d),clearTimeout(e),a(window).off("resize orientationchange",f)}function h(){c.slides.each(j)}function i(){j.apply(c.container.find(c.slideActiveClass)),clearTimeout(e),e=setTimeout(h,50)}function j(){var b=a(this),d=c.container.width(),e=c.container.height(),f=b.width(),g=b.height();c.centerHorz&&f<d&&b.css("marginLeft",(d-f)/2),c.centerVert&&g<e&&b.css("marginTop",(e-g)/2)}if(!c.centerHorz&&!c.centerVert)return;var d,e;a(window).on("resize orientationchange",f),c.container.on("cycle-destroyed",g),c.container.on("cycle-initialized cycle-slide-added cycle-slide-removed",function(a,b,c,d){i()}),i()})})(jQuery);
(function(e){"use strict";e.event.special.swipe=e.event.special.swipe||{scrollSupressionThreshold:10,durationThreshold:1e3,horizontalDistanceThreshold:30,verticalDistanceThreshold:75,setup:function(){var i=e(this);i.bind("touchstart",function(t){function n(i){if(r){var t=i.originalEvent.touches?i.originalEvent.touches[0]:i;s={time:(new Date).getTime(),coords:[t.pageX,t.pageY]},Math.abs(r.coords[0]-s.coords[0])>e.event.special.swipe.scrollSupressionThreshold&&i.preventDefault()}}var s,o=t.originalEvent.touches?t.originalEvent.touches[0]:t,r={time:(new Date).getTime(),coords:[o.pageX,o.pageY],origin:e(t.target)};i.bind("touchmove",n).one("touchend",function(){i.unbind("touchmove",n),r&&s&&s.time-r.time<e.event.special.swipe.durationThreshold&&Math.abs(r.coords[0]-s.coords[0])>e.event.special.swipe.horizontalDistanceThreshold&&Math.abs(r.coords[1]-s.coords[1])<e.event.special.swipe.verticalDistanceThreshold&&r.origin.trigger("swipe").trigger(r.coords[0]>s.coords[0]?"swipeleft":"swiperight"),r=s=void 0})})}},e.event.special.swipeleft=e.event.special.swipeleft||{setup:function(){e(this).bind("swipe",e.noop)}},e.event.special.swiperight=e.event.special.swiperight||e.event.special.swipeleft})(jQuery);


// Draggable

!function(a){function f(a,b){if(!(a.originalEvent.touches.length>1)){a.preventDefault();var c=a.originalEvent.changedTouches[0],d=document.createEvent("MouseEvents");d.initMouseEvent(b,!0,!0,window,1,c.screenX,c.screenY,c.clientX,c.clientY,!1,!1,!1,!1,0,null),a.target.dispatchEvent(d)}}if(a.support.touch="ontouchend"in document,a.support.touch){var e,b=a.ui.mouse.prototype,c=b._mouseInit,d=b._mouseDestroy;b._touchStart=function(a){var b=this;!e&&b._mouseCapture(a.originalEvent.changedTouches[0])&&(e=!0,b._touchMoved=!1,f(a,"mouseover"),f(a,"mousemove"),f(a,"mousedown"))},b._touchMove=function(a){e&&(this._touchMoved=!0,f(a,"mousemove"))},b._touchEnd=function(a){e&&(f(a,"mouseup"),f(a,"mouseout"),this._touchMoved||f(a,"click"),e=!1)},b._mouseInit=function(){var b=this;b.element.bind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),c.call(b)},b._mouseDestroy=function(){var b=this;b.element.unbind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),d.call(b)}}}(jQuery);
jQuery('.ui-slider-handle').draggable();


// Easing

jQuery.extend(jQuery.easing,{def:'easeOutQuad',swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d);},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b;},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b;},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t+b;return-c/2*((--t)*(t-2)-1)+b;},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b;},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b;},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b;},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b;},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b;},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b;},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b;},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b;},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b;},easeInSine:function(x,t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b;},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b;},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b;},easeInExpo:function(x,t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b;},easeOutExpo:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b;},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b;},easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b;},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b;},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b;},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b;},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4;}else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b;},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b;},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b;},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b;},easeInBounce:function(x,t,b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b;},easeOutBounce:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b;}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b;}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b;}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b;}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return jQuery.easing.easeInBounce(x,t*2,0,c,d)*.5+b;return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*.5+c*.5+b;}});


// Fade

(function($){$.fn.customFadeIn=function(speed,callback){$(this).fadeIn(speed,function(){if(!$.support.opacity)$(this).get(0).style.removeAttribute('filter');if(callback!=undefined)callback()});return this};$.fn.customFadeOut=function(speed,callback){$(this).fadeOut(speed,function(){if(!$.support.opacity)$(this).get(0).style.removeAttribute('filter');if(callback!=undefined)callback()});return this};$.fn.customFadeTo=function(speed,opaque,callback){if(!$.support.opacity)opaque=1;$(this).fadeTo(speed,opaque,function(){if(!$.support.opacity)$(this).get(0).style.removeAttribute('filter');if(callback!=undefined)callback()});return this};$.each(['prev','next'],function(unusedIndex,name){$.fn[name+'ALL']=function(matchExpr){var $all=$('body').find('*').andSelf();$all=(name=='prev')?$all.slice(0,$all.index(this)).reverse():$all.slice($all.index(this)+1);if(matchExpr)$all=$all.filter(matchExpr);return $all}});$.fn.reverse=function(){return this.pushStack(this.get().reverse(),arguments)}})(jQuery);


// Hover

(function($){$.fn.hoverIntent=function(f,g){var cfg={sensitivity:7,interval:50,timeout:0};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY;};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev]);}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev]);};var handleHover=function(e){var p=(e.type=="mouseover"?e.fromElement:e.toElement)||e.relatedTarget;while(p&&p!=this){try{p=p.parentNode;}catch(e){p=this;}}if(p==this){return false;}var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);}if(e.type=="mouseover"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob);},cfg.timeout);}}};return this.mouseover(handleHover).mouseout(handleHover);};})(jQuery);


// Load

!function(a,b,c,d){var e=a(b);a.fn.lazyload=function(f){function g(){var b=0;i.each(function(){var c=a(this);if(!j.skip_invisible||c.is(":visible"))if(a.abovethetop(this,j)||a.leftofbegin(this,j));else if(a.belowthefold(this,j)||a.rightoffold(this,j)){if(++b>j.failure_limit)return!1}else c.trigger("appear"),b=0})}var h,i=this,j={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:b,data_attribute:"original",skip_invisible:!1,appear:null,load:null,placeholder:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"};return f&&(d!==f.failurelimit&&(f.failure_limit=f.failurelimit,delete f.failurelimit),d!==f.effectspeed&&(f.effect_speed=f.effectspeed,delete f.effectspeed),a.extend(j,f)),h=j.container===d||j.container===b?e:a(j.container),0===j.event.indexOf("scroll")&&h.bind(j.event,function(){return g()}),this.each(function(){var b=this,c=a(b);b.loaded=!1,(c.attr("src")===d||c.attr("src")===!1)&&c.is("img")&&c.attr("src",j.placeholder),c.one("appear",function(){if(!this.loaded){if(j.appear){var d=i.length;j.appear.call(b,d,j)}a("<img />").bind("load",function(){var d=c.attr("data-"+j.data_attribute);c.hide(),c.is("img")?c.attr("src",d):c.css("background-image","url('"+d+"')"),c[j.effect](j.effect_speed),b.loaded=!0;var e=a.grep(i,function(a){return!a.loaded});if(i=a(e),j.load){var f=i.length;j.load.call(b,f,j)}}).attr("src",c.attr("data-"+j.data_attribute))}}),0!==j.event.indexOf("scroll")&&c.bind(j.event,function(){b.loaded||c.trigger("appear")})}),e.bind("resize",function(){g()}),/(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion)&&e.bind("pageshow",function(b){b.originalEvent&&b.originalEvent.persisted&&i.each(function(){a(this).trigger("appear")})}),a(c).ready(function(){g()}),this},a.belowthefold=function(c,f){var g;return g=f.container===d||f.container===b?(b.innerHeight?b.innerHeight:e.height())+e.scrollTop():a(f.container).offset().top+a(f.container).height(),g<=a(c).offset().top-f.threshold},a.rightoffold=function(c,f){var g;return g=f.container===d||f.container===b?e.width()+e.scrollLeft():a(f.container).offset().left+a(f.container).width(),g<=a(c).offset().left-f.threshold},a.abovethetop=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollTop():a(f.container).offset().top,g>=a(c).offset().top+f.threshold+a(c).height()},a.leftofbegin=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollLeft():a(f.container).offset().left,g>=a(c).offset().left+f.threshold+a(c).width()},a.inviewport=function(b,c){return!(a.rightoffold(b,c)||a.leftofbegin(b,c)||a.belowthefold(b,c)||a.abovethetop(b,c))},a.extend(a.expr[":"],{"below-the-fold":function(b){return a.belowthefold(b,{threshold:0})},"above-the-top":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-screen":function(b){return a.rightoffold(b,{threshold:0})},"left-of-screen":function(b){return!a.rightoffold(b,{threshold:0})},"in-viewport":function(b){return a.inviewport(b,{threshold:0})},"above-the-fold":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-fold":function(b){return a.rightoffold(b,{threshold:0})},"left-of-fold":function(b){return!a.rightoffold(b,{threshold:0})}})}(jQuery,window,document);


// Placeholder

(function(b){function d(a){this.input=a;a.attr("type")=="password"&&this.handlePassword();b(a[0].form).submit(function(){if(a.hasClass("placeholder")&&a[0].value==a.attr("placeholder"))a[0].value=""})}d.prototype={show:function(a){if(this.input[0].value===""||a&&this.valueIsPlaceholder()){if(this.isPassword)try{this.input[0].setAttribute("type","text")}catch(b){this.input.before(this.fakePassword.show()).hide()}this.input.addClass("placeholder");this.input[0].value=this.input.attr("placeholder")}},hide:function(){if(this.valueIsPlaceholder()&&this.input.hasClass("placeholder")&&(this.input.removeClass("placeholder"),this.input[0].value="",this.isPassword)){try{this.input[0].setAttribute("type","password")}catch(a){}this.input.show();this.input[0].focus()}},valueIsPlaceholder:function(){return this.input[0].value==this.input.attr("placeholder")},handlePassword:function(){var a=this.input;a.attr("realType","password");this.isPassword=!0;if(b.browser.msie&&a[0].outerHTML){var c=b(a[0].outerHTML.replace(/type=(['"])?password\1/gi,"type=$1text$1"));this.fakePassword=c.val(a.attr("placeholder")).addClass("placeholder").focus(function(){a.trigger("focus");b(this).hide()});b(a[0].form).submit(function(){c.remove();a.show()})}}};var e=!!("placeholder"in document.createElement("input"));b.fn.placeholder=function(){return e?this:this.each(function(){var a=b(this),c=new d(a);c.show(!0);a.focus(function(){c.hide()});a.blur(function(){c.show(!1)});b.browser.msie&&(b(window).load(function(){a.val()&&a.removeClass("placeholder");c.show(!0)}),a.focus(function(){if(this.value==""){var a=this.createTextRange();a.collapse(!0);a.moveStart("character",0);a.select()}}))})}})(jQuery);


// Scrolling

(function($){var special=$.event.special,uid1='D'+(+new Date()),uid2='D'+(+new Date()+1);special.scrollstart={setup:function(){var timer,handler=function(evt){var _self=this,_args=arguments;if(timer){clearTimeout(timer)}else{evt.type='scrollstart';$.event.handle.apply(_self,_args)}timer=setTimeout(function(){timer=null},special.scrollstop.latency)};$(this).bind('scroll',handler).data(uid1,handler)},teardown:function(){$(this).unbind('scroll',$(this).data(uid1))}};special.scrollstop={latency:400,setup:function(){var timer,handler=function(evt){var _self=this,_args=arguments;if(timer){clearTimeout(timer)}timer=setTimeout(function(){timer=null;evt.type='scrollstop';$.event.handle.apply(_self,_args)},special.scrollstop.latency)};$(this).bind('scroll',handler).data(uid2,handler)},teardown:function(){$(this).unbind('scroll',$(this).data(uid2))}}})(jQuery);
(function($){var special=$.event.special,uid1='D'+(+new Date()),uid2='D'+(+new Date()+1);special.scrollstart={setup:function(){var timer,handler=function(evt){var _self=this,_args=arguments;if(timer){clearTimeout(timer)}else{evt.type='scrollstart';$.event.handle.apply(_self,_args)}timer=setTimeout(function(){timer=null},special.scrollstop2.latency)};$(this).bind('scroll',handler).data(uid1,handler)},teardown:function(){$(this).unbind('scroll',$(this).data(uid1))}};special.scrollstop2={latency:200,setup:function(){var timer,handler=function(evt){var _self=this,_args=arguments;if(timer){clearTimeout(timer)}timer=setTimeout(function(){timer=null;evt.type='scrollstop2';$.event.handle.apply(_self,_args)},special.scrollstop2.latency)};$(this).bind('scroll',handler).data(uid2,handler)},teardown:function(){$(this).unbind('scroll',$(this).data(uid2))}}})(jQuery);


// Timeout

(function($){var a={},c="doTimeout",d=Array.prototype.slice;$[c]=function(){return b.apply(window,[0].concat(d.call(arguments)))};$.fn[c]=function(){var f=d.call(arguments),e=b.apply(this,[c+f[0]].concat(f));return typeof f[0]==="number"||typeof f[1]==="number"?this:e};function b(l){var m=this,h,k={},g=l?$.fn:$,n=arguments,i=4,f=n[1],j=n[2],p=n[3];if(typeof f!=="string"){i--;f=l=0;j=n[1];p=n[2]}if(l){h=m.eq(0);h.data(l,k=h.data(l)||{})}else{if(f){k=a[f]||(a[f]={})}}k.id&&clearTimeout(k.id);delete k.id;function e(){if(l){h.removeData(l)}else{if(f){delete a[f]}}}function o(){k.id=setTimeout(function(){k.fn()},j)}if(p){k.fn=function(q){if(typeof p==="string"){p=g[p]}p.apply(m,d.call(n,i))===true&&!q?o():e()};o()}else{if(k.fn){j===undefined?e():k.fn(j===false);return true}else{e()}}}})(jQuery);


// Transition

(function(d){function k(a){var b=["Moz","Webkit","O","ms"],c=a.charAt(0).toUpperCase()+a.substr(1);if(a in i.style)return a;for(a=0;a<b.length;++a){var d=b[a]+c;if(d in i.style)return d}}function j(a){"string"===typeof a&&this.parse(a);return this}function p(a,b,c){!0===b?a.queue(c):b?a.queue(b,c):c()}function m(a){var b=[];d.each(a,function(a){a=d.camelCase(a);a=d.transit.propertyMap[a]||a;a=r(a);-1===d.inArray(a,b)&&b.push(a)});return b}function q(a,b,c,e){a=m(a);d.cssEase[c]&&(c=d.cssEase[c]);var h=""+n(b)+" "+c;0<parseInt(e,10)&&(h+=" "+n(e));var f=[];d.each(a,function(a,b){f.push(b+" "+h)});return f.join(", ")}function f(a,b){b||(d.cssNumber[a]=!0);d.transit.propertyMap[a]=e.transform;d.cssHooks[a]={get:function(b){return(d(b).css("transform")||new j).get(a)},set:function(b,e){var h=d(b).css("transform")||new j;h.setFromString(a,e);d(b).css({transform:h})}}}function r(a){return a.replace(/([A-Z])/g,function(a){return"-"+a.toLowerCase()})}function g(a,b){return"string"===typeof a&&!a.match(/^[\-0-9\.]+$/)?a:""+a+b}function n(a){d.fx.speeds[a]&&(a=d.fx.speeds[a]);return g(a,"ms")}d.transit={version:"0.1.3",propertyMap:{marginLeft:"margin",marginRight:"margin",marginBottom:"margin",marginTop:"margin",paddingLeft:"padding",paddingRight:"padding",paddingBottom:"padding",paddingTop:"padding"},enabled:!0,useTransitionEnd:!1};var i=document.createElement("div"),e={},s=-1<navigator.userAgent.toLowerCase().indexOf("chrome");e.transition=k("transition");e.transitionDelay=k("transitionDelay");e.transform=k("transform");e.transformOrigin=k("transformOrigin");i.style[e.transform]="";i.style[e.transform]="rotateY(90deg)";e.transform3d=""!==i.style[e.transform];d.extend(d.support,e);var o=e.transitionEnd={MozTransition:"transitionend",OTransition:"oTransitionEnd",WebkitTransition:"webkitTransitionEnd",msTransition:"MSTransitionEnd"}[e.transition]||null,i=null;d.cssEase={_default:"ease","in":"ease-in",out:"ease-out","in-out":"ease-in-out",snap:"cubic-bezier(0,1,.5,1)"};d.cssHooks.transform={get:function(a){return d(a).data("transform")},set:function(a,b){var c=b;c instanceof j||(c=new j(c));a.style[e.transform]="WebkitTransform"===e.transform&&!s?c.toString(!0):c.toString();d(a).data("transform",c)}};d.cssHooks.transformOrigin={get:function(a){return a.style[e.transformOrigin]},set:function(a,b){a.style[e.transformOrigin]=b}};d.cssHooks.transition={get:function(a){return a.style[e.transition]},set:function(a,b){a.style[e.transition]=b}};f("scale");f("translate");f("rotate");f("rotateX");f("rotateY");f("rotate3d");f("perspective");f("skewX");f("skewY");f("x",!0);f("y",!0);j.prototype={setFromString:function(a,b){var c="string"===typeof b?b.split(","):b.constructor===Array?b:[b];c.unshift(a);j.prototype.set.apply(this,c)},set:function(a){var b=Array.prototype.slice.apply(arguments,[1]);this.setter[a]?this.setter[a].apply(this,b):this[a]=b.join(",")},get:function(a){return this.getter[a]?this.getter[a].apply(this):this[a]||0},setter:{rotate:function(a){this.rotate=g(a,"deg")},rotateX:function(a){this.rotateX=g(a,"deg")},rotateY:function(a){this.rotateY=g(a,"deg")},scale:function(a,b){void 0===b&&(b=a);this.scale=a+","+b},skewX:function(a){this.skewX=g(a,"deg")},skewY:function(a){this.skewY=g(a,"deg")},perspective:function(a){this.perspective=g(a,"px")},x:function(a){this.set("translate",a,null)},y:function(a){this.set("translate",null,a)},translate:function(a,b){void 0===this._translateX&&(this._translateX=0);void 0===this._translateY&&(this._translateY=0);null!==a&&(this._translateX=g(a,"px"));null!==b&&(this._translateY=g(b,"px"));this.translate=this._translateX+","+this._translateY}},getter:{x:function(){return this._translateX||0},y:function(){return this._translateY||0},scale:function(){var a=(this.scale||"1,1").split(",");a[0]&&(a[0]=parseFloat(a[0]));a[1]&&(a[1]=parseFloat(a[1]));return a[0]===a[1]?a[0]:a},rotate3d:function(){for(var a=(this.rotate3d||"0,0,0,0deg").split(","),b=0;3>=b;++b)a[b]&&(a[b]=parseFloat(a[b]));a[3]&&(a[3]=g(a[3],"deg"));return a}},parse:function(a){var b=this;a.replace(/([a-zA-Z0-9]+)\((.*?)\)/g,function(a,d,e){b.setFromString(d,e)})},toString:function(a){var b=[],c;for(c in this)if(this.hasOwnProperty(c)&&(e.transform3d||!("rotateX"===c||"rotateY"===c||"perspective"===c||"transformOrigin"===c)))"_"!==c[0]&&(a&&"scale"===c?b.push(c+"3d("+this[c]+",1)"):a&&"translate"===c?b.push(c+"3d("+this[c]+",0)"):b.push(c+"("+this[c]+")"));return b.join(" ")}};d.fn.transition=d.fn.transit=function(a,b,c,f){var h=this,g=0,i=!0;"function"===typeof b&&(f=b,b=void 0);"function"===typeof c&&(f=c,c=void 0);"undefined"!==typeof a.easing&&(c=a.easing,delete a.easing);"undefined"!==typeof a.duration&&(b=a.duration,delete a.duration);"undefined"!==typeof a.complete&&(f=a.complete,delete a.complete);"undefined"!==typeof a.queue&&(i=a.queue,delete a.queue);"undefined"!==typeof a.delay&&(g=a.delay,delete a.delay);"undefined"===typeof b&&(b=d.fx.speeds._default);"undefined"===typeof c&&(c=d.cssEase._default);var b=n(b),j=q(a,b,c,g),l=d.transit.enabled&&e.transition?parseInt(b,10)+parseInt(g,10):0;if(0===l)return p(h,i,function(b){h.css(a);f&&f.apply(h);b&&b()}),h;var k={},m=function(b){var c=false,g=function(){c&&h.unbind(o,g);l>0&&h.each(function(){this.style[e.transition]=k[this]||null});typeof f==="function"&&f.apply(h);typeof b==="function"&&b()};if(l>0&&o&&d.transit.useTransitionEnd){c=true;h.bind(o,g)}else window.setTimeout(g,l);h.each(function(){l>0&&(this.style[e.transition]=j);d(this).css(a)})};p(h,i,function(a){var b=0;e.transition==="MozTransition"&&b<25&&(b=25);window.setTimeout(function(){m(a)},b)});return this};d.transit.getTransitionValue=q})(jQuery);jQuery.cssEase['easeOutQuad'] = 'ease-out';if (!jQuery.support.transition) jQuery.fn.transition = jQuery.fn.animate;


// Upload

// [% of ] = [% / ]
// [+"kB] = [+" "+"KB]
var qq=qq||{},qq=function(a){return{hide:function(){a.style.display="none";return this},attach:function(b,c){a.addEventListener?a.addEventListener(b,c,!1):a.attachEvent&&a.attachEvent("on"+b,c);return function(){qq(a).detach(b,c)}},detach:function(b,c){a.removeEventListener?a.removeEventListener(b,c,!1):a.attachEvent&&a.detachEvent("on"+b,c);return this},contains:function(b){return a==b?!0:a.contains?a.contains(b):!!(b.compareDocumentPosition(a)&8)},insertBefore:function(b){b.parentNode.insertBefore(a,b);return this},remove:function(){a.parentNode.removeChild(a);return this},css:function(b){null!=b.opacity&&("string"!=typeof a.style.opacity&&"undefined"!=typeof a.filters)&&(b.filter="alpha(opacity="+Math.round(100*b.opacity)+")");qq.extend(a.style,b);return this},hasClass:function(b){return RegExp("(^| )"+b+"( |$)").test(a.className)},addClass:function(b){qq(a).hasClass(b)||(a.className+=" "+b);return this},removeClass:function(b){a.className=a.className.replace(RegExp("(^| )"+b+"( |$)")," ").replace(/^\s+|\s+$/g,"");return this},getByClass:function(b){if(a.querySelectorAll)return a.querySelectorAll("."+b);for(var c=[],d=a.getElementsByTagName("*"),e=d.length,f=0;f<e;f++)qq(d[f]).hasClass(b)&&c.push(d[f]);return c},children:function(){for(var b=[],c=a.firstChild;c;)1==c.nodeType&&b.push(c),c=c.nextSibling;return b},setText:function(b){a.innerText=b;a.textContent=b;return this},clearText:function(){return qq(a).setText("")}}}; qq.log=function(a,b){if(window.console)if(!b||"info"===b)window.console.log(a);else if(window.console[b])window.console[b](a);else window.console.log("<"+b+"> "+a)};qq.isObject=function(a){return null!==a&&a&&"object"===typeof a&&a.constructor===Object};qq.extend=function(a,b,c){for(var d in b)b.hasOwnProperty(d)&&(c&&qq.isObject(b[d])?(void 0===a[d]&&(a[d]={}),qq.extend(a[d],b[d],!0)):a[d]=b[d])}; qq.indexOf=function(a,b,c){if(a.indexOf)return a.indexOf(b,c);var c=c||0,d=a.length;for(0>c&&(c+=d);c<d;c++)if(c in a&&a[c]===b)return c;return-1};qq.getUniqueId=function(){var a=0;return function(){return a++}}();qq.ie=function(){return-1!=navigator.userAgent.indexOf("MSIE")};qq.ie10=function(){return-1!=navigator.userAgent.indexOf("MSIE 10")};qq.safari=function(){return void 0!=navigator.vendor&&-1!=navigator.vendor.indexOf("Apple")};qq.chrome=function(){return void 0!=navigator.vendor&&-1!=navigator.vendor.indexOf("Google")}; qq.firefox=function(){return-1!=navigator.userAgent.indexOf("Mozilla")&&void 0!=navigator.vendor&&""==navigator.vendor};qq.windows=function(){return"Win32"==navigator.platform};qq.preventDefault=function(a){a.preventDefault?a.preventDefault():a.returnValue=!1};qq.toElement=function(){var a=document.createElement("div");return function(b){a.innerHTML=b;b=a.firstChild;a.removeChild(b);return b}}(); qq.obj2url=function(a,b,c){var d=[],e="&",f=function(a,c){var e=b?/\[\]$/.test(b)?b:b+"["+c+"]":c;"undefined"!=e&&"undefined"!=c&&d.push("object"===typeof a?qq.obj2url(a,e,!0):"[object Function]"===Object.prototype.toString.call(a)?encodeURIComponent(e)+"="+encodeURIComponent(a()):encodeURIComponent(e)+"="+encodeURIComponent(a))};if(!c&&b)e=/\?/.test(b)?/\?$/.test(b)?"":"&":"?",d.push(b),d.push(qq.obj2url(a));else if("[object Array]"===Object.prototype.toString.call(a)&&"undefined"!=typeof a)for(var g=0,c=a.length;g<c;++g)f(a[g],g);else if("undefined"!=typeof a&&null!==a&&"object"===typeof a)for(g in a)f(a[g],g);else d.push(encodeURIComponent(b)+"="+encodeURIComponent(a));return b?d.join(e):d.join(e).replace(/^&/,"").replace(/%20/g,"+")};qq.DisposeSupport={_disposers:[],dispose:function(){for(var a;a=this._disposers.shift();)a()},addDisposer:function(a){this._disposers.push(a)},_attach:function(){this.addDisposer(qq(arguments[0]).attach.apply(this,Array.prototype.slice.call(arguments,1)))}}; qq.UploadButton=function(a){this._options={element:null,multiple:!1,acceptFiles:null,name:"file",onChange:function(){},hoverClass:"qq-upload-button-hover",focusClass:"qq-upload-button-focus"};qq.extend(this._options,a);qq.extend(this,qq.DisposeSupport);this._element=this._options.element;qq(this._element).css({position:"relative",overflow:"hidden",direction:"ltr"});this._input=this._createInput()}; qq.UploadButton.prototype={getInput:function(){return this._input},reset:function(){this._input.parentNode&&qq(this._input).remove();qq(this._element).removeClass(this._options.focusClass);this._input=this._createInput()},_createInput:function(){var a=document.createElement("input");this._options.multiple&&a.setAttribute("multiple","multiple");this._options.acceptFiles&&a.setAttribute("accept",this._options.acceptFiles);a.setAttribute("type","file");a.setAttribute("name",this._options.name);qq(a).css({position:"absolute",right:0,top:0,fontFamily:"Arial",fontSize:"118px",margin:0,padding:0,cursor:"pointer",opacity:0});this._element.appendChild(a);var b=this;this._attach(a,"change",function(){b._options.onChange(a)});this._attach(a,"mouseover",function(){qq(b._element).addClass(b._options.hoverClass)});this._attach(a,"mouseout",function(){qq(b._element).removeClass(b._options.hoverClass)});this._attach(a,"focus",function(){qq(b._element).addClass(b._options.focusClass)});this._attach(a,"blur",function(){qq(b._element).removeClass(b._options.focusClass)}); window.attachEvent&&a.setAttribute("tabIndex","-1");return a}}; qq.FineUploaderBasic=function(a){this._options={debug:!1,button:null,multiple:!0,maxConnections:3,disableCancelForFormUploads:!1,autoUpload:!0,request:{endpoint:"/server/upload",params:{},customHeaders:{},forceMultipart:!1,inputName:"qqfile"},validation:{allowedExtensions:[],sizeLimit:0,minSizeLimit:0,stopOnFirstInvalidFile:!0},callbacks:{onSubmit:function(){},onComplete:function(){},onCancel:function(){},onUpload:function(){},onProgress:function(){},onError:function(){},onAutoRetry:function(){},onManualRetry:function(){},onValidate:function(){}},messages:{typeError:"{file} has an invalid extension. Valid extension(s): {extensions}.",sizeError:"{file} is too large, maximum file size is {sizeLimit}.",minSizeError:"{file} is too small, minimum file size is {minSizeLimit}.",emptyError:"{file} is empty, please select files again without it.",noFilesError:"No files to upload.",onLeave:"The files are being uploaded, if you leave now the upload will be cancelled."},retry:{enableAuto:!1,maxAutoAttempts:3,autoAttemptDelay:5,preventRetryResponseProperty:"preventRetry"}};qq.extend(this._options,a,!0);this._wrapCallbacks();qq.extend(this,qq.DisposeSupport);this._filesInProgress=0;this._storedFileIds=[];this._autoRetries=[];this._retryTimeouts=[];this._preventRetries=[];this._handler=this._createUploadHandler();this._options.button&&(this._button=this._createUploadButton(this._options.button));this._preventLeaveInProgress()}; qq.FineUploaderBasic.prototype={log:function(a,b){this._options.debug&&(!b||"info"===b)?qq.log("[FineUploader] "+a):b&&"info"!==b&&qq.log("[FineUploader] "+a,b)},setParams:function(a){this._options.request.params=a},getInProgress:function(){return this._filesInProgress},uploadStoredFiles:function(){for(;this._storedFileIds.length;)this._filesInProgress++,this._handler.upload(this._storedFileIds.shift(),this._options.request.params)},clearStoredFiles:function(){this._storedFileIds=[]},retry:function(a){return this._onBeforeManualRetry(a)? (this._handler.retry(a),!0):!1},cancel:function(a){this._handler.cancel(a)},reset:function(){this.log("Resetting uploader...");this._handler.reset();this._filesInProgress=0;this._storedFileIds=[];this._autoRetries=[];this._retryTimeouts=[];this._preventRetries=[];this._button.reset()},_createUploadButton:function(a){var b=this,c=new qq.UploadButton({element:a,multiple:this._options.multiple&&qq.UploadHandlerXhr.isSupported(),acceptFiles:this._options.validation.acceptFiles,onChange:function(a){b._onInputChange(a)}}); this.addDisposer(function(){c.dispose()});return c},_createUploadHandler:function(){var a=this,b;b=qq.UploadHandlerXhr.isSupported()?"UploadHandlerXhr":"UploadHandlerForm";return new qq[b]({debug:this._options.debug,endpoint:this._options.request.endpoint,forceMultipart:this._options.request.forceMultipart,maxConnections:this._options.maxConnections,customHeaders:this._options.request.customHeaders,inputName:this._options.request.inputName,demoMode:this._options.demoMode,log:this.log,onProgress:function(b, d,e,f){a._onProgress(b,d,e,f);a._options.callbacks.onProgress(b,d,e,f)},onComplete:function(b,d,e,f){a._onComplete(b,d,e,f);a._options.callbacks.onComplete(b,d,e)},onCancel:function(b,d){a._onCancel(b,d);a._options.callbacks.onCancel(b,d)},onUpload:function(b,d,e){a._onUpload(b,d,e);a._options.callbacks.onUpload(b,d,e)},onAutoRetry:function(b,d,e,f){a._preventRetries[b]=e[a._options.retry.preventRetryResponseProperty];return a._shouldAutoRetry(b,d,e)?(a._maybeParseAndSendUploadError(b,d,e,f),a._options.callbacks.onAutoRetry(b, d,a._autoRetries[b]+1),a._onBeforeAutoRetry(b,d),a._retryTimeouts[b]=setTimeout(function(){a._onAutoRetry(b,d,e)},1E3*a._options.retry.autoAttemptDelay),!0):!1}})},_preventLeaveInProgress:function(){var a=this;this._attach(window,"beforeunload",function(b){if(a._filesInProgress)return b=b||window.event,b.returnValue=a._options.messages.onLeave})},_onSubmit:function(){this._options.autoUpload&&this._filesInProgress++},_onProgress:function(){},_onComplete:function(a,b,c,d){this._filesInProgress--;this._maybeParseAndSendUploadError(a, b,c,d)},_onCancel:function(a){clearTimeout(this._retryTimeouts[a]);a=qq.indexOf(this._storedFileIds,a);this._options.autoUpload||0>a?this._filesInProgress--:this._options.autoUpload||this._storedFileIds.splice(a,1)},_onUpload:function(){},_onInputChange:function(a){this._handler instanceof qq.UploadHandlerXhr?this._uploadFileList(a.files):this._validateFile(a)&&this._uploadFile(a);this._button.reset()},_onBeforeAutoRetry:function(a,b){this.log("Waiting "+this._options.retry.autoAttemptDelay+" seconds before retrying "+ b+"...")},_onAutoRetry:function(a,b){this.log("Retrying "+b+"...");this._autoRetries[a]++;this._handler.retry(a)},_shouldAutoRetry:function(a){return!this._preventRetries[a]&&this._options.retry.enableAuto?(void 0===this._autoRetries[a]&&(this._autoRetries[a]=0),this._autoRetries[a]<this._options.retry.maxAutoAttempts):!1},_onBeforeManualRetry:function(a){if(this._preventRetries[a])return this.log("Retries are forbidden for id "+a,"warn"),!1;if(this._handler.isValid(a)){var b=this._handler.getName(a); if(!1===this._options.callbacks.onManualRetry(a,b))return!1;this.log("Retrying upload for '"+b+"' (id: "+a+")...");this._filesInProgress++;return!0}this.log("'"+a+"' is not a valid file ID","error");return!1},_maybeParseAndSendUploadError:function(a,b,c,d){if(!c.success)if(d&&200!==d.status&&!c.error)this._options.callbacks.onError(a,b,"XHR returned response code "+d.status);else this._options.callbacks.onError(a,b,c.error?c.error:"Upload failure reason unknown")},_uploadFileList:function(a){var b, c;b=this._getValidationDescriptors(a);1<b.length&&(c=!1===this._options.callbacks.onValidate(b));if(!c)if(0<a.length)for(b=0;b<a.length;b++)if(this._validateFile(a[b]))this._uploadFile(a[b]);else{if(this._options.validation.stopOnFirstInvalidFile)break}else this._error("noFilesError","")},_uploadFile:function(a){var a=this._handler.add(a),b=this._handler.getName(a);!1!==this._options.callbacks.onSubmit(a,b)&&(this._onSubmit(a,b),this._options.autoUpload?this._handler.upload(a,this._options.request.params): this._storeFileForLater(a))},_storeFileForLater:function(a){this._storedFileIds.push(a)},_validateFile:function(a){var b,c,a=this._getValidationDescriptor(a);b=a.name;c=a.size;if(!1===this._options.callbacks.onValidate([a]))return!1;if(this._isAllowedExtension(b)){if(0===c)return this._error("emptyError",b),!1;if(c&&this._options.validation.sizeLimit&&c>this._options.validation.sizeLimit)return this._error("sizeError",b),!1;if(c&&c<this._options.validation.minSizeLimit)return this._error("minSizeError", b),!1}else return this._error("typeError",b),!1;return!0},_error:function(a,b){var c=this._options.messages[a],d=this._options.validation.allowedExtensions.join(", "),e=this._formatFileName(b),c=c.replace("{file}",e),c=c.replace("{extensions}",d),d=this._formatSize(this._options.validation.sizeLimit),c=c.replace("{sizeLimit}",d),d=this._formatSize(this._options.validation.minSizeLimit),c=c.replace("{minSizeLimit}",d);this._options.callbacks.onError(null,b,c);return c},_formatFileName:function(a){33< a.length&&(a=a.slice(0,19)+"..."+a.slice(-13));return a},_isAllowedExtension:function(a){var a=-1!==a.indexOf(".")?a.replace(/.*[.]/,"").toLowerCase():"",b=this._options.validation.allowedExtensions;if(!b.length)return!0;for(var c=0;c<b.length;c++)if(b[c].toLowerCase()==a)return!0;return!1},_formatSize:function(a){var b=-1;do a/=1024,b++;while(99<a);return Math.max(a,0.1).toFixed(1)+" "+"KB MB GB TB PB EB".split(" ")[b]},_wrapCallbacks:function(){var a,b;a=this;b=function(b,c,f){try{return c.apply(a, f)}catch(g){a.log("Caught exception in '"+b+"' callback - "+g,"error")}};for(var c in this._options.callbacks)(function(){var d=a._options.callbacks[c];a._options.callbacks[c]=function(){return b(c,d,arguments)}})()},_parseFileName:function(a){return a.value?a.value.replace(/.*(\/|\\)/,""):null!==a.fileName&&void 0!==a.fileName?a.fileName:a.name},_parseFileSize:function(a){var b;a.value||(b=null!==a.fileSize&&void 0!==a.fileSize?a.fileSize:a.size);return b},_getValidationDescriptor:function(a){var b, c;c={};b=this._parseFileName(a);a=this._parseFileSize(a);c.name=b;a&&(c.size=a);return c},_getValidationDescriptors:function(a){var b,c;c=[];for(b=0;b<a.length;b++)c.push(a[b]);return c}}; qq.FineUploader=function(a){qq.FineUploaderBasic.apply(this,arguments);qq.extend(this._options,{element:null,listElement:null,dragAndDrop:{extraDropzones:[],hideDropzones:!0,disableDefaultDropzone:!1},text:{uploadButton:"Upload a file",cancelButton:"Cancel",retryButton:"Retry",failUpload:"Upload failed",dragZone:"Drop files here to upload",formatProgress:"{percent}% / {total_size}",waitingForResponse:"Processing..."},template:'<div class="qq-uploader">'+(!this._options.dragAndDrop||!this._options.dragAndDrop.disableDefaultDropzone? '<div class="qq-upload-drop-area"><span>{dragZoneText}</span></div>':"")+(!this._options.button?'<div class="qq-upload-button"><div>{uploadButtonText}</div></div>':"")+(!this._options.listElement?'<ul class="qq-upload-list"></ul>':"")+"</div>",fileTemplate:'<li><div class="qq-progress-bar"></div><span class="qq-upload-spinner"></span><span class="qq-upload-finished"></span><span class="qq-upload-file"></span><span class="qq-upload-size"></span><a class="qq-upload-cancel" href="#">{cancelButtonText}</a><a class="qq-upload-retry" href="#">{retryButtonText}</a><span class="qq-upload-status-text">{statusText}</span></li>', classes:{button:"qq-upload-button",drop:"qq-upload-drop-area",dropActive:"qq-upload-drop-area-active",dropDisabled:"qq-upload-drop-area-disabled",list:"qq-upload-list",progressBar:"qq-progress-bar",file:"qq-upload-file",spinner:"qq-upload-spinner",finished:"qq-upload-finished",retrying:"qq-upload-retrying",retryable:"qq-upload-retryable",size:"qq-upload-size",cancel:"qq-upload-cancel",retry:"qq-upload-retry",statusText:"qq-upload-status-text",success:"qq-upload-success",fail:"qq-upload-fail",successIcon:null, failIcon:null},failedUploadTextDisplay:{mode:"default",maxChars:50,responseProperty:"error",enableTooltip:!0},messages:{tooManyFilesError:"You may only drop one file"},retry:{showAutoRetryNote:!0,autoRetryNote:"Retrying {retryNum}/{maxAuto}...",showButton:!1},showMessage:function(a){alert(a)}},!0);qq.extend(this._options,a,!0);this._wrapCallbacks();this._options.template=this._options.template.replace(/\{dragZoneText\}/g,this._options.text.dragZone);this._options.template=this._options.template.replace(/\{uploadButtonText\}/g, this._options.text.uploadButton);this._options.fileTemplate=this._options.fileTemplate.replace(/\{cancelButtonText\}/g,this._options.text.cancelButton);this._options.fileTemplate=this._options.fileTemplate.replace(/\{retryButtonText\}/g,this._options.text.retryButton);this._options.fileTemplate=this._options.fileTemplate.replace(/\{statusText\}/g,"");this._element=this._options.element;this._element.innerHTML=this._options.template;this._listElement=this._options.listElement||this._find(this._element, "list");this._classes=this._options.classes;this._button||(this._button=this._createUploadButton(this._find(this._element,"button")));this._bindCancelAndRetryEvents();this._setupDragDrop()};qq.extend(qq.FineUploader.prototype,qq.FineUploaderBasic.prototype); qq.extend(qq.FineUploader.prototype,{clearStoredFiles:function(){qq.FineUploaderBasic.prototype.clearStoredFiles.apply(this,arguments);this._listElement.innerHTML=""},addExtraDropzone:function(a){this._setupExtraDropzone(a)},removeExtraDropzone:function(a){var b=this._options.dragAndDrop.extraDropzones,c;for(c in b)if(b[c]===a)return this._options.dragAndDrop.extraDropzones.splice(c,1)},getItemByFileId:function(a){for(var b=this._listElement.firstChild;b;){if(b.qqFileId==a)return b;b=b.nextSibling}}, reset:function(){qq.FineUploaderBasic.prototype.reset.apply(this,arguments);this._element.innerHTML=this._options.template;this._listElement=this._options.listElement||this._find(this._element,"list");this._options.button||(this._button=this._createUploadButton(this._find(this._element,"button")));this._bindCancelAndRetryEvents();this._setupDragDrop()},_leaving_document_out:function(a){return(qq.chrome()||qq.safari()&&qq.windows())&&0==a.clientX&&0==a.clientY||qq.firefox()&&!a.relatedTarget},_storeFileForLater:function(a){qq.FineUploaderBasic.prototype._storeFileForLater.apply(this, arguments);var b=this.getItemByFileId(a);qq(this._find(b,"spinner")).hide()},_find:function(a,b){var c=qq(a).getByClass(this._options.classes[b])[0];if(!c)throw Error("element not found "+b);return c},_setupExtraDropzone:function(a){this._options.dragAndDrop.extraDropzones.push(a);this._setupDropzone(a)},_setupDropzone:function(a){var b=this,c=new qq.UploadDropZone({element:a,onEnter:function(c){qq(a).addClass(b._classes.dropActive);c.stopPropagation()},onLeave:function(){},onLeaveNotDescendants:function(){qq(a).removeClass(b._classes.dropActive)}, onDrop:function(c){b._options.dragAndDrop.hideDropzones&&qq(a).hide();qq(a).removeClass(b._classes.dropActive);1<c.dataTransfer.files.length&&!b._options.multiple?b._error("tooManyFilesError",""):b._uploadFileList(c.dataTransfer.files)}});this.addDisposer(function(){c.dispose()});this._options.dragAndDrop.hideDropzones&&qq(a).hide()},_setupDragDrop:function(){var a,b;a=this;this._options.dragAndDrop.disableDefaultDropzone||(b=this._find(this._element,"drop"),this._options.dragAndDrop.extraDropzones.push(b)); var c=this._options.dragAndDrop.extraDropzones,d;for(d=0;d<c.length;d++)this._setupDropzone(c[d]);!this._options.dragAndDrop.disableDefaultDropzone&&(!qq.ie()||qq.ie10())&&this._attach(document,"dragenter",function(){if(!qq(b).hasClass(a._classes.dropDisabled)){b.style.display="block";for(d=0;d<c.length;d++)c[d].style.display="block"}});this._attach(document,"dragleave",function(b){if(a._options.dragAndDrop.hideDropzones&&qq.FineUploader.prototype._leaving_document_out(b))for(d=0;d<c.length;d++)qq(c[d]).hide()}); qq(document).attach("drop",function(b){if(a._options.dragAndDrop.hideDropzones)for(d=0;d<c.length;d++)qq(c[d]).hide();b.preventDefault()})},_onSubmit:function(a,b){qq.FineUploaderBasic.prototype._onSubmit.apply(this,arguments);this._addToList(a,b)},_onProgress:function(a,b,c,d){qq.FineUploaderBasic.prototype._onProgress.apply(this,arguments);var e,f,g,h;e=this.getItemByFileId(a);f=this._find(e,"progressBar");h=Math.round(100*(c/d));c===d?(g=this._find(e,"cancel"),qq(g).hide(),qq(f).hide(),qq(this._find(e, "statusText")).setText(this._options.text.waitingForResponse),g=this._formatSize(d)):(g=this._formatProgress(c,d),qq(f).css({display:"block"}));qq(f).css({width:h+"%"});e=this._find(e,"size");qq(e).css({display:"inline"});qq(e).setText(g)},_onComplete:function(a,b,c,d){qq.FineUploaderBasic.prototype._onComplete.apply(this,arguments);var e=this.getItemByFileId(a);qq(this._find(e,"statusText")).clearText();qq(e).removeClass(this._classes.retrying);qq(this._find(e,"progressBar")).hide();(!this._options.disableCancelForFormUploads|| qq.UploadHandlerXhr.isSupported())&&qq(this._find(e,"cancel")).hide();qq(this._find(e,"spinner")).hide();c.success?(qq(e).addClass(this._classes.success),this._classes.successIcon&&(this._find(e,"finished").style.display="inline-block",qq(e).addClass(this._classes.successIcon))):(qq(e).addClass(this._classes.fail),this._classes.failIcon&&(this._find(e,"finished").style.display="inline-block",qq(e).addClass(this._classes.failIcon)),this._options.retry.showButton&&!this._preventRetries[a]&&qq(e).addClass(this._classes.retryable), this._controlFailureTextDisplay(e,c))},_onUpload:function(a,b,c){qq.FineUploaderBasic.prototype._onUpload.apply(this,arguments);this._showSpinner(this.getItemByFileId(a))},_onBeforeAutoRetry:function(a){var b,c,d,e,f;qq.FineUploaderBasic.prototype._onBeforeAutoRetry.apply(this,arguments);b=this.getItemByFileId(a);c=this._find(b,"progressBar");this._showCancelLink(b);c.style.width=0;qq(c).hide();this._options.retry.showAutoRetryNote&&(c=this._find(b,"statusText"),d=this._autoRetries[a]+1,e=this._options.retry.maxAutoAttempts, f=this._options.retry.autoRetryNote.replace(/\{retryNum\}/g,d),f=f.replace(/\{maxAuto\}/g,e),qq(c).setText(f),1===d&&qq(b).addClass(this._classes.retrying))},_onBeforeManualRetry:function(a){if(qq.FineUploaderBasic.prototype._onBeforeManualRetry.apply(this,arguments)){var b=this.getItemByFileId(a);this._find(b,"progressBar").style.width=0;qq(b).removeClass(this._classes.fail);this._showSpinner(b);this._showCancelLink(b);return!0}return!1},_addToList:function(a,b){var c=qq.toElement(this._options.fileTemplate); if(this._options.disableCancelForFormUploads&&!qq.UploadHandlerXhr.isSupported()){var d=this._find(c,"cancel");qq(d).remove()}c.qqFileId=a;d=this._find(c,"file");qq(d).setText(this._formatFileName(b));qq(this._find(c,"size")).hide();this._options.multiple||this._clearList();this._listElement.appendChild(c)},_clearList:function(){this._listElement.innerHTML="";this.clearStoredFiles()},_bindCancelAndRetryEvents:function(){var a=this;this._attach(this._listElement,"click",function(b){var b=b||window.event, c=b.target||b.srcElement;if(qq(c).hasClass(a._classes.cancel)||qq(c).hasClass(a._classes.retry)){qq.preventDefault(b);for(b=c.parentNode;void 0==b.qqFileId;)b=c=c.parentNode;qq(c).hasClass(a._classes.cancel)?(a.cancel(b.qqFileId),qq(b).remove()):(qq(b).removeClass(a._classes.retryable),a.retry(b.qqFileId))}})},_formatProgress:function(a,b){var c=this._options.text.formatProgress,d=Math.round(100*(a/b)),c=c.replace("{percent}",d),d=this._formatSize(b);return c=c.replace("{total_size}",d)},_controlFailureTextDisplay:function(a, b){var c,d,e,f;c=this._options.failedUploadTextDisplay.mode;d=this._options.failedUploadTextDisplay.maxChars;e=this._options.failedUploadTextDisplay.responseProperty;"custom"===c?((c=b[e])?c.length>d&&(f=c.substring(0,d)+"..."):(c=this._options.text.failUpload,this.log("'"+e+"' is not a valid property on the server response.","warn")),qq(this._find(a,"statusText")).setText(f||c),this._options.failedUploadTextDisplay.enableTooltip&&this._showTooltip(a,c)):"default"===c?qq(this._find(a,"statusText")).setText(this._options.text.failUpload): "none"!==c&&this.log("failedUploadTextDisplay.mode value of '"+c+"' is not valid","warn")},_showTooltip:function(a,b){a.title=b},_showSpinner:function(a){this._find(a,"spinner").style.display="inline-block"},_showCancelLink:function(a){if(!this._options.disableCancelForFormUploads||qq.UploadHandlerXhr.isSupported())this._find(a,"cancel").style.display="inline"},_error:function(a,b){this._options.showMessage(qq.FineUploaderBasic.prototype._error.apply(this,arguments))}}); qq.UploadDropZone=function(a){this._options={element:null,onEnter:function(){},onLeave:function(){},onLeaveNotDescendants:function(){},onDrop:function(){}};qq.extend(this._options,a);qq.extend(this,qq.DisposeSupport);this._element=this._options.element;this._disableDropOutside();this._attachEvents()}; qq.UploadDropZone.prototype={_dragover_should_be_canceled:function(){return qq.safari()||qq.firefox()&&qq.windows()},_disableDropOutside:function(){qq.UploadDropZone.dropOutsideDisabled||(this._dragover_should_be_canceled?qq(document).attach("dragover",function(a){a.preventDefault()}):qq(document).attach("dragover",function(a){a.dataTransfer&&(a.dataTransfer.dropEffect="none",a.preventDefault())}),qq.UploadDropZone.dropOutsideDisabled=!0)},_attachEvents:function(){var a=this;a._attach(a._element, "dragover",function(b){if(a._isValidFileDrag(b)){var c=qq.ie()?null:b.dataTransfer.effectAllowed;b.dataTransfer.dropEffect="move"==c||"linkMove"==c?"move":"copy";b.stopPropagation();b.preventDefault()}});a._attach(a._element,"dragenter",function(b){if(a._isValidFileDrag(b))a._options.onEnter(b)});a._attach(a._element,"dragleave",function(b){if(a._isValidFileDrag(b)){a._options.onLeave(b);var c=document.elementFromPoint(b.clientX,b.clientY);if(!qq(this).contains(c))a._options.onLeaveNotDescendants(b)}}); a._attach(a._element,"drop",function(b){a._isValidFileDrag(b)&&(b.preventDefault(),a._options.onDrop(b))})},_isValidFileDrag:function(a){if(qq.ie()&&!qq.ie10())return!1;var a=a.dataTransfer,b=qq.safari(),c=qq.ie10()?!0:"none"!=a.effectAllowed;return a&&c&&(a.files||!b&&a.types.contains&&a.types.contains("Files"))}}; qq.UploadHandlerAbstract=function(a){this._options={debug:!1,endpoint:"/upload.php",maxConnections:999,log:function(){},onProgress:function(){},onComplete:function(){},onCancel:function(){},onUpload:function(){},onAutoRetry:function(){}};qq.extend(this._options,a);this._queue=[];this._params=[];this.log=this._options.log}; qq.UploadHandlerAbstract.prototype={add:function(){},upload:function(a,b){var c=this._queue.push(a),d={};qq.extend(d,b);this._params[a]=d;c<=this._options.maxConnections&&this._upload(a,this._params[a])},retry:function(a){0<=qq.indexOf(this._queue,a)?this._upload(a,this._params[a]):this.upload(a,this._params[a])},cancel:function(a){this.log("Cancelling "+a);this._cancel(a);this._dequeue(a)},cancelAll:function(){for(var a=0;a<this._queue.length;a++)this._cancel(this._queue[a]);this._queue=[]},getName:function(){}, getSize:function(){},getQueue:function(){return this._queue},reset:function(){this.log("Resetting upload handler");this._queue=[];this._params=[]},_upload:function(){},_cancel:function(){},_dequeue:function(a){a=qq.indexOf(this._queue,a);this._queue.splice(a,1);var b=this._options.maxConnections;this._queue.length>=b&&a<b&&(a=this._queue[b-1],this._upload(a,this._params[a]))},isValid:function(){}}; qq.UploadHandlerForm=function(a){qq.UploadHandlerAbstract.apply(this,arguments);this._inputs={};this._detach_load_events={}};qq.extend(qq.UploadHandlerForm.prototype,qq.UploadHandlerAbstract.prototype); qq.extend(qq.UploadHandlerForm.prototype,{add:function(a){a.setAttribute("name",this._options.inputName);var b="qq-upload-handler-iframe"+qq.getUniqueId();this._inputs[b]=a;a.parentNode&&qq(a).remove();return b},getName:function(a){return this._inputs[a].value.replace(/.*(\/|\\)/,"")},isValid:function(a){return void 0!==this._inputs[a]},reset:function(){qq.UploadHandlerAbstract.prototype.reset.apply(this,arguments);this._inputs={};this._detach_load_events={}},_cancel:function(a){this._options.onCancel(a, this.getName(a));delete this._inputs[a];delete this._detach_load_events[a];if(a=document.getElementById(a))a.setAttribute("src","javascript:false;"),qq(a).remove()},_upload:function(a,b){this._options.onUpload(a,this.getName(a),!1);var c=this._inputs[a];if(!c)throw Error("file with passed id was not added, or already uploaded or cancelled");var d=this.getName(a);b[this._options.inputName]=d;var e=this._createIframe(a),f=this._createForm(e,b);f.appendChild(c);var g=this;this._attachLoadEvent(e,function(){g.log("iframe loaded"); var b=g._getIframeContentJSON(e);setTimeout(function(){g._detach_load_events[a]();delete g._detach_load_events[a];qq(e).remove()},1);if(b.success||!g._options.onAutoRetry(a,d,b))g._options.onComplete(a,d,b),g._dequeue(a)});this.log("Sending upload request for "+a);f.submit();qq(f).remove();return a},_attachLoadEvent:function(a,b){var c=this;this._detach_load_events[a.id]=qq(a).attach("load",function(){c.log("Received response for "+a.id);if(a.parentNode){try{if(a.contentDocument&&a.contentDocument.body&& "false"==a.contentDocument.body.innerHTML)return}catch(d){c.log("Error when attempting to access iframe during handling of upload response ("+d+")","error")}b()}})},_getIframeContentJSON:function(a){try{var b=a.contentDocument?a.contentDocument:a.contentWindow.document,c,d=b.body.innerHTML;this.log("converting iframe's innerHTML to JSON");this.log("innerHTML = "+d);d&&d.match(/^<pre/i)&&(d=b.body.firstChild.firstChild.nodeValue);c=eval("("+d+")")}catch(e){this.log("Error when attempting to parse form upload response ("+ e+")","error"),c={success:!1}}return c},_createIframe:function(a){var b=qq.toElement('<iframe src="javascript:false;" name="'+a+'" />');b.setAttribute("id",a);b.style.display="none";document.body.appendChild(b);return b},_createForm:function(a,b){var c=qq.toElement('<form method="'+(this._options.demoMode?"GET":"POST")+'" enctype="multipart/form-data"></form>'),d=qq.obj2url(b,this._options.endpoint);c.setAttribute("action",d);c.setAttribute("target",a.name);c.style.display="none";document.body.appendChild(c); return c}});qq.UploadHandlerXhr=function(a){qq.UploadHandlerAbstract.apply(this,arguments);this._files=[];this._xhrs=[];this._loaded=[]};qq.UploadHandlerXhr.isSupported=function(){var a=document.createElement("input");a.type="file";return"multiple"in a&&"undefined"!=typeof File&&"undefined"!=typeof FormData&&"undefined"!=typeof(new XMLHttpRequest).upload};qq.extend(qq.UploadHandlerXhr.prototype,qq.UploadHandlerAbstract.prototype); qq.extend(qq.UploadHandlerXhr.prototype,{add:function(a){if(!(a instanceof File))throw Error("Passed obj in not a File (in qq.UploadHandlerXhr)");return this._files.push(a)-1},getName:function(a){a=this._files[a];return null!==a.fileName&&void 0!==a.fileName?a.fileName:a.name},getSize:function(a){a=this._files[a];return null!=a.fileSize?a.fileSize:a.size},getLoaded:function(a){return this._loaded[a]||0},isValid:function(a){return void 0!==this._files[a]},reset:function(){qq.UploadHandlerAbstract.prototype.reset.apply(this, arguments);this._files=[];this._xhrs=[];this._loaded=[]},_upload:function(a,b){this._options.onUpload(a,this.getName(a),!0);var c=this._files[a],d=this.getName(a);this.getSize(a);this._loaded[a]=0;var e=this._xhrs[a]=new XMLHttpRequest,f=this;e.upload.onprogress=function(b){b.lengthComputable&&(f._loaded[a]=b.loaded,f._options.onProgress(a,d,b.loaded,b.total))};e.onreadystatechange=function(){4==e.readyState&&f._onComplete(a,e)};b=b||{};b[this._options.inputName]=d;var g=qq.obj2url(b,this._options.endpoint); e.open(this._options.demoMode?"GET":"POST",g,!0);e.setRequestHeader("X-Requested-With","XMLHttpRequest");e.setRequestHeader("X-File-Name",encodeURIComponent(d));e.setRequestHeader("Cache-Control","no-cache");this._options.forceMultipart?(g=new FormData,g.append(this._options.inputName,c),c=g):(e.setRequestHeader("Content-Type","application/octet-stream"),e.setRequestHeader("X-Mime-Type",c.type));for(key in this._options.customHeaders)e.setRequestHeader(key,this._options.customHeaders[key]);this.log("Sending upload request for "+ a);e.send(c)},_onComplete:function(a,b){if(this._files[a]){var c=this.getName(a),d=this.getSize(a),e;this._options.onProgress(a,c,d,d);this.log("xhr - server response received for "+a);this.log("responseText = "+b.responseText);try{e="function"===typeof JSON.parse?JSON.parse(b.responseText):eval("("+b.responseText+")")}catch(f){this.log("Error when attempting to parse xhr response text ("+f+")","error"),e={}}if(200===b.status&&e.success||!this._options.onAutoRetry(a,c,e,b))this._options.onComplete(a, c,e,b),this._xhrs[a]=null,this._dequeue(a)}},_cancel:function(a){this._options.onCancel(a,this.getName(a));this._files[a]=null;this._xhrs[a]&&(this._xhrs[a].abort(),this._xhrs[a]=null)}}); (function(a){var b,c,d,e,f,g,h,i,j,k;g=["uploaderType"];d=function(a){a&&(a=i(a),h(a),"basic"===f("uploaderType")?b(new qq.FineUploaderBasic(a)):b(new qq.FineUploader(a)));return c};e=function(a,b){var d=c.data("fineuploader");if(b)void 0===d&&(d={}),d[a]=b,c.data("fineuploader",d);else return void 0===d?null:d[a]};b=function(a){return e("uploader",a)};f=function(a,b){return e(a,b)};h=function(b){var d=b.callbacks={};a.each((new qq.FineUploaderBasic)._options.callbacks,function(a){var b,e;b=/^on(\w+)/.exec(a)[1]; b=b.substring(0,1).toLowerCase()+b.substring(1);e=c;d[a]=function(){var a=Array.prototype.slice.call(arguments);return e.triggerHandler(b,a)}})};i=function(b,d){var e,h;e=void 0===d?"basic"!==b.uploaderType?{element:c[0]}:{}:d;a.each(b,function(b,c){0<=a.inArray(b,g)?f(b,c):c instanceof a?e[b]=c[0]:a.isPlainObject(c)?(e[b]={},i(c,e[b])):a.isArray(c)?(h=[],a.each(c,function(b,c){c instanceof a?a.merge(h,c):h.push(c)}),e[b]=h):e[b]=c});if(void 0===d)return e};j=function(c){return"string"===a.type(c)&& !c.match(/^_/)&&void 0!==b()[c]};k=function(a){return b()[a].apply(b(),Array.prototype.slice.call(arguments,1))};a.fn.fineUploader=function(e){c=this;if(b()&&j(e))return k.apply(this,arguments);if("object"===typeof e||!e)return d.apply(this,arguments);a.error("Method "+e+" does not exist on jQuery.fineUploader");return this}})(jQuery);