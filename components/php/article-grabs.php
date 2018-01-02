<article class="grabs" id="grabs">
	<div class="container">
    	<h1 class="text-center">HARDWARE FOR GRABS</h1>
        <section class="row ">
             <?php 
			 $n=10;
			 $page = isset($_POST['gadget_pn'])? $_POST['gadget_pn'] : 0;
			 $gadgets = Gadget::numbered_paging_attribute_and_value("agentid",0, $page, $n);
			 $limit = count($gadgets);
			 if (count($gadgets) == 0) echo '<h3 class="text-center"> No Gadgets Available </h3>';
			 else include "snippet-grabs.php"; 
			 ?>
             <div class="arrows pull-right">
                <a  <?php echo 'href=" ?'.$page.'='.($page-1).'"'; if($page-1 < 0) echo "hidden";?> >
                	<span class="glyphicon glyphicon-chevron-left"/></a>
                <a  <?php echo 'href=" ?'.$page.'='.($page+1).'"'; if($page*$n+$n >= $limit) echo "hidden";?> >
                	<span class="glyphicon glyphicon-chevron-right"/></a>
			</div>
             <!--nav class="pull-right">
              <ul class="pagination">
                <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                <li class="active"><a href="#">1 <span class="sr-only"></span></a></li>
                <li class=""><a href="#">2 <span class="sr-only"></span></a></li>
                <li class=""><a href="#">3 <span class="sr-only"></span></a></li>
                <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>
              </ul>
            </nav-->	
        </section>
    </div>
</article>
