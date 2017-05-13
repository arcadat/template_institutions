/**
    Custom Teachers JS

    1. MOBILE MENU
    2. PRELOADER
    3. BOTTOM TO UP
    4. HIRE ME SCROLL
**/

jQuery(function($){


    /* ----------------------------------------------------------- */
    /*  1. Mobile MENU
    /* ----------------------------------------------------------- */

    jQuery(".button-collapse").sideNav({
        menuWidth: 300, // Default is 300
        closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
        draggable: true // Choose whether you can drag to open on touch screens
    });

    /* ----------------------------------------------------------- */
    /*  2. PRELOADER
    /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded
      jQuery('.progress').fadeOut(); // will first fade out the loading animation
      jQuery('#preloader').delay(100).fadeOut('slow'); // will fade out the white DIV that covers the website.
      jQuery('body').delay(100).css({'overflow':'visible'});
    });

    /* ----------------------------------------------------------- */
    /* 3. BOTTOM TO UP
    /* ----------------------------------------------------------- */

    jQuery(".up-btn, .brand-logo").click(function() {
    jQuery('html,body').animate({
        scrollTop: jQuery("#header").offset().top},
        'slow');
    });

    /* ----------------------------------------------------------- */
    /* 4. HIRE ME SCROLL
    /* ----------------------------------------------------------- */

    jQuery(".hire-me-btn").click(function(e) {
        e.preventDefault();
    jQuery('html,body').animate({
        scrollTop: jQuery("#footer").offset().top},
        'slow');
    });

    /* ----------------------------------------------------------- */
    /* 5. MODAL WINDOWS
    /* ----------------------------------------------------------- */
    jQuery("#modal_download").modal();
    jQuery("#modal_reports").modal();
    jQuery("#modal_results").modal();

    /* ----------------------------------------------------------- */
    /* 6. LIGHTBOX ( FOR PORTFOLIO POPUP VIEW )
    /* ----------------------------------------------------------- */

    jQuery(".portfolio-list").lightGallery({
        selector: '.portfolio-thumbnill',
        download: false
    });

    /* ----------------------------------------------------------- */
    /* 7. COLLAPSIBLE
    /* ----------------------------------------------------------- */

    jQuery('.collapsible').collapsible();


    /* ----------------------------------------------------------- */
    /* 8. DROPDOWN
    /* ----------------------------------------------------------- */

    jQuery('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        alignment: 'right', // Displays dropdown with edge aligned to the left of button
        stopPropagation: true // Stops event propagation
    });

    /* ----------------------------------------------------------- */
    /* 9. TOOLTIPS
    /* ----------------------------------------------------------- */

    jQuery('.tooltipped').tooltip({
        delay: 50,
        html: 'true'
    });

    /* ----------------------------------------------------------- */
    /* 10. TR SELECT
    /* ----------------------------------------------------------- */

    jQuery(".trselected").click(function(){
        jQuery(this).addClass("selected").siblings().removeClass("selected");
    });

    /* ----------------------------------------------------------- */
    /* 11. TABS
    /* ----------------------------------------------------------- */

    jQuery('ul.tabs').tabs();
});

/* ----------------------------------------------------------- */
/* 12. APP MENU
/* ----------------------------------------------------------- */

jQuery('#appmenu').load('partials/appmenu', {
    "person": d_person,
    "settings": d_settings,
    "request": 'teachers',
});

/* ----------------------------------------------------------- */
/* 13. LOAD TABS CONTENT
/* ----------------------------------------------------------- */

jQuery('#data_teacher').load('teachers/partials/data_teacher', d_data);
jQuery('#documents_teacher').load('teachers/partials/documents_teacher', d_documents);
jQuery('#tutorials_teacher').load('teachers/partials/tutorials_teacher', d_tutorials);
jQuery('#class_teacher').load('teachers/partials/class_teacher', d_class);

/* ----------------------------------------------------------- */
/* 14. Alert Message
/* ----------------------------------------------------------- */
function swalc(title,text,type) {
    swal({
        title: title,
        text: text,
        type: type,
        confirmButtonColor: d_color,
        confirmButtonText: "Aceptar"
    });
}

/* ----------------------------------------------------------- */
/* 15. REFRESH TAB
/* ----------------------------------------------------------- */
function refreshTab(tab) {

    var option;

    switch(tab) {
        case 'data_teacher':
            option = 1;
            break;
        case 'documents_teacher':
            option = 2;
            break;
        case 'tutorials_teacher':
            option = 3;
            break;
        case 'class_teacher':
            option = 4;
            break;
    }

    var formData = {
        't': d_settings.token,
        'o': option
    };

    jQuery('#'+tab).html('<div class="progress"><div class="indeterminate"></div></div>');

    jQuery.ajax({
        type: 'POST',
        url: '/teachers/refreshTab',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function(data) {
        console.log(data);
        if (data.result.number_error != 0) {
            swalc(data.result.msg_error, "Error Nro. " + data.result.number_error, "error");
            return false;
        } else {
            jQuery('#'+tab).load('teachers/partials/' + tab, eval('data.' + tab));
        }
    });
}

/* ----------------------------------------------------------- */
/* 16. QUERY RESOURCE
/* ----------------------------------------------------------- */

function queryResource(action, option, name, new_name, content) {

    var formData = {
        't': d_settings.token,
        'action': action,
        'option': option,
        'name': name,
        'new_name': new_name,
        'content': content,
    };
    jQuery.ajax({
        type: 'POST',
        url: '/teachers/resource',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function(data) {
        console.log(data);
        if (data.result.number_error != 0) {
            swalc(data.result.msg_error, "Error Nro. " + data.result.number_error, "error");
            return false;
        }
    });
    return true;
}

/* ----------------------------------------------------------- */
/* 17. NAVIGATION RESOURCE FOLDER
/* ----------------------------------------------------------- */

function loadFolder(id) {
    d_id_folder = id;
    jQuery('#subfoldertitle').text(
        jQuery('#folder_title_'+id).text()
    );
    jQuery('#subfoldertitle').show();
    jQuery('#folders').hide();
    jQuery('#menu_folder').hide();
    jQuery('#menu_youtube').show();
    jQuery('#folder_resources_'+id).show();
}

function closeFolder() {
    jQuery("div[id^='folder_resources_']").hide();
    jQuery('#subfoldertitle').hide();
    jQuery('#menu_youtube').hide();
    jQuery('#menu_folder').show();
    jQuery('#folders').show();
}

/* ----------------------------------------------------------- */
/* 18. ACTION FOLDER MENU
/* ----------------------------------------------------------- */

function actionFolder(action,id) {
    var name = jQuery('#folder_title_'+id).text();
    switch(action) {
        case 'create':
            swal(
                {
                    title: "Crear Carpeta!",
                    text: "Nombre de la Carpeta",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    confirmButtonText: "Guardar",
                    cancelButtonText: "Cancelar",
                    confirmButtonColor: d_color,
                    animation: "slide-from-top",
                    inputPlaceholder: "Carpeta"
                },
                function(inputValue){
                    if (inputValue === false) return false;

                    if (inputValue === "") {
                        swal.showInputError("Necesita ingresar el nombre de la carpeta!");
                        return false
                    }

                    if (createFolder(inputValue)) {
                        swalc("Muy bien!","Se ha creado la carpeta: " + inputValue,"success");
                    } else {
                        swalc("Disculpe","Hubo un error al intentar crear la carpeta: " + inputValue,"error");
                    }
                }
            );
            break;
        case 'update':
            swal(
                {
                    title: "Actualizar Carpeta!",
                    text: "Nombre de la Carpeta",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    confirmButtonColor: d_color,
                    confirmButtonText: "Actualizar",
                    cancelButtonText: "Cancelar",
                    animation: "slide-from-top",
                    inputPlaceholder: name,
                    inputValue: name,
                },
                function(inputValue){
                    if (inputValue === false) return false;

                    if (inputValue === "") {
                        swal.showInputError("Necesita ingresar el nuevo nombre de la carpeta!");
                        return false
                    }

                    if (updateFolder(id,name,inputValue)) {
                        swalc("Muy bien!", "Se ha actualizado el nombre de la carpeta a: " + inputValue, "success");
                    } else {
                        swalc("Disculpe!", "Hubo un error al intentar actualizar el nombre de la carpeta a: " + inputValue, "error");
                    }
                }
            );
            break;
        case 'delete':
            swal(
                {
                    title: "¿Está seguro de continuar?",
                    text: 'La carpeta <b>"'+name+'"</b> será borrada con todo su contenido, y la información no podrá ser recuperada!',
                    html: true,
                    type: "warning",
                    confirmButtonColor: d_color,
                    showCancelButton: true,
                    confirmButtonText: "Si, Borrar!",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false
                },
                function(){
                    if(removeFolder(id, name)) {
                        swalc("Eliminada!", "La carpeta "+name+" ha sido eliminada.", "success");
                    } else {
                        swalc("Disculpe!", "La carpeta "+name+" no pudo ser eliminada.", "error");
                    }
                }
            );
            break;
    }
}

/* ----------------------------------------------------------- */
/* 19. CREATE FOLDER
/* ----------------------------------------------------------- */

function createFolder(folder) {

    if(!queryResource(1, 1, folder, '', '')) return false;

    d_resources.folders_teaching_resource++;
    jQuery('#folders').prepend(
        '<div id="folder_' + d_resources.folders_teaching_resource + '" class="col s12 m6">' +
            '<div class="card horizontal hoverable">' +
                '<div class="card-image fontCircle" style="background-color: ' + d_settings.color_i + '">' +
                    '<i class="material-icons medium">folder</i>' +
                '</div>' +
                '<div class="card-stacked">' +
                    '<div class="card-content">' +
                        '<span id="folder_title_' + d_resources.folders_teaching_resource + '">' + folder + '</span>' +
                        '<a href="#" class="right dropdown-button" data-activates="dropdown_' + d_resources.folders_teaching_resource + '"><i class="material-icons">more_vert</i></a href="#">' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<ul id="dropdown_' + d_resources.folders_teaching_resource + '" class="dropdown-content">' +
                '<li><a href="#!" onclick="loadFolder(' + d_resources.folders_teaching_resource + ',\'' + folder + '\');"><i class="material-icons">folder</i>Abrir</a></li>' +
                '<li class="divider"></li>' +
                '<li><a href="#!" onclick="actionFolder(\'update\',\''+ d_resources.folders_teaching_resource +'\');"><i class="material-icons">mode_edit</i>Editar</a></li>' +
                '<li><a href="#!" onclick="actionFolder(\'delete\',\''+ d_resources.folders_teaching_resource +'\');"><i class="material-icons">delete</i>Borrar</a></li>' +
            '</ul>' +
        '</div>'
    );
    jQuery('#tab_2').append('<div id="folder_resources_' + d_resources.folders_teaching_resource + '" class="portfolio-list col s12" style="display: none;"></div>');
    jQuery('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        alignment: 'right', // Displays dropdown with edge aligned to the left of button
        stopPropagation: true // Stops event propagation
    });

    return true;
}

/* ----------------------------------------------------------- */
/* 20. UPDATE FOLDER
/* ----------------------------------------------------------- */

function updateFolder(id, name, new_name) {

    if(!queryResource(2, 1, name, new_name, '')) return false;

    jQuery('#folder_title_'+id).text(new_name);

    return true;
}

/* ----------------------------------------------------------- */
/* 21. REMOVE FOLDER
/* ----------------------------------------------------------- */

function removeFolder(id, name) {

    if(!queryResource(3, 1, name, '', '')) return false;

    jQuery('#folder_'+id).remove();
    jQuery('#folder_resources_'+id).remove();

    return true;
}

/* ----------------------------------------------------------- */
/* 22. ACTION RESOURCE MENU
/* ----------------------------------------------------------- */

function actionResource(action, id_folder, id_resource, code) {
    var name = jQuery('#folder_title_'+d_id_folder).text();
    switch(action) {
        case 'create':
            swal(
                {
                    title: "Crear Recurso!",
                    text: "En su navegador, seleccione y copie el codigo del enlace del video que desea agregar, como se muestra en la figura de ejemplo<br/><img class='responsive-img' src='http://www.arcadat.com/screen_guide/copy_code_video_youtube.png'/><br/>Código del video de enlace de youtube:",
                    type: "input",
                    html: true,
                    confirmButtonColor: d_color,
                    showCancelButton: true,
                    confirmButtonText: "Guardar",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputPlaceholder: "Código"
                },
                function(inputValue){
                    if (inputValue === false) return false;

                    if (inputValue === "") {
                        swal.showInputError("Necesita ingresar el codigo de youtube!");
                        return false;
                    }

                    if (createResource(d_id_folder,name,inputValue)) {
                        swalc("Muy bien!", "Se ha creado la carpeta: " + inputValue, "success");
                    } else {
                        swalc("Disculpe!", "Hubo un error al intentar crear la carpeta: " + inputValue, "error");
                    }
                }
            );
            break;
        case 'delete':
            swal(
                {
                    title: "¿Está seguro de continuar?",
                    text: 'El recurso será borrado, y no podrá ser recuperado!',
                    html: true,
                    type: "warning",
                    confirmButtonColor: d_color,
                    showCancelButton: true,
                    confirmButtonText: "Si, borrar!",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false
                },
                function(){
                    if(removeResource(id_folder, id_resource, code)) {
                        swalc("Eliminado!", "El recurso ha sido eliminado.", "success");
                    } else {
                        swalc("Disculpe!", "El recurso no pudo ser eliminado.", "error");
                    }
                }
            );
            break;
    }
}

/* ----------------------------------------------------------- */
/* 23. CREATE RESOURCE
/* ----------------------------------------------------------- */

function createResource(id_folder, folder, code) {

    if(!queryResource(1, 2, code, '', folder)) return false;

    var id_resource = ++d_resources.list_folders[id_folder].files_folder.numbers_items_url_youtube;
    jQuery.getJSON( "https://noembed.com/embed?format=json&url=https://www.youtube.com/watch/?v="+code)
        .done(function (json) {
            jQuery('#folder_resources_'+id_folder).prepend(
                '<div id="resource_item_'+id_folder+'_'+id_resource+'" class="col s12 m4">' +
                    '<div class="card small hoverable" id="resource-list">' +
                        '<div class="card-image mix">' +
                            '<a class="portfolio-thumbnill" target="_blank" href="https://www.youtube.com/embed/'+code+'/?autoplay=1">' +
                                '<img src="https://i.ytimg.com/vi/'+code+'/hqdefault.jpg" alt="">' +
                                '<i class="material-icons view-icon">play_circle_outline</i>' +
                            '</a>'+
                        '</div>' +
                        '<div class="card-content">' +
                            '<span class="card-title activator" onclick="actionResource(\'delete\',\''+id_folder+'\',\''+id_resource+'\',\''+code+'\');"><i class="material-icons right">delete</i></span>' +
                            '<p>'+json.title+'</p>' +
                        '</div>' +
                    '</div>' +
                '</div>'
            );
    });

    jQuery(".portfolio-list").lightGallery({
        selector: '.portfolio-thumbnill',
        download: false
    });

    return true;
}

/* ----------------------------------------------------------- */
/* 24. REMOVE RESOURCE
/* ----------------------------------------------------------- */

function removeResource(id_folder, id_resource, code) {

    var content = jQuery('#folder_title_'+id_folder).text();
    if(!queryResource(3, 2, code, '', content)) return false;

    jQuery('#resource_item_'+id_folder+'_'+id_resource).remove();

    return true;
}

/* ----------------------------------------------------------- */
/* 25. NAVIGATION CLASS APP
/* ----------------------------------------------------------- */

function loadClassApp(opt, parm) {
    jQuery('#class_list').hide();
    jQuery('#class_app').html('<div class="progress"><div class="indeterminate"></div></div>');
    jQuery('#class_app').show();
    parm.params.t = d_settings.token;
    jQuery('#class_app').load('teachers/classapp/' + opt, parm);
}

function closeClassApp() {
    jQuery('#class_app').hide();
    jQuery('#class_list').show();
}

function absences_save() {
    var formData = {
        't': d_settings.token,
        'absences_list': jQuery('#absences_students_data').val(),
        'type_subject': jQuery('#type_subject').val(),
        'lapse_absences': jQuery('#lapse_absences').val(),
    };
    jQuery.ajax({
        type: 'POST',
        url: '/teachers/absences_save',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function(data) {
        console.log(data);
        if (data.result.number_error !== 0) {
            swalc("Error!", data.result.msg_error, "error");
        } else {
            absencesChange = false;
            swalc("Muy bien!", data.result.msg_error, "success");
        }
    });
}

function qlfs_save() {
    var formData = {
        't': d_settings.token,
        'lapse': jQuery('#lapse').val(),
        'type_class': jQuery('#type_class').val(),
        'id_evaluation': jQuery('#id_evaluation').val(),
        'qlfs_list': jQuery('#results_students_data').val(),
    };
    jQuery.ajax({
        type: 'POST',
        url: '/teachers/save_qlfs_teacher',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function(data) {
        console.log(data);
        if (data.result.number_error !== 0) {
            swalc("Error!", data.result.msg_error, "error");
            return false;
        } else {
            swalc("Muy bien!", data.result.msg_error, "success");
            return true;
        }
    });
}

function evaluations_save() {
    var formData = {
        't': d_settings.token,
        'lapse': jQuery('#lapse').val(),
        'type_class': jQuery('#type_class').val(),
        'id_evaluation': jQuery('#id_evaluation').val(),
        'evaluations_list': jQuery('#evaluations_data').val(),
    };
    jQuery.ajax({
        type: 'POST',
        url: '/teachers/save_evaluation_plan',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function(data) {
        console.log(data);
        if (data.result.number_error !== 0) {
            swalc("Error!", data.result.msg_error, "error");
            return false;
        } else {
            evaluations_list = {};
            jQuery("input[id^='eval_date_']").val('');
            jQuery("textarea[id^='eval_desc_']").val('');
            jQuery("input[id^='eval_perc_']").val('0.0').attr('disabled',true);
            jQuery.each(data.list_evaluations.evaluations, function(index, el) {
                evaluations_list[index] = {
                    date:  el.date.date,
                    description: el.description,
                    percent: Number(el.percent).toFixed(2),
                };
                jQuery('#eval_date_' + index).val(moment(el.date.date,'YYYY-MM-DD HH:mm:ss').format('DD-MM-YYYY'));
                jQuery('#eval_desc_' + index).val(el.description);
                jQuery('#eval_perc_' + index).val(Number(el.percent).toFixed(2)).removeAttr('disabled');
            });
            swalc("Muy bien!", data.result.msg_error, "success");
            return true;
        }
    });
}

function importEvaluation (option,lapse,id_section,id_turn,id_detail,id_subject) {

    var formData = {
        't'         : d_settings.token,
        'option'    : option,
        'type_class': d_params.type_class,
        'lapse'     : (lapse) ? lapse : jQuery('#lapse').val(),
        'id_section': (id_section) ? id_section : d_params.id_section,
        'id_turn'   : (id_turn) ? id_turn : d_params.id_turn,
        'id_period' : d_params.id_period,
        'id_pensum' : d_params.id_pensum,
        'id_detail' : (id_detail) ? id_detail : d_params.id_detail,
        'id_subject': (id_subject) ? id_subject : d_params.id_subject,
    };
    jQuery('#list_evaluations_import').html('<div class="progress"><div class="indeterminate"></div></div>');
    jQuery.ajax({
        type: 'POST',
        url: '/teachers/import_evaluation_plan',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function(data) {
        console.log(data);
        if (data.result.number_error !== 0) {
            swalc("Error!", data.result.msg_error, "error");
            return false;
        } else {
            if (option == 1) {
                var html_output = '<div class="collection">';
                if (data.sections.numbers_sections > 0) {
                    jQuery.each(data.sections.list_sections, function(index, el) {
                        html_output += '<a href="#!" class="collection-item" onclick="importEvaluation(2,'+
                            el.lapse+','+
                            el.id_section+','+
                            el.id_turn+','+
                            el.id_detail+','+
                            el.id_subject+')">'+
                            el.name_subject+' '+el.name_level+' ('+el.name_section+')</a>';
                    });
                } else {
                    html_output += '<a href="#!" class="collection-item">Sin Registro</a>';
                }
                html_output += '</div>';
                jQuery('#list_evaluations_import').html(html_output);
            } else if(option == 2) {
                evaluations_list = {};
                jQuery("input[id^='eval_date_']").val('');
                jQuery("textarea[id^='eval_desc_']").val('');
                jQuery("input[id^='eval_perc_']").val('0.0').attr('disabled',true);
                jQuery.each(data.evaluations.list_evaluations, function(index, el) {
                    evaluations_list[index] = {
                        date:  el.date.date,
                        description: el.description,
                        percent: Number(el.percent).toFixed(2),
                    };
                    jQuery('#eval_date_' + index).val(moment(el.date.date,'YYYY-MM-DD HH:mm:ss').format('DD-MM-YYYY'));
                    jQuery('#eval_desc_' + index).val(el.description);
                    jQuery('#eval_perc_' + index).val(Number(el.percent).toFixed(2)).removeAttr('disabled');
                });
                jQuery('#modal_evaluations').modal('close');
                swalc("Muy bien!", data.result.msg_error, "success");
            }
            return true;
        }
    });
}
