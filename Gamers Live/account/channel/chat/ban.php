<?php
session_start();

error_reporting(0);

include_once("http://www.gamers-live.net/analyticstracking.php");
if ($_SESSION['access'] != true) {
    header( 'Location: http://www.gamers-live.net/account/login/?msg=Please login to view this page' ) ;
    exit;
}
$mod_name = $_SESSION['channel_id'];
$username = $_GET['username'];
$channel_id = $_GET['channel'];
$msg = $_GET['msg'];

// we now check if the user is mod on the channel

// we first get data from our mysql database
$database_url = "127.0.0.1";
$database_user = "root";
$database_pw = "";

$dir_name = basename(__DIR__);

// connect to database
$connect = mysql_connect($database_url, $database_user, $database_pw) or die(mysql_error());

// select the database we need
$select_db = mysql_select_db("live", $connect) or die(mysql_error());

$result = mysql_query("SELECT * FROM chat_mods WHERE user_id='$mod_name' AND channel_id='$channel_id' AND mod='1'");
$count = mysql_num_rows($result);
$rows_mods = mysql_fetch_array($result);

if($count == 0 && $mod_name != $channel_id){
    // then we redict to the usernames channel
    header( 'Location: http://www.gamers-live.net/user/'.$username.'/' ) ;
    exit;
}else{
    $is_mod = true;
}

if($rows_mods['admin'] == "1"){
    $is_admin = true;
}

if($mod_name == $channel_id){
    $is_admin = true;
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="ThemeFuse" />
    <meta name="Description" content="A short description of your company" />
    <meta name="Keywords" content="Some keywords that best describe your business" />
    <title>GAMERS LIVE</title>
    <link href="http://www.gamers-live.net/style.css" media="screen" rel="stylesheet" type="text/css" />
    <script type="text/javascript" language="JavaScript" src="http://www.gamers-live.net/js/general.js"></script>
    <script type="text/javascript" language="JavaScript" src="http://www.gamers-live.net/js/jquery.tools.min.js"></script>
    <script type="text/javascript" language="JavaScript" src="http://www.gamers-live.net/js/jquery.easing.1.3.js"></script>

    <script type="text/javascript" language="JavaScript" src="http://www.gamers-live.net/js/slides.jquery.js"></script>

    <link rel="stylesheet" href="http://www.gamers-live.net/css/prettyPhoto.css" type="text/css" media="screen" />
    <script src="http://www.gamers-live.net/js/jquery.prettyPhoto.js" type="text/javascript"></script>

    <script type="text/javascript">
        // Popup window code
        function newPopup(url) {
            popupWindow = window.open(
                    url,'popUpWindow','height=700,width=1200,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes')
        }
    </script>

    <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="css/ie.css" />
    <![endif]-->
</head>

<body>
<div class="body_wrap thinpage">

    <div class="header_image" style="background-image:url(http://www.gamers-live.net/images/header.png)">&nbsp;</div>

    <div class="header_menu">
        <div class="container">
            <div class="logo"><a href="http://www.gamers-live.net/account/?<?=SID; ?>"><img src="http://www.gamers-live.net/images/logo.png" alt="" /></a></div>
            <div class="top_login_box"><a href="http://www.gamers-live.net/account/logout/?<?=SID; ?>">Logout</a><a href="http://www.gamers-live.net/account/settings/?<?=SID; ?>">Settings</a></div>
            <div class="top_search">
                <form id="searchForm" action="http://www.gamers-live.net/browse/" method="get">
                    <fieldset>
                        <input type="submit" id="searchSubmit" value="" />
                        <div class="input">
                            <input type="text" name="s" id="s" value="Type & press enter" />
                        </div>
                    </fieldset>
                </form>
            </div>

            <!-- topmenu -->
            <div class="topmenu">
                <ul class="dropdown">
                    <li><a href="http://www.gamers-live.net/browse/lol/?<?=SID; ?>"><span>LoL</span></a></li>
                    <li><a href="http://www.gamers-live.net/browse/dota2/?<?=SID; ?>"><span>Dota 2</span></a></li>
                    <li><a href="http://www.gamers-live.net/browse/hon/?<?=SID; ?>"><span>HoN</span></a></li>
                    <li><a href="http://www.gamers-live.net/browse/sc2/?<?=SID; ?>"><span>SC 2</span></a></li>
                    <li><a href="http://www.gamers-live.net/browse/wow/?<?=SID; ?>"><span>WoW</span></a></li>
                    <li><a href="http://www.gamers-live.net/browse/callofduty/?<?=SID; ?>"><span>Call Of Duty</span></a></li>
                    <li><a href="http://www.gamers-live.net/browse/minecraft/?<?=SID; ?>"><span>Minecraft</span></a></li>
                    <li><a href="http://www.gamers-live.net/browse/other/?<?=SID; ?>"><span>Others</span></a></li>
                    <li><a href="http://www.gamers-live.net/blog/"><span>Blog</span></a></li>
                    <li><a href="#"><span>More</span></a>
                        <ul>
                            <li><a href="http://www.gamers-live.net/company/about/"><span>About</span></a></li>
                            <li><a href="http://www.gamers-live.net/company/support/"><span>Contact</span></a></li>
                            <li><a href="http://www.gamers-live.net/account/partner/?<?=SID; ?>"><span>Partner</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/ topmenu -->
        </div>
    </div>
    <!--/ header -->



    <!-- middle -->
    <div class="middle full_width">
        <div class="container_12">

            <div class="back_title">
                <div class="back_inner">
                    <a href="http://www.gamers-live.net/account/?"<? SID;?><span>Home</span></a>
                </div>
            </div>


            <!-- content -->
            <div class="content"><br />
                <!-- account menu -->
                <center>
                    <a href="http://www.gamers-live.net/account/?<?=SID; ?>" class="button_link"><span>Account Overview</span></a><a href="http://www.gamers-live.net/account/channel/?<?=SID; ?>" class="button_link"><span>Channel</span></a><a href="http://www.gamers-live.net/account/settings/?<?=SID; ?>" class="button_link"><span>Settings</span></a><a href="http://www.gamers-live.net/account/partner/?<?=SID; ?>" class="button_link"><span>Partner</span></a><a href="http://www.gamers-live.net/account/help/?<?=SID; ?>" class="button_link"><span>Support</span></a>
                </center>
                <!-- account menu end -->
                <br>
                <center><b><?=$msg?></b></center>
                <br>
                <h3>Chat moderation for Channel: <?=$channel_id?></h3>
                    You are
                    <?php

                    if($is_mod == true && $is_admin != true){echo 'Moderator';}
                    if($is_admin == true){echo 'Administrator';}
                    ?>
                     on this channel.<br><br>
                <div class="sb">
                    <div class="box_title">Ban User</div>
                    <div class="box_content">
                       <center>
                           <form name="ban_user" action="ban_user.php" method="post">

                               <p><label>User to ban</label><br><input class="gamersTextbox" name="username" id="username" value="<?=$username?>" type="text" style="width: 250px;height: 25px"></p>
                               <p><label>Reason</label><br><input name="reason" id="reason" class="gamersTextbox" value="No reason..." type="text" style="width: 250px;height: 25px"></p>
                               <input type="hidden" value="<?=$channel_id?>" id="channel_id" name="channel_id">
                               <select name="day" id="day">
                                   <option value="1">1</option>
                                   <option value="5">5</option>
                                   <option value="10">10</option>
                                   <option value="15">15</option>
                                   <option value="20">20</option>
                                   <option value="25">25</option>
                               </select>
                               /
                               <select name="month" id="month">
                                   <option value="1">1</option>
                                   <option value="2">2</option>
                                   <option value="3">3</option>
                                   <option value="4">4</option>
                                   <option value="5">5</option>
                                   <option value="6">6</option>
                                   <option value="7">7</option>
                                   <option value="8">7</option>
                                   <option value="9">9</option>
                                   <option value="10">10</option>
                                   <option value="11">11</option>
                                   <option value="12">12</option>
                               </select>
                               /
                               <select name="year" id="year">
                                   <option value="2013">2013</option>
                                   <option value="2014">2014</option>
                                   <option value="2015">2015</option>
                                   <option value="2016">2016</option>
                                   <option value="2017">2017</option>
                                   <option value="2018">2018</option>
                                   <option value="6000">6000 (permanent)</option>
                               </select>
                           </form>

                               <a href="#" onclick="document.ban_user.submit()" class="button_link"><span>Ban This User!</span></a>
                       </center>
                        <div class="clear"></div><br><br>
                        <i><a href="JavaScript:newPopup('list_banned.php?channel=<?=$channel_id?>&username=<?=$mod_name?>');">List all banned users / unban users</a></i>
                    </div>
                </div>
                <div class="sb">
                    <div class="box_title">Add Moderator</div>
                    <div class="box_content">
                        <form name="add_mod" action="add_mod.php" method="post">
                        <center>
                            <p><label>User to ADD as moderator</label><br><input class="gamersTextbox" name="mod" id="mod" value="<?=$username?>" type="text" style="width: 250px;height: 25px"></p>
                            <input type="hidden" value="<?=$channel_id?>" id="channel" name="channel">
                            <a href="#" onclick="document.add_mod.submit()" class="button_link"><span>Add chat moderator</span></a>
                        </center>

                        </form>
                        <i><a href="JavaScript:newPopup('list_mods.php?channel=<?=$channel_id?>');">List mods / Remove Mods</a></i>

                    </div>
                </div>

            </div>
        </div>
        <!--/ content -->


        <div class="clear"></div>

    </div>
</div>
<!--/ middle -->

<div class="footer">
    <div class="footer_inner">
        <div class="container_12">

            <div class="grid_8">
                <h3>Hostse.net</h3>

                <div class="copyright">
                    &copy; 2013 GAMERS LIVE. An Hostse.net production. All Rights Reserved. <br /><a href="http://www.gamers-live.net/company/legal/">Terms of Service</a> - <a href="http://www.gamers-live.net/company/support/">Contact</a> -
                    <a href="http://www.gamers-live.net/company/legal/">Privacy guidelines</a> - <a href="http://www.gamers-live.net/company/support/">Advertise with Us</a> - <a href="http://www.gamers-live.net/company/about/">About Us</a></p>
                </div>
            </div>

            <div class="grid_4">
                <h3>Follow us</h3>
                <div class="footer_social">
                    <a href="http://www.gamers-live.net/facebook/" class="icon-facebook">Facebook</a>
                    <a href="http://www.gamers-live.net/twitter/" class="icon-twitter">Twitter</a>
                    <a href="http://www.gamers-live.net/rss/" class="icon-rss">RSS</a>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="clear"></div>
        </div>
    </div>
</div>

</div>
</body>
</html>
