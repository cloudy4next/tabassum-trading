$('.btn-submit-action').on('click', function (e) {
    $("#myForm").submit();
});

window.loadModal = function (url) {
    $("#body-content").load(url);
}

window.fadeOutAndClear = function (elementId, timeout = 2000) {
    setTimeout(() => {
        $(`#${elementId}`).fadeOut('slow', function () {
            $(this).html('');
            $(this).show(); // Ensure it’s not permanently hidden if you want to reuse it.
        });
    }, timeout);
};

window.ajaxGet = function (url, data = {}, successCallback, errorCallback, completeCallback) {
    $.ajax({
        url: url,
        method: 'GET',
        data: data,
        success: function (response) {
            if (successCallback && typeof successCallback === 'function') {
                successCallback(response);
            }
        },
        error: function (error) {
            if (errorCallback && typeof errorCallback === 'function') {
                errorCallback(error);
            }
        },
        complete: function () {
            if (completeCallback && typeof completeCallback === 'function') {
                completeCallback();
            }
        }
    });
};

window.ajaxRequest = function (url, data = {}, successCallback, errorCallback, completeCallback) {
    let settings = {
        url: url,
        type: "POST",
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (successCallback && typeof successCallback === 'function') {
                successCallback(response);
            }
            console.log(response);
            if (response.data && response.alert) {
                $("#alert").html(response.alert);
                window.fadeOutAndClear('alert', 2000);
            }
        },
        error: function (error) {
            if (error && error.responseJSON) {
                const response = error.responseJSON;
                if (response.alert) {
                    $("#alert").html(response.alert);
                }
            } else {
                console.error('An error occurred:', error);
            }
            window.fadeOutAndClear('alert', 2000);

            // Call the errorCallback after handling the error
            if (errorCallback && typeof errorCallback === 'function') {
                errorCallback(error);
            }
        },
        complete: function () {
            $('html, body').scrollTop(0);
            if (completeCallback && typeof completeCallback === 'function') {
                completeCallback();
            }
        }
    };

    if (data instanceof FormData) {
        settings.processData = false; // don't process the data
        settings.contentType = false; // set content type to false as jQuery will tell the server it's a query string request
    }

    $.ajax(settings);
};

window.ajaxPost = function (url, data, successCallback, errorCallback, completeCallback) {
    ajaxRequest(url, data, successCallback, errorCallback, completeCallback);
};

window.ajaxPut = function (url, data, successCallback, errorCallback, completeCallback) {
    data.append('_method', 'put'); // Add the _method field with value 'PATCH'
    ajaxRequest(url, data, successCallback, errorCallback, completeCallback);
};

window.ajaxPatch = function (url, data, successCallback, errorCallback, completeCallback) {
    data.append('_method', 'patch'); // Add the _method field with value 'PATCH'
    ajaxRequest(url, data, successCallback, errorCallback, completeCallback);
};


window.resetForm = function () {

// Reset text, email, password fields
    $('#ajax-form input[type="text"], #ajax-form input[type="email"], #ajax-form input[type="password"], #ajax-form textarea').val('');

// Reset radio buttons and checkboxes
    $('#ajax-form input[type="radio"], #ajax-form input[type="checkbox"]').prop('checked', false);

// Reset select dropdowns
    $('#ajax-form select').prop('selectedIndex', 0);

// Reset CKEditor instances
//     $('.editor').each(function () {
//         const id = $(this).attr('id');
//         if (ckEditorsMap[id]) {
//             ckEditorsMap[id].setData('');
//         }
//     });
}

$(document).delegate(".ajax-submit-button", "click", function (event) {
    event.preventDefault();
    $("#alert").html("");
    const btn = $(this);
    btn.buttonLoader('start');

    // $('[ck-id]').each(function () {
    //     const ckIdValue = $(this).attr('ck-id');
    //     $(this).val(ckEditorsMap[ckIdValue].getData());
    // });

    $('[tinymce-id]').each(function () {
        const tmcIdValue = $(this).attr('tinymce-id');
        tinymceEditorsMap[tmcIdValue].triggerSave();
    });


    const form = $('form#ajax-form')[0]; // You need to use standard javascript object here
    const formData = new FormData(form);

    const method = $(this).data('method'); // Using data() method
    // const action = $(this).data('action'); // Using data() method

    const ajaxFunction = (function () {
        switch (method) {
            case 'put':
                return window.ajaxPut;
            case 'patch':
                return window.ajaxPatch;
            default:
                return window.ajaxPost;
        }
    })();

    ajaxFunction($("#ajax-form").attr('action'), formData, function (data) {
        console.log('Received data:', data);
        // resetForm()
    }, function (error) {
        console.error('An unexpected error occurred:', error);
        btn.buttonLoader('stop');
    }, function () {
        console.log('Request completed');
        btn.buttonLoader('stop');
    });
});




