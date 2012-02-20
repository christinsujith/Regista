<?php $this->load->view('header'); 

 ?>
    <h1><?php if(isset($sPageHeading)) echo $sPageHeading; ?></h1>
    <div style="overflow:auto; padding:30px;border:1px solid #ccc;">
<center> <span style="font-size:14px; color:#009900;"><?php if(isset($message)) echo $message; ?></span></center>
        <form action="<?php echo site_url(array('api','changepassword')); ?>" method="post" enctype="multipart/form-data" onsubmit="javascript:return formValidate();">
         <input type="hidden" name="userid" value="<?php if(isset($aUser))echo $aUser['userid']; ?>" />
            <table class="nostyle">
            
            <tr>
                <td width="18%" nowrap="nowrap">Old PassWord<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="password" name="pass" id="pass"  size="50" class="input-text"/>
                    
                </td>
            </tr>
            <tr>
                <td width="18%" nowrap="nowrap">New PassWord<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="password" name="newpass" id="newpass"  size="50" class="input-text"/>
                    
                </td>
            </tr>
             <tr>
                <td width="18%" nowrap="nowrap">Confirm PassWord<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="password" name="confirm_pass" id="confirm_pass" value="<?php if(isset($aUser))echo $aUser['pass']; ?>"  size="50" class="input-text"/>
                    
                </td>
            </tr>
            
            <tr>
                <td>&nbsp; </td>
                <td>
              
                    <input type="submit" name="btnSubmit" value="Submit" class="input-submit" />
                    &nbsp;<input type="button" name="btnClose" value="Close" onclick="javascript: window.location.href='<?php echo site_url('api'); ?>'; " class="input-submit" />
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
	if($("#pass").val().trim() == "")
	{	
		alert("enter the password");
		$("#pass").val('');
		$("#pass").focus();
		return false;
	}
        if($("#newpass").val().trim() == "")
	{	
		alert("enter the password");
		$("#newpass").val('');
		$("#newpass").focus();
		return false;
	}
	if($("#confirm_pass").val().trim() == "")
	{	
		alert("enter the confirm password");
		$("#confirm_pass").val('');
		$("#confirm_pass").focus();
		return false;
	}
	if($("#confirm_pass").val().trim() != $("#newpass").val().trim())
	{	
		alert("enter the password as same");
		$("#confirm_pass").val('');
		$("#confirm_pass").focus();
		return false;
	}
	
	
	
}		
</script>
        
               
<?php $this->load->view('footer'); ?>