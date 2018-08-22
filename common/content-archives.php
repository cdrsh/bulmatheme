<div class="box pad5">
	<strong>Archives</strong>
	<article class="media w100prc">
		<aside class="menu">
			<ul class="menu-list">
				<?php 
					$args = array(
						'type'            => 'monthly',
						'before'          => '',
						'after'           => '',
						'show_post_count' => false,
						'echo'            => 1,
						'order'           => 'DESC',
						'post_type'     => 'post'
					);
					$arch=wp_get_archives( $args ); 
				?>
			</ul>
		</aside>
	</article>
</div>