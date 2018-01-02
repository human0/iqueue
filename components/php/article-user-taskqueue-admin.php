<article class="task_queue" id="user_task_queue">
    	<h2 class="filled">TASK QUEUE</h2>
        <div class="tabbable tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#queuedtasks" data-toggle="tab">Queued Tasks</a></li>
                <li class=""><a href="#ongoingtasks"  data-toggle="tab">Ongoing Tasks</a></li>
                <li class=""><a href="#completedtasks" data-toggle="tab">Completed Tasks</a></li>
            </ul><!-- nav nav-tabs -->
        </div><!-- tabbable tabs -->
        <section class="tab-content tab-content-scroll">
        	<div class="tab-pane active" id="queuedtasks">
        		<?php 
			 $multi_search = array();
			 $multi_search[0] =array('status' => 'ready');	
			 $multi_search[1]= array('status' => 'queued');	
			 $tasks = Task::find_by_multiarray_page_and_number($multi_search);
				include "snippet-tasks-table.php"; 
				?>
            </div>
            <div class="tab-pane" id="ongoing">
          		<?php 
			 $multi_search = array();
			 $multi_search[0] = array('status' => 'started');	
			 $tasks = Task::find_by_multiarray_page_and_number($multi_search);
				include "snippet-tasks-table.php"; ?>
            </div> 
            <div class="tab-pane" id="completedtasks">
          		<?php 
			 $multi_search = array();
			 $multi_search[0] =array('status' => 'completed');	
			 $tasks = Task::find_by_multiarray_page_and_number($multi_search);
				include "snippet-tasks-table.php"; ?> 
            </div>
        </section><!-- tab-content -->
</article>
