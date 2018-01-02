<article class="grabs" id="user_grabs">
    	<h2 class="filled">PURCHASED GADGETS</h2>
        <div class="tabbable tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#grabbed" data-toggle="tab">Purchased Gadgets</a></li>
                <li class=""><a href="#allgrabs"  data-toggle="tab">available Gadgets</a></li>
            </ul><!-- nav nav-tabs -->
        </div><!-- tabbable tabs -->
        <section class="tab-content tab-content-scroll">
        	<div class="tab-pane active" id="grabbed">
        		<?php 
				$gadgets=Gadget::find_by_attribute_and_value("agentid", $agent->agentid); //new, ordered, delivered
				include "snippet-grabs.php"; ?>
            </div>
            <div class="tab-pane" id="allgrabs">
          		<?php 
				$gadgets=Gadget::find_by_attribute_and_value("status", "new");
				include "snippet-grabs.php"; 
				?>
            </div> 
        </section><!-- tab-content -->
</article>
