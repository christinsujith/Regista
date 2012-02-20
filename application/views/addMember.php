<?php $this->load->view('header'); 

 ?>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/ckeditor/ckeditor.js"></script>
    <h1><?php if(isset($sPageHeading)) echo $sPageHeading; ?></h1>
    <div style="overflow:auto; padding:30px;border:1px solid #ccc;">
        <form action="<?php echo site_url(array('api',$sPostPage)); ?>" method="post" enctype="multipart/form-data" onsubmit="javascript:return formValidate();">
         <input type="hidden" name="memberid" value="<?php if(isset($aMember))echo $aMember['memberid']; ?>" />
            <table class="nostyle">
             <tr>
                <td width="18%" nowrap="nowrap">First Name<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="text" name="firstname" id="lastname" value="<?php if(isset($aMember))echo $aMember['firstname']; ?>"  size="50" class="input-text"/>
                </td>
            </tr>
            <tr>
                <td width="18%" nowrap="nowrap">Last Name<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="text" name="lastname" id="lastname" value="<?php if(isset($aMember))echo $aMember['lastname']; ?>"  size="50" class="input-text"/>
                </td>
            </tr>
            <tr>
                <td width="18%" nowrap="nowrap">Number<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="number" name="number" id="number" value="<?php if(isset($aMember))echo $aMember['number']; ?>"  size="50" class="input-text"/>
                </td>
            </tr>
             <tr>
                <td width="18%" nowrap="nowrap">Born<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="text" name="born" id="born" value="<?php if(isset($aMember))echo $aMember['born']; ?>"  size="50" class="input-text"/>
                </td>
            </tr>
              <tr>
                <td width="18%" nowrap="nowrap">Games<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="text" name="games" id="games" value="<?php if(isset($aMember))echo $aMember['games']; ?>"  size="50" class="input-text"/>
                </td>
            </tr>
              <tr>
                <td width="18%" nowrap="nowrap">Goals<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="text" name="goals" id="goals" value="<?php if(isset($aMember))echo $aMember['goals']; ?>"  size="50" class="input-text"/>
                </td>
            </tr>
             <tr>
                <td width="18%" nowrap="nowrap">Arrived<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="text" name="arrived" id="arrived" value="<?php if(isset($aMember))echo $aMember['arrived']; ?>"  size="50" class="input-text"/>
                </td>
            </tr>
             <tr>
                <td width="18%" nowrap="nowrap">Firstclub<span style="color:#FF0000;"> *</span> : </td>
                <td ><textarea name="firstclub" id="firstclub" cols="70" rows="5"><?php if(isset($aMember))echo $aMember['firstclub']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top;">Text : </td>
                <td><textarea name="text" id="text" cols="70" rows="5" style="border:0px; padding:0px;">
				<?php if(isset($aMember)) echo $aMember['text']; ?></textarea>
                <script type="text/javascript">
                //<![CDATA[
                CKEDITOR.replace( 'text', 
                {
                    filebrowserBrowseUrl : '<?php echo base_url(); ?>js/ckfinder/ckfinder.html',
                    filebrowserImageBrowseUrl : '<?php echo base_url(); ?>js/ckfinder/ckfinder.html?Type=Images',
                    filebrowserFlashBrowseUrl : '<?php echo base_url(); ?>js/ckfinder/ckfinder.html?Type=Flash',
                    filebrowserUploadUrl : '<?php echo base_url(); ?>js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl : '<?php echo base_url(); ?>js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl : '<?php echo base_url(); ?>js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                });
                //]]>
                </script>
                </td>
            </tr>
            <?php if(isset($aMember)) {?>
             <tr>
                <td>Image </td>
                <td><img src="<?php echo base_url().'members/'.str_replace('.', '_thumb.', $aMember['imageurl']); ?>"></td>
                    
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td>Image </td>
                <td ><input type="file" name="imageurl" id="imageurl"  size="50" class="input-text"/>
                    
                </td>
            </tr>
            <tr>
                <td>&nbsp; </td>
                <td>
                <?php if(isset($aMember)) {?>
                <input type="submit" name="btnUpdate" value="Update" class="input-submit" />
                <?php } else { ?>
                    <input type="submit" name="btnSubmit" value="Submit" class="input-submit" /><?php }?>&nbsp;<input type="button" name="btnClose" value="Close" onclick="javascript: window.location.href='<?php echo site_url('api/viewmembers'); ?>'; " class="input-submit" />
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
	if($("#firstname").val().trim() == "0")
	{	
		alert("enter first name");
		$("#firstname").val('');
		$("#firstname").focus();
		return false;
	}
	if($("#lastname").val().trim() == "")
	{	
		alert("enter last name");
		$("#lastname").val('');
		$("#lastname").focus();
		return false;
	}
	if($("#number").val().trim() == "")
	{	
		alert("enter number");
		$("#number").val('');
		$("#number").focus();
		return false;
	}
	if($("#born").val().trim() == "")
	{	
		alert("enter the born");
		$("#born").val('');
		$("#born").focus();
		return false;
	}
	if($("#games").val().trim() == "")
	{	
		alert("enter the games");
		$("#games").val('');
		$("#games").focus();
		return false;
	}
	if($("#goals").val().trim() == "")
	{	
		alert("enter the goals");
		$("#goals").val('');
		$("#goals").focus();
		return false;
	}
	if($("#arrived").val().trim() == "")
	{	
		alert("enter the arrived");
		$("#arrived").val('');
		$("#arrived").focus();
		return false;
	}
	
}		
</script>
        
               
<?php $this->load->view('footer'); ?>