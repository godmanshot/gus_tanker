function hide_selector_options() {
    var spec_selector_options = $(".select-options");
    
    if(spec_selector_options.length > 0) {
        spec_selector_options.each(function(i) {
            var list_count = $(this).find('ul').find('li').length;
            if(list_count > 20) {
                $(this).find('ul').find('li').each(function(i) {if(i>20 && (list_count-i)>2) $(this).css({'display': 'none'});});
                $(this).find('ul').find('li>.select-options-more').css({'display': 'initial'});
                $(this).find('ul').find('li>.select-options-more').click(function() {
                    $(this).parent().parent().find('li').each(function(i) {$(this).css({'display': 'initial'})});
                    $(this).css({'display': 'none'});
                });
            }
        });
    }
}