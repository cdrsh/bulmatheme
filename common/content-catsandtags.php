<?php 
	global $categories;
	$cats=hGetCatsByPostId($categories, get_the_ID());
	if (count($cats)>0) {
		print('<div class="is-size-6"><br>Categories</div>');
		foreach ($cats as $cat) {
			echo "<a href='"
				.get_site_url()
				."/category/"
				.$cat->slug
				."'><span class='tag is-link'>"
				.$cat->name
				."</span></a> ";
		}
	} 

	global $tagsAndPosts;
	$tagsOfPost=hGetTagsByPostId($tagsAndPosts, get_the_ID());
	if (count($tagsOfPost)>0) {
		print('<div class="is-size-6"><br>Tags</div>');
		foreach ($tagsOfPost as $tag) {
			echo "<a href='"
				.get_site_url()
				."/tag/"
				.$tag->slug
				."'><span class='tag is-info'>"
				.$tag->name
				."</span></a> ";
		}
	} 
?>