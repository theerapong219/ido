
<?php
header("Content-type: text/html; charset=utf-8");
session_start();

require_once "../service/service.php";
?>
<!DOCTYPE html>
<html class="login-bg">
<head>
    <title><?php echo SITE;?> - Login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/icons.css" />

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
    
    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/signin.css" type="text/css" media="screen" />

    <!-- open sans font -->

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>


    <!-- background switcher -->


    <div class="login-wrapper">
        <a href="index.html">
            <img class="logo" src="img/logo.png" alt="logo" />
        </a>

        <div class="box">
            <form id="frmLogin" name="frmLogin" action=" " onsubmit="return false;">
            <div class="content-wrap">
                <h6><?php echo SITE;?></h6>
                <input class="form-control" type="text" id="usernames" placeholder="Your username" value="boywebmaster">
                <input class="form-control" type="password" id="passwords" placeholder="Your password" value="tirapant4129">
                <br/>
                <button type="submit" class="btn-glow primary login">Log in</button>

            </div>
            </form>
        </div>
        <div class="no-account">
            <p> Your IP is  :: <?php //echo get_client_ip(); ?></p> <br/>
           <p id="date"></p> <br/>
            <p><?php echo $_SERVER['HTTP_USER_AGENT'];?></p>
        </div>
    </div>


<!-- JS -->
<script src="scripts/vendor/jquery/jquery.min.js"></script>
<script src="scripts/vendor/jquery-ui/js/jquery-ui.min.js"></script>
<script src="scripts/vendor/jquery.uniform/jquery.uniform.min.js"></script>
<script src="scripts/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="scripts/vendor/bootstrap-jasny/dist/extend/js/jasny-bootstrap.min.js"></script>
<script src="scripts/vendor/jquery-autosize/jquery.autosize.min.js"></script>
<script src="scripts/vendor/moment/min/moment.min.js"></script>
<script src="scripts/vendor/dropzone/downloads/dropzone.min.js"></script>
<script src="scripts/vendor/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="scripts/vendor/jquery-flot/jquery.flot.js"></script>
<script src="scripts/vendor/jquery-flot/jquery.flot.pie.js"></script>
<script src="scripts/vendor/jquery-flot/jquery.flot.stack.js"></script>
<script src="scripts/vendor/jquery-flot/jquery.flot.resize.js"></script>
<script src="scripts/vendor/select2/select2.min.js"></script>
<script src="scripts/js/ark.min.js"></script>
<script src="../main/main.func.js" charset="utf-8"></script>
<script src="login.script.js" charset="utf-8"></script>  
<script>
function date(){
   var m = "AM";
   var gd = new Date();
   var secs = gd.getSeconds();
   var minutes = gd.getMinutes();
   var hours = gd.getHours();
   var day = gd.getDay();
   var month = gd.getMonth();
   var date = gd.getDate();
   var year = gd.getYear();

   if(year<1000){
     year += 1900;
   }
   if(hours==0){
     hours = 12;
   }
   if(hours>12){
     hours = hours - 12;
     m = "PM";
   }
   if(secs<10){
     secs = "0"+secs;
   }
   if(minutes<10){
     minutes = "0"+minutes;
   }

   var dayarray = new Array ("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
   var montharray = new Array ("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

   var fulldate = dayarray[day]+", "+montharray[month]+" "+date+", "+year+" at "+hours+":"+minutes+":"+secs+" "+m;
   $("#date").html(fulldate);

   setTimeout("date()", 1000);
}
date();
</script>
</body>
</html>