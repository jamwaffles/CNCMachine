var par = 0;
var nac = 0;
var nav = 'nav';
jQuery(document).ready(function() { if (jQuery('#navex').length) nav = 'navex'; });

function menu_position()
{
    var i = 1;
    while (i <= 50)
    {
        var c2 = document.getElementById('chi' + i);
        if (c2)
        {
            if (c2.style.visibility == 'visible')
            {
                menu_show_aux('par' + i, 'chi' + i);
                break;
            }
        }

        i++;
    }
}

function menu_show_aux(parent, child)
{
    var p = document.getElementById(parent);
    var c = document.getElementById(child);
    var num = p.id.match(/\d+/);

    var top = Math.round(p.offsetHeight);
    var left = Math.round(jQuery('#par' + num).offset().left) - Math.round(jQuery('#' + nav).offset().left);

    var mode = document.documentMode || 0;
    if (jQuery.browser.msie && ((jQuery.browser.version < 8 && !mode) || mode < 8) && (c.style.width == '100%')) c.style.width = jQuery('#' + nav).outerWidth() + 'px';

    c.style.position = 'absolute';
    c.style.top = top + 'px';
    c.style.left = left + 'px';

    if (c.style.visibility != 'visible')
    {
        c.style.visibility = 'visible';
        c.style.opacity = 1;
        blackout(true);
        setTimeout(function() { jQuery('div#' + nav).addClass('navopen'); }, 150);
    }
}

function menu_show(parchi)
{
    var p = document.getElementById(parchi['menu_parent']);
    var c = document.getElementById(parchi['menu_child']);
    var num = p.id.match(/\d+/);
    var navout = 'navout parent';

    clearTimeout(c['menu_timeout']);
    clearTimeout(c['menu_transition']);
    if (c.style.visibility != 'visible')
    {
        var i = 1;
        var open = 0;
        while (i <= 50)
        {
            var c2 = document.getElementById('chi' + i);
            if ((c2) && (('chi' + i) != c.id))
            {
                if (c2.style.visibility == 'visible')
                {
                    clearTimeout(c2['menu_timeout']);
                    clearTimeout(c2['menu_transition']);
                    if (i != par) { if (i == nac) navout = 'navover navactive parent'; document.getElementById('par' + i).className = navout; if (document.getElementById('par' + i).firstChild.className) document.getElementById('par' + i).firstChild.className = navout; }
                    c2.style.visibility = 'hidden';
                    c2.style.opacity = 0;
                    open = 1;
                    break;
                }
            }

            i++;
        }

        if (!open)
        {
            c['menu_timeout'] = setTimeout(function() { if (num != par) { document.getElementById('par' + num).className = 'navover parent'; if (document.getElementById('par' + num).firstChild.className) document.getElementById('par' + num).firstChild.className = 'navover parent'; } menu_show_aux(p.id, c.id); }, 50);
        }
        else
        {
            if (num != par) { document.getElementById('par' + num).className = 'navover parent'; if (document.getElementById('par' + num).firstChild.className) document.getElementById('par' + num).firstChild.className = 'navover parent'; } menu_show_aux(p.id, c.id);
        }
    }
}

function menu_hide(parchi)
{
    var p = document.getElementById(parchi['menu_parent']);
    var c = document.getElementById(parchi['menu_child']);
    var num = p.id.match(/\d+/);
    var navout = 'navout parent';

    clearTimeout(c['menu_timeout']);
    clearTimeout(c['menu_transition']);
    if (c.style.visibility != 'hidden')
    {
        c['menu_timeout'] = setTimeout(function() { if (num != par) { if (num == nac) navout = 'navover navactive parent'; document.getElementById('par' + num).className = navout; if (document.getElementById('par' + num).firstChild.className) document.getElementById('par' + num).firstChild.className = navout; } document.getElementById(c.id).style.visibility = 'hidden'; document.getElementById(c.id).style.opacity = 0; blackout(false); }, 200);
        c['menu_transition'] = setTimeout(function() { jQuery('div#' + nav).removeClass('navopen'); }, 150);
    }
}

function menu_attach(parent, child)
{
    var p = document.getElementById(parent);
    var c = document.getElementById(child);

    p['menu_parent'] = p.id;
    c['menu_parent'] = p.id;
    p['menu_child'] = c.id;
    c['menu_child'] = c.id;

    c.style.position = 'absolute';
    c.style.visibility = 'hidden';
    c.style.opacity = 0;
    blackout(false);
}

function blackout(vis)
{
    var arrPageSizes = calcPageSize();
    var dark = document.getElementById('blackout');

    if (dark)
    {
        if (vis)
        {
            dark.style.position = 'absolute';
            dark.style.top = '0px';
            dark.style.left = '0px';
            dark.style.zIndex = 43;
            dark.style.overflow = 'hidden';
            dark.style.backgroundColor = '#000000';
            dark.style.width = arrPageSizes[0] + 'px';
            dark.style.height = arrPageSizes[1] + 'px';
            if (jQuery('div#menu > div.logo').length) dark.style.width = (arrPageSizes[0] - 220) + 'px';
            dark.style.minWidth = '100%';
            dark.style.minHeight = '100%';
            dark.className = 'navopen';
            jQuery('div#' + nav).addClass('blackout');
        }
        else
        {
            dark.className = '';
            jQuery('div#' + nav).removeClass('blackout');
        }
    }
}