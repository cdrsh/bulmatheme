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
		$category = single_term_title("", false);
		$year     = get_query_var('year');
		$month = get_query_var('monthnum');
		if(strlen($month)==1) 
			$month="0".$month;
		print("<nav class='breadcrumb' aria-label='breadcrumbs'><ul>");
		print("<li><a href='".get_site_url()."'>Home</a></li>");
		print(	"<li><a href='"
				.get_site_url()
				."/".$year
				."/".$month
				."'>"
				.$month
				."."
				.$year
				."</a></li>"
		);
		print("</ul></nav>");

		global $categories;
		global $tagsAndPosts;
		//get tags and post ids
		$tagsAndPosts=hGetTagsAndPostsRel();

		//Posts loop
		if (have_posts()) {
			while (have_posts()) {

				the_post();

				//Don't output posts password
				if (!post_password_required()) {
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


// Previous/next page navigation.
the_posts_pagination(array(
    'prev_text'          => 'Previous post',
    'next_text'          => 'Next post',
	'before_page_number' => 
		'<span class="meta-nav screen-reader-text"> '."Page".' </span>',
));
?>
	</div>
</div>

<?php get_footer();?>
