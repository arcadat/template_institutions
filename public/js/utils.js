function ajaxSigin() {
    ++try_numbers;
    var formData = {
        'user': $('#login_email').val(),
        'pass': $('#login_pass').val(),
        'check': $('#login_check').is(':checked'),
        'rcode': $('#g-recaptcha-response-1').val(),
        'tn': try_numbers
    };
    $('#login_email').attr('disabled',true);
    $('#login_pass').attr('disabled',true);
    $('#login_check').attr('disabled',true);
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
                grecaptcha.reset(signin_reCaptcha);
                $('#signin_reCaptcha').show();
            }
            $('#login_email').removeAttr('disabled');
            $('#login_pass').removeAttr('disabled');
            $('#login_check').removeAttr('disabled');
            $('#btnsubmit').removeClass('disabled').html('INICIAR SESIÓN');
            Materialize.toast('Error<br/> ' + data.result.msg_error, 5000, 'rounded');
            $('#login_pass').focus();
        } else {
            $('ul.tabs li').removeClass('disabled');
            Materialize.toast('Bienvenido<br/> ' + data.person.first_name, 5000, 'rounded');
            $('#userInfo').load('partials/user', data.person);
            $('#appmenu').load('partials/appmenu', {
                "person": data.person,
                "settings": data.settings,
                "request": 'web',
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
    $('#contact-name').attr('disabled',true);
    $('#contact-email').attr('disabled',true);
    $('#contact-subject').attr('disabled',true);
    $('#contact-message').attr('disabled',true);
    $('input[name=send_to]').attr('disabled',true);
    $('#contact-btn').addClass('disabled').html('POR FAVOR ESPERE...');

    $.ajax({
        type: 'POST',
        url: '/contact',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function(data) {
        console.log(data);
        $('#contact-name').removeAttr('disabled');
        $('#contact-email').removeAttr('disabled');
        $('#contact-subject').removeAttr('disabled');
        $('#contact-message').removeAttr('disabled');
        $('input[name=send_to]').removeAttr('disabled');
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
            Materialize.toast(data.result.msg_error, 5000, 'rounded');
        }
        grecaptcha.reset(contact_reCaptcha);
    });
}


function ajaxRecovery() {

    var formData = {
        'email': $('#recovery_email').val(),
    };
    $('#recovery_email').attr('disabled',true);
    $('#recovery_btn').addClass('disabled').html('POR FAVOR ESPERE...');

    $.ajax({
        type: 'POST',
        url: '/recovery',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function(data) {
        console.log(data);
        $('#recovery_email').removeAttr('disabled');
        $('#recovery_btn').removeClass('disabled').html('ENVIAR MENSAJE');
        if (data.result.number_error != 0) {
            Materialize.toast('Error<br/> ' + data.result.msg_error, 5000, 'rounded');
            $('#recovery_email').focus();
        } else {
            $('#recovery-content').hide('slow');
            $('#recovery-message').html('<h5 class="center-align">'+data.result.msg_error+'<h5>').show('slow');
        }
    });
}


function ajaxRegister() {

    var formData = {
        'op': $('#register_option').val(),
        'id': $('#register_nip').val(),
        'date': $('#register_date').val(),
        'recaptcha': $("#register_frm [name='g-recaptcha-response']").val(),
    };
    $('#register_nip').attr('disabled',true);
    $('#register_date').attr('disabled',true);
    $('#register_btn').addClass('disabled').html('POR FAVOR ESPERE...');

    $.ajax({
        type: 'POST',
        url: '/register',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function(data) {
        console.log(data);
        grecaptcha.reset(register_reCaptcha);
        $('#register_nip').removeAttr('disabled');
        $('#register_date').removeAttr('disabled');
        $('#register_btn').removeClass('disabled').html('ENVIAR MENSAJE');
        if (data.result.number_error != 0) {
            Materialize.toast('Error<br/> ' + data.result.msg_error, 5000, 'rounded');
            $('#register_nip').focus();
        } else {
            $('#modal_process').load('partials/register2', data.data_person);
        }
    });
}

function ajaxRegister2() {

    var formData = {
        'op': $('#register2_option').val(),
        'id': $('#register2_id_person').val(),
        'email': $('#register2_email').val(),
        'pass': $('#register2_pass').val(),
    };
    $('#register2_email').attr('disabled',true);
    $('#register2_pass').attr('disabled',true);
    $('#register2_pass1').attr('disabled',true);
    $('#register2_btn').addClass('disabled').html('POR FAVOR ESPERE...');

    $.ajax({
        type: 'POST',
        url: '/register2',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function(data) {
        console.log(data);
        grecaptcha.reset(register_reCaptcha);
        $('#register2_email').removeAttr('disabled');
        $('#register2_pass').removeAttr('disabled');
        $('#register2_pass1').removeAttr('disabled');
        $('#register2_btn').removeClass('disabled').html('ENVIAR MENSAJE');
        if (data.result.number_error != 0) {
            Materialize.toast('Error<br/> ' + data.result.msg_error, 5000, 'rounded');
            $('#register2_email').focus();
        } else {
            $('#register2-content').hide('slow');
            $('#register2-message').html('<h5 class="center-align">'+data.result.msg_error+'</h5>').show('slow');
        }
    });
}


function loadModal(proc) {

    $('#modal_process').load('partials/'+proc, {'process': proc});

}
