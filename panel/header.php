<?php
require_once 'complex/configuration.php';
require_once 'complex/init.php';

if (!$user -> LoggedIn()){
    header('Location: login.php');
    exit;
}

function hasBNAccess($db){
	$stmt = $db->prepare("SELECT botnet FROM users WHERE username=:login");
	$stmt->bindParam("login", $_SESSION['username'], PDO::PARAM_STR);
	$stmt->execute();
	$value = $stmt->fetchColumn(0);
	return $value;
}
$lastactive = $odb -> prepare("UPDATE `users` SET activity=UNIX_TIMESTAMP() WHERE username=:username");
$lastactive -> execute(array(':username' => $_SESSION['username']));

 $onedayago = time() - 86400;

 $twodaysago = time() - 172800;
 $twodaysago_after = $twodaysago + 86400;

 $threedaysago = time() - 259200;
 $threedaysago_after = $threedaysago + 86400;

 $fourdaysago = time() - 345600;
 $fourdaysago_after = $fourdaysago + 86400;

 $fivedaysago = time() - 432000;
 $fivedaysago_after = $fivedaysago + 86400;

 $sixdaysago = time() - 518400;
 $sixdaysago_after = $sixdaysago + 86400;

 $sevendaysago = time() - 604800;
 $sevendaysago_after = $sevendaysago + 86400;
 
 $SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` > :date");
 $SQL -> execute(array(":date" => $onedayago));
 $count_one = $SQL->fetchColumn(0);

 $SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
 $SQL -> execute(array(":before" => $twodaysago, ":after" => $twodaysago_after));
 $count_two = $SQL->fetchColumn(0);

 $SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
 $SQL -> execute(array(":before" => $threedaysago, ":after" => $threedaysago_after));
 $count_three = $SQL->fetchColumn(0);

 $SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
 $SQL -> execute(array(":before" => $fourdaysago, ":after" => $fourdaysago_after));
 $count_four = $SQL->fetchColumn(0);

 $SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
 $SQL -> execute(array(":before" => $fivedaysago, ":after" => $fivedaysago_after));
 $count_five = $SQL->fetchColumn(0);

 $SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
 $SQL -> execute(array(":before" => $sixdaysago, ":after" => $sixdaysago_after));
 $count_six = $SQL->fetchColumn(0);

 $SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
 $SQL -> execute(array(":before" => $sevendaysago, ":after" => $sevendaysago_after));
 $count_seven = $SQL->fetchColumn(0);
 
 $date_one = date('d/m/Y', $onedayago);
 $date_two = date('d/m/Y', $twodaysago);
 $date_three = date('d/m/Y', $threedaysago);
 $date_four = date('d/m/Y', $fourdaysago);
 $date_five = date('d/m/Y', $fivedaysago);
 $date_six = date('d/m/Y', $sixdaysago);
 $date_seven = date('d/m/Y', $sevendaysago);

     $plansql = $odb -> prepare("SELECT `users`.`expire`, `plans`.`name`, `plans`.`concurrents`, `plans`.`mbt` FROM `users`, `plans` WHERE `plans`.`ID` = `users`.`membership` AND `users`.`ID` = :id");
     $plansql -> execute(array(":id" => $_SESSION['ID']));
     $row = $plansql -> fetch(); 
     $date = date("m-d-Y, h:i:s a", $row['expire']);
     if (!$user->hasMembership($odb)){
         $row['mbt'] = 0;
         $row['concurrents'] = 0;
         $row['name'] = 'No membership';
         $date = '0-0-0';
     }
     
     $SQL = $odb -> prepare("SELECT * FROM `users` WHERE `username` = :usuario");
             $SQL -> execute(array(":usuario" => $_SESSION['username']));
             $balancebyripx = $SQL -> fetch();
             $balance = $balancebyripx['balance'];
     
 
?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content="Complex"/>
  <title><?php echo $sitename; ?> | <?php echo $page; ?></title>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon"/>
 <link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel='stylesheet' />
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>

<link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />

<link href="assets/plugins/inputtags/css/bootstrap-tagsinput.css" rel="stylesheet" />

<link href="assets/plugins/jquery-multi-select/multi-select.css" rel="stylesheet" type="text/css">

<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">

<link href="assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-zrnmn8R8KkWl12rAZFt4yKjxplaDaT7/EUkKm7AovijfrQItFWR7O/JJn4DAa/gx" crossorigin="anonymous">

<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

<link rel="stylesheet" href="assets/plugins/notifications/css/lobibox.min.css" />

<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />

<link href="assets/css/bootstrap.min.css" rel="stylesheet" />

<link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel='stylesheet' />

<link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">

<link href="assets/css/animate.css" rel="stylesheet" type="text/css" />

<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />

 <!--Chartist Chart CSS -->
  <link rel="stylesheet" href="plugins/chartist/css/chartist.min.css">



<link href="assets/css/sidebar-menu.css" rel="stylesheet" />


<link href="assets/css/app-style.css" rel="stylesheet" />
<script src="assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
 <link href="assets/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="assets/node_modules/sweetalert2/dist/sweetalert2.min.css">
	  <!--Morris JavaScript -->
  <script src="assets/plugins/raphael/raphael-min.js"></script>
  <script src="assets/plugins/morris/js/morris.js"></script>
  <script src="assets/plugins/morris/js/morris-data.js"></script>


</head>
<style type="text/css">
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}
::-webkit-scrollbar-button {
  width: 8px;
  height: 8px;
}
::-webkit-scrollbar-thumb {
  background: #e1e1e1;
  border: 0px none #ffffff;
  border-radius: 50px;
}
::-webkit-scrollbar-thumb:hover {
  background: #ffffff;
}
::-webkit-scrollbar-thumb:active {
  background: #ff8000;
}
::-webkit-scrollbar-track {
  background: #666666;
  border: 0px none #ffffff;
  border-radius: 50px;
}
::-webkit-scrollbar-track:hover {
  background: #666666;
}
::-webkit-scrollbar-track:active {
  background: #333333;
}
::-webkit-scrollbar-corner {
  background: transparent;
}
</style>


<body>



<!-- Start wrapper-->
	
 <div id="wrapper">

	 

  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="home.php">
	  <img src="assets/images/favicon.png" class="logo-icon" alt="logo icon">
       <h3 class="logo-text"><b>vStress.io</b></h3> 
     </a>
   </div>
   <div class="user-details">
    <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
      <div class="avatar"><img class="mr-3 side-user-img" src="user.png" alt="user avatar"></div>
       <div class="media-body">
       <h6 class="side-user-name"> <?php echo $_SESSION['username']; ?></h6>
      </div>
       </div>
     <div id="user-dropdown" class="collapse">
      <ul class="user-setting-menu">
            <li><a href="javascript:void(0)"><i class="fad fa-user-secret"></i>Rank: <?php echo $rank ?></a></li>
            <li><a href="javascript:void(0)"><i class="fad fa-charging-station"></i>Plan name: <span class="badge badge-primary shadow-primary m-1"> <?php echo $row['name']; ?></span></a></li>
      <li><a href="javascript:void(0)"><i class="fad fa-clock"></i>Expire: <span class="badge badge-primary shadow-primary m-1"> <?php echo $date ?></span></a></li>
	  <li><a href="javascript:void(0)"><i class="fad fa-money-bill-alt"></i>Balance: <span class="badge badge-primary shadow-primary m-1"> <?php echo number_format((float)$balance, 2, '.', ''); ?>$</span></a></li>
	  
      </ul>
     </div>
      </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">NAVIGATION</li>
	   <li>
        <a href="home.php" class="waves-effect">
          <i class="fad fa-home" style="color: dodgerblue;"></i> <span>Home</span>
        </a>
      </li>
      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="fad fa-shopping-basket text-success"></i> <span>Store</span>
          <i class="fa fa-angle-left float-right"></i>
        </a>
		<ul class="sidebar-submenu">
		  <li><a href="purchase.php"><i class="fad fa-shopping-cart"></i>Purchase</a></li>
          <li><a href="extras.php"><i class="fad fa-cart-plus"></i>Addons</a></li>
		  <li><a href="addbalance.php"><i class="fad fa-wallet"></i> Add Balance</a></li>
		  <li><a href="payments.php"><i class="fad fa-cash-register" ></i>Payments</a></li> 
		</ul>
      </li>
      <li>
        <a href="hub.php" class="waves-effect">
          <i class="fad fa-fire-alt text-danger"></i>
          <span>HUB</span>
        </a>
		
      </li>
	  <li><a href="api.php"><i class="fad fa-code text-secondary"></i>API</a></li>
	   <li>
        <a href="tos.php" class="waves-effect">
          <i class="fad fa-gavel" style="color: yellow;"></i> <span>TOS123</span>
        </a>
      </li>
	   <li>
        <a href="faq.php" class="waves-effect">
          <i class="fad fa-question" style="color: red;"></i> <span>FAQ</span>
        </a>
      </li>
	  <li>
       
      </li>
	
	   
	   
	  

      
      <li class="sidebar-header">---> Staff Team <---</li>
	   <?php
				                     if ($user -> isAdmin($odb)){ 
	                                 ?>
                											  <li>
        <a href="ComplexAdmin/home.php" class="waves-effect">
          <i class="zmdi zmdi-power"></i> <span>Admin Panel</span>
        </a>
      </li><?php  }?>
									
									
									
										 <?php
				                     if ($user -> isSupport($odb)){ 
	                                 ?>
                											    <a href="supporCOMPLEX" class="waves-effect">
          <i class="zmdi zmdi-power"></i> <span>Support Panel</span>
        </a><?php  }?>
									
									
									
	                                
									<?php 				
									$Adminnn = $odb->query("SELECT * FROM `users` WHERE `rank` = '69'");

									while($rowAdmins = $Adminnn->fetch(PDO::FETCH_BOTH)){
										$timeoffline = time() - $rowAdmins['activity'];
                                        $conline = $odb->prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username  AND {$timeoffline} < 60");
										$conline->execute(array(':username' => $rowAdmins['username']));
										$onlineripx = $conline->fetchColumn(0);

						                if($rowAdmins['username'] == "Complex"){
											 $emojis = "??";
										}elseif($rowAdmins['username'] == "DDoSMan"){
										     $emojis = "??";	
										}elseif($rowAdmins['username'] == "SecurityMan"){
										 $emojis = "??";
										}else{
											 $emojis = "??";
										}
										$logo = "fa fa-ban";
										if($onlineripx == "1"){  
                                        echo '<li><a href="#"><i class="zmdi zmdi-circle-o text-success"></i><span> [<bb class="text-success">Admin</bb>] '. $rowAdmins['username'] .'</span></a></li>';
                                        } 
										else {
										 echo '<li><a href="#"><i class="zmdi zmdi-close-circle-o text-danger"></i><span> [<bb class="text-danger">Admin</bb>] '. $rowAdmins['username'].'</span></a></li>';
                                        }
									}
									
									$Supportt = $odb->query("SELECT * FROM `users` WHERE `rank` = '15'");

									while($rowSupports = $Supportt->fetch(PDO::FETCH_BOTH)){
										$timeofflinex = time() - $rowSupports['activity'];
                                        $conlinex = $odb->prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username  AND {$timeofflinex} < 60");
										$conlinex->execute(array(':username' => $rowSupports['username']));
										$onlinesupportripx = $conlinex->fetchColumn(0);

										if($rowSupports['username'] == ""){
											 $emojis = "ðŸ’Ž";
										}elseif($rowSupports['username'] == ""){
										 $emojis = "ðŸ‘»";
										}else{
											 $emojis = "ðŸ’Ž";
										}
										
										$logo = "fa fa-ban";
										if($onlinesupportripx == "1"){  
                                        echo '<li><a href="#"><i class="zmdi zmdi-circle-o text-success"></i><span class="sidebar-mini-hide"> [<bb class="text-success">Mod</bb>] '. $rowSupports['username'] .'</span></a></li>';
                                        } 
										else {
										 echo '<li><a href="#"><i class="zmdi zmdi-close-circle-o text-danger"></i><span class="sidebar-mini-hide"> [<bb class="text-danger">Mod</bb>] '. $rowSupports['username'] .'</span></a></li>';
                                        }
									}
									
									
									$SQLGetTickets = $odb -> prepare("SELECT COUNT(*) FROM `notifications` WHERE `username` = :username AND `read` = 0");
        $SQLGetTickets -> execute(array(':username' => $_SESSION['username']));
        $active = $SQLGetTickets -> fetchColumn(0);
								?>	
     
    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav id="header-setting" class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    
  </ul>
  						<script type="text/javascript">
    var auto_refresh = setInterval(
    function ()
    {
     $('#getOnlinesUsers').load('complexx/totalOnlines.php').fadeIn("slow");
    }, 4000);
   </script>
     
  <ul class="navbar-nav align-items-center right-nav-link">
  <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="https://discord.gg/8EbwGE6" data-toggle="tooltip" data-placement="top" title="Discord" data-original-title="Join Discord">
    <i class="fab fa-discord"></i><span class="badge badge-info badge-up"></span></a>
  
  
 <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
    <i class="fad fa-battery-half text-danger"></i></a>
      <div class="dropdown-menu dropdown-menu-right">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
           Net Load
          <span class="badge badge-danger shadow-danger"><?php echo $load; ?>%</span>
          </li>
		 
		
        </ul>
      </div>
    </li>
	
	 <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" href="javascript:void();"data-toggle="tooltip" data-placement="top" title="Online" data-original-title="Total Online" >
   <i class="fad fa-users text-primary"></i><span class="badge badge-primary badge-up"><bb class="" id="getOnlinesUsers"></bb></span> </a>
      <div class="dropdown-menu dropdown-menu-right">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
           Members Online
          <span class="badge badge-primary shadow-primary"><bb class="" id="getOnlinesUsers"></bb></span>
          </li>
		 
		
        </ul>
      </div>
    </li>
  
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
    <i class="fad fa-bell text-info"></i><span class="badge badge-info badge-up"><?php echo $active ?></span></a>
      <div class="dropdown-menu dropdown-menu-right">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
           Notifications
          <span class="badge badge-info"><?php echo $active ?></span>
          </li>
		                  	<?php 
							$SQLGetNews = $odb -> query("SELECT * FROM `notifications` WHERE `username`='{$_SESSION['username']}' AND `read` = 0 ORDER BY `date` DESC LIMIT 5");
							while ($getInfo = $SQLGetNews -> fetch(PDO::FETCH_ASSOC)){
							
							$userrr = $getInfo['username'];
								$content = $getInfo['content'];
								$date = date("m-d-Y, h:i:s a" ,$getInfo['date']);
								
								
								echo ' <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <i class="zmdi zmdi-accounts fa-2x mr-3 text-info"></i>
            <div class="media-body">
            <h6 class="mt-0 msg-title">System</h6>
			<p class="msg-info">'. $content . '</p>
            </div>
          </div>
          </a>
          </li>';
							}
							
							?>
         
          
          <li class="list-group-item text-center"><a href="javaScript:void();" onclick="makeread()">Make all as Read</a></li>
        </ul>
      </div>
    </li>
	

	 
   
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="user.png" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="user.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title"><?php echo $_SESSION['username']; ?></h6>
			<p class="user-subtitle">Welcome Back</p>
            
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><a href="inbox.php"><i class="icon-envelope mr-2"></i> Inbox</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><a href="profile.php"><i class="icon-wallet mr-2"></i> Account</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><a href="profile.php"><i class="icon-settings mr-2"></i> Setting</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><a href="javascript:void(0)" onclick="logOut()"><i class="icon-power mr-2"></i> Logout</a></li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->
<div class="clearfix"></div>
	 <div class="content-wrapper">
	     <div class="container-fluid">



   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
    


  </div><!--End wrapper-->





<script src="assets/plugins/jquery-knob/excanvas.js"></script>
<script src="assets/plugins/jquery-knob/jquery.knob.js"></script>



<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>

	<script>
					window.setInterval(function(){
					var xmlhttp;
					if (window.XMLHttpRequest) {
						xmlhttp = new XMLHttpRequest();
					}
					else {
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function(){
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							var respone = xmlhttp.responseText
							if (xmlhttp.responseText == "SESSION_STATUS_OFF") {
								swal({
								title: "Session ended :(",
								text: "Your Session is over, Disconnects in 3 seconds.",
								timer: 3000,
								showConfirmButton: false
							});
							
							setTimeout(function() {
								document.location = "login";
							}, 3000)
							} else if(xmlhttp.responseText == "KICKED_DONE") {
								swal({
								  title: "Kicked from vStress.io!",
								  text: "The stuff decided to disconnect you from the system!",
								  showCancelButton: false,
								  showConfirmButton: false,
								  allowOutsideClick: false,
									});
							setTimeout(function() {
								window.location = "login";
							}, 1500)
							} else if(respone.indexOf("PRIVATEMESSAGE_") >= 0) {
								var message = respone.split("_");
								$("#getPrivateMessage").text(message[1]);
								document.getElementById("privateMessage").style.display = "block";
							} else if(respone.indexOf("RECEIVEMONEY_") >= 0) {
								var data = respone.split("_");
								$("#getMoneyMessage").text(data[2]);
								$("#moneybal").text("$" + data[1]);
								document.getElementById("receiveMoney").style.display = "block";
							}
							else if(respone.indexOf("transferMoney") >= 0) {
								document.getElementById("transferMoneyPopup").innerHTML = xmlhttp.responseText;
							}
						
						}
					}					
					xmlhttp.open("GET","complexx/checkSESSION.php",true);
					xmlhttp.send();
					
				}, 25000);
				</script>
	
	<button type="button" id="popGift" class="btn btn-alt-warning" data-toggle="modal" data-target="#modal-popGift"></button>
<style>
	#popGift {
		color: transparent;
		background: transparent;
		border: none;
		box-shadow: 0px 0px 0px rgba(0,0,0,0);
        width: 0px;
        height: 0px;
		opacity: 0;
		display:none;

	}
</style>
<script>
	SendPop = setTimeout(function(){
		document.getElementById('popGift').click();
		clearTimeout(SendPop);
	}, 5000);
</script>
<?php
$SQL = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username AND `dailygiftdate` < UNIX_TIMESTAMP(NOW())");
$SQL -> execute(array(':username' => $_SESSION['username']));
$count = $SQL -> fetchColumn(0);
	if ($count == '1') {	
	$expiresdate = strtotime("+1 day", time());
	$SQLUpdate = $odb -> prepare("UPDATE `users` SET `dailygiftdate`= :dailydate WHERE `username` = :username");
	$SQLUpdate -> execute(array(':username' => $_SESSION['username'], ':dailydate' => $expiresdate));
	$SQL = $odb -> query("UPDATE `users` SET `TestsDaily` = '0' WHERE `id` = '" . $_SESSION['ID'] . "'");
	
$randGift = rand(1, 300);
$getDailyGiftData = $odb -> prepare("SELECT *,COUNT(*) FROM `dailygift` WHERE `number` = :number");
$getDailyGiftData -> execute(array(':number' => $randGift));
$userGift = $getDailyGiftData -> fetch(PDO::FETCH_ASSOC);
if ($userGift['COUNT(*)'] == '0') {
//Nothing = background: linear-gradient(135deg,#ab4444 0,#ab5f57 100%)!important;
//Success = box-shadow: 0 -5px 25px -5px #69ab57, 0 1px 5px 0 rgb(45, 53, 61), 0 0 0 0 #44ab8e;
$ShadowGift = '<div class="modal-content animated bounceIn" style="
    box-shadow: 0 -5px 25px -5px #ab4444, 0 1px 5px 0 rgb(45, 53, 61), 0 0 0 0 #ab5f57;
">';
$TitleGift = 'Oops, You don\'t receive anything';
$HeaderGift = '<div class="card-header">';
$MessageGift = '<center><div class="text-danger">Sorry, But you did not received anything today!</br>Come back tomorrow to check your luck</div><hr><div class="text-warning">Daily Gifts</div></br><bb class="text-danger">Low:</bb> 1$, 2$, 3$</br><bb class="text-warning">Medium:</bb> 4$, 5$</br><bb class="text-success">High:</bb> 10$</center></br>';
} else {
	$ShadowGift = '<div class="modal-content animated bounceIn" style="
    box-shadow: 0 -5px 25px -5px #69ab57, 0 1px 5px 0 rgb(45, 53, 61), 0 0 0 0 #44ab8e;
">';
$HeaderGift = '<div class="card-header ">';
$TitleGift = 'You received a Daily gift :)';
$gift = str_replace('$', '', $userGift['gift']);
$MessageGift = '<center><div class="text-success">Congratulations, you\'ve been awarded a free gift!</div><div class="text-success tossing"><i class="fa fa-gift"></i> You received $' . $gift . ' gift to your acount Balance! <i class="fa fa-gift"></i></div><hr><div class="text-warning">Daily Gifts</div></br><bb class="text-danger">Low:</bb> 1$, 2$, 3$</br><bb class="text-warning">Medium:</bb> 4$, 5$</br><bb class="text-success">High:</bb> 10$</center></br>';

$SQL = $odb -> prepare("SELECT `balance`,`plan` FROM `users` WHERE `username` = :username");
$SQL -> execute(array(':username' => $_SESSION['username']));
$balance = $SQL -> fetch(PDO::FETCH_ASSOC);
$balance['balance'] = $balance['balance'] + $gift;

$SQLUpdate = $odb -> prepare("UPDATE `users` SET `abalance`= :accb WHERE `username` = :username");
$SQLUpdate -> execute(array(':username' => $_SESSION['username'], ':accb' => $balance['balance']));

if($user->isVIP($odb)) {
$usernameSQL = '[<bb class="text-warning">VIP</bb>] ' . $_SESSION['username'] . " - Won: $" . $gift . ".00";
} elseif ($user->hasMembership($odb)) {
$usernameSQL = '[<bb class="text-success">Member</bb>] ' . $_SESSION['username'] . " - Won: $" . $gift . ".00";
} else {
$usernameSQL = '[<bb class="text-gray">User</bb>] ' . $_SESSION['username']. " - Won: $" . $gift . ".00";
}

$SQLUpdate = $odb -> prepare("INSERT INTO `dailygiftwon`(`ID`, `username`, `date`) VALUES (NULL,:username,:date)");
$SQLUpdate -> execute(array(':username' => $usernameSQL, ':date' => $expiresdate));
}
?>
<div class="modal animated flip" id="modal-popGift" tabindex="-1" role="dialog" aria-labelledby="modal-popGift" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-dialog-popout" role="document">
<?= $ShadowGift; ?>
<div class="card mb-0">
<?= $HeaderGift; ?>
<h3 class="card-title"><i class="fa fa-gift"></i> <?= $TitleGift; ?></h3>
</div>
<div class="card-body">
<?= $MessageGift; ?>
</div>
</div>

</div>
</div>
</div>

	<?php } ?>
	
	<div class="modal animated flipInX show" id="privateMessage" tabindex="-1" role="dialog" aria-labelledby="modal-popout" style="display: none;">
   <div class="modal-dialog modal-dialog-popout" role="document">
      <div class="modal-content animated infinite pulse" style="
    box-shadow: 0px 2px #e0a414;
">
         <div class="card">
            <div class="card-header">
               You got one message from staff!
            </div>
            <div class="card-body">
               Dear <strong><?= $_SESSION['username']; ?>.</strong><br><br><p id="getPrivateMessage"></p><br>
				
				<div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-outline-warning" id="privateMessageBtn" style="margin-bottom: -2px; border-radius: 5px 5px 0px 0px" onclick="document.getElementById('privateMessage').style.display = 'none';"><i class="fa fa-check"></i> Ok, I got it!</button>
               </div>				
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal animated flipInX show" id="receiveMoney" tabindex="-1" role="dialog" aria-labelledby="modal-popout" style="display: none;">
	<div class="modal-dialog modal-dialog-popout animated infinite swing" role="document">
		  <div class="modal-content" style="
		box-shadow: 0px 2px #7ba94d;
	">
			 <div class="card">
				<div class="card-header">
				   You have received money from your Admins
				</div>
				<div class="card-body text-center"><span>You just got <bb class="text-success" id="moneybal">$50</bb> from one of the Admins </span><br>

	<span id="getMoneyMessage"></span></br>
	<span>hope you use them wisely, enjoy :)</span><br><br>
					
					<div class="col-md-12 text-center">
					  <button type="submit" class="btn btn-outline-success" id="privateMessageBtn" style="margin-bottom: -2px; border-radius: 5px 5px 0px 0px" onclick="document.getElementById('receiveMoney').style.display = 'none';"><i class="fa fa-check"></i> Ok, I got it!</button>
				   </div>				
				</div>
			 </div>
		  </div>
	   </div>
</div>
	
	<script>
	function makeread() {
				    window.setInterval(function(){
					var xmlhttp;
					if (window.XMLHttpRequest){
				    xmlhttp = new XMLHttpRequest();
					}
					else{
				    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.open("GET","complexx/read.php?username=<?php echo $_SESSION['username']; ?>",true);
					xmlhttp.send(); 
					}, 500);
					}
</script>
	<script>
				    window.setInterval(function(){
					var xmlhttp;
					if (window.XMLHttpRequest){
				    xmlhttp = new XMLHttpRequest();
					}
					else{
				    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.open("GET","complexx/Complexcheck.php?username=<?php echo $_SESSION['username']; ?>",true);
					xmlhttp.send(); 
					}, 8000);
</script>

<script>
                function logOut() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Are you sure you want to logout?",
                type: 'info',
				
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!'
            }).then((result) => {
                if (result.value) {
                    setTimeout(function () {
                        window.location.replace('logout.php');
                    }, 500);
                    Swal.fire({
                         title: 'Success',
						 type: 'success',
                        text: "Redirecting, Bye"
					}
                   )
                }
            })
        }

				
function ShowMyIp() {
const ipAPI = 'https://api.ipify.org?format=json'
swal.queue([{
  title: "Your public IP",
  confirmButtonText: "Show my public IP",
  showLoaderOnConfirm: true,
  preConfirm: () => {
    return fetch(ipAPI)
      .then(response => response.json())
      .then(data => swal.insertQueueStep(data.ip))
      .catch(() => {
        swal.insertQueueStep({
          type: 'error',
          title: 'Unable to get your public IP'
        })
      })
  }
}])

				}
</script>
<script>
xmlhttp.onreadystatechange = function(){
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							var respone = xmlhttp.responseText
							if (xmlhttp.responseText == "SESSION_STATUS_OFF") {
								swal({
								title: "Session ended :(",
								text: "Your Session is over, Disconnects in 3 seconds.",
								timer: 3000,
								showConfirmButton: false
							});
							
							setTimeout(function() {
								document.location = "login";
							}, 3000)
							} else if(xmlhttp.responseText == "KICKED_DONE") {
								swal({
								  title: "Kicked from vStress.io!",
								  text: "The staff decided to disconnect you from the system!",
								  showCancelButton: false,
								  showConfirmButton: false,
								  allowOutsideClick: false,
									});
							setTimeout(function() {
								window.location = "login";
							}, 1500)
							} else if(respone.indexOf("PRIVATEMESSAGE_") >= 0) {
								var message = respone.split("_");
								$("#getPrivateMessage").text(message[1]);
								document.getElementById("privateMessage").style.display = "block";
							} else if(respone.indexOf("RECEIVEMONEY_") >= 0) {
								var data = respone.split("_");
								$("#getMoneyMessage").text(data[2]);
								$("#moneybal").text("$" + data[1]);
								document.getElementById("receiveMoney").style.display = "block";
							} else if(respone.indexOf("transferMoney") >= 0) {
								document.getElementById("transferMoneyPopup").innerHTML = xmlhttp.responseText;
							}
						
						}
					}					
					xmlhttp.open("GET","complexx/checkSESSION.php",true);
					xmlhttp.send();

</script>


</html>
