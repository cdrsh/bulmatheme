<div class="box pad5">
	<article class="media">
		<div class="my-slider">
			<?php
				if ( $images = get_posts(array(
					'post_type' => 'attachment',
					'numberposts' => -1,
					'orderby' => 'title',
					'order' => 'ASC',
					'post_mime_type' => 'image',
				)))
				{
					foreach ($images as $image) {
						if($image->post_content=="carousel") {
							print("<div><img src=".$image->guid."></div>");
						}
					}
				}
			?>
		</div>
	</article>
</div>