<?php get_header(); ?>

<?php get_template_part( 'common/content', 'header' ); ?>

<div class="columns is-narrow pr15">

	<?php get_template_part( 'common/content', 'lpanel' ); ?>

	<div class="column is-12-mobile is-8-tablet is-9-desktop ">
		<div class="menu1">
			<?php wp_nav_menu(array("menu"=>"Menu1"));?>
		</div>

		<?php
			global $categories;

			//get tags and post ids
			$tagsAndPosts=hGetTagsAndPostsRel();

			if (have_posts()) {
				the_post();
				print("<div class='box' ");
				post_class();
				print(">"); 
		?>

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
				<?php the_content("Read more...", false);	?>
			</div>
		</div>

		<div class="ar">
			<?php the_time(); ?> - <?php echo get_the_date(); ?>
		</div>

	</div>

<?php
}
?>
	</div>
</div>

<?php get_footer();?>
