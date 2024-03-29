<?php
/*
Plugin Name: Join Portal
Plugin URI: https://github.com/mittmedia/join_portal
Description: This is where you join the portal.
Version: 1.0.0
Author: Fredrik Sundström
Author URI: https://github.com/fredriksundstrom
License: MIT
*/

/*
Copyright (c) 2012 Fredrik Sundström

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
*/

require_once( 'wp_mvc/init.php' );

$join_portal_app = new \WpMvc\Application();

$join_portal_app->init( 'JoinPortal', WP_PLUGIN_DIR . '/join_portal' );

// WP: Add pages
add_action( 'network_admin_menu', 'join_portal_add_pages' );
function join_portal_add_pages()
{
  add_submenu_page( 'settings.php', 'Join Portal Settings', 'Join Portal', 'Super Admin', 'join_portal_settings', 'join_portal_settings_page');
}

function join_portal_settings_page()
{
  global $join_portal_app;

  $join_portal_app->settings_controller->index();
}

if ( isset( $_GET['join_portal_updated'] ) ) {
  add_action( 'network_admin_notices', 'join_portal_updated_notice' );
}

function join_portal_updated_notice()
{
  $html = \WpMvc\ViewHelper::admin_notice( __( 'Settings saved.' ) );

  echo $html;
}
