<?php $this->load->view('header'); 
$aEnable = array('No','Yes')
?>
<style>
#content table th, #content table td { padding:5px 5px;}
</style>

	<h1><?php if(isset($sPageHeading)) echo $sPageHeading; ?></h1>
    <br>
    <div style="overflow:auto;">
    <center> <span style="font-size:14px; color:#009900;"><?php if(isset($message)) echo $message; ?></span></center>
    <table width="100%" style="padding:5px 5px;">
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>User Name</th>
            <th>User Type</th>
            <th>Last login</th>
            <th>Enabled</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Action</th>
        </tr>
        <?php if(count($aUsers) > 0){ ?>
        <?php for($i=0;$i<count($aUsers);$i++) { ?>
        <tr>
            <td><?php echo $i+1; ?></td>
            <td><?php echo $aUsers[$i]['name']; ?></td>
            <td><?php echo $aUsers[$i]['username']; ?></td>
            <td><?php echo $aUsers[$i]['type_name']; ?></td>
            <td><?php echo $aUsers[$i]['lastlogin']; ?></td>
            <td><?php echo $aEnable[$aUsers[$i]['enabled']]; ?></td>
            <td><?php echo $aUsers[$i]['created']; ?></td>
            <td><?php echo $aUsers[$i]['updated']; ?></td>
            <td>
                <?php if($aUsers[$i]['typeid']!= 3) { ?>
            <a href="<?php echo site_url(array('api','edituser', $aUsers[$i]['userid'])); ?>"><img src="<?php echo base_url(); ?>design/btn.edit.png" border="0" alt="Edit" title="Edit" /></a><br>
            
           <a href="javascript: void(null);" onClick="javascript: if(confirm('Are you sure?')) { deleteUser('<?php echo $aUsers[$i]['userid']; ?>'); }"><img src="<?php echo base_url(); ?>design/btn.delete.png" border="0" alt="Delete" title="Delete"/></a>
            <?php } ?>
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
function deleteUser(iUserId)
{
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(array('api','deleteUserAjax')); ?>/"+iUserId,
			success: function(data){ 
				window.location.href='<?php echo site_url(array('api','users')); ?>';
				},
			error: function(data){
				window.location.href='<?php echo site_url(array('api','users')); ?>';
			}
		});
}
</script>


<?php $this->load->view('footer'); ?>
