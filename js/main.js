jQuery(document).ready(function()
{
    var
        styles = {
            'id': 'jquery-ui-css-theme',
            'rel': "stylesheet",
            'href': YUS.ui_css
        },
        css_link = '<link id="' + styles.id + '" rel="' + styles.rel + '" href="' + styles.href + '" />';
    
    jQuery('body').append( css_link );
});