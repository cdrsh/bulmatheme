<div class="hdr" style="<?php echo hGetImg(); ?>">
	<div class="columns is-gapless plr-5">

		<div class="column 
					is-1-widescreen 
					is-1-desktop 
					is-1-tablet 
					is-hidden-mobile">
			<div class="mylogo ">
				<?php echo hGetLogo(); ?>
			</div>
		</div>

		<div class="	column 
						is-8-widescreen 
						is-8-desktop  
						is-6-tablet 
						is-12-mobile"
		>
			<div class="is-size-5-mobile 
						is-size-4-tablet 
						is-size-3-desktop 
						is-size-2-widescreen 
						has-text-weight-bold 
						pad5"
			>
				<?php echo hGetTitle();?>
			</div>
		</div>

		<div class="column 
					is-3-widescreen 
					is-3-desktop 
					is-5-tablet 
					is-12-mobile 
					ar"
		>
			<div class="tile is-parent is-vertical">
				<div class="tile is-child">
					<?php if(!is_user_logged_in()) { ?>
						<a href="<?php 
							echo get_site_url()
							."/wp-login.php?action=register"; 
						?>">
							<i class="fa fa-user-circle"></i> 
							Registration
						</a> 
						| 
						<a href="<?php 
							echo get_site_url()
							."/wp-login.php"; ?>">
							<i class="fa fa-sign-in"></i> 
							Login
						</a>
					<?php } else { ?>
						<span class="rss">
							<a href="<?php echo get_site_url()."/feed";?>">
								<i class="fa fa-rss"></i> 
								RSS
							</a>
						</span>
						<a href="<?php echo wp_logout_url(); ?>">
							<i class="fa fa-sign-out"></i> 
							Logout
						</a>
					<?php } ?>
				</div>
				<div class="tile is-child">
					<?php
						$pages=get_pages();
						foreach($pages as $itm) {
							$socials=get_post_meta($itm->ID,'socials',true);
							if($socials!="") 
								echo $itm->post_content."<br>";
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

