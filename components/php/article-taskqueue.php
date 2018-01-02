<article class="task_queue" id="task_queue">
	<div class="container">
    	<h1 class="text-center">TASK QUEUE</h1>
        <section class="row ">
        	
             <?php 
			 //n = 10
			 $n=10;
			 $page = isset($_POST['task_pn'])? $_POST['task_pn'] : 0;
			 $multi_search = array();
			 $multi_search[0] = array('privacy'=>'public', 'status' => 'ready');	
			 $multi_search[1]= array('privacy'=>'public', 'status' => 'queued');	
			 $tasks = Task::find_by_multiarray_page_and_number($multi_search, $page, $n);
			 $limit = count($tasks);
			 if (count($tasks) == 0) echo '<h3 class="text-center"> No Tasks in Queue </h3>';
			 else include "snippet-tasks-table.php"; 
			 ?>
             <div class="arrows pull-right">
                <a  <?php echo 'href=" ?'.$page.'='.($page-1).'"'; if($page-1 < 0) echo "hidden";?> >
                	<span class="glyphicon glyphicon-chevron-left"/></a>
                <a  <?php echo 'href=" ?'.$page.'='.($page+1).'"'; if($page*$n+$n >= $limit) echo "hidden";?> >
                	<span class="glyphicon glyphicon-chevron-right"/></a>
			</div>
        </section>
    </div>
</article>
