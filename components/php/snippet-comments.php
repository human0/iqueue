<?php function recursive_replies($id = 0){
			$replies = Comment::find_with_limit_type_and_target(-1 , "reply", $id); 
			if (count($replies)>0)
			foreach($replies as $reply){
			$user = User::find_by_id($reply->userid);
			$usertype = User::usertype($reply->userid);		
			if ($usertype[0]=="agent"){ $c_agent = Agent::find_by_id($usertype[1]); $image=date("M", strtotime($c_agent->dateofbirth)); } 
			if ($usertype[0]=="client"){$image = "client";}
			if ($usertype[0]=="admin"){$image = "admin";}
			?>
            <ul class="media-list reply">
               	<li id="<?php echo $comment->commentid ?>" class="media">
                   	<div class="media-left"> 
                   		 <img class="img-circle" src="images/misc/<?php echo $image.'png'; ?>" alt="..." width="46">
                   	</div>
                   	<div class="media-body">
                        <h4 class="media-heading">
							<?php echo '<a href="profile.php?pf='.$user->userid.'">'. $user->username.'</a>'; ?>
                            <small> - <?php echo $reply->dateandtime; ?> 
                        		<span class="glyphicon glyphicon-share-alt"/><?php echo $reply->target_comment_username() ?>
                            </small>
                            <?php if ($reply->ext != "null") {?>
                        		<a href="<?php echo "images/comments/".$reply->commentid.".".$reply->ext; ?>" download> 
                            		<span class="glyphicon glyphicon-link" ></span>
                            	</a>
                        	<?php } ?>
                        </h4>
                        <p><?php  echo $reply->comment; ?></p>
                        <button class="btn reply blue"><span class="glyphicon glyphicon-share-alt"></span>Reply</button>
                        <?php  newcoment_with_targetid_type($reply->targetid, "reply"); ?> 
                    </div>
                    <?php  if (count($replies)>0)recursive_replies($reply->commentid); ?>
                </li>
            </ul>
	<?php } 
}?>

<?php function newcoment_with_targetid_type($targetid=0, $type=""){ ?>
<form class="comment" action="#" name="comment-form" method="post" hidden >
     	<textarea name="comment" class="form-control" placeholder="reply..." required></textarea>
                      
        <input type="text" name="targetid" value="<?php echo htmlentities($targetid); ?>"  hidden />
        <input type="text" name="type" value="<?php echo htmlentities($type); ?>"  hidden />
        <div class="comment-control">
	     	<button type="submit" class="btn btn-primary" name="submit"  >Send</button>
	  		<input class="file" type="file" name="file_upload" />                  
        </div>                    
        <input name="MM_action" value="new-comment"  hidden />   
        <input name="MM_notification" value="reply comment"  hidden />    
</form> 
<?php } ?>

<div class="modal_commentsection text-left">
	<ul class="media-list">      
		<?php 
		$comments = Comment::find_with_limit_type_and_target(-1 , "comment", $_GET['tmodal']); 
		foreach($comments as $comment){
			$user = User::find_by_id($comment->userid);
				
			$usertype = User::usertype($comment->userid);		
			if ($usertype[0]=="agent"){ $c_agent = Agent::find_by_id($usertype[1]); $image=date("M", strtotime($c_agent->dateofbirth)); } 
			if ($usertype[0]=="client"){$image = "client";}
			if ($usertype[0]=="admin"){$image = "admin";}
			?>
			<li id="<?php echo $comment->commentid ?>" class="media">
				<div class="media-left" href="#">
				   <img class="img-circle" src="images/misc/<?php echo $image.'png';?>" alt="<?php echo $user->username; ?>" width="46">
				</div>
				<div class="media-body">
					<h4 class="media-heading">
						<?php echo '<a href="profile.php?pf='.$user->userid.'">'. $user->username.'</a>'; ?>
                    	<small> - <?php echo $comment->dateandtime; ?></small>
                        <?php if ($comment->ext != "null") {?>
                        	<a href="<?php echo "images/comments/".$comment->commentid.".".$comment->ext; ?>" download> 
                            	<span class="glyphicon glyphicon-link" ></span>
                            </a>
                        <?php } ?>
                    </h4>
					<p><?php  echo $comment->comment; ?></p>
					<button class="btn reply blue"><span class="glyphicon glyphicon-share-alt"></span>Reply</button>
					<?php echo newcoment_with_targetid_type($comment->commentid, "reply"); ?>
				</div>
				<?php  recursive_replies($comment->commentid); ?>
			 </li>
		 <?php 
		 } ?>
	</ul>
</div>