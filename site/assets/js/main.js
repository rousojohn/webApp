(function(){
    
    var checkContactForm = function (name, email, msg) {
        return ( email.match(/(\w+)@(.+)\.(\w+)$/) && name != '' && msg != '');
    };

$(document).ready(function($) {

    
    $(".collapse").on('hide.bs.collapse', function(evt) {
        $("a[data-target='#"+evt.currentTarget.id+"']").children("i").removeClass("fa fa-chevron-down").addClass("fa fa-chevron-right");
    });
    
     $(".collapse").on('show.bs.collapse', function(evt) {
        $("a[data-target='#"+evt.currentTarget.id+"']").children("i").removeClass("fa fa-chevron-right").addClass("fa fa-chevron-down");
    });
    
    $('#contactModal').on('hidden.bs.modal', function() {
        $('input#name').val('');
        $('input#email').val('');
        $('input#subject').val('');
        $('textarea#msg').val('');
    });
    
    $('input.tovalidate').on('change', function (evt) {
        $(evt.currentTarget).parent('div').removeClass('has-error').addClass("has-success");
        $(evt.currentTarget).siblings('p').addClass('hidden');
        $(evt.currentTarget).siblings('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
        if ( $(evt.currentTarget).val() == '' || 
            ( $(evt.currentTarget).attr('type') == "email" && !$(evt.currentTarget).val().match(/(\w+)@(.+)\.(\w+)$/))
           ){
            $(evt.currentTarget).parent('div').removeClass("has-success").addClass('has-error');
            $(evt.currentTarget).siblings('p').removeClass('hidden');
            $(evt.currentTarget).siblings('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
        }
    });
    
    $('button#send').on('click', function (evt) {
        if (!checkContactForm($('input#name').val(), $('input#email').val(), $('textarea#msg').val())) return false;
        $.post('sendEmail.php', 
               {
                name : $('input#name').val(),
                email : $('input#email').val(),
                subject : $('input#subject').val(),
                msg : $('textarea#msg').val()
            })
        .done(function (data){
            if ($.parseJSON(data).success)
                alert($.parseJSON(data).msg);
            else
                alert($.parseJSON(data).error);
        })
        .fail(function () {
            alert('Message was not sent');
        })
        .always(function () {
            $('#contactModal').modal('hide');
        });
    });
    
    
});
})();