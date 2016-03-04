<?php
/*
Plugin Name: Facebook Analytics
Plugin URI: https://binaty.org/plugins/facebook-analytics
Description: Add total Facebook likes, unlikes, comments to Google Analytics
Version: 1.0
Author: Tan Nguyen
Author URI: http://www.binaty.org
License: GPL2+
Text Domain: facebook-analytics
Domain Path: /lang
*/

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

//----------------------------------------------------------
// Define plugin URL for loading static files or doing AJAX
//------------------------------------------------------------
if ( ! defined( 'BFA_URL' ) )
	define( 'BFA_URL', plugin_dir_url( __FILE__ ) );

define( 'BFA_JS_URL', trailingslashit( BFA_URL . 'js' ) );
// ------------------------------------------------------------
// Plugin paths, for including files
// ------------------------------------------------------------
if ( ! defined( 'BFA_DIR' ) )
	define( 'BFA_DIR', plugin_dir_path( __FILE__ ) );

// Load the conditional logic and assets
include BFA_DIR . 'lib/class-tgm-plugin-activation.php';
include BFA_DIR . 'class-facebook-analytics.php';
include BFA_DIR . 'class-facebook-analytics-settings.php';

new Facebook_Analytics;