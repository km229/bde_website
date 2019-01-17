<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-tofit=no">
        <!-- Utilise Bootstrap -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Utilise FontAwesome -->
        <link href="{{ asset('fonts/fontawesome/css/all.min.css') }}" rel="stylesheet">
        <!-- Utilise Polices -->
        <link href="{{ asset('css/fonts.css') }}" rel="stylesheet" type="text/css">
        <!-- Utilise CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
        <!-- Utilise LESS -->
        <link rel="stylesheet/less" type="text/css" href="{{ asset('less/styles.less') }}">
        <title>@yield('title')</title>
    </head>
    <body>
        
        <header>
            <div class="inner">
                <div class="logo">
                    <a href=""><img src='{{ asset('img/logo.jpg') }}'></a>
                </div>
                <div class="burger"><i class="fas fa-bars"></i></div>
                <nav>
                    <ul>
                        <li class="level1"><a href="activities">Activities</a></li>
                        <li class="level1"><a href="ideas/ideas">Ideas</a></li>
                        <li class="level1"><a href="shop">Shop</a></li>
                        <li class="level2">
                            <?php
                                if(isset($_SESSION["name"])){
                                    echo "Hello ".$_SESSION["name"];
                                } else {
                                    echo "My account";
                                }
                            ?>
                            <ul>
                                <?php
                                if(isset($_SESSION["name"])){
                                echo "<li><a href=\"\">My orders</a></li>"
                                    ."<li><a href=\"\">My informations</a></li>"
                                    . "<li><a href=\"\">Logout</a></li>";
                                } else {
                                echo "<li><a href=\"register\">Sign up</a></li>"
                                    ."<li><a href=\"login\">Sign in</a></li>";
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="level1"><a href="test">Cart</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        
        @yield('body')
        
        <footer>
            <div class="inner">
                <div class="footer-menu row">
                    <div class="footer-bloc">
                        <div class="footer-title">Boite à idées</div>
                        <ul>
                            <li><a href="">Ajouter une idée</a></li>
                            <li><a href="">Voir la liste des idées</a></li>
                        </ul>
                    </div>
                    <div class="footer-bloc">
                        <div class="footer-title">Activités</div>
                        <ul>
                            <li><a href="">Liste des activités</a></li>
                        </ul>
                    </div>
                    <div class="footer-bloc">
                        <div class="footer-title">Boutique</div>
                        <ul>
                            <li><a href="">Accès</a></li>
                            <li><a href="">Rechercher un produit</a></li>
                        </ul>
                    </div>
                    <div class="footer-bloc">
                        <div class="footer-title">Nous suivre</div>
                        <ul class="social">
                            <li><a href=""><i class="fab fa-facebook"></i></a></li>
                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
    </body>
</html>
