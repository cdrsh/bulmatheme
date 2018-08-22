<div class="column is-12-mobile is-4-tablet is-3-desktop mlr-5">

	<?php get_template_part( 'common/content', 'search' ); ?>

	<div class="pad5">
		<aside class="menu">
			<p class="menu-label">Categories</p>
			<ul class="menu-list">
				<?php
					global $categories;
					$categories = hGetCatsAndPostsRel( array("orderby"=>"ID") );
					if($categories)
						foreach ($categories as $cat) {
							$fa="";
							if($cat->description.substr(0,3)=="fa-")
								$fa="<i class='fa ".$fa."'></i> ";
							echo "<li><a href='"
								.get_site_url()
								."/category/"
								.$cat->slug
								."'>"
								.$fa
								.$cat->name
								."</a></li>";
						}
				?>
			</ul>
		</aside>
	</div>

	<?php get_template_part( 'common/content', 'slider' ); ?>

	<div class="menu-l">
		<?php wp_nav_menu(array("menu"=>"MenuL"));?>
	</div>
	
	<br>

	<div class="box pad5">
		<strong>Tags</strong>
		<article class="media">
			<?php wp_tag_cloud(); ?>
		</article>
	</div>

	<br>

	<?php get_template_part( 'common/content', 'archives' ); ?>

</div>