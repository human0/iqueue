<div class="user-activity" id="user-activity">
    <h2>USER ACTIVITY</h2>
    <a data-toggle="collapse" href="#profiledetail" aria-expanded="false" aria-controls="profiledetail">
      <h5><span class="glyphicon glyphicon-user"> </span>  Profile Details </h5>
      <span class="pointer glyphicon glyphicon-chevron-down"></span>
    </a>
    <div class="collapse" id="profiledetail">
    	<div class="well">
        	<h5> First Name: <small class="pull-right"><?php echo $client->firstname; ?></small></h5>
        	<h5> Last Name: <small class="pull-right"><?php echo $client->lastname; ?></small></h5>
        	<h5> Address: <small class="pull-right"><?php echo $client->address; ?></small></h5>
    	</div>
    </div>
    <a data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
      <h5><span class="glyphicon glyphicon-cog"></span>  Settings </h5>
      <span class="pointer glyphicon glyphicon-chevron-down"></span>
    </a>
    <div class="collapse" id="settings">
      <div class="well">
			<form role="form"  name="update-user" action="#" enctype="multipart/form-data" method="POST">	
            	<input name="client-firstname" type="text" placeholder="Change firstname" value="<?php echo $client->firstname; ?>" />
            	<input name="client-lastname" type="text" placeholder="Change lastname" value="<?php echo $client->lastname; ?>" />
            	<textarea name="client-address" type="text" placeholder="Change address" ><?php echo $client->address ?></textarea> 
                
                <input name="usertype" type="hidden" value="client"/>
                <input name="clientid" type="hidden" value="<?php echo $client->clientid; ?>" />
                <br  />
                <button formnovalidate class="submit btn btn-primary" type="submit" name="submit" value="Submit" tabindex="50"/>Apply Changes</button>
		 		<input type="hidden" name="MM_action" value="update-user"/>
                <input type="hidden" name="MM_notification" value="profile update"/>
            </form>
      </div>
    </div>
 
     <a data-toggle="collapse" href="#createtask" aria-expanded="false" aria-controls="#createtask">
      <h5><span class="glyphicon glyphicon-briefcase"></span> Create Task </h5>
      <span class="pointer glyphicon glyphicon-chevron-down"></span>
    </a>
    <div class="collapse" id="createtask">
      <div class="well">
			<form role="form" id="create-taskandupdateclient" name="create-taskandupdateclient" action="#" enctype="multipart/form-data" method="POST">
            	<input name="clientid" type="hidden" value="<?php echo $client->clientid; ?>" /> 
                <input name="task-clientid" type="hidden" value="<?php echo $client->clientid; ?>" />            

                <input name="client-points-minus" class="points" type="hidden" /> 
                <input name= "funds" class="funds" type="hidden" value="<?php echo $client->points; ?>" />
            	<input required name="task-weight" class="weight" type="number" placeholder="Points Offered"/>

                <input required name="task-completiontime" type="number" placeholder="Duration (days)"/>               
            	<input required name="task-title" type="text" placeholder="Task Name" />
            	<textarea required name="task-description" type="text" placeholder="Requirements and Instructions" ></textarea> 
				
                public<input name="task-privacy" value="public" type="radio" checked="checked"/>&nbsp;
                private<input name="task-privacy" value="private" type="radio"/>&nbsp;
                
                <button formnovalidate class="submit btn btn-primary" type="submit" name="submit" value="Submit" tabindex="50"/>Create</button>
		 		<input type="hidden" name="MM_action" value="create-taskandupdateclient"/>
                <input type="hidden" name="MM_notification" value="task creation"/> 
            </form>
      </div>
    </div>

	<?php 
	// --------------------- TASKS ------------------ queued, ready, started, completed//
	$multi_search = array();
	$multi_search[0] = array('clientid'=>$clientid, 'status' => 'ready');	
	$multi_search[1]= array('clientid'=>$clientid, 'status' => 'queued');	
	$multi_search[2]= array('clientid'=>$clientid, 'status' => 'started');	
	$tasks_ongoing = Task::find_by_multi_array($multi_search); ?>
    <a data-toggle="collapse" href="#tasksongoing" aria-expanded="false" aria-controls="#tasksongoing">
      <h5><span class="glyphicon glyphicon-briefcase"></span> Tasks Ongoing 
      	<?php if (count($tasks_ongoing) > 0) 
		{
      		echo '<span class="badge orange">'.count($tasks_ongoing).'</span>';
		} ?>
	  </h5>
      <span class="pointer glyphicon glyphicon-chevron-down"></span>
    </a>
    <div class="collapse" id="tasksongoing">
      <div class="well">
      	<?php  
		foreach ($tasks_ongoing as $ongoing){ 
			?>
			<h5><?php echo $ongoing->title; 
				if ($ongoing->status == "started") 
				{?>
					<small class="pull-right"> <?php echo "started - ".$ongoing->hours_to_go()." Hrs to go";?></small>
                    <div class="well">
                        <form name="update-taskandagent" action="#" enctype="multipart/form-data" method="POST">	
                            <input name="taskid" type="hidden" value="<?php echo $ongoing->taskid; ?>"/>
                            <input name="task-status" type="hidden" value="completed" />
                            
                            <input name="agentidlist" type="hidden" value="<?php echo $ongoing->agentlist; ?>" />                           
                            <input name="task-agents-points-plus" type="hidden" value="<?php echo $ongoing->weight; ?>" />
        
                            <button class="submit btn btn-primary" type="submit" name="submit"/>This is completed</button>
                            <input type="hidden" name="MM_action" value="update-taskandagent"/>
                            <input type="hidden" name="MM_notification" value="completed task"/>
                        </form>
                  	</div> 
				<?php 
				}		
				else  if ($ongoing->status == "ready")
				{?>
					<small class="pull-right"><?php echo $ongoing->status;?></small>
                    <div class="well">
                        <form role="form"  name="update-task" action="#" enctype="multipart/form-data" method="POST">				
                    	<input name="taskid" type="hidden" value="<?php echo $ongoing->taskid; ?>" />
        	            <input name="task-status" type="hidden" value="started" />
            	        <button formnovalidate class="submit btn btn-success" type="submit" name="submit" value="Submit" />Start</button>
                	    <input type="hidden" name="MM_action" value="update-task"/>
                        <input type="hidden" name="MM_notification" value="started task"/>
                		</form>
                    </div>
				<?php }
				else { ?>
                	<small class="pull-right"><?php echo $ongoing->status;?></small>
				<?php }?>
		</h5>
       <?php } ?>
      </div>
    </div>

	<?php 
	// --------------------- Applications -----------------pending, accpted, declined-//
	$search = array('clientid'=>$clientid, 'status' => 'pending');
	$task_applications = Application::find_by_inclusive_array($search);
	?>
    <a data-toggle="collapse" href="#taskapplications" aria-expanded="false" aria-controls="taskapplications">
      <h5><span class="glyphicon glyphicon-book"></span>  Pending Task Applicaions
      	<?php if (count($tasks_ongoing) > 0) 
		{
      		echo '<span class="badge orange">'.count($task_applications).'</span>';
		} ?>
      </h5>
      <span class="pointer glyphicon glyphicon-chevron-down"></span>
    </a>
    <div class="collapse" id="taskapplications">
      <div class="well">
      	<?php  foreach ($task_applications as $application)
		{
			$agent = Agent::find_by_id($application->agentid);
		 	$task = Task::find_by_id($application->taskid);
		 ?>
		 <h5> <?php echo $task->title; ?>
			<small class="pull-right"><?php echo 'Requested by '.$agent->username; ?> </small>
                <div class="floating-forms">
                    <form role="form"  name="update-applicationandtask" action="#" enctype="multipart/form-data" method="POST">				
                        <input name="taskid" type="hidden" value="<?php echo $task->taskid; ?>" />
                        <input name="agentid" type="hidden" value="<?php echo $agent->agentid; ?>" />
                        <input name="applicationid" type="hidden" value="<?php echo $application->applicationid; ?>" />
                        
                        <input name="task-agentlist-id" type="hidden" value="<?php echo $agent->agentid; ?>" />
                        <input name="task-status" type="hidden" value="ready" />
                        
                        <input name="application-status" type="hidden" value="accepted" />
                        
                        <button formnovalidate class="submit btn btn-primary" type="submit" name="submit" value="Submit" />Accept</button>
                        <input type="hidden" name="MM_action" value="update-applicationandtask"/>
                        <input type="hidden" name="MM_notification" value="task application accepted"/>
                    </form>
                    
                    <form role="form"  name="update-application" action="#" enctype="multipart/form-data" method="POST">				
                        <input name="applicationid" type="hidden" value="<?php echo $application->applicationid; ?>" />
                        
                        <input name="application-status" type="hidden" value="declined" />
                        
                        <button formnovalidate class="submit btn btn-warning" type="submit" name="submit" value="Submit" />Decline</button>
                        <input type="hidden" name="MM_action" value="update-application"/>
                        <input type="hidden" name="MM_notification" value="task application declined"/>
                    </form>
                </div> 
            </h5>
       <?php } ?>
      </div>
    </div>
            
    <div class="well">
    		<span class="glyphicon glyphicon-remove"> </span>
        	<h5>Notification</h5>
            <?php 
				$notifications = Notification::find_by_attribute_and_value("userid", $client->userid); 
				foreach ($notifications as $notification)
				{ 
					echo 
					'<p>'.
						'<a href="'.$notification->link.'">'.
							'<h4>'.$notification->note.'</h4>'.
						'</a>'.
						$notification->description.
					'</p>';					
				}
			?>
      </div>
</div>