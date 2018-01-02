<table class="table table-striped">
	<?php foreach($tasks as $task){ ?>
    <tr class="row">
    	<td class="col col-sm-8">
        	<div class="row table-head">
        		<a href="<?php echo '?tmodal='.$task->taskid; ?>" >
                   	<h3 class="pull-left"><?php echo $task->title; ?></h3>
                   	<span class="glyphicon glyphicon-info-sign"></span>
                </a>
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
            	
            </div>
            <p><?php echo substr($task->description, 0, 50).'...'; ?></p>
        </td>
        <td class="col col-sm-2">
        	<div class="row"> 
            	<div class="col col-sm-4">
                	<img class="center-block" src="images/misc/task-weight.png" />
                </div>
            	<div class="col col-sm-8">
            		<h5>Weight</h5>
                	<h4><?php echo $task->weight; ?> hr</h4>
                </div>
            </div>
        </td>
         <td class="col col-sm-2">
        	<div class="row">
            	<div class="col col-sm-4 detail">
                	<img class="center-block" src="images/misc/task-completion-time.png" />
                </div>
            	<div class="col col-sm-8">
            		<h5>Time</h5>
                	<h4><?php echo $task->completiontime; ?> Days</h4>
                </div>
            </div>
        </td>
    </tr>
    <?php } ?>
   
</table>
