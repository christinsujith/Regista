<?php $this->load->view('header'); 
?>
<style>
#content table th, #content table td { padding:5px 5px;}
</style>

	<h1>Members List</h1>
    <br>
    <div style="overflow:auto;">
    <center> <span style="font-size:14px; color:#009900;"><?php if(isset($message)) echo $message; ?></span></center>
    <table width="100%" style="padding:5px 5px;">
        <tr>
            <th>No.</th>
            <th>First Name</th>
            <th>Image</th>
            <th>User</th>
            <th>Number</th>
            <th>Born</th>
            <th>Games</th>
            <th>Goals</th>
            <th>Arrived</th>
            <th>First Club</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Action</th>
        </tr>
        <?php if(count($aMembers) > 0){ ?>
        <?php for($i=0;$i<count($aMembers);$i++) { ?>
        <tr>
            <td><?php echo $i+1; ?></td>
            <td><?php echo $aMembers[$i]['firstname'].'&nbsp;'.$aMembers[$i]['lastname']; ?></td>
            <td align="center"><img src="<?php echo base_url().'members/'.str_replace('.', '_thumb.', $aMembers[$i]['imageurl']); ?>"></td>
             <td><?php echo $aMembers[$i]['username']; ?></td>
            <td><?php echo $aMembers[$i]['number']; ?></td>
            <td><?php echo $aMembers[$i]['born']; ?></td>
            <td><?php echo $aMembers[$i]['games']; ?></td>
            <td><?php echo $aMembers[$i]['goals']; ?></td>
            <td><?php echo $aMembers[$i]['arrived']; ?></td>
            <td><?php echo $aMembers[$i]['firstclub']; ?></td>
            <td><?php echo $aMembers[$i]['created']; ?></td>
            <td><?php echo $aMembers[$i]['updated']; ?></td>
            <td>
            <a href="<?php echo site_url(array('api','editmember', $aMembers[$i]['memberid'])); ?>"><img src="<?php echo base_url(); ?>design/btn.edit.png" border="0" alt="Edit" title="Edit" /></a><br>
            
            <a href="javascript: void(null);" onClick="javascript: if(confirm('Are you sure?')) { deleteMember('<?php echo $aMembers[$i]['memberid']; ?>'); }"><img src="<?php echo base_url(); ?>design/btn.delete.png" border="0" alt="Delete" title="Delete"/></a>
            </td>
        </tr>
         <?php }
        }
        else
        {
            ?>
        <td colspan="12" align="center"><span style="font-size:14px; color:#009900;">No Records Found </span></td>
        <?php
        
        }
         ?>
    </table>
    
    </div>
<script>
function deleteMember(iMemberId)
{
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(array('api','deleteMemberAjax')); ?>/"+iMemberId,
			success: function(data){ 
				window.location.href='<?php echo site_url(array('api','viewmembers')); ?>';
				},
			error: function(data){
				window.location.href='<?php echo site_url(array('api','viewmembers')); ?>';
			}
		});
}
</script>


<?php $this->load->view('footer'); ?>
