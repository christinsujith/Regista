          <ul class="box">
				<li<?php if($sActiveNavigation == 'news') { ?> id="submenu-active"<?php } ?>><a href="<?php echo site_url(array('api','viewnews')); ?>">View News</a>
	                <ul>
						<li<?php if($sActiveNavigation == 'add_news') { ?> id="submini-active"<?php } ?>><a href="<?php echo site_url(array('api','addnews')); ?>">Add News</a></li>
                    </ul>
                </li>
			</ul>