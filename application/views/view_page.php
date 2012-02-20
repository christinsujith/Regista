<?php $this->load->view('header'); 
?>

<style>
#content table th, #content table td { padding:5px 5px;}
</style>

	<h1><?php if(isset($sPageHeading)) echo $sPageHeading; ?></h1>
    <br>
    <div style="overflow:auto;">
    <center> <span style="font-size:14px; color:#009900;"><?php if(isset($message)) echo $message; ?></span></center>
    <table width="100%" style="padding:5px 5px;" class="nostyle">
       
        <?php if(isset($aPage)) { ?>
           
        <tr>
            <td align="center"><img src="<?php echo base_url().'page/'.$aPage['imageurl']; ?>"></td>
        </tr> 
         <tr>
             <td align="center"><h2><?php echo $aPage['headline']; ?></h2></td>
        </tr>    
        <tr>
            <td align="center"><?php echo $aPage['url']; ?></td>
       </tr>
         <tr>
            <td align="center"><?php echo $aPage['text']; ?></td>
       </tr>
        <tr>
            <td align="center"><?php echo $aPage['post_from']; ?></td>
        </tr>    
        <tr>
            <td align="center"><?php echo $aPage['post_to']; ?></td>
        </tr>    
        <tr>    
            <td align="center"><?php echo $aPage['created']; ?></td>
        </tr>    
        <tr>    
            <td align="center"><?php echo $aPage['updated']; ?></td>
           
        </tr>
         <?php } ?>
    </table>
    </div>


<?php $this->load->view('footer'); ?>
