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
            <div class="hero-unit media-grid">
                <a href="#">
                    <img src="<?php echo base_url().'page/'.$aPage['imageurl']; ?>" width="600" height="400" /></a>
            </div>
            
            <div class="hero-unit">
                <div class="page-header"><h1><?php echo $aPage['headline']; ?></h1></div>
                <p align="justify"><?php echo $aPage['text']; ?></p></div>
        </div>
    </body>
</html>

