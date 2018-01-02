<?php
date_default_timezone_set('africa/johannesburg');
$message = "null";
$username = "";
$password = "";

function createApplication()
{
	$app =new Application;
	foreach(Application::$db_defaults as $att => $val)
	{
		if ($att == 'epoch')
		{
			$app->$att=date("U");
		} 
		else if(isset($_POST['application-'.$att]))
		{
			$app->$att = trim($_POST['application-'.$att]);
		}
		else
		{
			$app->$att = $val;
		}
	}
	$app->save();
	return $app->applicationid;
}  //create functions return id
function updateApplication()
{
	$app = Application::find_by_id($_POST['applicationid']);
	foreach(Application::$db_defaults as $att => $val)
	{
		if(isset($_POST['application-'.$att]))
		{
			$app->$att = trim($_POST['application-'.$att]);
		}
	}
	$app->save();
}		
function createTask()
{
	$task =new Task;
	foreach(Task::$db_defaults as $att => $val)
	{
		if ($att == 'epoch')
		{
			$task->$att=date("U");
		} 
		else if(isset($_POST['task-'.$att]))
		{
			$task->$att = trim($_POST['task-'.$att]);
		}
		else
		{
			$task->$att = $val;
		}
	}
	$task->save();
	return $task->taskid;
}
function updateTask()
{
	$task =Task::find_by_id($_POST['taskid']);
	foreach(Task::$db_defaults as $att => $val)
	{
		if (strpos($att, "list") && isset( $_POST['task-'.$att.'-id']))
		{
			if (!strpos($task->$att, $_POST['task-'.$att."-id"]))
			{				
				$task->agentlist .=  $task->agentlist == " "? 
				$_POST['task-'.$att.'-id'] : ','.$_POST['task-'.$att.'-id']; 
			}
		}
		else if(isset($_POST['task-'.$att]))
		{
			$task->$att = trim($_POST['task-'.$att]);
		}
	}
	$task->save();
}
function createGadget()
{
	$gadget =new Gadget;
	foreach(Gadget::$db_defaults as $att => $val)
	{
		if ($att == 'epoch')
		{
			$gadget->$att=date("U");
		} 
		else if(isset($_POST['gadget-'.$att]))
		{
			$gadget->$att = trim($_POST['gadget-'.$att]);
		}
		else
		{
			$gadget->$att = $val;
		}
	}
	$gadget->save();
	return $gadget->gadgetid;
}		
function updateGadget()
{
	$gadget = Gadget::find_by_id($_POST['gadgetid']);
	foreach(Gadget::$db_defaults as $att => $val)
	{
		if(isset($_POST['gadget-'.$att]))
		{
			$gadget->$att = trim($_POST['gadget-'.$att]);
		}
	}
	$gadget->save();
}			

function createUser()
{
		$user = new User;
		$user->username = trim($_POST['username']);
		$user->password = trim($_POST['password']);
		$user->usertype =  trim($_POST['usertype']);
		$user->email = trim($_POST['email']);
		$user->epoch = date("U");
		$user->status = ($user->usertype =="client")? "active" : "pending" ;
		$user->create();
		
		if ($_POST['usertype']=="agent")
		{
			$agent = new Agent;
			$agent->userid = $user->userid;
			$agent->firstname =trim($_POST['agent-firstname']);
			$agent->lastname =trim($_POST['agent-lastname']);
			$agent->dateofbirth =trim($_POST['agent-dateofbirth']);
			$agent->idnumber = trim($_POST['agent-idnumber']);
			$agent->gender = trim($_POST['agent-gender']);
			$agent->address = trim($_POST['agent-address']);
			$agent->phonenumber = trim($_POST['agent-phonenumber']);
			$agent->educationalbackground = trim($_POST['agent-educationalbackground']);
			$agent->points =  0;
			$agent->hoursspent = 0;
			$agent->create();			
			$user->typeid = $agent->agentid;
			$user->update();
		}
		
		else if ($_POST['usertype']=="client")
		{
			$client = new Client;
			$client->userid = $user->userid;
			$client->firstname =trim($_POST['client-firstname']);
			$client->lastname =trim($_POST['client-lastname']);
			$client->address = trim($_POST['client-address']);
			$client->points =  0;
			$client->hoursspent = 0;
			$client->create();
			$user->typeid = $client->clientid;
			$user->update();
		}
		
		else if ($_POST['usertype']=="admin")
		{
			$admin = new Admin;
			$admin->userid = $user->userid;
			$admin->create();
			$user->typeid = $admin->admin;
			$user->update();
		}
		
		return $user->userid;
}

function updateAgent()
{
	$agent =Agent::find_by_id($_POST['agentid']);
	
	if(isset($_POST['agent-firstname']))
		$agent->firstname = trim($_POST['agent-firstname']);
	if(isset($_POST['agent-lastname']))
		$agent->lastname =trim($_POST['agent-lastname']);
	if(isset($_POST['agent-dateofbirth']))
		$agent->dateofbirth =trim($_POST['agent-dateofbirth']);
	if(isset($_POST['agent-idnumber']))
		$agent->idnumber = trim($_POST['agent-idnumber']);
	if(isset($_POST['agent-gender']))
		$agent->gender = trim($_POST['agent-gender']);
	if(isset($_POST['agent-address']))
		$agent->address = trim($_POST['agent-address']);
	if(isset($_POST['agent-phonenumber']))
		$agent->phonenumber = trim($_POST['agent-phonenumber']);
	if(isset($_POST['agent-educationalbackground']))
		$agent->educationalbackground = trim($_POST['agent-educationalbackground']);
	if(isset($_POST['agent-points']))
		$agent->points =  trim($_POST['agent-points']);
	if(isset($_POST['agent-points-plus']))
		$agent->points +=  trim($_POST['agent-points-plus']);
	if(isset($_POST['agent-points-minus']))
		$agent->points -=  trim($_POST['agent-points-minus']);
	if(isset($_POST['agent-hoursspent']))
		$agent->hoursspent = trim($_POST['agent-hoursspent']);
	$agent->update();
}
function updateClient()
{
	$client =Client::find_by_id($_POST['clientid']);
	if(isset($_POST['client-firstname']))
		$client->firstname =trim($_POST['client-firstname']);
	if(isset($_POST['client-lastname']))
		$client->lastname =trim($_POST['client-lastname']);
	if(isset($_POST['client-address']))
		$client->address = trim($_POST['client-address']);
	if(isset($_POST['client-points']))
		$client->points = trim($_POST['client-points']);
	if(isset($_POST['client-points-plus']))
		$client->points += trim($_POST['client-points-plus']);
	if(isset($_POST['client-points-minus']))
		$client->points -= trim($_POST['client-points-minus']);
	if(isset($_POST['client-hoursspent']))
		$client->hoursspent = trim($_POST['client-hoursspent']);
	$client->update();
}
function updateAdmin()
{
}
//------------------------------------------
function deleteUser($userid)
{
	$user = User::find_by_id($userid);
	$user->delete();
	if ($user->usertype == "agent")
	{
		deleteAgent($user->typeid);	
	}
	if ($user->usertype == "client")
	{
		deleteClient($user->typeid);	
	}
	if ($user->usertype == "admin")
	{
		deleteAdmin($user->typeid);	
	}
}
function deleteAdmin($adminid)
{
	$admin =Admin::find_by_id($adminid);
	$admin->delete();
	return $admin->userid;
}
function deleteAgent($agentid)
{
	$agent =Agent::find_by_id($_POST['agentid']);
	$agent->delete();
	return $agent->userid;
}
function deleteClient($clientid)
{
	$client =Admin::find_by_id($clientid);
	$client->delete();
	return $client->userid;
}

//profile update, task creation, task closed, task appliction accepted, task application declined, completed task, started task, created gadget, deleted gadget, new comment, reply comment 
function createNotification($mm_notification, $description, $link, $userid)
{
	$notification = new Notification;
	$notification->note = $mm_notification;
	$notification->description = $description;
	$notification->link = $link;
	$notification->userid = $userid;
	$notification->save();	
}
if(isset($_POST['MM_notification']))
{
	$mm_notification = $_POST['MM_notification'];

	if ($mm_notification == "reply comment")
	{
		$task = Task::find_by_id($_POST['targetid']);
		$description = "you comment of the following task was replied : ".$task->title;
		$link = "?tmodal=".$task->taskid."#".$_POST['targetid'];
		$comment = Comment::find_by_id($_POST['targetid']);
		createNotification($mm_notification, $description, $link, $comment->userid);
	}
	if ($mm_notification == "new comment")
	{
		$task = Task::find_by_id($_POST['targetid']);
		$description = "new comment on a task you are a part of";
		$link = "?tmodal=".$task->taskid."#".$task->taskid;
		if ($task->agentlist != " ")
		{
			$agentids = explode(",", $task->agentlist);
			foreach ($agentids as $agentid)
			{
				$agent = Agent::find_by_id($agentid);
				createNotification($mm_notification, $description, $link, $agent->userid);
			}
		}
		$client = Client::find_by_id($task->clientid);
		createNotification($mm_notification, $description, $link, $client->userid);
	}
	
	if ($mm_notification == "task closed" || $mm_notification == "task started")
	{
		$task = Task::find_by_id($_POST['taskid']);
		$description = $mm_notification." : ".$task->title;
		$link = "?tmodal=".$task->taskid;
		if ($task->agentlist != " ") 
		{
			$agentids = explode(",", $task->agentlist);
			foreach ($agentids as $agentid)
			{
				$agent = Agent::find_by_id($agentid);
				createNotification($mm_notification, $description, $link, $agent->userid);
			}
		}
	}
	
	if ($mm_notification == "task application accepted")
	{
		$task = Task::find_by_id($_POST['taskid']);
		$agent = Agent::find_by_id($_POST['agentid']);
		$description = "Your application to the following task as been accepted : ".$task->title;
		$link = "?tmodal=".$task->taskid;
		createNotification($mm_notification, $description, $link, $agent->userid);		
	}
}


//------------FILE UPLOAD------------
$upload_errors = array(
	// http://www.php.net/manual/en/features.file-upload.errors.php
	UPLOAD_ERR_OK 				=> "No errors.",
	UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
  UPLOAD_ERR_NO_FILE 		=> "No file.",
  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
);

function fileupload($path, $name)
{
	if(!file_exists($_FILES['file_upload']['tmp_name']) || !is_uploaded_file($_FILES['file_upload']['tmp_name'])) 
	{return "null";}
	$tmp_file = $_FILES['file_upload']['tmp_name'];
	
	$n = $_FILES["file_upload"]["name"];
	$ext = end((explode(".", $n)));
	
	$target_file = $name.'.'.$ext;
	$upload_dir = $path;
	 
	if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)) {
	$message = "File uploaded successfully.";
	} else {
	$error = $_FILES['file_upload']['error'];
	$message = $upload_errors[$error];
	$ext = "null";
	}
	
	return $ext;
}//returns extension
//------------EMAIL-----------------------------------------------------
function email_to_user($subject, $body, $user)
{
	$body = wordwrap($body, 70);	
	
	$to_name = $user->username;
	$to = $user->email;
	
	$from_name = "Admin";
	$from = "admin@iqueueoffice.com";

	$mail = new PHPMailer();
	$mail->IsSMTP();

	$mail->Host     = "smtp.1and1.com";
	$mail->Port     = 25;
	$mail->SMTPAuth = true;
	$mail->Username = "admin@iqueueoffice.com";
	$mail->Password = "Iqueue1!";

	$mail->FromName = $from_name;
	$mail->From     = $from;
	$mail->AddAddress($to, $to_name);
	$mail->Subject  = $subject;
	$mail->Body     = $body;
	
	$result = $mail->Send();
	$message = $result ? 'Email Sent' : 'Error Sending Email';
}
/*
function email_from_user($subject, $body, $email, $name)
{
	$body = wordwrap($body,70);
	
	$user = user::find_by_id($session->user_id);
	$from_name = $name;
	$from = $email;
	
	$to_name = "Admin";
	$to = "admin@iqueueoffice.com";

	$mail = new PHPMailer();
	$mail->IsSMTP();

	$mail->Host     = "smtp.1and1.com";
	$mail->Port     = 25;
	$mail->SMTPAuth = true;
	$mail->Username = "admin@iqueueoffice.com";
	$mail->Password = "Iqueue1!";
	
	$mail->FromName = $from_name;
	$mail->From     = $from;
	$mail->AddAddress($to, $to_name);
	$mail->Subject  = $subject;
	$mail->Body     = $body;
	
	$result = $mail->Send();
	$message = $result ? 'Email Sent' : 'Error Sending Email';
}
*/

//-----------PAGE SPECIFIC------------
if ($currentpage == "profile")
{
	if (!$session->is_logged_in())
	{
		redirect_to("signup.php");	
	}
}
if ($session->is_logged_in())
{	
	$user = User::find_by_id($session->user_id);
	if ($user->status == "pending")
	{
		$message="This account is pendding admin validation.";
		if ($currentpage == "profile")
		{
			redirect_to("index.php");
		}
	}
}
//-----------SCREEN ACTIONS -------------
if(isset($_GET["action"])) 
{
	$action = $_GET["action"];
	if ($session->is_logged_in())
	{
		//----------LOGOUT
		if($action=="logout")
		{
			 $session->logout();
			 redirect_to(url_arguments_without("action"));
		}
	}
}

//-----------FORM ACTIONS -------------
if (isset($_POST["MM_action"]))
{	
	$action = $_POST["MM_action"];
	//logged in
	if ($session->is_logged_in())
	{
		//------------------- INSERTS comments---------------------------------
		if (($action== "new-comment")) 
		{
			$comment = new Comment; 
			$comment->dateandtime = date("Y-m-d");
			$comment->userid= $session->user_id;
			$comment->targetid= trim($_POST['targetid']); //commentid, ProjectID
			$comment->type= trim($_POST['type']); // comment, reply
			$comment->comment= trim($_POST['comment']);
			$comment->ext = "null";
			$comment->create();
			
			$ext = fileupload('images/gadgets', $comment->commentid);
			
			if ($ext != "null")
			{
				$comment->ext = $ext;
				$comment->update();
			}
		}
	}
	//logged out
	if (!$session->is_logged_in())
	{
	}
	//any time... logedin or out
	if (true)
	{
		//---------------------  UPDATE USER -------------------------
		if ($action == "update-user")
		{
			if ($_POST['usertype']=="agent")
			{
				updateAgent();
			}
			
			else if ($_POST['usertype']=="client")
			{
				updateClient();
			}
			
			else if ($_POST['usertype']=="admin")
			{
				updateAdmin();
			}			
			$message = "Your profile as been updated";	
		}

		//------------------------create-user----------------------------------
		//--------------------  CREATE AND SIGNIN -------------------------------------
		else if ($action == "create-user-and-signin" || $action == "create-user")
		{
			$found_user = User::authenticate_by_attribute("username", $_POST['username']);
			$found_email = User::authenticate_by_attribute("email", $_POST['email']);
			if (!$found_email)
			{ 
				if (!$found_user) 
				{
					$userid = createUser();
					if (strpos($action, 'signin'))
					{
						$user=User::find_by_id($userid);
						$session->login($user);
						$body = "Thank you for signing up at www.iqueueoffice.com. If you are not resposible for this registration, please contact support@iqueueoffice.com for rectification.";
						email_to_user("Iqueue Signup", $body, $user);
						redirect_to("profile.php");
					}
				}
				else $message = "Sign Up Failed, Username ".$_POST['username']." is already in use.";
			}
			else $message = "Sign Up Failed, Email ".$_POST['email']." is already in use.";
		}//action 
		else if ($action == "login")
		{
			  $username = trim($_POST['username']);
			  $password = trim($_POST['password']);
			  
			  $found_user = User::authenticate($username, $password);
			  if ($found_user) 
			  {
				$session->login($found_user);
				redirect_to("profile.php");	
			  }
			  else 
			  {
				$message = "Username/password combination incorrect.";
			  }
		}//action
		//---------------------  CREATE TASK -------------------------
		else if ($action == "create-task")
		{
			createTask();
		}
		//---------------------  UPDATE TASK -------------------------
		else if ($action == "update-task")
		{
			updateTask();
			$message = "Task updated";
		}
		//---------------------  CREATE APPLICATIONS -------------------------
		else if ($action == "create-application")
		{
			createApplication();
			$message = "Your application as been submited";
		}		
		//---------------------  UPDATE APPLICATIONS -------------------------
		else if ($action == "update-application")
		{
			updateApplication();	
			$message = "Responded to application";
		}
		//---------------------  CREATE GADDETS -------------------------
		else if ($action == "create-gadget")
		{
			createGadget();	
			$message = "Gadget created";
		}
		//---------------------  UPDATE GADGETS -------------------------
		else if ($action == "update-gadget")
		{
			updateGadget();	
			$message = "Gadget updated";
			
		}
		//---------------------------- Mixed ----------------------------------//
		//------------------  UPDATE TASK AND APPLICATION --------------------
		else if ($action == "update-applicationandtask")
		{
			updateApplication();
			updateTask();
			$message = "task accepted";
	
		}
		//--------------------taskandupdateclient----------------------------
		else if($action == "create-taskandupdateclient")
		{
			createTask();
			updateClient();
			$message = "you have created a new task";
		}
		//--------------------update-taskandagent---------------------
		else if($action == "update-taskandagent")
		{
			updateTask();
			
			if ($_POST['agentidlist'] != " ")
			{
				$agentids = explode(",", $_POST['agentidlist']);
				foreach ($agentids as $agentid)
				{
					$agent = Agent::find_by_id($agentid);
					$agent->points += $_POST['task-agents-points-plus'];
					$agent->update();
				}
				$message = "task ended";
			}
		}
		//------------------ create-gadgetandupdateclient -----------------------
		else if ($action == "create-gadgetandupdateclient")
		{
			$gadgetid = createGadget();
			$gadget = Gadget::find_by_id($gadgetid);
			$ext = fileupload('images/gadgets', $gadgetid);
			if ($ext != "null")
			{
				$gadget->ext = $ext;
				$gadget->update();
			}
			
			updateClient();
			
			$client = Client::find_by_id($_POST['clientid']);
			$description = "Your account as been credited";
			$link = "";
			createNotification($mm_notification, $description, $link, $client->userid);		
			
			$message = "you have addded a new gadget";
		}
		//--------------------delete-gadget----------------------
		else if ($action == "delete-gadget")
		{
			$gadget = Gadget::find_by_id($_POST['gadgetid']);
			$gadget->delete();
		}
		//------------------ update-gadgetandagent -----------------------
		else if ($action == "update-gadgetandagent")
		{
			updateGadget();
			updateAgent();
			$message="task purchased. Contact admin about delevery";
		}
		//--------------------ManageUser-----------------------------
		else if ($action == "ManageUser")
		{
			$user = User::find_by_id($_POST['userid']);
			$act = $_POST['action'];
			if ($act == 'delete')
			{
				deleteUser($user->userid);
				$message = $user->usertype." ".$user->username." as been deleted.";
			}
			if ($act == 'activate')
			{
				$user->status = 'active';
				$user->save();
				$message = "user ".$user->username." as been activated.";
			}
			if ($act == 'deactivate')
			{
				$user->status = 'pending';
				$user->save();
				$message = "user ".$user->username." as been deactivated.";
			}
			if ($act == 'details')
			{
				 redirect_to('profile.php?pf='.$user->userid);
			}				
		}
	}//any (logged in or out	
		/*		//------------------- LIKE comment---------------------------------
		if (($action == "comment-like")) 
		{
			$comment = Comment::find_by_id($_POST["commentid"]);
			$comment->update_likes_by_id( $session->user_id);
		}
	}
	else if ($action == "login")
		{
			  $username = trim($_POST['username']);
			  $password = trim($_POST['password']);
			  
			  $found_user = User::authenticate($username, $password);
			  if ($found_user) 
			  {
				$session->login($found_user);
				redirect_to(url_arguments_without("smodal"));	
			  }
			  else 
			  {
				$message = "Username/password combination incorrect.";
			  }
		}
	else if( !strpos(url_arguments(),"smodal"))
	{
		redirect_to(url_arguments()."&smodal=..to ".$action);
	}
	*/
}
//--------- modalS
if (isset($_GET['tmodal']))echo '<div class="task-modal-ready"></div>';	
if (isset($_GET['gmodal']))echo '<div class="gadget-modal-ready"></div>';
if (isset($_GET['smodal']))echo '<div class="signup-modal-ready"></div>';
if (isset($_GET['omodal']))echo '<div class="order-modal-ready"></div>';

if ($message!='null')echo '<div class="message-modal-ready"></div>';

if (false) //not paid
{
	echo '<div class="notification-modal-ready"></div>';
}

 ?>