<?php $this->load->view('header'); 
$date = Date('Y-m-d');
 ?>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/datepicker/datepicker.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>js/datepicker/datepicker.css">
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#post_from').DatePicker({
                format:'Y-m-d',
                date: $('#post_from').val(),
                current: $('#post_from').val(),
                starts: 1,
                position: 'r',
                onChange: function(formated, dates){
                    jQuery('#post_from').val(formated);
                    jQuery('#post_from').DatePickerHide();
                }
            });
            
            $('#post_to').DatePicker({
                format:'Y-m-d',
                date: $('#post_to').val(),
                current: $('#post_to').val(),
                starts: 1,
                position: 'r',
                onChange: function(formated, dates){
                    $('#post_to').val(formated);
                    $('#post_to').DatePickerHide();
                }
            });
        });
    </script>
    <h1><?php if(isset($sPageHeading)) echo $sPageHeading; ?></h1>
    <div style="overflow:auto; padding:30px;border:1px solid #ccc;">

        <form action="<?php echo site_url(array('api',$sPostPage)); ?>" method="post" enctype="multipart/form-data" onsubmit="javascript:return formValidate();">
            <input type="hidden" name="typeid" value="<?php if(isset($iTypeId)) echo $iTypeId; ?>">
             <input type="hidden" name="pageid" value="<?php if(isset($aPage))echo $aPage['pageid']; ?>" />
            <table class="nostyle">
             <tr>
                <td width="18%" nowrap="nowrap">Headline<span style="color:#FF0000;"> *</span> : </td>
                <td ><input type="text" name="headline" id="headline" value="<?php if(isset($aPage))echo $aPage['headline']; ?>"  size="50" class="input-text"/>
                    
                </td>
            </tr>
             
              <tr>
                <td style="vertical-align:top;">Text : </td>
                 <td><textarea name="text" id="text" cols="70" rows="5" style="border:0px; padding:0px;">
				<?php if(isset($aPage)) echo $aPage['text']; ?></textarea>
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
             <?php if(isset($aPage) && isset($aPage['imageurl'])) {?>
          <tr>
                <td>Image </td>
                <td><img src="<?php echo base_url().'page/'.str_replace('.', '_thumb.', $aPage['imageurl']); ?>"></td>
                    
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td>Image </td>
                <td ><input type="file" name="imageurl" id="imageurl"  size="50" class="input-text"/>
                    
                </td>
            </tr>
             <tr>
                <td  >Post From : </td>
                <td >
                    <input type="text" name="post_from" id="post_from" 
                      value="<?php if(isset($aPage) && $aPage['post_from'] != '0000-00-00 00:00:00')echo $aPage['post_from']; else if(!isset($aPage)) echo $date;

 ?>"  size="15" class="input-text"/>
                    
                </td>
            </tr>
             <tr>
                <td>Post To : </td>
                <td ><input type="text" name="post_to" id="post_to" value="<?php if(isset($aPage)&& $aPage['post_to'] != '0000-00-00 00:00:00'){ echo $aPage['post_to']; } else if(!isset($aPage)) { echo Date('Y-m-d',strtotime(Date('Y-m-d').'+2 day')); } ?>"  size="15" class="input-text"/>
                    
                </td>
            </tr>
            <tr>
                <td>&nbsp; </td>
                <td>
                <?php if(isset($aPage)) {?>
                <input type="submit" name="btnUpdate" value="Update" class="input-submit" />
                <?php } else { ?>
                    <input type="submit" name="btnSubmit" value="Submit" class="input-submit" /><?php }?>&nbsp;<input type="button" name="btnClose" value="Close" onclick="javascript: window.location.href='<?php echo site_url('api',$sPostPage); ?>'; " class="input-submit" />
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
	if($("#headline").val().trim() == "")
	{	
		alert("enter headline");
		$("#headline").val('');
		$("#headline").focus();
		return false;
	}
	
	
	
}		
</script>
        
               
<?php $this->load->view('footer'); ?>