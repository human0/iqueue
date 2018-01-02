<header class="clearfix">
	<section class="row">
    	<nav class="navbar navbar-default navbar-fixed-top">    
            <div class="container">
                <div class="navbar-header">
                    <img class="pull-left" src="images/misc/logo_transparent.png" width="70">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>    
                <div class="collapse navbar-collapse" id="collapse" >
                    <ul class="nav navbar-nav pull-right"> 
                        <li class="home-nav"><a href="index.php">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle about-nav" data-toggle="dropdown"> About <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                <li><a tabindex="-1" href="about.php#quick_review">Quick Review</a></li><li class="divider"></li>
                                <li><a tabindex="-1" href="about.php#services">Services</a></li><li class="divider"></li>             
                                <li><a tabindex="-1" href="about.php#the_team">The Team</a></li><li class="divider"></li>
                                <li><a tabindex="-1" href="about.php#founder">Founder</a></li><li class="divider"></li>
                                <li><a tabindex="-1" href="about.php#partners">Partners</a></li>
                            </ul><!-- dropdown menu -->
                        </li>
                        <?php if ($session->is_logged_in()){ ?>
                        <li  class="profile-nav"><a href="profile.php">Profile</a></li>
                        <li  class=""><a href="?action=logout">Logout</a></li>
                        <?php } else { ?>
                        <li  class="signup-nav"><a href="signup.php">Sign Up</a></li>
                        <li  class=""><a href="#" class="login-modal-triger">Login</a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </nav>
	</section><!-- navbar -->
	<?php if(isset($_GET['tmodal'])) include "components/php/snippet-task-modal.php"; ?>
    <section id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
        	<div class="modal-content">
         		<div class="modal-header">
           			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            		<h4 class="modal-title text-center" id="myModalLabel">Signin</h4>
          		</div>
                <div class="modal-body clearfix">
                	 <?php  include "components/php/form-login.php"; ?>
                </div>
			</div>
        </div>
	</section>
    <section id="message-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md">
        	<div class="modal-content">
         		<div class="modal-header">
           			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            		<h4 class="modal-title text-center" id="myModalLabel">Note!</h4>
          		</div>
                <div class="modal-body clearfix">
                	 <?php echo $message; ?>
                </div>
			</div>
        </div>
	</section>
    <section id="notice-modal" class="modal fade">
		<div class="modal-dialog modal-md">
        	<div class="modal-content">
         		<div class="modal-header">
           			<button type="button" class="close" data-dismiss="modal">
                    	<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <img src="images/misc/sparkdt.png" class="img-rounded" 
                    alt="sparkDT" width="100" height="100" style="margin: 0 auto;" />
            		<h4 class="modal-title text-center" id="myModalLabel ">
                    	This Website is powered by <b>Spark Development Team</b> <br/>
                        <small> Where professional websites are made affordable</small>
                    </h4>
             	</div>
             	<div class="modal-body" clearfix>
                    <p> 
                    	<b>Notice!!</b> This website as not been paid for, and is currently not being maintained. 
                        Its contents may be outdated, malicious or unsafe to browse.  
                    	We keep it online only so you can find what information you are looking for. 
                    </p>
          		</div>
                <div class="modal-footer clearfix">
                	<div class="row">
                        <div class="col col-sm-6">
                            <a class="btn btn-primary btn-block" href="http://www.sparkdevteam.com"> 
                            Visit Spark Dev Team 
                            </a>
                        </div>
                      	<div class="col col-sm-6">
                            <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"> 
                            Proceed with caution 
                            </button>
                        </div>
                  </div>
                </div>
            </div><!-- modal-body -->
        </div><!----content--->
	</section>
</header><!-- header -->
