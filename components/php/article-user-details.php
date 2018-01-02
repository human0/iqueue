<?php 
$month = date("M", strtotime($agent->dateofbirth)); ?>
<article class="intro jumbotron" id="user-intro">
	<div class="wraper">
    <div class="details">
    	<img class="center-block profile-img img-circle" src="<?php echo "images/misc/".$month.".png"; ?>" >
         <?php // echo $agent->points; ?>
        <h3 class="text-center"><?php echo $agent->username; ?> </h3>
        <div class="row">
			<div class="col col-xs-6 text-right">
				<h5>EXPERIENCE</h5>
                <h2 class="orange"> <?php echo $agent->hoursspent; ?> xp</h2>
            </div>
			<div class="col col-xs-6">
				<h5>POINTS</h5>
                <h2 class="orange"> <?php echo $agent->points; ?> pt</h2>            
			</div class="col col-xs-6">
        </div>
    </div>
    </div>
</article><!-- intro -->