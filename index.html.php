<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>
        <?php echo $main_data->name_i ?>
    </title>

    <!-- Favicon -->
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo $main_data->root_favicon . $main_data->favicon_i ?>' />
    <!-- CSS  -->
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <!-- Font Awesome -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Skill Progress Bar -->
    <link href="css/pro-bars.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <!-- Owl Carousel -->
    <link href='css/fullcalendar.min.css' rel='stylesheet' />
    <link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
    <!-- Default Theme CSS File-->
    <link id="switcher" href="css/theme.css.php?color_i=<?php echo urlencode($main_data->color_i); ?>" type="text/css" rel="stylesheet" media="screen,projection" />
    <!-- LightGallery -->
    <link type="text/css" rel="stylesheet" href="css/lightgallery.min.css" />
    <!-- Main css File -->
    <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection" />

    <!-- Font -->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <!-- BEGAIN PRELOADER -->
    <div id="preloader">
        <div class="progress">
            <div class="indeterminate"></div>
        </div>
        <div class="caja">
            <h6>Bienvenido a nuestro sitio web</h6><br><br>
            <img src="<?php echo $main_data->root_logo . $main_data->logo_i ?>" alt="Logo">
            <p><b><?php echo $main_data->name_i ?></b><br>
                <?php echo $main_data->slogan_i ?>
            </p>
        </div>
    </div>
    <!-- END PRELOADER -->
    <header id="header" role="banner">
        <div class="navbar-fixed">
            <nav>
                <div class="container">
                    <div class="nav-wrapper">

                        <!-- LOGO -->

                        <!-- TEXT BASED LOGO -->
                        <a href="#" class="brand-logo">
                            <?php if (!empty($main_data->logo_top_i)): ?>
                            <img src="<?php echo $main_data->root_logo_top . $main_data->logo_top_i ?>" alt="<?php echo $main_data->name_i ?>">
                            <?php else: ?>
                            <?php echo $main_data->name_i ?>
                            <?php endif;?>
                        </a>

                        <!-- Image Based Logo -->
                        <!-- <a href="index.html" class="brand-logo"><img src="img/logo.jpeg" alt="logo img"></a>  -->
                        <ul class="right hide-on-med-and-down custom-nav menu-scroll">
                            <li><a href="#about">Nosotros</a></li>
                            <li><a href="#resume">Historia</a></li>
                            <li><a href="#edcuation"><?php echo $degree->label_degree ?></a></li>
                            <?php if ($installations->installations): ?>
                            <li><a href="#portfolio">Instalaciones</a></li>
                            <?php endif;?>
                            <li><a href="#calendar">Cronograma</a></li>
                            <li><a href="#footer">Contáctenos</a></li>
                        </ul>
                        <!-- For Mobile View -->
                        <ul id="slide-out" class="side-nav menu-scroll">
                            <li><a href="#about">Nosotros</a></li>
                            <li><a href="#resume">Historia</a></li>
                            <li><a href="#edcuation"><?php echo $degree->label_degree ?></a></li>
                            <?php if ($installations->installations): ?>
                            <li><a href="#portfolio">Instalaciones</a></li>
                            <?php endif;?>
                            <li><a href="#calendar">Cronograma</a></li>
                            <li><a href="#footer">Contáctenos</a></li>
                        </ul>
                        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <div class="main-wrapper">
        <main role="main">
            <!-- START HOME SECTION -->
            <section id="home">
                <!-- div class="container" -->
                <div class="overlay-section"></div>
                <div class="slider">
                    <ul class="slides">
                        <?php
                        if ($covers->covers):
                            foreach ($photos_covers as $photo_cover):?>
                            <li>
                                <img src="<?php echo $main_data->root_covers . $photo_cover->cover ?>">
                                <div class="caption center-align">
                                    <h3><?php echo $photo_cover->ad_cover ?></h3>
                                </div>
                            </li>
                            <?php
                            endforeach;
                        endif;?>
                    </ul>
                </div>
                <!-- /div -->
                <!-- /div -->
            </section>

            <!-- START ABOUT SECTION -->
            <section id="about">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <div class="about-inner">
                                <div class="row">
                                    <div class="col s12 m4 l3">
                                        <div class="about-inner-left">
                                            <img class="profile-img" src="<?php echo $main_data->root_logo . $main_data->logo_i ?>" alt="Profile Image">
                                        </div>
                                    </div>
                                    <div class="col s12 m8 l9">
                                        <div class="about-inner-right">
                                            <h3><?php echo $main_data->name_i ?></h3>
                                            <p>
                                                <?php echo strtoupper($main_data->city_i . ' '. $main_data->state_i . ', ' . $main_data->country_i); ?>
                                            </p>
                                            <div class="personal-information col s12 m12 l6">
                                                <h3>DATOS OFICIALES</h3>
                                                <ul>
                                                    <li><span>Código : </span>
                                                        <?php echo $main_data->code_i ?>
                                                    </li>
                                                    <li><span>Fundado : </span>
                                                        <?php echo strftime("%d de %B de %Y", strtotime($main_data->date_foundation->date)); ?>
                                                    </li>
                                                    <li><b><?php echo $tiempoServicio ?></b></li>
                                                    <li><span>Teléfono : </span>
                                                        <?php echo $main_data->phone_i ?>
                                                    </li>
                                                    <li><span>Email : </span>
                                                        <?php echo $main_data->email_i ?>
                                                    </li>
                                                    <li><span>Dirección : </span>
                                                        <?php echo $main_data->address_i . ', ' . strtoupper($main_data->city_i . ' ' . $main_data->state_i . ', ' . $main_data->country_i); ?>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="resume-download col s12 m12 l6">
                                                <a href="#footer" class="hire-me-btn waves-effect waves-light btn btn-large resume-btn"><i class="material-icons">send</i>&nbsp;&nbsp;Contáctenos</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Start Resume -->
            <section id="resume">
                <!-- Start Skill -->
                <section id="skill">
                    <div class="container">
                        <div class="skill-inner">
                            <h2 class="title">Historia</h2>
                            <p><?php echo strip_tags($main_data->short_description_i, '<div><strong><br>') ?></p>
                        </div>
                    </div>
                </section>
                <!-- Start Objetivos -->
                <section id="experience">
                    <div class="container">
                        <div class="experience-inner">
                            <h2 class="title">Objetivos</h2>
                            <p><?php echo strip_tags($main_data->target_i, '<strong><br>') ?></p>
                        </div>
                    </div>
                </section>
            </section>
            <!-- Start Education -->
            <?php if ($degree->degree): ?>
            <section id="edcuation">
                <div class="container">
                    <div class="education-inner">
                        <h2 class="title"><?php echo $degree->label_degree ?></h2>
                        <div class="row">
                            <?php if ($degree->degree):
                                foreach ($data_degree as $data): ?>
                                <div class="col s12 m6">
                                    <div class="card">
                                        <div class="card-content white-text" style="background-color: <?php echo $data->color ?>;">
                                            <span class="card-title"><b><?php echo $data->name ?></b></span>
                                            <p><?php echo $data->levels ?></p>
                                        </div>
                                        <div class="card-action text-darken-2">
                                            <p><?php echo str_replace("\\n", "<br/>", strip_tags($data->profile, '<strong><br><li>')) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;
                            endif;?>
                        </div>
                    </div>
                </div>
            </section>
            <?php endif;?>
            <?php if ($installations->installations): ?>
            <!-- Start Portfolio -->
            <section id="portfolio">
                <div class="portfolio-top">
                    <div class="container">
                        <div class="portfolio-top-inner">
                            <h2 class="title">Instalaciones</h2>
                        </div>
                    </div>
                </div>
                <div class="portfolio-bottom">
                    <div class="container">
                        <div class="portfolio-bottom-inner">
                            <div id="portfolio-list">
                            <?php foreach ($photos_installations as $photo_installation):?>
                                <div class="mix">
                                    <a class="portfolio-thumbnill" href="<?php echo $main_data->root_installations . $photo_installation->installation ?>" data-sub-html="<?php echo $photo_installation->ad_installation ?>">
                                        <img src="<?php echo $main_data->root_thumbs_installations . $photo_installation->installation ?>" />
                                        <i class="material-icons view-icon">pageview</i>
                                    </a>
                                </div>
                            <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php endif;?>
            <!-- Start Calendar -->
            <section id="calendarioacademico">
                <div class="portfolio-top">
                    <div class="container">
                        <div class="portfolio-top-inner">
                            <h2 class="title">Cronograma Académico</h2>
                        </div>
                    </div>
                </div>
                <div class="portfolio-bottom">
                    <div class="container">
                        <div id='calendar'></div><br/>
                    </div>
                </div>
            </section>
            <!-- Start Footer -->
            <footer id="footer" role="contentinfo">
                <!-- Start Footer Top -->
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <div class="footer-top-inner">
                                    <h2 class="title">Contáctenos</h2>
                                    <div class="contact">
                                        <div class="row">
                                            <div class="col s12 m6 l6">
                                                <div class="contact-form">
                                                    <form>
                                                        <div class="input-field">
                                                            <input type="text" class="input-box" name="contactName" id="contact-name">
                                                            <label class="input-label" for="contact-name">Nombre</label>
                                                        </div>
                                                        <div class="input-field">
                                                            <input type="email" class="input-box" name="contactEmail" id="email">
                                                            <label class="input-label" for="email">Email</label>
                                                        </div>
                                                        <div class="input-field">
                                                            <input type="text" class="input-box" name="contactSubject" id="subject">
                                                            <label class="input-label" for="subject">Asunto</label>
                                                        </div>
                                                        <div class="input-field textarea-input">
                                                            <textarea class="materialize-textarea" name="contactMessage" id="textarea1"></textarea>
                                                            <label class="input-label" for="textarea1">Mensaje</label>
                                                        </div>
                                                        <button class="left waves-effect btn-flat brand-text submit-btn" type="submit">enviar mensaje</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col s12 m6 l6">
                                                <div id="mapa" class="contact-map"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Footer Bottom -->
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col s12">
                                <div class="footer-inner">
                                    <!-- Bottom to Up Btn -->
                                    <button class="btn-floating btn-large up-btn"><i class="material-icons">expand_less</i></button>
                                    <p class="design-info">Servicio proporcionado por<br/>
                                        <a href="http://www.arcadat.com/"><img src="<?php echo $main_data->logo_arcadat_footer ?>" alt=""></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </main>
    </div>
    <!-- jQuery Library -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!-- Materialize js -->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!-- Skill Progress Bar -->
    <script type="text/javascript" src="js/appear.min.js"></script>
    <script type="text/javascript" src="js/pro-bars.min.js"></script>
    <!-- Owl slider -->
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <!-- counter -->
    <script type="text/javascript" src="js/waypoints.min.js"></script>
    <script type="text/javascript" src="js/jquery.counterup.min.js"></script>
    <!-- FullCalendar -->
    <script type="text/javascript" src='js/moment.min.js'></script>
    <script type="text/javascript" src='js/fullcalendar.min.js'></script>
    <script type="text/javascript" src='js/fullcalendar.locale.min.es.js'></script>
    <!-- Google Maps -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6-_MBg2QXptawIOEdL7-k1doOfuYdm70"></script>
    <script type="text/javascript" src="js/gmaps.min.js"></script>
    <!-- A jQuery plugin that adds cross-browser mouse wheel support. (Optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    <script src="js/lightgallery.min.js"></script>

    <!-- lightgallery plugins -->
    <script src="js/lg-thumbnail.min.js"></script>
    <script src="js/lg-fullscreen.min.js"></script>

    <!-- GmapsJs Config -->
    <script type="text/javascript">
        $(document).ready(function() {
            var fuente = <?php echo $data_schedule ?>;

            $('#calendar').fullCalendar({
                defaultDate: '<?php echo date('Y-m-d'); ?>',
                locale: 'es',
                height: 700,
                editable: true,
                eventLimit: true <?php if (isset($data_schedule) && !empty($data_schedule)): ?>,
                /* eventRender: function(event, element) {
                    element.addClass('tooltipped');
                    element.attr('data-position', 'top');
                    element.attr('data-html', 'true');
                    element.attr('data-tooltip', event.title + '<br/>Del: ' + moment(event.start).format('DD/MM/YYYY') + '<br/>Al: ' + moment(event.end).format('DD/MM/YYYY'));
                }, */
                eventMouseover: function (data, event, view) {
                    tooltip = '<div class="tooltiptopicevent" style="color:#fff;width:auto;height:auto;background:<?php echo $main_data->color_i ?>;text-transform:uppercase;position:absolute;z-index:10001;padding:10px 10px 10px 10px;line-height:100%;">' + data.title + '</br>Del' + ': ' + moment(data.start).format('DD/MM/YYYY') + '<br/>Al: ' + moment(data.end).subtract(1,'days').format('DD/MM/YYYY') + '</div>';


                    $("body").append(tooltip);
                    $(this).mouseover(function (e) {
                        $(this).css('z-index', 10000);
                        $('.tooltiptopicevent').fadeIn('500');
                        $('.tooltiptopicevent').fadeTo('10', 1.9);
                    }).mousemove(function (e) {
                        $('.tooltiptopicevent').css('top', e.pageY + 15);
                        $('.tooltiptopicevent').css('left', e.pageX - 70);
                    });


                },
                eventMouseout: function (data, event, view) {
                    $(this).css('z-index', 8);

                    $('.tooltiptopicevent').remove();

                },
                dayClick: function () {
                    tooltip.hide()
                },
                eventResizeStart: function () {
                    tooltip.hide()
                },
                eventDragStart: function () {
                    tooltip.hide()
                },
                viewDisplay: function () {
                    tooltip.hide()
                },
                events: fuente
                <?php endif;?>
            });

            var map;
            var latitud = <?php echo $main_data->latitud_i; ?>;
            var longitud = <?php echo $main_data->longitud_i; ?>;
            var titulo = "<?php echo $main_data->name_i ?>";
            var contenido = '<?php
                echo '<div id="content" style="height:130px; width:320px;"><h6 id="firstHeading" style=" font-weight:bold; font-size:14px;">'
                . $main_data->name_i
                . '</h6><p id="bodyContent" style="font-family: arial; font-size:12px">Dirección: '
                . $main_data->address_i
                . ', '
                . ucfirst(strtolower($main_data->city_i))
                . ' Estado '
                . ucfirst(strtolower($main_data->state_i))
                . ', '
                . ucfirst(strtolower($main_data->country_i))
                . '<br><br> Teléfonos: <font style = "color: green">'
                . $main_data->phone_i
                .'</font><br>Correo electrónico: <font style="color: '
                . $main_data->color_i
                . '">'
                . $main_data->email_i
                . '</font></p></div>'
                ?>';

            map = new GMaps({
                el: '#mapa',
                zoom: 15,
                lat: latitud,
                lng: longitud,
                scrollwheel: false
            });
            marker = map.addMarker({
                lat: latitud,
                lng: longitud,
                title: titulo,
                infoWindow: {
                    content: contenido
                }
            });
            marker.infoWindow.open(map.map, marker);
            map.setCenter((latitud + 0.001), longitud);

            $('.dropdown-button').dropdown();
            $('.tooltipped').tooltip({
                delay: 50,
                html: 'true'
            });
        });
    </script>

    <!-- Custom Js -->
    <script type="text/javascript" src="js/custom.js"></script>
</body>

</html>
