<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="ThemeFuse" />
<meta name="Description" content="A short description of your company" />
<meta name="Keywords" content="Some keywords that best describe your business" />
<title>GAMERS LIVE - Store</title>
<link href="http://www.gamers-live.net/style.css" media="screen" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://www.gamers-live.net/js/jquery.min.js"></script>
<script type="text/javascript" src="http://www.gamers-live.net/js/preloadCssImages.js"></script>
<script type="text/javascript" src="http://www.gamers-live.net/js/jquery.color.js"></script>

<script type="text/javascript" language="JavaScript" src="http://www.gamers-live.net/js/general.js"></script>
<script type="text/javascript" language="JavaScript" src="http://www.gamers-live.net/js/jquery.tools.min.js"></script>
<script type="text/javascript" language="JavaScript" src="http://www.gamers-live.net/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" language="JavaScript" src="http://www.gamers-live.net/js/slides.jquery.js"></script>

<link rel="stylesheet" href="http://www.gamers-live.net/css/prettyPhoto.css" type="text/css" media="screen" />
<script src="http://www.gamers-live.net/js/jquery.prettyPhoto.js" type="text/javascript"></script>

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/ie.css" />
<![endif]-->
</head>
<?php
error_reporting(0);
session_start();
$donater_name = $_SESSION['channel_id'];
$user_email = $_SESSION['email'];

if($donater_name == null){
    $donater_name = "Anonymous";
    $user_email = "none";
}else{}

if ($_SESSION['access'] != true) {
 $login_box = ' <div class="top_login_box"><a href="http://www.gamers-live.net/account/login/">Sign in</a><a href="http://www.gamers-live.net/account/register/">Register</a></div>';
}else{
$login_box = '<div class="top_login_box"><a href="http://www.gamers-live.net/account/logout/">Logout</a><a href="http://www.gamers-live.net/account/settings/">Settings</a></div>';
}

include_once("http://www.gamers-live.net/analyticstracking.php");
			
$channel_id_get = $_GET['channel'];
$tip = $_GET['tip'];
$gateway = $_GET['gateway'];

// gateways

$payza = false;
$mb = false;
$paypal = true;

// first we get all info about the streamer
// we first get data from our mysql database
$database_url = "127.0.0.1";
$database_user = "root";
$database_pw = "";
$date = date("d/m-Y G:i:s");


// connect to database
$connect = mysql_connect($database_url, $database_user, $database_pw) or die(mysql_error());
			
// select the database we need
$select_db = mysql_select_db("live", $connect) or die(mysql_error());
			
$result = mysql_query("SELECT * FROM channels WHERE channel_id='$channel_id_get'");
$row = mysql_fetch_array($result);

$channel_id = $row['channel_id'];
$donate = $row['donate'];

if($donate != 1){
    header( 'Location: http://www.gamers-live.net/user/'.$channel_id.'' ) ;
}
$tip_per = $row['tip_perc'];
$comment1 = chunk_split(strip_tags($row['info2']), 40, '<br>');

// generate the number for this purchase
$r_nr = rand(999, 9999);
$item_nr = "".time()."".$r_nr."-".$channel_id."";
// add purchase to the db

if($gateway == "paypal" && $paypal == true){
    $add_pur = mysql_query("INSERT into tips_payza (streamer, date, value, user, user_email, currency, paid, item_code, gateway) VALUES ('$channel_id', '$date', '0', '$donater_name', '$user_email', 'USD', '0', '$item_nr', 'paypal') ") or die(mysql_error());
}
?>

<script type="text/javascript">

    function validate_payza(){
        x=document.paymentpayza
        txt=x.ap_amount.value
        if (txt>=1.00) {
            document.paymentpayza.submit()
            return true
        }else{
            alert("Due to payments fees we do not accept payments below $1.00 \n\nShould you have more questions please contact support at: www.gamers-live.net/company/support/")
            return false
        }
    }
    function validate_mb(){
        x=document.paymentmb
        txt=x.amount.value
        if (txt>=1.00) {
            document.paymentmb.submit()
            return true
        }else{
            alert("Due to payments fees we do not accept payments below $1.00 \n\nShould you have more questions please contact support at: www.gamers-live.net/company/support/")
            return false
        }
    }
    function validate_paypal(){
        x=document.paymentpaypal
        txt=x.amount.value
        if (txt>=1.00) {
            document.paymentpaypal.submit()
            return true
        }else{
            alert("Due to payments fees we do not accept payments below $1.00 \n\nShould you have more questions please contact support at: www.gamers-live.net/company/support/")
            return false
        }
    }
    // calculation of the amount the steamer will get
    function calc_paypal(){
            x=document.paymentpaypal
            number=x.amount.value
            document.getElementById('current').innerHTML = number;
            if(number >= 1.00){
                streamer_cut = (number - (number * 0.034) - 0.5) * (0.<?=$tip_per?>)
                document.getElementById('streamers_cut').innerHTML = streamer_cut.toFixed(2);
            }else{
                document.getElementById('streamers_cut').innerHTML = '0.00';
            }
    }

    function start_calc_paypal(){
        x=document.paymentpaypal
        number=x.amount.value
            document.getElementById('current').innerHTML = number;
            streamer_cut = (number - (number * 0.034) - 0.5) * (0.<?=$tip_per?>)
            document.getElementById('streamers_cut').innerHTML = streamer_cut.toFixed(2);
    }
</script>
<body onload="start_calc_paypal()">

<div class="body_wrap thinpage">

<div class="header_image" style="background-image:url(http://www.gamers-live.net/images/header.png)">&nbsp;</div>

<div class="header_menu">
	<div class="container">
		<div class="logo"><a href="http://www.gamers-live.net/"><img src="http://www.gamers-live.net/images/logo.png" alt="" /></a></div>
        <?=$login_box?>
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
                        <li><a href="http://www.gamers-live.net/browse/lol/"><span>LoL</span></a></li>
                        <li><a href="http://www.gamers-live.net/browse/dota2/"><span>Dota 2</span></a></li>
                        <li><a href="http://www.gamers-live.net/browse/hon/"><span>HoN</span></a></li>
                        <li><a href="http://www.gamers-live.net/browse/sc2/"><span>SC 2</span></a></li>
                        <li><a href="http://www.gamers-live.net/browse/wow/"><span>WoW</span></a></li>
                        <li><a href="http://www.gamers-live.net/browse/callofduty/"><span>Call Of Duty</span></a></li>
                        <li><a href="http://www.gamers-live.net/browse/minecraft/"><span>Minecraft</span></a></li>
                        <li><a href="http://www.gamers-live.net/browse/other/"><span>Others</span></a></li>
                        <li><a href="http://www.gamers-live.net/blog/"><span>Blog</span></a></li>
                        <li><a href="#"><span>More</span></a>                        
                        	<ul>
                                <li><a href="http://www.gamers-live.net/company/about/"><span>About</span></a></li>
                                <li><a href="http://www.gamers-live.net/company/support/"><span>Contact</span></a></li>
                                <li><a href="http://www.gamers-live.net/account/partner/"><span>Partner</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
        	<!--/ topmenu -->
    </div>
</div>     	
<!--/ header -->


<br><br>
<!-- middle -->
<div class="middle full_width">
<div class="container_12">
   
    
    <!-- content -->
    <div class="content">
    <br>

<div class="col col_1_2 ">
    <div class="sb">
        <div class="box_title">Streamer Information</div>
        <div class="box_content">
            <h3><?=$channel_id?></h3>
            <p><img src="http://www.gamers-live.net/user/<?=$channel_id?>/avatar.png" alt="" width="90" height="90" class="frame_left"><?=$comment1?></p>
            <br>
            <a href="http://www.gamers-live.net/user/<?=$channel_id?>/">http://gamers-live.net/user/<?=$channel_id?>/</a>


            <div class="clear"></div>
        </div>
    </div>

</div>

<div class="col col_1_2 ">

    <div class="sb">
        <div class="box_title">Payment Information</div>
        <div class="box_content">
            <?php

            if($gateway == null){
                // then we echo all gateways enabled
                echo 'Choose Your Payment Gateway<br>';
                if($payza == true){
                 echo'<a href="?channel='.$channel_id.'&tip=true&gateway=payza" class="button_link"><span>Payza</span></a>';
                }

                if($mb == true){
                    echo'<a href="?channel='.$channel_id.'&tip=true&gateway=mb" class="button_link"><span>Moneybookers</span></a>';

                }

                if($paypal == true){
                    echo'<a href="?channel='.$channel_id.'&tip=true&gateway=paypal" class="button_link"><span>Paypal</span></a>';

                }
            }else{
            echo'
            <a href="?channel='.$channel_id.'&tip=true" class="button_link"><span>Change Payment Gateway</span></a>';
            }

            // now we will display gateways

            // mb
            if($gateway == "mb" && $mb == true){

                echo '<br>';
                echo '<br>';
                echo '<b>Gateway</b>';
                echo '<br>';
                echo 'Moneybookers';
                echo '<br>';
                echo '<br>';
                echo '<b>User</b>';
                echo '<br>';
                echo $donater_name;
                if($donater_name == "Anonymous"){
                    // login link
                    echo ' - <a href="http://www.gamers-live.net/account/login/"><span>Login to change</span></a>';
                }
                echo '<br>';
                echo '<br>';

                echo '<form name="paymentmb" action="https://www.moneybookers.com/app/payment.pl" method="post" onsubmit="return validate_mb()" xmlns="http://www.w3.org/1999/html">
                            <input type="hidden" name="pay_to_email" value="admin@gamers-live.net">
                            <input type="hidden" name="currency" value="USD">
                            <input type="hidden" name="transaction_id" value="'.$item_nr.'"/>
                            <input type="hidden" name="status_url" value="http://www.gamers-live.net/store/tip/mb-return.php"/>
                            <input type="hidden" name="language" value="EN"/>
                            <input type="hidden" name="detail1_description" value="Tips to: '.$channel_id.'"/>
                            <input type="hidden" name="detail1_text" value="Tips for the streamer: '.$channel_id.' from '.$donater_name.'"/>

                            <label for="amount"><b>Amount</b></label><br>
                            <input name="amount" value="15" maxlength="10" class="gamersTextbox"> USD<br><br>
                        </form>';
                echo'<a href="#" class="button_link" onclick="return validate_mb()"><span>PURCHASE NOW</span></a>';
            }

            // payza
            if($gateway == "payza" && $payza == true){

                echo '<br>';
                echo '<br>';
                echo '<b>Gateway</b>';
                echo '<br>';
                echo 'Payza';
                echo '<br>';
                echo '<br>';
                echo '<b>User</b>';
                echo '<br>';
                echo $donater_name;
                if($donater_name == "Anonymous"){
                    // login link
                    echo ' - <a href="http://www.gamers-live.net/account/login/"><span>Login to change</span></a>';
                }
                echo '<br>';
                echo '<br>';

                echo '<form name="paymentpayza" method="post" action="https://secure.payza.com/checkout" onsubmit="return validate_payza()">
                            <input type="hidden" name="ap_merchant" value="admin@gamers-live.net"/>
                            <input type="hidden" name="ap_purchasetype" value="service"/>
                            <label for="ap_amount"><b>Amount</b></label><br>
                            <input type="hidden" name="ap_itemname" value="Tips to: '.$channel_id.'"/>
                            <input name="ap_amount" value="15" maxlength="10" class="gamersTextbox"> USD<br><br>
                            <input type="hidden" name="ap_currency" value="USD"/>

                            <input type="hidden" name="ap_quantity" value="1"/>
                            <input type="hidden" name="ap_description" value="Tips for the streamer: '.$channel_id.' from '.$donater_name.'"/>
                            <input type="hidden" name="ap_itemcode" value="'.$item_nr.'"/>
                        </form>
                        ';
                echo'<a href="#" class="button_link" onclick="return validate_payza()"><span>PURCHASE NOW</span></a>';

            }

            // paypal
            if($gateway == "paypal" && $paypal == true){

                // run javascript

                echo '<br>';
                echo '<br>';
                echo '<b>Gateway</b>';
                echo '<br>';
                echo 'Paypal';
                echo '<br>';
                echo '<br>';
                echo '<b>User</b>';
                echo '<br>';
                echo $donater_name;
                if($donater_name == "Anonymous"){
                    // login link
                    echo ' - <a href="http://www.gamers-live.net/account/login/"><span>Login to change</span></a>';
                }
                echo '<br>';
                echo '<br>';

                echo '<form name="paymentpaypal" method="post" action="https://www.paypal.com/cgi-bin/webscr" onsubmit="return validate_paypal()" autocomplete="off">
                <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="business" value="admin@gamers-live.net">
                            <input type="hidden" name="notify_url" value="http://www.gamers-live.net/store/tip/paypal-return.php">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="item_name" value="Tips to: '.$channel_id.'">
                            <input type="hidden" name="item_number" value="'.$item_nr.'">

                            <label for="amount"><b>Amount</b></label><br>
                            <input name="amount" value="15" maxlength="10" class="gamersTextbox" onKeyUp="calc_paypal()"> USD<br>

                        </form>
                        <br><br>
                        ';

                echo'<a href="#" class="button_link" onclick="return validate_paypal()"><span>PURCHASE NOW</span></a>';

            }
            ?>
            <br><br>Gamers Live reserves the right to terminate without refund any Account found in violation of our <a href=http://www.gamers-live.net/company/legal/">Terms of Service</a>.
            <div class="clear"></div>
        </div>
    </div>
</div>

        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <h2><span>FAQ</span></h2>
    <h3 class="toggle box">Tipping FAQ (Click to Open) <span class="ico"></span></h3>
    <div class="toggle_content boxed" style="display: block;">
                        	
        <div class="faq_question toggle"><span class="faq_q">Q:</span> <span class="faq_title">How much do the streamer receive from my purchase?</span> <span class="ico"></span></div>
            <div class="faq_answer toggle_content" style="display: none;">
            <p>The percentage amount of the purchase the streamer receives varies from streamer to streamer. In the following case the streamer receives <?=$tip_per?>% of the total payment after the payment fee is subtracted (see list of payment fee(s) below). The rest of the purchase is going directly to Gamers Live (in this case it is <?=$to_us?>% of the payments). <br /><br />
            Also note that: The payment fee is subtracted from the streamers percentage and NOT Gamers Live! <br />You can see below the payment fee(s) for our partnered gateways:<br />

                <div class="styled_table table_white">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th style="width:25%">Gateway</th>
                            <th style="width:25%">Payment fee(s)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Paypal</td>
                            <td>3.40 % + $0.50 USD</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                With the current value of <i id="current">0.00</i> $, the streamer will receive <i id="streamers_cut">0.00</i> $.<br>
                <br>
           	<b>Because of these fixed fee(s) we are not accepting payments under $1.00!</b>.</p>
        </div>
        
        <div class="faq_question toggle"><span class="faq_q">Q:</span> <span class="faq_title">How do i get in touch with you?</span> <span class="ico"></span></div>
            <div class="faq_answer toggle_content" style="display: none;">
            <p>Should you ever need any support or help with a Gamers Live Service, then please check out our <a href="http://www.gamers-live.net/company/support/">support page</a>. Here you will find all the information needed to submit a ticket and recieve support.</p>
        </div>
        
        <div class="faq_question toggle"><span class="faq_q">Q:</span> <span class="faq_title">What payment options do you support?</span> <span class="ico"></span></div>
            <div class="faq_answer toggle_content" style="display: none;">
            <p>We are currently using Moneybookers as our primary payment gateway. Should you need additional information about the supported credit cards etc. then <a href="https://https://www.moneybookers.com/">see here</a></p>
        </div>
        
        <div class="faq_question toggle"><span class="faq_q">Q:</span> <span class="faq_title">Refunds?</span> <span class="ico"></span></div>
            <div class="faq_answer toggle_content" style="display: none;">
            <p>There is a 14 days refund period after the payment, as stated in our <a href="http://www.gamers-live.net/company/legal/">Terms Of Sale</a>.</p>
            <p>Should you need to do a refund then please contact us at our <a href="http://www.gamers-live.net/company/support/">support page</a>.</p>
        </div>
            
    </div>
    <center>
    <br />   
	<center><img src="http://www.gamers-live.net/images/logos_creditcards.png"/></center>
    </div>
    <!--/ content --> 
    
   
    <div class="clear"></div>
    
</div>
</div>
<!--/ middle -->
<!--/ middle -->

<div class="footer">
<div class="footer_inner">
<div class="container_12">
	
    <div class="grid_8">
    	<h3>Gamers Live</h3>   
		
        <div class="copyright">
		&copy; 2013 GAMERS LIVE. An Gamers Live production. All Rights Reserved. <br /><a href="http://www.gamers-live.net/company/legal/">Terms of Service</a> - <a href="http://www.gamers-live.net/company/support/">Contact</a> -
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
