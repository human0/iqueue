<article class="grabs" id="user_grabs">
    	<h2 class="filled">PURCHASED GADGETS</h2>
        <div class="tabbable tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#grabbed" data-toggle="tab">Purchased Gadgets</a></li>
                <li class=""><a href="#allgrabs"  data-toggle="tab">All Gadgets</a></li>
            </ul><!-- nav nav-tabs -->
        </div><!-- tabbable tabs -->
        <section class="tab-content tab-content-scroll">
        	<div class="tab-pane active" id="grabbed">
        		<?php include "snippet-user-grabbed.php"; ?>
            </div>
            <div class="tab-pane" id="allgrabs">
          		<?php include "snippet-user-grabs.php"; ?>
            </div> 
        </section><!-- tab-content -->
</article>
