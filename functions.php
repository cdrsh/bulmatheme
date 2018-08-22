<?php

//My logo
function hGetLogo() {
	if(has_custom_logo()) 
		return get_custom_logo();
	else 
		return 
			"<a href='".get_site_url()."'>"
			."<img src='".get_template_directory_uri()."/assets/img/logo/logo.png'>"
			."</a>";
}


//My title
function hGetTitle() {
	return 
		"<div style='color:#".get_header_textcolor().";'>"
		.wp_get_document_title()
		."</div>";
}


//Header image
function hGetImg() {
	return "background-image: url('".get_custom_header()->url."')";
}


//get categories ids relations with post ids (minimize quries to db)
function hGetCatsAndPostsRel() {
	global $wpdb;
	$catPostIds=$wpdb->get_results( "
		SELECT wp_terms.term_id, wp_posts.ID AS postid FROM wp_term_relationships 
		LEFT JOIN wp_term_taxonomy 
		ON wp_term_taxonomy.term_taxonomy_id=wp_term_relationships.term_taxonomy_id
		LEFT JOIN wp_terms
		ON wp_terms.term_id=wp_term_taxonomy.term_id
		LEFT JOIN wp_posts
		ON wp_posts.ID=wp_term_relationships.object_id
		WHERE wp_term_taxonomy.taxonomy='category'
	" );
	$categories = get_categories( array("orderby"=>"ID") );
	if($categories)
		foreach ($categories as $cat) {
			foreach ($catPostIds as $catPostId) {
				if($cat->term_id==$catPostId->term_id) {
					if(!isset($cat->postIds))
						$cat->postIds=array();
					array_push($cat->postIds,$catPostId->postid);
				}
			}
		}
	return $categories;
}


function hGetAllTags() {
	global $wpdb;
	return $wpdb->get_results( "
		SELECT wp_terms.name, wp_terms.slug, wp_terms.term_id FROM wp_terms 
		LEFT JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id=wp_terms.term_id
		WHERE wp_term_taxonomy.taxonomy='post_tag'");
}

//get tags ids relations with post ids (minimize quries to db)
function hGetTagsAndPostsRel() {
	global $wpdb;
	$tagPostIds=$wpdb->get_results( "
		SELECT wp_terms.term_id, wp_posts.ID AS postid FROM wp_term_relationships 
		LEFT JOIN wp_term_taxonomy 
		ON wp_term_taxonomy.term_taxonomy_id=wp_term_relationships.term_taxonomy_id
		LEFT JOIN wp_terms
		ON wp_terms.term_id=wp_term_taxonomy.term_id
		LEFT JOIN wp_posts
		ON wp_posts.ID=wp_term_relationships.object_id
		WHERE wp_term_taxonomy.taxonomy='post_tag'
	" );
	//$tags = get_the_tags();
	$tags = hGetAllTags();
	if($tags)
		foreach ($tags as $tag) {
			foreach ($tagPostIds as $tagPostId) {
				if($tag->term_id==$tagPostId->term_id) {
					if(!isset($tag->postIds))
						$tag->postIds=array();
					array_push($tag->postIds,$tagPostId->postid);
				}
			}
		}
	return $tags;
}


//get categories by Post id
function hGetCatsByPostId($categories,$postId) {
	$cats=array();
	if($categories)
		foreach ($categories as $cat) {
			if(in_array($postId,$cat->postIds))
				array_push($cats,$cat);
		}
	if(count($cats)==0)
		return array();
	return $cats;
}


//get tags by Post id
function hGetTagsByPostId($tags,$postId) {
	$tagsOut=array();
	if($tags)
		foreach ($tags as $tag) {
			if(in_array($postId,$tag->postIds))
				array_push($tagsOut,$tag);
		}
	if(count($tagsOut)==0)
		return array();
	return $tagsOut;
}


//Add font-awesome icon before menu text
function my_filter_menu_items( $args, $item, $depth ){
	$fa="";
	$fa=get_post_meta( $item->object_id, 'fa', true);
	if($fa!="")
		$args->before="<i class='fa ".$fa." ml15'></i> ";
	else
		$args->before="<i class='fa fa-link ml15'></i> ";
		//$args->before="<span class='ml15'></span>";
	return $args;
}
add_filter( 'nav_menu_item_args', 'my_filter_menu_items', 10, 3 );


//Support theme post-formats
add_theme_support( 'post-formats', array(
	'aside',
	'gallery',
	'link',
	'image',
	'quote',
	'status',
	'video',
	'audio',
	'chat'
) );


//Support theme post images
add_theme_support( 'post-thumbnails');


//Support theme post header
add_theme_support( 'custom-header', array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => '', // вызывается функций get_header_textcolor()
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	'video'                  => true, // с 4.7
	'video-active-callback'  => 'is_front_page', // с 4.7
) );


//Support theme custom logo
add_theme_support( 'custom-logo', array(
	'height'      => 100,
	'width'       => 100,
	'flex-height' => true,
)  );


//Support theme feeds
add_theme_support( 'automatic-feed-links' );


//Support theme htmls5
add_theme_support( 'html5', array( 
	'comment-list', 
	'comment-form', 
	'search-form', 
	'gallery', 
	'caption' 
));


//Support theme title tag
add_theme_support( 'title-tag' );


//Support theme selective refresh widgets
add_theme_support( 'customize-selective-refresh-widgets' );


//Support theme widgets
add_theme_support('widgets');


//Support theme menus
add_theme_support( 'menus' );


//Two menu locations
register_nav_menus( array(
	'primary' => __( 'Главное меню', 'mytheme' ),
	'social'  => __( 'Меню соцссылок', 'mytheme' ),
) );


//Sidebar register
function myfn_register_wp_sidebars() {

	//Main sidebar for widgets
	register_sidebar(
		array(
			'id' => 'sidebar1',
			'name' => 'Main sidebar',
			'description' => 'Move widgets here to add them to sidebar.',
			'before_widget' => '<div id="%1$s" class="side widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);

}
add_action( 'widgets_init', 'myfn_register_wp_sidebars' );


//Load styles and scripts
function my_assets() {

	//Load style.css
	wp_enqueue_style( 'mytheme-style', get_stylesheet_uri() );

	//Load bulma
	wp_enqueue_style('bulma-css', 
		get_stylesheet_directory_uri().'/assets/bulma.min.css'); 

	//Load font-awesome
	wp_enqueue_style('font-awesome-css', 
		get_stylesheet_directory_uri()
		.'/assets/font-awesome/css/font-awesome.min.css'); 

	//Load carousel tiny-slider
	wp_enqueue_style('tiny-slider-css', 
		get_stylesheet_directory_uri().'/assets/tiny-slider/tiny-slider.css'); 

	wp_enqueue_script( 'tiny-slider-js', 
		get_stylesheet_directory_uri().'/assets/tiny-slider/tiny-slider.js' );
		
	wp_enqueue_script( 'my-slider-js', 
		get_stylesheet_directory_uri().'/assets/tiny-slider/myslider.js' );

	//Reply comments
	if ( 	is_singular() && 
			comments_open() && 
			get_option('thread_comments') ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'my_assets' );

?>