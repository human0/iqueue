<div class="user-activity" id="user-activity">
	<?php 
	// --------------------- Manage GADGET ------------------//
	?>
    <a data-toggle="collapse" href="#taskapplications" aria-expanded="false" aria-controls="taskapplications">
      <h5><span class="glyphicon glyphicon-book"></span> Manage Gadgets</h5>
      <span class="pointer glyphicon glyphicon-chevron-down"></span>
    </a>
    <div class="collapse" id="taskapplications">
      <div class="well">
		 <form role="form"  name="create-gadgetandupdateclient" id="create-gadgetandupdateclient" class="selectform" action="#" enctype="multipart/form-data" method="POST">				
			<input name="usertype" type="hidden" value="client"/>

			<h4> Client Details </h4>
			<select name="clientid" type="text" />
                <option value="" disabled selected>select client</option>
                <?php foreach ( Client::find_with_limit_and_sort(-1, 'username') as $client){?>
					<option value="<?php echo $client->clientid ?>" >	<?php echo $client->username; ?> </option>
				<?php }?>
			</select>       
            
			<input required="required" name="client-points-plus" type="number" />
                        
			<h4> Gadget Details </h4>                       
			<input required name="gadget-cost" type="number" placeholder="cost" />
			<input required name="gadget-name" type="text" placeholder="name" />
			<textarea required name="gadget-description" type="text" placeholder="description" ></textarea>

			<h4> Upload Image </h4> 
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
		  	<input required type="file" name="file_upload" />
                      
			<button formnovalidate class="submit btn btn-primary" type="submit" name="submit" value="Submit"  disabled />Accept</button>
			<input type="hidden" name="MM_action" value="create-gadgetandupdateclient"/>
            <input type="hidden" name="MM_notification" value="created gadget"/>
          </form>
     	  <h4> Delete Gadget </h4>
      	  <h5> 
        	<div class="floating-forms">
            	<form role="form"  class="selectform" name="delete-gadget" action="#" enctype="multipart/form-data" method="POST">                     
                    <select name="gadgetid"/>
                    <option value="" disabled selected>select gadget</option>
					<?php 
                    $gadgets = Gadget::find_sorted_with_limit('name', -1);
                    foreach ($gadgets as $gadget){?>
                    <option value="<?php echo $gadget->gadgetid; ?>" >	<?php echo $gadget->name; ?> </option>
                    <?php }?>
                    </select>
 					<input type="hidden" name="MM_action" value="delete-gadget"/>
                    <input type="hidden" name="MM_notification" value="deleted gadget"/>
                    <button disabled formnovalidate class="submit btn btn-warning" type="submit" name="submit" value="Submit" />delete</button>
                </form>
            </div>
		  </h5>
          <br /> 
       </div>
    </div>	 

	<?php 
	// --------------------- MANAGE USERS ------------------//
	?>
    <a data-toggle="collapse" href="#manageuser" aria-expanded="false" aria-controls="manageuser">
      <h5><span class="glyphicon glyphicon-book"></span> Manage Users:
      	<?php
		$clients = Client::find_with_limit(-1);
		 if (count($clients) > 0) 
		{
      		echo '&nbsp; &nbsp; <span class="badge orange">'.count($clients).'</span>Clients';
		} 
		$agents = Agent::find_with_limit(-1);
		 if (count($agents) > 0) 
		{
      		echo '&nbsp;<span class="badge orange">'.count($agents).'</span>Agents';
		} ?>
	  </h5>
      <span class="pointer glyphicon glyphicon-chevron-down"></span>
    </a>
    <div class="collapse" id="manageuser">
      <div class="well">
		 <form role="form"  name="ManageUser" class="selectform" action="#" enctype="multipart/form-data" method="POST">				
			<select name="userid" type="text" />
                <option value="" disabled selected>select user</option>
                <?php foreach ( User::find_with_limit_and_sort(-1, 'username') as $user){?>
					<option value="<?php echo $user->userid; ?>" >	<?php echo $user->username.' ('.$user->status.')'; ?> </option>
				<?php }?>
			</select>       
            <div class="radios"> 
                Activate<input name="action" value="activate" class="activate" type="radio" />&nbsp;             
                Deactivate<input name="action" value="deactivate" class="deactivate" type="radio" />&nbsp;        
                Details<input name="action" value="details" class="details" type="radio" checked="checked"/>&nbsp;
                Delete<input name="action" value="delete" class="delete" type="radio" />
             </div>                                    
			<button formnovalidate class="submit btn btn-primary" type="submit" name="submit" value="Submit"  disabled />Accept</button>
			<input type="hidden" name="MM_action" value="ManageUser"/>
          </form>
       </div>
    </div>
                
    <div class="well">
    		<span class="glyphicon glyphicon-remove"> </span>
        	<h5>Notification</h5>
            <?php 
				$notifications = Notification::find_by_attribute_and_value("userid", $admin->userid); 
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