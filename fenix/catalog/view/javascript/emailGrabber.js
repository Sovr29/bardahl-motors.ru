(function($){
  $.fn.emailGrabber = function(options){
    var settings = $.extend({
        isStatic: false,
        time: 10,
        text_success: '<p>Спасибо! на указанный Вами адрес было направлено письмо с дальнейшими инструкциями.</p>'
    }, options);
    var frm;
    if(!settings.isStatic){
        var show = true;
        var date = new Date();
        var timeStart = parseInt($.cookie("EmailGrabberTimeStart"), 10);
        if(timeStart <= 0 || isNaN(timeStart))
        {
            timeStart = date.getTime();
            $.cookie("EmailGrabberTimeStart", timeStart, { expires: 5 * 365 });
        }
        var diff = (date - new Date(timeStart)) / 1000;
        if(diff > 60)
        {
            show = false;
            diff = settings.time;
            timeStart = date.getTime();
            $.cookie("EmailGrabberTimeStart", timeStart, { expires: 5 * 365 });
        }
        var dlg = this.modal({
                        keyboard: false,
                        backdrop: 'static',
                        show:false
                    });
        dlg.on('hide.bs.modal', function(){
           $.cookie("EmailGrabberShown", true, { expires: 5 * 365 });
        });
        frm = dlg;
    }
    else{
        frm = this;
    }
    
    frm.find('#emailGrabberPhone').mask("+7 (999) 999-99-99");
    frm.find('.btn-primary').on('click', function(){
       var btn = $(this);
       if(frm.find('.emailGrabberForm') && frm.find('.emailGrabberForm').length > 0 && frm.find('.emailGrabberForm').valid())
       {
           var f = settings.isStatic ? frm : dlg.find('.modal-body');
           $.ajax({
                url: frm.find('.emailGrabberForm').prop('action'),
                type: frm.find('.emailGrabberForm').prop('method'),
                data: 'email_grabber_name=' + encodeURIComponent(frm.find('.emailGrabberForm').find('#emailGrabberName').val()) + 
                        '&email_grabber_email=' + encodeURIComponent(frm.find('.emailGrabberForm').find('#emailGrabberEmail').val()) +
                        '&email_grabber_phone=' + encodeURIComponent(frm.find('.emailGrabberForm').find('#emailGrabberPhone').val()),
                beforeSend: function () {
                    btn.button('loading');
                },
                success: function (data) {
                    btn.button('reset');
                    if(!data.error)
                    {
                        f.html(settings.text_success);
                        if(!settings.isStatic)
                        {
                            dlg.hide();
                        }
                    }
                    else{
                        f.find('.alert-danger').remove();
                        f.prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + data.error + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }
                },
                error: function(){
                    btn.button('reset');
                    f.find('.alert-danger').remove();
                    f.prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> Произошла ошибка при передаче данных <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }
            });
       }
    });
    if(!settings.isStatic && show && !$.cookie("EmailGrabberShown"))
    {
        setTimeout(
            function() 
            {
              dlg.modal('toggle');
            }, (settings.time - diff)*1000);
        };
    };    
})( jQuery );