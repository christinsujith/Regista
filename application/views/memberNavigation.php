          <ul class="box">
				<li<?php if($sActiveNavigation == 'members') { ?> id="submenu-active"<?php } ?>><a href="<?php echo site_url(array('api','viewmembers')); ?>">View Members</a>
	                <ul>
						<li<?php if($sActiveNavigation == 'add_member') { ?> id="submini-active"<?php } ?>><a href="<?php echo site_url(array('api','addmember')); ?>">Add Members</a></li>
                    </ul>
                </li>
               
			</ul>