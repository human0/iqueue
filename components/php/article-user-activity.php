<div class="user-activity" id="user-activity">
    <h2>USER ACTIVITY</h2>
    <a data-toggle="collapse" href="#profiledetail" aria-expanded="false" aria-controls="profiledetail">
      <h5><span class="glyphicon glyphicon-user"></span>  Profile Details </h5>
      <span class="pointer glyphicon glyphicon-chevron-down"></span>
    </a>
    <div class="collapse" id="profiledetail">
      <div class="well">
        	<h5>Firstname: <small class="pull-right"><?php echo $agent->firstname; ?></small></h5>
        	<h5>Lastname: <small class="pull-right"><?php echo $agent->lastname; ?></small></h5>
        	<h5>Dateofbirth: <small class="pull-right"><?php echo $agent->dateofbirth; ?></small></h5>
        	<h5>Idnumber: <small class="pull-right"><?php echo $agent->idnumber; ?></small></h5>
        	<h5>Address: <small class="pull-right"><?php echo $agent->address; ?></small></h5>
        	<h5>Phonenumber: <small class="pull-right"><?php echo $agent->phonenumber; ?></small></h5>
        	<h5>Educationalbackground: <small class="pull-right"><?php echo $agent->educationalbackground; ?></small></h5>
     </div>
    </div>

  
  
    
    <a data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
      <h5><span class="glyphicon glyphicon-cog"></span>  Settings </h5>
      <span class="pointer glyphicon glyphicon-chevron-down"></span>
    </a>
    <div class="collapse" id="settings">
      <div class="well">
			<form role="form" id="update-form" name="update" action="#" enctype="multipart/form-data" method="POST">	
            	<input name="agent-firstname" type="text" placeholder="Change firstname" value="<?php echo $agent->firstname; ?>" />
            	<input name="agent-lastname" type="text" placeholder="Change lastname" value="<?php echo $agent->lastname; ?>" />
            	<input name="agent-dateofbirth" type="date" placeholder="Change date of birth" value="<?php echo $agent->dateofbirth ?>" /> 
            	<input name="agent-idnumber" type="text" placeholder="Change idnumber" value="<?php echo $agent->idnumber; ?>" />
            	<input name="agent-address" type="text" placeholder="Change address" value="<?php echo $agent->address; ?>" />
            	<input name="agent-phonenumber" type="text" placeholder="Change phonenumber" value="<?php echo $agent->phonenumber; ?>" />
            	<textarea name="agent-educationalbackground" type="text" placeholder="Change educationalbackground">
                	<?php echo $agent->educationalbackground; ?>
                </textarea>

                <input name="usertype" type="hidden" value="agent"/>
                <input name="agentid" type="hidden" value="<?php echo $agentid; ?>" />
                
                <button formnovalidate class="submit btn btn-primary" type="submit" name="submit" value="Submit" tabindex="50"/>Apply Changes</button>
		 		<input type="hidden" name="MM_action" value="update-user">
		 		<input type="hidden" name="MM_notification" value="profile update">
            </form>
      </div>
    </div>

    
<?php 
	// --------------------- TASKS ------------------ queued, ready, started, completed//
	$tasks_ongoing = Task::find_by_attribute_and_listvalue('agentlist', $agentid); ?>
    <a data-toggle="collapse" href="#tasksongoing" aria-expanded="false" aria-controls="tasksongoing">
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
      	<?php  foreach ($tasks_ongoing as $ongoing){ ?> 
		<h5><?php echo $ongoing->title;?>
			<small class="pull-right"> <?php echo $ongoing->status; ?> </small>
		</h5>
        <?php } ?>
      </div>
    </div>
    
	<?php 
	// --------------------- Applications ------------------//
	$task_applications = Application::find_by_attribute_and_value('agentid', $agentid); 
	?>
    <a data-toggle="collapse" href="#taskapplications" aria-expanded="false" aria-controls="taskapplications">
      <h5><span class="glyphicon glyphicon-book"></span> Tasks Applicaions 
      	<?php if (count($task_applications) > 0) 
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
		 	$task = Task::find_by_id($application->taskid);
		 	echo 
			'<h5>'.$task->title.
				'<small class="pull-right">'.$application->status.'</small>'.
			'</h5>';
        } ?>
      </div>
    </div>
  
    <div class="well">
    		<span class="glyphicon glyphicon-remove"> </span>
        	<h5>Notification</h5>
            <?php 
				$notifications = Notification::find_by_attribute_and_value("userid", $agent->userid); 
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