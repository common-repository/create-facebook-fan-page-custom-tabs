<?php

add_action('admin_menu', 'fbfeed_create_menu');

function fbfeed_create_menu() {

	add_menu_page('Social Habits Plugin Settings', 'Social Habits', 'administrator', __FILE__, 'fbfeed_settings_page',plugins_url('/images/fire_icon2.png', __FILE__));
	
	$y = basename(__FILE__);
	$x = plugin_basename(__FILE__);
	$myPath =  (substr($x,0,-strlen($y)));
	wp_enqueue_style( 'fbfeed-css', plugins_url($myPath.'/css/main.css') );
	wp_print_styles();
	
	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {
	register_setting( 'fbfeed-settings-group', 'new_option_name' );
	register_setting( 'fbfeed-settings-group', 'some_other_option' );
	register_setting( 'fbfeed-settings-group', 'option_etc' );
}

function fbfeed_settings_page() {
	
	global $wp;
	 
	$x = plugins_url('/images/social_habits_logo.png', __FILE__);
	$bloginfo = get_bloginfo("wpurl");
	
?>
<div id='fbfeedHolder'>
	<div style='padding:20px;'>
		<div class='pageHeader'>
		
			<div class='logo' style='float:left;margin-bottom:20px;'>
				<a href='http://apps.facebook.com/socialhabits'><img src="<?=plugins_url('/images/social_habits_logo.png', __FILE__); ?>" title='<?=$x?>' border='0'></a>
			</div>
			
		
			
			<div class="void"></div>
		</div>
		<h1 style='padding:10px 0px;'>create a custom <span style='color:#506fa1'>fan page</span> <!-- tab --> easily... and fast!</h1>
		<h2>Socialize your brand on facebook and increase users loyalty to your products & services</h2>
		
		
		
			<div class='loginBT' style='padding:20px 0px 0px 0px;' align="center">
			Thank you for instaling Social Habits, Your fan-page feed link is: 
			<input type='text' style='width:400px;font-size:16px;font-weight:bold;' value='<?=$bloginfo?>/fbfeed' readonly/>
			<br/>
			<br/>
				<a href='http://apps.facebook.com/socialhabits/?register=1' target='_blank'><img src="<?=plugins_url('/images/start_bt.png', __FILE__); ?>" border='0'></a>
			</div>
			
			
		<div class='hpColumn' style='margin-right:40px;'>
			
			<h3>Rich Media Platform</h3>
			We provide the most advanced facebook content delivery platform to fulfill all of your busines's social marketing needs.
			Our platform provides rich designed pages. We support videos, image galleries and formated text.<br>
			No design skills needed.<br/>
			<b>just set up your content - we'll do the rest.</b>
			
			<h3>Demo fan pages</h3>
			<div class='profileHolder'><img src='http://graph.facebook.com/125767760779322/picture' onclick=''/><a href='http://www.facebook.com/pages/Cincopa/125767760779322?v=app_177188365630772'>Cincopa</a></div>
			<div class='profileHolder'><img src='http://graph.facebook.com/185408411472709/picture' onclick=''/><a href='http://www.facebook.com/apps/application.php?id=185408411472709&v=app_177188365630772'>Erlich & Neuman</a></div>
		
		</div>
		<div class='hpColumn'>
			
			<h3>Custom Templates</h3>
			Different brands have different needs, our platform will let you customize the looks of your fan page, add your logo and design a color theme to fit your brand looks.
		
			<h3>Wordpress Plugin</h3>
			Now available! a custom wordpress plugin to stream your site content into your facebook fan page. the plugin will automatically format your most recent posts and display their content on your Social-Habits tab. you can download and install the plug-in at <a href='#'>http://www.wordpress.org/plugins/create-something</a>.
			
			
			
		</div>
		
		<div class="void"></div>
		
	</div>
</div>

<?php } ?>
