<div id="task-modal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php 
		$t_task =  Task::find_by_id($_GET['tmodal']); 
		$t_client = Client::find_by_id($t_task->clientid);
		?>
        <h2 class="modal-title" id="myModalLabel"><?php echo $t_task->title; ?></h2>
      </div>
	  <div class="modal-body clearfix">
              <div class="row">
              	<div class="col col-md-8">
                    <div class="modal-description">
            			<p><?php echo $t_task->description; ?></p>
                    </div>                    
                </div><!--modal-thing-->
                <div class="col col-md-4 modal-side">
                	<h4><small>weight: </small><?php echo $t_task->weight.' points'; ?></h4>                    
                    <h4><small>Completion Time: </small><?php echo $t_task->completiontime.' days'; ?></h4>
                    <h4><small>Status: </small><?php echo $t_task->status; ?></h4>  
                    <h4><small>Client: </small><?php echo $t_client->username; ?></h4>                 
					<h4><small>TASK BY: </small>
						<?php 
							$first = true;					
							if ($t_task->agentlist != " ")
							{
								$ext_agentids = explode(',',$t_task->agentlist);
								foreach($ext_agentids as $ext_agentid)
								{
									if (!$first) echo ', '; else $first = false;
									$ext_agent = Agent::find_by_id($ext_agentid); 
                        			echo '<a href="profile.php?pf='.$ext_agent->userid.'">'. $ext_agent->username.'</a>';
								}
							}
						?>
					</h4>
                    <?php //-------------------------------USER OPTIONS----------------------------
					if ($session->is_logged_in())
					{
						$user = isset($s_user)? $s_user : User::find_by_id($session->user_id);		
						if ($user->usertype == "agent" && ($task->status == "queued" || $task->status == "ready"))
						{ 
							$search = array('agentid'=>$user->typeid, 'taskid' => $task->taskid);
							$task_applications = Application::find_by_inclusive_array($search);
							if ( count($task_applications)==0)
							{?>
                                <form role="form"  name="create-application" action="#" enctype="multipart/form-data" method="POST">	
                                    <input name="application-taskid" type="hidden" value="<?php echo $task->taskid; ?>" />
                                    <input name="application-clientid" type="hidden" value="<?php echo $task->clientid; ?>" />
                                    <input name="application-agentid" type="hidden" value="<?php echo $user->typeid; ?>" />
                                    <button formnovalidate class="submit btn btn-primary" type="submit" name="submit" value="Submit" />Apply</button>
                                    <input type="hidden" name="MM_action" value="create-application"/>
                                </form>
               		<?php   }
							else
							{
								foreach ($task_applications as $task_application)
								{
									echo "your application : ".$task_application->status;
								}	
							}
						}	
					}?>
                 </div><!-- modal side-->
              </div><!--row-->
          </div><!--modal body -->
          <div class="modal-footer">
        <?php 
		if ($session->is_logged_in() )
		{
			$usertype = User::usertype($session->user_id);
			if ( $usertype[0] = 'admin' ||
				($usertype[0] = 'client' && $t_task->clientid == $usertype[1]) ||
				($usertype[0] = 'agent' && strpos($t_task->agentlist, $usertype[1])))
			{	?>
              <div class="semi_comment_section">
                <form class="comment" name="new-comment"  action="#" enctype="multipart/form-data" method="POST">
                    <textarea name="comment" class="form-control" placeholder="comment" required></textarea>
                       
                    <input type="text" name="targetid" value="<?php  echo $t_task->taskid; ?>"  hidden />
                    <input type="hidden" name="type" value="comment"  />
                    
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" /> 
                    <div class="comment-control">
                        <button type="submit" class="btn btn-primary" name="submit"  >Comment</button>
                        <input class="file" type="file" name="file_upload" />                  
                    </div>
                    <input name="MM_action" value="new-comment"  hidden />
                    <input name="MM_notification" value="new comment"  hidden /> 
                </form> 
              </div>
              <?php  include "components/php/snippet-comments.php";  
			}
		  } ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

