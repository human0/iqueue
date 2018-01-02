	<form role="form" id="signup-form" name="create-user-and-signin" action="#" enctype="multipart/form-data" method="POST">
    	<div class="new-user" id="new-user">
            <h3> Create A New Account</h3>
            <div>
                <label class="control-label" for="email">Email: </label>
                <input required name="email" type="email" tabindex="10" placeholder="your email">
            </div>
            <div>
            	<label class="control-label" for="username">Username: </label>
            	<input required name="username" type="text" tabindex="12" placeholder="new username">
            </div>
            <div>
            	<label class="control-label" for="password">Password: </label>
            	<input required name="password" type="password" tabindex="14" placeholder="strong password">
            </div>
            <div>
            	<label class="control-label" for="usertype"> User Type </label>
            	<select name="usertype" id="new-usertype" tabindex="16">
                	<option value="agent">Agent</option>
                 	<option value="client">Client</option>
            	</select>
            </div>
         </div>	   
               
         <div class="new-client" id="new-client"  hidden="true">
            <h3>Client Details</h3>
			<div>
            	<label class="control-label" for="client-firstname">First Name: </label>
            	<input class="required" name="client-firstname" type="firstname" tabindex="18" placeholder="first name">
			</div>
            <div>
            	<label class="control-label" for="client-lastname">Last Name: </label>
            	<input class="required" name="client-lastname" type="lastname" tabindex="20" placeholder="last name">
			</div>
            <div>
                <label class="control-label" for="client-address">address: </label>
            	<textarea class="required" name="client-address" placeholder="your address.." tabindex="22"></textarea>
         	</div>
         </div>
         
         <div id="new-agent" class="new-agent">
         	<h3>Agent Details</h3>
			<div>
            	<label class="control-label" for="agent-firstname">First Name: </label>
            	<input required class="required" name="agent-firstname" type="text" tabindex="30" placeholder="first name">
			</div>
            <div>
            	<label class="control-label" for="agent-lastname">Last Name: </label>
            	<input required class="required" name="agent-lastname" type="text" tabindex="32" placeholder="last name">
			</div>
            <div>
            	<label class="control-label" for="agent-address">address: </label>
            	<textarea required class="required" name="agent-address" placeholder="your address.." tabindex="34"></textarea>            
            </div>
            <div>
            	<label class="control-label" for="agent-dateofbirth" >Date Of Birth: </label>
            	<input required class="required" name="agent-dateofbirth" type="date" max="" tabindex="36">
            </div>
            <div>
            	<label class="control-label" for="agent-idnumber">ID Number: </label>
            	<input required class="required" name="agent-idnumber" type="text" tabindex="40">
            </div>
            <div>
            	<label class="control-label" for="agent-gender">Agent Gender: </label>
            	<select name="agent-gender" id="agent-gender" tabindex="42">
                	<option value="male">male</option>
                	<option value="female">female</option>
            	</select>
            </div>
            <div>
            	<label class="control-label" for="agent-phonenumber">Phonenumber: </label>
            	<input  required class="required" name="agent-phonenumber" type="text" tabindex="44" placeholder="your number">
            </div>
            <div>
            	<label class="control-label" for="agent-educationalbackground">Educational Background: </label>            
            	<textarea required class="required" name="agent-educationalbackground" tabindex="46" placeholder="You educational background"></textarea>
            </div>
         </div> 
         <input  class="submit btn btn-primary" type="submit" name="submit" value="Submit" tabindex="50"/> 
         <input  type="hidden" name="MM_action" value="create-user-and-signin">     
     </form>
