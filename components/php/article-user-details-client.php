<article class="intro jumbotron" id="user-intro">
	<div class="wraper">
    <div class="details">
    	<img class="center-block profile-img img-circle" src="images/misc/client.png" >
        <h3 class="text-center"><?php echo $client->username; ?> </h3>
        <div class="row">
			<div class="col col-xs-6 text-right">
				<h5>POINTS SPENT</h5>
                <h2 class="orange"> <?php echo $client->hoursspent; ?> pt</h2>
            </div>
			<div class="col col-xs-6">
				<h5>AVAILABLE POINTS</h5>
                <h2 class="orange"> <?php echo $client->points; ?> pt</h2>            
			</div class="col col-xs-6">
        </div>
    </div>
    </div>
</article><!-- intro -->