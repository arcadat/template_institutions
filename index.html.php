<!DOCTYPE html>
  <html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
      <title><?php echo $main_data->name_i ?></title>

      <!-- Favicon -->
      <link rel='shortcut icon' type='image/x-icon' href='<?php echo $main_data->root_favicon.$main_data->favicon_i ?>' />
       <!-- CSS  -->
      <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <!-- Font Awesome -->
      <link href="css/font-awesome.css" rel="stylesheet">
      <!-- Skill Progress Bar -->
      <link href="css/pro-bars.css" rel="stylesheet" type="text/css" media="all" />
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="css/owl.carousel.css">
      <!-- Default Theme CSS File-->
      <link id="switcher" href="css/theme.css.php?color_i=<?php echo urlencode($main_data->color_i); ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
      <!-- Main css File -->
      <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

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
          <img src="<?php echo $main_data->root_logo.$main_data->logo_i ?>" alt="Logo">
          <p><b><?php echo $main_data->name_i ?></b><br><?php echo $main_data->slogan_i ?></p>
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
                    <img src="<?php echo $main_data->root_logo_top.$main_data->logo_top_i ?>" alt="<?php echo $main_data->name_i ?>">
                <?php else: ?>
                    <?php echo $main_data->name_i ?>
                <?php endif; ?>
                </a>

                <!-- Image Based Logo -->
                 <!-- <a href="index.html" class="brand-logo"><img src="img/logo.jpeg" alt="logo img"></a>  -->
                <ul class="right hide-on-med-and-down custom-nav menu-scroll">
                  <li><a href="#about">Nosotros</a></li>
                  <li><a href="#resume">Historia</a></li>
                  <li><a href="#portfolio">Instalaciones</a></li>
                  <li><a href="#footer">Contactenos</a></li>
                </ul>
                <!-- For Mobile View -->
                <ul id="slide-out" class="side-nav menu-scroll">
                  <li><a href="#about">Nosotros</a></li>
                  <li><a href="#resume">Historia</a></li>
                  <li><a href="#portfolio">Instalaciones</a></li>
                  <li><a href="#footer">Contactenos</a></li>
                </ul>
                <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
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
                    foreach ($photos_covers as $photo_cover):
                        ?>
                        <li>
                            <img src="<?php echo $main_data->root_covers.$photo_cover->cover ?>">
                            <div class="caption center-align">
                                <h3><?php echo $photo_cover->ad_cover ?></h3>
                            </div>
                        </li>
                        <?php
                    endforeach;
                endif; ?>
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
                          <img class="profile-img" src="<?php echo $main_data->root_logo.$main_data->logo_i ?>" alt="Profile Image">
                        </div>
                      </div>
                      <div class="col s12 m8 l9">
                        <div class="about-inner-right">
                          <h3><?php echo $main_data->name_i ?></h3>
                          <p><?php echo ucfirst(strtolower($main_data->city_i)).' Estado '.ucfirst(strtolower($main_data->state_i)).'. '.ucfirst(strtolower($main_data->country_i)); ?>
                          </p>
                          <div class="personal-information col s12 m12 l6">
                            <h3>Información</h3>
                            <ul>
                              <li><span>Código : </span><?php echo $main_data->code_i ?></li>
                              <li><span>Fundado : </span><?php echo strftime("%d de %B de %Y", strtotime($main_data->date_foundation->date)); ?></li>
                              <li><b><?php echo $tiempoServicio ?></b></li>
                              <li><span>Teléfono : </span><?php echo $main_data->phone_i ?></li>
                              <li><span>Email : </span><?php echo $main_data->email_i ?></li>
                              <li><span>Dirección : </span><?php echo $main_data->address_i.', '.ucfirst(strtolower($main_data->city_i)).' Estado '.ucfirst(strtolower($main_data->state_i)).', '.ucfirst(strtolower($main_data->country_i)); ?></li>
                            </ul>
                          </div>
                          <div class="resume-download col s12 m12 l6">
                            <a href="#footer" class="hire-me-btn waves-effect waves-light btn btn-large resume-btn"><i class="mdi-content-send left"></i> Contactenos</a>
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
            <section id="edcuation">
              <div class="container">
                <div class="education-inner">
                  <h2 class="title">Etapas o Especialidades</h2>
                  <div class="row">
                    <?php
                    if ($degree->degree):
                      foreach ($data_degree as $data): ?>
                    <div class="col s12 m6">
                      <div class="card" style="background-color: <?php echo $data->color ?>;">
                        <div class="card-content white-text">
                          <span class="card-title"><?php echo $data->name ?></span>
                          <p><?php echo str_replace("\\n", "<br/>", strip_tags($data->profile, '<strong><br><li>')) ?></p>
                        </div>
                        <div class="card-action white-text">
                          <p><?php echo $data->levels ?></p>
                        </div>
                      </div>
                    </div>
                    <?php
                      endforeach;
                    endif; ?>
                  </div>
                </div>
              </div>
            </section>
          </section>
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
                        <?php
                        if ($installations->installations):
                            foreach ($photos_installations as $photo_installation):
                                ?>
                            <div class="mix">
                                <a href="#" class="portfolio-thumbnill">
                                <img src="<?php echo $main_data->root_thumbs_installations . $photo_installation->installation ?>" alt="img">
                                <i class="material-icons view-icon">pageview</i>
                                </a>
                                <div class="portfolio-detail">
                                    <a href="#" class="modal-close-btn"><span class="fa fa-times"></span></a>
                                    <img src="<?php echo $main_data->root_installations . $photo_installation->installation ?>" alt="img">
                                    <h2><?php echo $photo_installation->ad_installation ?></h2>
                                </div>
                            </div>
                                <?php
                            endforeach;
                        endif; ?>
                        </div>
                    </div>
                  </div>
              </div>
          </section>
          <!-- Start Facts -->
          <section id="facts">
            <div class="facts-overlay">
              <div class="container">
              <div class="row">
                <div class="col s12">
                  <div class="facts-inner">
                    <div class="row">
                      <div class="col s12 m4 l4">
                        <div class="single-facts waves-effect waves-block waves-light">
                          <i class="material-icons">work</i>
                          <span class="counter">329</span>
                          <span class="counter-text">Project Completed</span>
                        </div>
                      </div>
                      <div class="col s12 m4 l4">
                        <div class="single-facts waves-effect waves-block waves-light">
                          <i class="material-icons">supervisor_account</i>
                          <span class="counter">250</span>
                          <span class="counter-text">Happy Clients</span>
                        </div>
                      </div>
                      <div class="col s12 m4 l4">
                        <div class="single-facts waves-effect waves-block waves-light">
                          <i class="material-icons">redeem</i>
                          <span class="counter">69</span>
                          <span class="counter-text">Award Won</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
                      <h2 class="title">Contactenos</h2>
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
                            <div id="mapa" class="contact-map">
                            </div>
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
                      <button class="btn-floating btn-large up-btn"><i class="mdi-navigation-expand-less"></i></button>
                     <p class="design-info">Copyright &copy; <?php echo date('Y'); ?> <a href="http://www.arcadat.com/">Arcadat.com</a> - Todos los derechos reservados</p>
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
      <script src="js/appear.min.js" type="text/javascript"></script>
      <script src="js/pro-bars.min.js" type="text/javascript"></script>
      <!-- Owl slider -->
      <script src="js/owl.carousel.min.js"></script>
      <!-- counter -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <!-- Google Maps -->
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6-_MBg2QXptawIOEdL7-k1doOfuYdm70"></script>
      <script src="js/gmaps.min.js"></script>

      <!-- GmapsJs Config -->
      <script type="text/javascript">
          var map;
          var latitud   = <?php echo $main_data->latitud_i; ?>;
          var longitud  = <?php echo $main_data->longitud_i; ?>;
          var titulo    = '<?php echo $main_data->name_i; ?>';
          var contenido = '<div id="content" style="height:130px; width:320px;"><h6 id="firstHeading" style=" font-weight:bold; font-size:14px;"><?php echo $main_data->name_i; ?></h6><p id="bodyContent" style="font-family: arial; font-size:12px">Dirección: <?php
            echo $main_data->address_i.", "
            .ucfirst(strtolower($main_data->city_i))
            ." Estado ".ucfirst(strtolower($main_data->state_i))
            .", ".ucfirst(strtolower($main_data->country_i));
            ?><br><br>Teléfonos: <font style="color: green"><?php echo $main_data->phone_i ?></font><br>Correo electrónico: <font style="color: <?php echo $main_data->color_i; ?>"><?php echo $main_data->email_i ?></font></p></div>';
          $(document).ready(function(){
              map = new GMaps({
                  el: '#mapa',
                  zoom: 15,
                  lat: latitud,
                  lng: longitud
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
          });
      </script>

      <!-- Custom Js -->
      <script src="js/custom.js"></script>
    </body>
  </html>