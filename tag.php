<?php get_header(); ?>

<?php get_template_part( 'common/content', 'header' ); ?>

<div class="columns is-narrow pr15">

	<?php get_template_part( 'common/content', 'lpanel' ); ?>

	<div class="column is-12-mobile is-8-tablet is-9-desktop ">
		<div class="menu1">
			<?php wp_nav_menu(array("menu"=>"Menu1")); ?>
		</div>

		<hr>

		<?php
			global $categories;
			global $tagsAndPosts;

			//get tags and post ids
			$tagsAndPosts=hGetTagsAndPostsRel();
			$category = single_term_title("", false);
			$catid = get_cat_ID( $category );

			print("<nav class='breadcrumb' aria-label='breadcrumbs'><ul>");
			print(	"<li><i class='fa fa-home'></i>&nbsp;<a href='"
					.get_site_url()
					."'>Home</a></li>"
			);
			print("<li><a href='#'>".$category."</a></li>");
			print("</ul></nav>");

			if (have_posts()) {
				while (have_posts()) {
					the_post();

					if (	!post_password_required() &&  
							has_tag($category, get_the_ID() )
					) {
						print("<div class='box' ");
						post_class();
						print(">");
        ?>

		<div class="columns">
			<?php
				$attach=get_the_post_thumbnail( get_the_ID() );
				$classIs=" is-8 ";
                if ($attach!="") {
			?>
			<div class="column is-4">
				<a href="<?php the_guid(); ?>">
					<figure class="image box">
						<?php echo $attach; ?>
					</figure>
				</a>
			</div>
			<?php
				}
				else 
					$classIs=" is-12 ";
			?>
			<div class="column <?php echo $classIs;?>">
				<a 	href="<?php the_guid(); ?>" 
					class="is-size-1 has-text-weight-bold"
				>
					<?php the_title(); ?>
				</a>
			</div>
		</div>

		<?php echo has_excerpt()?the_excerpt():the_content('',true);?>

		<?php get_template_part( 'common/content', 'catsandtags' );?>

		<div class="ar">
			<?php the_time(); ?> - <?php echo get_the_date(); ?>
		</div>
<?php
        print("</div>");
		}
	}
}
else {
	print('No posts...');
}
?>
	</div>
</div>

<?php get_footer();?>
