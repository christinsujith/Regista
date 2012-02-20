<?php $this->load->view('header'); 
?>
<style>
#content table th, #content table td { padding:5px 5px;}
</style>
 <script type="text/javascript" src="<?php echo base_url();?>js/datepicker/datepicker.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>js/datepicker/datepicker.css">
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#pPost_from').DatePicker({
                format:'Y-m-d',
                date: $('#pPost_from').val(),
                current: $('#pPost_from').val(),
                starts: 1,
                position: 'r',
                onChange: function(formated, dates){
                    jQuery('#pPost_from').val(formated);
                    jQuery('#pPost_from').DatePickerHide();
                }
            });
            
            $('#pPost_to').DatePicker({
                format:'Y-m-d',
                date: $('#pPost_to').val(),
                current: $('#pPost_to').val(),
                starts: 1,
                position: 'r',
                onChange: function(formated, dates){
                    $('#pPost_to').val(formated);
                    $('#pPost_to').DatePickerHide();
                }
            });
        });
    </script>
	<h1><?php if(isset($sPageHeading)) echo $sPageHeading; ?></h1>
    <br>
    <div style="overflow:auto;">
        <fieldset>
            <legend>Search Pages</legend>
        <form name="frmSearchNews" action="<?php echo site_url(array('api','viewpages'));?>" method="post" id="frmSearchNews" >
            <table style="width:100%;">
                <tr>
                   <?if($this->session->userdata('typeid') == 3) { ?>
                     <th>User</th>
                    <td><input type="text" name="pUser" id="pUser" value="<?php if($this->session->userdata('pUser')) echo $this->session->userdata('pUser');?>"></td>
                    <?php } ?>
                    <th>Headline</th>
                    <td><input type="text" name="pHeadline" id="pHeadline" value="<?php if($this->session->userdata('pHeadline')) echo $this->session->userdata('pHeadline');?>"></td>
                    <th>From</th>
                    <td><input type="text" name="pPost_from" id="pPost_from" value="<?php if($this->session->userdata('pPost_from')) echo $this->session->userdata('pPost_from'); ?>"></td>
                    <th>To</th>
                    <td><input type="text" name="pPost_to" id="pPost_to" value="<?php if($this->session->userdata('pPost_to')) echo $this->session->userdata('pPost_to'); ?>"></td>
                    <td><input type="submit" name="btnSubmitSec" id="btnSubmitSec" value="Filter" ></td>
                    <td><input type="submit" name="btnResetSec" id="btnResetSec" value="Reset"></td>
                </tr>
            </table>  
        </form>
            </fieldset>
    <center> <span style="font-size:14px; color:#009900;"><?php if(isset($message)) echo $message; ?></span></center>
   
    <table width="100%" style="padding:5px 5px;">
        <tr>
            <th>No.</th>
            <th>Headline</th>
            <th>User</th>
            <th>url</th>
            <th>Image</th>
            <th>Post From</th>
            <th>Post To</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Action</th>
        </tr>
        <?php if(count($aPages) > 0){ ?>
        <?php for($i=0;$i<count($aPages);$i++) { ?>
        <tr>
            <td><?php echo $i+1; ?>  </td>
             <td><?php echo $aPages[$i]['headline']; ?></td>
            <!--<td><a href="<?php echo site_url(array('api','viewpageitem',$aPages[$i]['pageid']));?>"><?php echo $aPages[$i]['headline']; ?></a></td> -->
            <td><?php echo $aPages[$i]['username']; ?></td>
            <td><a href="<?php echo $aPages[$i]['url']; ?>" target="_blank"><?php echo $aPages[$i]['url']; ?></a></td>
            <td><img src="<?php echo base_url().'page/'.str_replace('.', '_thumb.', $aPages[$i]['imageurl']); ?>"></td>
            <td><?php if($aPages[$i]['post_from'] != '0000-00-00 00:00:00') echo $aPages[$i]['post_from']; ?></td>
            <td><?php if($aPages[$i]['post_to'] != '0000-00-00 00:00:00') echo $aPages[$i]['post_to']; ?></td>
            <td><?php echo $aPages[$i]['created']; ?></td>
            <td><?php echo $aPages[$i]['updated']; ?></td>
            <td>
            <a href="<?php echo site_url(array('api','editpage', $aPages[$i]['pageid'])); ?>"><img src="<?php echo base_url(); ?>design/btn.edit.png" border="0" alt="Edit" title="Edit" /></a>
            
           <a href="javascript: void(null);" onClick="javascript: if(confirm('Are you sure?')) { deletePage('<?php echo $aPages[$i]['pageid']; ?>'); }"><img src="<?php echo base_url(); ?>design/btn.delete.png" border="0" alt="Delete" title="Delete"/></a>
            </td>
        </tr>
         <?php }    }
        else
        {
            ?>
        <td colspan="12" align="center"><span style="font-size:14px; color:#009900;">No Records Found </span></td>
        <?php
        
        }
         ?>
    </table>
    <center><?php echo $linkPagination; ?></center>
    </div>
<script>
function deletePage(iPageId)
{
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(array('api','deletePageAjax')); ?>/"+iPageId,
			success: function(data){ 
				window.location.href='<?php echo site_url(array('api','viewpages',$iPage)); ?>';
				},
			error: function(data){
				window.location.href='<?php echo site_url(array('api','viewpages',$iPage)); ?>';
			}
		});
}
</script>


<?php $this->load->view('footer'); ?>
