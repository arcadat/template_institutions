<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1.0" name="viewport"/>
        <title>arcadat</title>
        <!-- Favicon -->
        <link href="img/arcadat.ico" rel="shortcut icon" type="image/x-icon"/>
        <!-- CSS  -->
        <link href="css/materialize.css" media="screen,projection" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome -->
        <link href="css/font-awesome.css" rel="stylesheet"/>
        <!-- Skill Progress Bar -->
        <link href="css/pro-bars.css" media="all" rel="stylesheet" type="text/css"/>
        <!-- Main css File -->
        <link href="style.css" media="screen,projection" rel="stylesheet" type="text/css"/>
        <!-- Font -->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
        <style>
            body {
              display: flex;
              min-height: 100vh;
              flex-direction: column;
            }

            main {
              flex: 1 0 auto;
            }

            body {
              background: #fff;
            }

            .input-field input[type=date]:focus + label,
            .input-field input[type=text]:focus + label,
            .input-field input[type=email]:focus + label,
            .input-field input[type=password]:focus + label {
              color: #e91e63;
            }

            .input-field input[type=date]:focus,
            .input-field input[type=text]:focus,
            .input-field input[type=email]:focus,
            .input-field input[type=password]:focus {
              border-bottom: 2px solid #e91e63;
              box-shadow: none;
            }
        </style>
    </head>
</html>
<body>
    <!-- BEGAIN PRELOADER -->
    <div id="preloader">
        <div class="progress">
            <div class="indeterminate"></div>
        </div>
        <div class="caja">
            <img alt="Logo" src="img/logo_arcadat.png"/>
        </div>
    </div>
    <!-- END PRELOADER -->
    <main>
        <div class="section"></div>
        <center>
            <img class="responsive-img" src="img/logo_arcadat.png" style="width: 250px;"/>
            <div class="section"></div>
            <h5 class="indigo-text">Por Favor Ingrese el Id del Colegio</h5>
            <div class="section"></div>
            <div class="container">
                <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
                    <form class="col s12" method="post" action="index.php">
                        <div class="row">
                            <div class="col s12"></div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input class="validate" id="id_col" name="id_col" type="text"/>
                                <label for="id_col">
                                    Identificador del Colegio
                                </label>
                            </div>
                        </div>
                        <br/>
                        <center>
                            <div class="row">
                                <button class="col s12 btn btn-large waves-effect indigo" name="btn_login" type="submit">
                                    Entrar
                                </button>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </center>
        <div class="section"></div>
        <div class="section"></div>
    </main>
    <!-- jQuery Library -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript">
    </script>
    <!-- Materialize js -->
    <script src="js/materialize.min.js" type="text/javascript">
    </script>
    <!-- Skill Progress Bar -->
    <script src="js/appear.min.js" type="text/javascript">
    </script>
    <script src="js/pro-bars.min.js" type="text/javascript">
    </script>
    <script>
        jQuery(window).load(function() { // makes sure the whole site is loaded
            $('.progress').fadeOut(); // will first fade out the loading animation
            $('#preloader').delay(100).fadeOut('slow'); // will fade out the white DIV that covers the website.
            $('body').delay(100).css({'overflow':'visible'});
          });
        $( "form" ).submit(function( event ) {
            if($('#id_col').val() == ''){
                Materialize.toast('Identificador del Colegio Vacío', 5000);
                $('#id_col').focus();
                event.preventDefault();
            }
        });
    </script>
</body>
