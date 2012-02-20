<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
         <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/page.css" />

    </head>

    <body>
       <div class="container">
           <div class="hero-unit">
            <table width="100%" class="nostyle" style="padding:5px 5px;">
        <tr>
            <td width="20%">First Name</td>
             <td><?php echo $aMember['firstname'].'&nbsp'.$aMember['lastname']; ?></td>
              </tr>
        <tr>
            <td>Image</td>
             <td><img src="<?php echo base_url().'members/'.str_replace('.', '_thumb.', $aMember['imageurl']); ?>"></td>
              </tr>
        <tr>
            <td>Number</td>
            <td><?php echo $aMember['number']; ?></td>
             </tr>
        <tr>
            <td>Born</td>
             <td><?php echo $aMember['born']; ?></td>
              </tr>
        <tr>
            <td>Games</td>
             <td><?php echo $aMember['games']; ?></td>
              </tr>
        <tr>
            <td>Goals</td>
             <td><?php echo $aMember['goals']; ?></td>
              </tr>
        <tr>
            <td>Arrived</td>
            <td><?php echo $aMember['arrived']; ?></td>
             </tr>
        <tr>
            <td>First Club</td>
             <td><?php echo $aMember['firstclub']; ?></td>
              </tr>
               <tr>
            <td>Text</td>
             <td><?php echo $aMember['text']; ?></td>
              </tr>
        <tr>
            <td>Created</td>
             <td><?php echo $aMember['created']; ?></td>
              </tr>
        <tr>
            <td>Updated</td>
            <td><?php echo $aMember['updated']; ?></td>
        </tr>
    </table>
           </div>
        </div>
        
    </body>
</html>

 