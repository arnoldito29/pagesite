$(document).ready(function () {
    $("#btn__landing-scrollto").on("click", "a", function (event) {
        event.preventDefault();
        var id = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1500);
    });
});
$(function () {
    var h_hght = 160; // height of landing header
    var h_mrg = 0;    // margin when landing header must hidden
    var elem = $('#header__sticky');
    var top = $(this).scrollTop();

    if (top > h_hght) {
        elem.css('top', h_mrg);
    }

    $(window).scroll(function () {
        top = $(this).scrollTop();

        if (top + h_mrg < h_hght) {
            elem.css('top', (h_hght - top));
            elem.css('display', 'none');
        } else {
            elem.css('top', h_mrg);
            elem.css('display', 'flex');
        }
    });

});
function initFileUpload(data) {

    var action = '/';
    var size_limit = 1000000;
    var allowedExtensions = [];
    var image_id = 'file-uploader';

    if (typeof data.action !== "undefined") {

        action = data.action;
    }
    if (typeof data.size_limit !== "undefined") {

        size_limit = data.size_limit;
    }
    if (typeof data.allowedExtensions !== "undefined") {

        allowedExtensions = data.allowedExtensions;
    }
    if (typeof data.image_id !== "undefined") {

        image_id = data.image_id;
    }

    var uploader = new qq.FileUploader({

        // pass the dom node (ex. $(selector)[0] for jQuery users)
        element: document.getElementById(image_id),

        // path to server-side upload script
        // action: '/server/upload'
        action: action,
        multiple: false,
        sizeLimit: size_limit,	// 10mb
        allowedExtensions: allowedExtensions,
        onComplete: function (id, fileName, responseJSON) {
            console.log(id);
            console.log(fileName);
            console.log(responseJSON);
            if (responseJSON.success == true) {

                if (typeof responseJSON.newFilename !== "undefined") {

                    $('#user_image').val(responseJSON.newFilename);
                }
            }
        }
    });
}

$(document).ready(function () {
    $('div.alert').not('.alert-danger').delay(2000).slideUp(300);
});
