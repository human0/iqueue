<div class="snippeet-grabs row">
  	<?php foreach ($gadgets as $gadget){ ?>
    <div class="col-sm-4 col-md-3">
    <div class="thumbnail">
      <img src="images/gadgets/<?php echo $gadget->gadgetid.'.'.$gadget->ext; ?>" alt="...">
      <div class="caption">
        <h3 class="text-center" ><?php echo $gadget->name; ?></h3>
        <h4 class="text-center"><?php echo $gadget->cost; ?> pts</h4>

        <?php 

		if ($session->is_logged_in())
		{
			$user = isset($s_user)? $s_user : User::find_by_id($session->user_id);		
			if ($user->usertype == "agent" && $gadget->status == "new")
			{ 
				$agent = Agent::find_by_id($user->typeid);
				if ( $agent->points >= $gadget->cost)
				{ ?>
                <form role="form"  name="update-gadgetandagent" action="#" enctype="multipart/form-data" method="POST">	
                	<input name="gadgetid" type="hidden" value="<?php echo $gadget->gadgetid; ?>"/>
               		<input name="gadget-status" type="hidden" value="ordered" />
                    <input name="gadget-agentid" type="hidden" value="<?php echo $gadget->agentid;?>" />
               		
                    <input name="usertype" type="hidden" value="agent"/>
                	<input name="agentid" type="hidden" value="<?php echo $agent->agentid; ?>" />
                    <input name="agent-points" type="hidden" value="<?php echo $agent->points - $gadget->cost; ?>" />

					<button formnovalidate class="submit btn btn-primary" type="submit" name="submit" value="Submit" />Earn</button>
					<input type="hidden" name="MM_action" value="update-gadgetandagent"/>
           		</form>
        <?php }	
			}
			else if ($user->usertype == "admin" && $gadget->status == "ordered")
			{?>
                <form role="form"  name="update-gadget" action="#" enctype="multipart/form-data" method="POST">	
                	<input name="gadgetid" type="hidden" value="<?php echo $gadget->gadgetid; ?>"/>
               		<input name="gadget-status" type="hidden" value="purchased" />
					<button formnovalidate class="submit btn btn-primary" type="submit" name="submit" value="Submit" />Delivered</button>
					<input type="hidden" name="MM_action" value="update-gadget"/>
           		</form>
	
		<?php }
	}?>
      

      </div>
    </div>
  </div>
  <?php } ?>
</div>
