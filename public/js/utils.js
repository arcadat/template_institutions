function ajaxSigin() {
    var formData = {
        'user': $('#login_email').val(),
        'pass': $('#login_pass').val(),
        'check': $('#login_check').is(':checked')
    };
    $.ajax({
        type: 'POST',
        url: '/signin',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function(data) {
        console.log(data);
        if (data.result.number_error != 0) {
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
            // $('#honor_roll').load('partials/honor', data.workers.honor_roll).show();
            $('#birthdays_week').load('partials/birthdays', data.workers.birthdays_week).show();
            $('ul.tabs').tabs();
        }
    });
}
