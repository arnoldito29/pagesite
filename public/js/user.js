$(function () {
    $('.faq_item').click(function () {
        var item = $(this).attr('rel');
        $('#faq_' + item).toggleClass('hide');
    });

    $(".dropdown.messages").on("show.bs.dropdown", function (event) {
        $(event.target).find('.loading').show();
        $(event.target).find('.content').hide();

        $.ajax({
            type: "GET",
            url: APP_URL + '/user/messages',
            success: function (response) {

                $(event.target).find('.loading').hide();

                if (response != "") {

                    $(event.target).find('.content').html(response);
                    $(event.target).find('.content').show();
                } else {

                    $(event.target).removeClass('open');
                }
            }
        });
    });
});

function submit(form,url,id) {

    var data = $(form).serialize();
    $.ajax({
        type: "POST",
        url: APP_URL + url,
        data: data,
        success: function (response) {
            if (response.error === true) {
                for (key in response.data) {
                    var logKey = $(id + key);
                    logKey.closest('.form__field ').addClass('invalid');
                    logKey.parent().find('.invalid__msg').html(response.data[key]);
                }
            } else {

                location.reload();
            }
        }
    });
}

function submitLogin(form) {
    submit(form,'/user/login','#login_');
}


function submitRegister(form) {
    submit(form,'/user/register','#register_');
}