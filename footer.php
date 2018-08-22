<div class="footer">
	<div class="columns">
		<div class="column is-3"></div>
		<div class="column is-3">
			<div class="is-size-4">Home</div>
			<?php wp_nav_menu(array("menu"=>"MenuF"));?>
		</div>
		<div class="column is-3 footer-brdl">
			<div class="is-size-4">Authorization</div>
			<?php if(!is_user_logged_in()) { ?>
				<a href="<?php 
					echo get_site_url()
					."/wp-login.php?action=register" ?>"
				>
					<i class="fa fa-user-circle"></i> 
					Registration
				</a><br> 
				<a href="<?php echo get_site_url()."/wp-login.php" ?>">
					<i class="fa fa-sign-in"></i> 
					Login
				</a>
			<?php } else { ?>
				<a href="<?php echo wp_logout_url() ?>">
					<i class="fa fa-sign-out"></i> 
					Logout
				</a>
			<?php } ?>
		</div>
		<div class="column is-3 footer-brdl">
			<?php 
				$user = get_user_by( "login","admin" );
				$userAdmin=get_userdata($user->ID);
			?>
			<div class="is-size-4">Contacts</div>
			<a href="mailto:<?php echo $userAdmin->user_email;?>">
				Email: <?php echo $userAdmin->user_email;?>
			</a>
			<br>
			<a href="#">Skype: sk123</a><br>
			<a href="#">Phone: 12345678</a><br>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
