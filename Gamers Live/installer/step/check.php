<?php
error_reporting(0);
session_start();

if($_SESSION['valid_key'] != true){
    header('Location: http://www.gamers-live.net/installer/?error=Please try the installation again&app='.$app.'');
    exit;
}
$app = "Gamers Live";
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">

    <!-- www.phpied.com/conditional-comments-block-downloads/ -->
    <!--[if IE]><![endif]-->

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame  -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Gamers Live</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Place favicon.ico and apple-touch-icon.png in the root of your domain and delete these references -->
    <link rel="shortcut icon" href="http://gamers-live.net/favicon.ico">
    <link rel="apple-touch-icon" href="http://gamers-live.net/apple-touch-icon.png">

    <!-- CSS - Setup -->
    <link href="http://gamers-live.net/css/style.css" rel="stylesheet" type="text/css" />
    <link href="http://gamers-live.net/css/base.css" rel="stylesheet" type="text/css" />
    <link href="http://gamers-live.net/css/grid.css" rel="stylesheet" type="text/css" />
    <!-- CSS - Theme -->
    <link id="theme" href="http://gamers-live.net/css/themes/light.css" rel="stylesheet" type="text/css" />
    <link id="color" href="http://gamers-live.net/css/themes/blue.css" rel="stylesheet" type="text/css" />

    <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
    <script src="http://gamers-live.net/js/modernizr-1.5.min.js"></script>
</head>

<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<body>
<!--<![endif]-->
<div id="wrapper">



    <!-- start header -->
    <header>
        <!-- logo -->
        <h1 id="logo"><a href="./">Gamers Live</a></h1>
        <!-- nav -->
        <br class="cl" />
    </header>
    <!-- end header -->
    <!-- page container -->
    <div id="page">
        <!-- page title -->
        <h2 class="ribbon blue full">Installer<span>You are about to to install <?=$app?></span> </h2>
        <div class="triangle-ribbon blue"></div>
        <br class="cl">
        <!-- page content -->
        <div id="page-content">
            <div class="grid_12">
                <h3>Checklist</h3>
                <p>Before we continue we need to make sure you have done the following steps that is required for Gamers Live to work:</p>
                <ul class="bullet-list">
                    <li>Installed WOWZA?</li>
                    <li>Setup connectioncounts in WOWZA?</li>
                    <li>Imported the WOWZA files that was included with the Gamers Live installation directory, into your WOWZA installation directory?</li>
                    <li>Imported the SQL Database file that was included in the Gamers Live installation directory, into your mySQL database for Gamers Live?</li>
                    <li>Made the following directories CHMOD 777: "/account/register/", "/account/settings/", "/account/admin/" and "/user/"?</li>
                </ul>
                <p>Should you not have done one or more if these essential actions then please visit <a href="http://gamers-live.net/store/index.php/topic/3-gamers-live-installation-guide/"/>our installation guide</a> for more information regarding this procedure. As this installation do <b>NOT</b> take care of this, and Gamers Live with <b>NOT</b> work if these actions are left undone.</p>
                <form method="post" action="1.php">
                    <button class="fr" type="submit" id="submit">Yep it's done</button>
                </form>
            </div>
        </div>
        <br class="cl">
        <br class="cl">
    </div>
    <!-- footer Start -->
    <footer>

        <p>Copyright ©2013 <a href="http://www.gamers-live.net">Gamers Live</a></p>
        <br class="cl" />
    </footer>
    <!-- footer end -->

    <!-- Javascript at the bottom for fast page loading -->
    <script src="http://gamers-live.net/js/jquery-1.4.2.min.js" type="text/javascript"></script>
    <script src="http://gamers-live.net/js/jquery.tools.min.js" type="text/javascript"></script>
    <script src="http://gamers-live.net/js/jquery.lightbox-0.5.min.js" type="text/javascript"></script>
    <script src="http://gamers-live.net/js/jquery.form.js" type="text/javascript"></script>
    <script src="http://gamers-live.net/js/cufon-yui.js" type="text/javascript"></script>
    <script src="http://gamers-live.net/js/Aller.font.js" type="text/javascript"></script>
    <script src="http://gamers-live.net/js/jquery.tipsy.js" type="text/javascript"></script>
    <script src="http://gamers-live.net/js/functions.js" type="text/javascript"></script>
    <!--[if lt IE 7 ]>
    <script src="http://gamers-live.net/js/dd_belatedpng.js"></script>
    <![endif]-->
</div>

</body>
</html>