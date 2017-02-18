function ajaxSigin() {
    ++try_numbers;
    var formData = {
        'user': $('#login_email').val(),
        'pass': $('#login_pass').val(),
        'check': $('#login_check').is(':checked'),
        'rcode': $('#g-recaptcha-response-1').val(),
        'tn': try_numbers
    };
    $('#btnsubmit').addClass('disabled').html('POR FAVOR ESPERE...');
    $.ajax({
        type: 'POST',
        url: '/signin',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function(data) {
        console.log(data);
        if (data.result.number_error != 0) {
            if (try_numbers >= 2) {
                $('#signin_reCaptcha').show();
            }
            $('#btnsubmit').removeClass('disabled').html('INICIAR SESIÓN');
            Materialize.toast('Error<br/> ' + data.result.msg_error, 5000, 'rounded');
            $('#login_pass').focus();
        } else {
            $('ul.tabs li').removeClass('disabled');
            Materialize.toast('Bienvenido<br/> ' + data.person.first_name, 5000, 'rounded');
            $('#userInfo').load('partials/user', data.person);
            $('#appmenu').load('partials/appmenu', {
                "person": data.person,
                "settings": data.settings
            });
            $('#tab_authorities').load('partials/authorities', data.workers.authorities);
            $('#tab_teachers').load('partials/teachers', data.workers.teachers);
            $('#tab_administrative_staff').load('partials/administrative', data.workers.administrative_staff);
            $('#tab_honor_roll').load('partials/honor', data.workers.honor_roll);
            $('#tab_birthdays_week').load('partials/birthdays', data.workers.birthdays_week);
            $('ul.tabs').tabs();
        }
    });
}

function ajaxContact() {

    var formData = {
        'name': $('#contact-name').val(),
        'email': $('#contact-email').val(),
        'subject': $('#contact-subject').val(),
        'message': $('#contact-message').val(),
        'send_to': $('input[name=send_to]:checked').val(),
        'recaptcha': $('#g-recaptcha-response').val()
    };
    $('#contact-name').addClass('disabled');
    $('#contact-email').addClass('disabled');
    $('#contact-subject').addClass('disabled');
    $('#contact-message').addClass('disabled');
    $('input[name=send_to]').addClass('disabled');
    $('#contact-btn').addClass('disabled').html('POR FAVOR ESPERE...');

    $.ajax({
        type: 'POST',
        url: '/contact',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function(data) {
        console.log(data);
        $('#contact-name').removeClass('disabled');
        $('#contact-email').removeClass('disabled');
        $('#contact-subject').removeClass('disabled');
        $('#contact-message').removeClass('disabled');
        $('input[name=send_to]').removeClass('disabled');
        $('#contact-btn').removeClass('disabled').html('ENVIAR MENSAJE');
        if (data.result.number_error != 0) {
            Materialize.toast('Error<br/> ' + data.result.msg_error, 5000, 'rounded');
            $('#contact-name').focus();
        } else {
            $('#contact-name').val('');
            $('#contact-email').val('').focus();
            $('#contact-subject').val('').focus();
            $('#contact-message').val('').focus();
            $('#contact-name').focus();
            grecaptcha.reset(contact_reCaptcha);
            Materialize.toast(data.result.msg_error, 5000, 'rounded');
        }
    });
}
