<?php

/*
	Plugin Name: Your site in facebook - create your fan page from wordpress
	Plugin URI: http://apps.facebook.com/socialhabits/
	Description: "Social Habits Plugin" - The plugin will automatically format your most recent posts and display their content on your Facebook fan-page.
	Author: itaynoy, orenshmu
	Version: 0.1
	Author URI: http://itaynoy.com
*/

require( dirname( __FILE__ ) . '/fbfeed-options.php' );

function feed_thumbnails() {

	foreach (explode("/",$_SERVER["REQUEST_URI"]) as $segment) {
		if (trim($segment) != "")
			$slug = $segment;
	}
	if($slug=="fbfeed"){
	
		if ( function_exists( 'get_the_image' ) and ( $thumb = get_the_image('format=array&echo=0') ) ) {
			$thumb[0] = $thumb['url'];
		} else if ( function_exists( 'has_post_thumbnail' ) and has_post_thumbnail() ) {
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumbnail' );
		} else if ( function_exists( 'get_post_thumbnail_src' ) ) {
			$thumb = get_post_thumbnail_src();
			if ( preg_match( '|^<img src="([^"]+)"|', $thumb[0], $m ) )
				$thumb[0] = $m[1];
		} else {
			$thumb = false;
		}
	
		if ( !empty( $thumb ) ) {
			echo "\t" . '<enclosure url="' . $thumb[0] . '" width="'.$thumb[1].'" height="'.$thumb[2].'" />' . "\n";
		}
	
	}
	

}

add_action( 'rss2_item', 'feed_thumbnails' );

function fbfeed_gen() {
	$x = WP_PLUGIN_DIR.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)); 
	//echo $x;
	load_template( $x . '/fbfeed-rss2.php'); // You'll create a your-custom-feed.php file in your theme's directory
}

function fbfeed_rewrite_rules( $wp_rewrite ) {
  $new_rules = array(
    'feed/(.+)' => 'index.php?feed='.$wp_rewrite->preg_index(1)
  );
  $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}

function fbfeed_add_feed(  ) {
  global $wp_rewrite;
  add_feed('fbfeed', 'fbfeed_gen');
  add_action('generate_rewrite_rules', 'fbfeed_rewrite_rules');
  $wp_rewrite->flush_rules();
}

add_action('init', 'fbfeed_add_feed');



?>