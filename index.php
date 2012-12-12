<?php
/**
 * @package tnn-report.server
 * @subpackage api
 * @copyright Copyright (C) 2012 Thai Netizen Network Developer. All rights reserved.
 * @license GNU General Public License version 2 or later; see COPYING
 */

define( '_VALID_ACCESS', true );

require_once( 'config/constrain.php' );
require_once( 'config/db.php' );
require_once( 'functions.php' );
require_once( 'method.php' );

$get_actions = array(
  '/clients/' => 'listClients',
  '/servers/' => 'listServers',
  '/landings/' => 'listLandings'
);

$post_actions = array(
  '/blocks/' => 'addBlock',
  '/landings/' => 'addLanding'
);

$url = getRequestPath();
$url = rtrim( $url, '/' ) . '/'; 

$params = explode( '/', $url );
$params = array_values( array_filter( $params, 'not_empty' ) );

$actions = $_SERVER['REQUEST_METHOD'] === 'GET' ? $get_actions : $post_actions;

$called = false;
foreach( $actions as $action_prefix => $function )  {
  if(strpos( $url,$action_prefix ) === 0 ) {
    $output = call_user_func( $function, $params );
    echo json_encode( $output );
    $called = true;
    break;
  }
}

if(!$called) {
  error( 'Method Not Found' );
}