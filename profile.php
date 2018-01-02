<?php 
error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display_errors', TRUE);
$currentpage="profile";
require_once("components/php/initialize.php"); 
?>
<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IQueue -- Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href="css/mystyles.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body id="profile">
		<section class="container-fluid">
			<div class="content row">
				<?php 
				$s_user = User::find_by_id($session->user_id);
				$s_usertype = $s_user->usertype;
				$authorised = false;
				if (isset($_GET['pf']))
				{
					$p_userid = $_GET['pf'];
					$p_user = User::find_by_id($p_userid);
					$p_usertype = $p_user->usertype;
					if ($s_usertype == "admin" && $p_usertype != "admin")
					{
						$s_user = $p_user;
						$message = "You are viewing this profile with as admin";
					}
					else if	($s_usertype == "client" && $p_usertype == "agent") 
					{
						$s_user = $p_user;
						$authorised = true;
					}
					else 
					{
						$message = "You are not authorised to view the profile you requested, or the user may not exist";
					}
				}
				
				include "components/php/header.php"; 				
								
				if ($authorised)
				{
					$agent = Agent::find_by_id($s_user->typeid);
					$agentid = $agent->agentid;
					include "components/php/article-user-details.php";		
					echo '<div class="container">';
						include "components/php/article-user-taskqueue.php"; 
						include "components/php/article-user-gadgets.php";
					echo '</div><!-- content -->';
				}

				//------------Agent Profile--------------------
				else if ($s_user->usertype == "agent")
				{
					$agent = Agent::find_by_id($s_user->typeid);
					$agentid = $agent->agentid;
					include "components/php/article-user-details.php";		
					echo 
					'<div class="container">         
                    	<div class="row">
                        	<div class="col col-sm-4">';
								include "components/php/article-user-activity.php";  
								echo     
                        	'</div>
                        		<div class="col col-sm-8" > ';  
                            		include "components/php/article-user-taskqueue.php"; 
                            		include "components/php/article-user-gadgets.php";
									echo  
                        	  '</div>           
                    		</div>
                	</div><!-- content -->';	
				}
				
				//-------------------Clinet Profile----------------------------
				else if ($s_user->usertype == "client")
				{
					$client = Client::find_by_id($s_user->typeid);
					$clientid = $client->clientid;
					include "components/php/article-user-details-client.php";					
					echo 
					'<div class="container">         
                    	<div class="row">
                        	<div class="col col-sm-4">';
								include "components/php/article-user-activity-client.php";  
								echo     
                        	'</div>
                        		<div class="col col-sm-8" > ';  
                            		include "components/php/article-user-taskqueue-client.php"; 
									echo  
                        	  '</div>           
                    		</div>
                	</div><!-- content -->';	
				}
				
				//-------------------Clinet Admin----------------------------
				else if ($s_user->usertype == "admin")
				{
					$admin = Admin::find_by_id($s_user->typeid);
					$adminid = $admin->adminid;
					include "components/php/article-user-details-admin.php";					
					echo 
					'<div class="container">         
                    	<div class="row">
                        	<div class="col col-sm-4">';
								include "components/php/article-user-activity-admin.php";  
								echo     
                        	'</div>
                        		<div class="col col-sm-8" > ';  
                            		include "components/php/article-user-taskqueue-admin.php"; 
                            		include "components/php/article-user-gadgets-admin.php";
									echo  
                        	  '</div>           
                    		</div>
                	</div><!-- content -->';	
				}

				?> 
                <?php include "components/php/footer.php"; ?>
            </div>
		</section><!-- container -->
    <script src="js/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="js/myscript.js"></script> 
  </body>
</html>
