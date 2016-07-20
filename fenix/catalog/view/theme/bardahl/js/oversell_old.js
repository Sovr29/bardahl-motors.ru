(function($){
    $.fn.oversell = function(options){
        var settings = $.extend({
            modalId: '#oversellModal',
            formId: '#createOrder',
            closedInputId : '#closed'
        }, options);
        var form = $(settings.formId);
        var closed = $(settings.closedInputId, form);
        var dlg = $(settings.modalId).modal({
                        keyboard: false,
                        backdrop: 'static',
                        show:false
                    });
        dlg.on('hide.bs.modal', function(){
           closed.val('1');
           var f = form.clone();
           f.attr('action', location.href);
           f.submit();
        });
        this.on('click', function(e){
            if(parseInt(closed.val(), 10) === 0)
            {
                e.preventDefault();
                e.stopPropagation();
                dlg.modal('show');
            }
        });
    };  
})( jQuery );