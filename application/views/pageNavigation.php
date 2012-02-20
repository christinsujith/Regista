			
            <!-- ############ SYSTEM NAVIGATION #################-->
            
            <ul class="box">
                <li<?php if($sActiveNavigation == 'pages') { ?> id="submenu-active"<?php } ?>><a href="<?php echo site_url(array('api','viewpages')); ?>">View Pages</a>
	                <ul>
						<li<?php if($sActiveNavigation == 'add_page') { ?> id="submini-active"<?php } ?>><a href="<?php echo site_url(array('api','addpage')); ?>">Add page</a></li>
                    </ul>
                </li>
			</ul>