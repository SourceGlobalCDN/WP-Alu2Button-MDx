<?php

/**
 * Plugin Name: WP Alu2Button with CDN
 * Plugin URI: 
 * Description: Add alu button to TinyMCE and add the alu expression in comment 
 * Version: 2.0.0
 * Author: AHdark
 * Author URI: https://ahdark.rc0.co
 */

function mce_smiley_button($buttons)
{
	array_push($buttons, 'smiley');
	return $buttons;
}
add_filter('mce_buttons', 'mce_smiley_button');

function mce_smiley_js($plugin_array)
{
	$plugin_array['smiley'] = plugins_url('/plugin.js', __FILE__);
	return $plugin_array;
}
add_filter('mce_external_plugins', 'mce_smiley_js');

function mce_smiley_css()
{
	wp_enqueue_style('smiley', plugins_url('/plugin.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'mce_smiley_css');

function mce_smiley_settings($settings)
{
	global $wpsmiliestrans;

	if (get_option('use_smilies')) {
		$keys = array_map('strlen', array_keys($wpsmiliestrans));
		array_multisort($keys, SORT_ASC, $wpsmiliestrans);
		$smilies = array_unique($wpsmiliestrans);
		$smileySettings = array(
			'smilies' => $smilies,
			'src_url' => apply_filters('smilies_src', includes_url('images/smilies/'), '', site_url())
		);
		echo '<script>var _smileySettings = ' . json_encode($smileySettings) . '</script>';
	}

	return $settings;
}
add_filter('tiny_mce_before_init', 'mce_smiley_settings');

define('ALU_VERSION', '1.0.6');
define('ALU_URL', plugins_url('', __FILE__));
define('ALU_PATH', dirname(__FILE__));
define('ALU_ADMIN_URL', admin_url());
define('ALU_URL_JSDELIVR', 'https://cdn.jsdelivr.net/gh/AH-dark/WP-Alu2Button-MDx@2.0.0');

/**
 * 加载函数
 */
require ALU_PATH . '/functions.php';
