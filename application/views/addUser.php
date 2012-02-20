<?php $this->load->view('header'); 

 ?>
    <h1><?php if(isset($sPageHeading)) echo $sPageHeading; ?></h1>
    <div style="overflow:auto; padding:30px;border:1px solid #ccc;">

        <form action="<?php echo site_url(array('api','users')); ?>" method="post" enctype="multipart/form-data" onsubmit="javascript:return formValidate();">
         <input type="hidden" name="userid" value="<?php if(isset($aUser))echo $aUser['userid']; ?>" />
            <table class="nostyle">
             <tr>
                <td width="18%" nowrap="nowrap">User Type<span style="color:#FF0000;"> *</span> : </td>
                <td >
                <select name="typeid" id="user_typeid">
                <option value="0">Select User Type</option>
                <?php foreach($aUserTypes as $aUserType){ ?>
                <option value="<?php echo $aUserType['typeid']; ?>" <?php if(isset($aUser) && $aUser['typeid'] == $aUserType['typeid']) echo 'selected'; ?>><?php echo $aUserType['name']; ?></option>
                <?php } ?>
                </select>
                    
                </td>
            </tr>
             <tr>
                <td width="18%" nowrap="nowrap">Name<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="text" name="name" id="name" value="<?php if(isset($aUser))echo $aUser['name']; ?>"  size="50" class="input-text"/>
                    
                </td>
            </tr>
            <tr>
                <td width="18%" nowrap="nowrap">User Name<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="text" name="username" id="username" value="<?php if(isset($aUser))echo $aUser['username']; ?>" <?php if(isset($aUser))echo "readonly"; ?>  size="50" class="input-text"/>
                    
                </td>
            </tr>
            <?php if(!isset($aUser)) {?>
            <tr>
                <td width="18%" nowrap="nowrap">PassWord<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="password" name="pass" id="pass" value="<?php if(isset($aUser))echo $aUser['pass']; ?>"  size="50" class="input-text"/>
                    
                </td>
            </tr>
             <tr>
                <td width="18%" nowrap="nowrap">Confirm PassWord<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="password" name="confirm_pass" id="confirm_pass" value="<?php if(isset($aUser))echo $aUser['pass']; ?>"  size="50" class="input-text"/>
                    
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td>&nbsp; </td>
                <td>
                <?php if(isset($aUser)) {?>
                <input type="submit" name="btnUpdate" value="Update" class="input-submit" />
                <?php } else { ?>
                    <input type="submit" name="btnSubmit" value="Submit" class="input-submit" /><?php }?>&nbsp;<input type="button" name="btnClose" value="Close" onclick="javascript: window.location.href='<?php echo site_url('api/users'); ?>'; " class="input-submit" />
                </td>
            </tr>
            </table>
        </form>
</div>		
		<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$(".fancybox").fancybox(); 
});

function formValidate()
{
	if($("#user_typeid").val().trim() == "0")
	{	
		alert("Select user type");
		$("#user_typeid").val('');
		$("#user_typeid").focus();
		return false;
	}
	if($("#name").val().trim() == "")
	{	
		alert("enter name");
		$("#name").val('');
		$("#name").focus();
		return false;
	}
	if($("#username").val().trim() == "")
	{	
		alert("enter name");
		$("#username").val('');
		$("#username").focus();
		return false;
	}
	if($("#pass").val().trim() == "")
	{	
		alert("enter the password");
		$("#pass").val('');
		$("#pass").focus();
		return false;
	}
	if($("#confirm_pass").val().trim() == "")
	{	
		alert("enter the confirm password");
		$("#confirm_pass").val('');
		$("#confirm_pass").focus();
		return false;
	}
	if($("#confirm_pass").val().trim() != $("#pass").val().trim())
	{	
		alert("enter the password as same");
		$("#confirm_pass").val('');
		$("#confirm_pass").focus();
		return false;
	}
	
	
	
}		
</script>
        
               
<?php $this->load->view('footer'); ?>