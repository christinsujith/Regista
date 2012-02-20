			
            <!-- ############ SYSTEM NAVIGATION #################-->
            
            <ul class="box">
                <?php if($this->session->userdata('typeid')  == 3) { ?>
                 <li<?php if($sActiveNavigation == 'users') { ?> id="submenu-active"<?php } ?>><a href="<?php echo site_url(array('api','users')); ?>">View Users</a>
	                <ul>
						<li<?php if($sActiveNavigation == 'add_user') { ?> id="submini-active"<?php } ?>><a href="<?php echo site_url('api/adduser'); ?>">Add users</a></li>
                    </ul>
                </li>
                <?php } ?>
			</ul>