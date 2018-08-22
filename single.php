<?php get_header(); ?>

<?php get_template_part( 'common/content', 'header' ); ?>

<div class="columns is-narrow pr15">

	<?php get_template_part( 'common/content', 'lpanel' ); ?>

	<div class="column is-12-mobile is-8-tablet is-9-desktop ">
		<div class="menu1">
			<?php wp_nav_menu(array("menu"=>"Menu1")); ?>
		</div>

		<?php
			global $categories;
			global $tagsAndPosts;
			
			//get tags and post ids
			$tagsAndPosts=hGetTagsAndPostsRel();
			if (have_posts()) {
				the_post();
				print("<div class='box' ");
				post_class();
				print(">"); ?>

		<div class="columns">
			<?php
                $attach=get_the_post_thumbnail(get_the_ID());
				$classIs=" is-8 ";
				if ($attach!="") {
			?>
			<div class="column is-4">
				<figure class="image box">
					<?php echo $attach; ?>
				</figure>
			</div>
			<?php
				} else {
					$classIs=" is-12 ";
				} 
			?>
			<div class="column <?php echo $classIs; ?>">
				<div class="is-size-1 has-text-weight-bold">
					<?php the_title(); ?>
				</div>
			</div>
		</div>

		<div class="columns">
			<div class="column">
				<?php the_content('',true); ?>
			</div>
		</div>

		<div class="columns">
			<div class="column">
				<?php wp_link_pages();?>
			</div>
		</div>

		<div class="box">
			<div class="columns">
				<div class="column">
					<?php
						previous_post_link(
							"%link", 
							"<i class='fa fa-arrow-left'></i> Previous post",
							true
						);
					?>
				</div>
				<div class="column">
					<?php 
						next_post_link(
							"%link", 
							"Next post <i class='fa fa-arrow-right'></i>",
							true
						);
					?>
				</div>
			</div>
			<hr>
			<div class="columns">
				<div class="column">
					<?php the_post_navigation();?>
				</div>
			</div>
		</div>

		<?php get_template_part( 'common/content', 'catsandtags' );?>

		<div class="ar">
			<?php the_time(); ?> - <?php echo get_the_date(); ?>
		</div>
		<br>
		<br>
		<br>

		<div class="box">
			<div class="columns">
				<div class="column">
					<div class="is-size-4">Comments</div>
					<?php
						if (comments_open() || get_comments_number()) 
							comments_template();
					?>
				</div>
			</div>
		</div>

	</div>

<?php
}
?>
	</div>

</div>


<?php get_footer();?>
