<?php $this->load->view('header');

?>
<script type="text/javascript" src="<?php echo base_url();?>js/datepicker/datepicker.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>js/datepicker/datepicker.css">
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#nPost_from').DatePicker({
                format:'Y-m-d',
                date: $('#nPost_from').val(),
                current: $('#nPost_from').val(),
                starts: 1,
                position: 'r',
                onChange: function(formated, dates){
                    jQuery('#nPost_from').val(formated);
                    jQuery('#nPost_from').DatePickerHide();
                }
            });
            
            $('#nPost_to').DatePicker({
                format:'Y-m-d',
                date: $('#nPost_to').val(),
                current: $('#nPost_to').val(),
                starts: 1,
                position: 'r',
                onChange: function(formated, dates){
                    $('#nPost_to').val(formated);
                    $('#nPost_to').DatePickerHide();
                }
            });
        });
    </script>
<style>
#content table th, #content table td { padding:5px 5px;}
</style>

	<h1><?php if(isset($sPageHeading)) echo $sPageHeading; ?></h1>
    <br>
    <div style="overflow:auto;">
        <fieldset>
            <legend>Search News</legend>
        <form name="frmSearchNews" action="<?php echo site_url(array('api','viewnews'));?>" method="post" id="frmSearchNews" >
            <table style="width:100%;">
                <tr>
                    <?if($this->session->userdata('typeid') == 3) { ?>
                     <th>User</th>
                    <td><input type="text" name="nUser" id="nUser" value="<?php if($this->session->userdata('nUser')) echo $this->session->userdata('nUser');?>"></td>
                    <?php } ?>
                    <th>Headline</th>
                    <td><input type="text" name="nHeadline" id="headline" value="<?php if($this->session->userdata('nHeadline')) echo $this->session->userdata('nHeadline');?>"></td>
                    <th>From</th>
                    <td><input type="text" name="nPost_from" id="nPost_from" value="<?php if($this->session->userdata('nPost_from')) echo $this->session->userdata('nPost_from'); ?>"></td>
                    <th>To</th>
                    <td><input type="text" name="nPost_to" id="nPost_to" value="<?php if($this->session->userdata('nPost_to')) echo $this->session->userdata('nPost_to'); ?>"></td>
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
        <?php if(count($aNews) > 0){ ?>
        <?php for($i=0;$i<count($aNews);$i++) { ?>
        <tr>
            <td><?php echo $i+1; ?></td>
            <td><?php echo $aNews[$i]['headline']; ?></td>
            <!-- <td><a href="<?php echo site_url(array('api','viewnewsitem',$aNews[$i]['pageid']));?>"><?php echo $aNews[$i]['headline']; ?></a></td> -->
            <td><?php echo $aNews[$i]['username']; ?></td>
            <td><a href="<?php echo $aNews[$i]['url']; ?>" target="_blank"><?php echo $aNews[$i]['url']; ?></a></td>
            <td><img src="<?php echo base_url().'page/'.str_replace('.', '_thumb.', $aNews[$i]['imageurl']); ?>"></td>
            <td><?php if($aNews[$i]['post_from'] != '0000-00-00 00:00:00') echo $aNews[$i]['post_from']; ?></td>
            <td><?php if($aNews[$i]['post_to'] != '0000-00-00 00:00:00') echo $aNews[$i]['post_to']; ?></td>
            <td><?php echo $aNews[$i]['created']; ?></td>
            <td><?php echo $aNews[$i]['updated']; ?></td>
            <td>
            <a href="<?php echo site_url(array('api','editnews', $aNews[$i]['pageid'])); ?>"><img src="<?php echo base_url(); ?>design/btn.edit.png" border="0" alt="Edit" title="Edit" /></a><br>
            
            <a href="javascript: void(null);" onClick="javascript: if(confirm('Are you sure?')) { deletePage('<?php echo $aNews[$i]['pageid']; ?>'); }"><img src="<?php echo base_url(); ?>design/btn.delete.png" border="0" alt="Delete" title="Delete"/></a>
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
				window.location.href='<?php echo site_url(array('api','viewnews')); ?>';
				},
			error: function(data){
				window.location.href='<?php echo site_url(array('api','viewnews')); ?>';
			}
		});
}
</script>


<?php $this->load->view('footer'); ?>
