<?php
/**
 * @package tnn-report.server
 * @subpackage api
 * @copyright Copyright (C) 2012 Thai Netizen Network Developer. All rights reserved.
 * @license GNU General Public License version 2 or later; see COPYING
 */

defined( '_VALID_ACCESS' ) or die( 'Direct Access to this location is not allowed.' );

function error( $msg, $code = 500 ) {
	echo json_encode( array(
		'status' => $code,
		'description' => $msg
	));
	die();
}

function getRequestPath() {
	static $path;
	if( isset( $path ) ) {
		return $path;
	}
	
	$script_path = $_SERVER['SCRIPT_NAME'] or error( 'Empty SCRIPT_NAME variable' );
	$request_uri = $_SERVER['REDIRECT_URL'] or error( 'Empty REDIRECT_URL variable' ); //URI without query string
	$script_dir = dirname( $script_path );
	if( strpos( $request_uri, $script_dir ) !== 0 ) { // Check
		error( 'URL Prefix not equal' );
	}
	
	return $path = substr( $request_uri, strlen($script_dir) );
}

function not_empty( $str ) {
	return strlen( $str ) != 0;
}

function responseDynamicList( $type, $list ) {
	global $params;
	$results = $list;
	if( isset( $params[1] ) ) {
		$name = $params[1];
		if( !array_key_exists( $name, $list ) ) {
			error( 'Item not found' );
		}
		$results = array( $list[$name] );
		
	}
	
	return array( $type => $results );
}

function getPDOConnection() {
	static $conn;
	if( !isset( $conn ) ) {
		try {
		    $conn = new PDO( PDO_DSN, PDO_USERNAME, PDO_PASSWORD );
		} catch ( PDOException $e ) {
			echo $e->getMessage();
		    error( 'Fail to connect to database' );
		    
		}
	}
	return $conn;
}

function getLandings( $only_approved = true ) {
	$conn = getPDOConnection();
	if( $only_approved ) {
    	$sql = 'SELECT landing_url FROM landings WHERE approved=true';
	} else {
		$sql = 'SELECT landing_url FROM landings';
	}
    $results = $conn->query( $sql )->fetchAll();
    $landings = array();
	foreach( $results as $landing ) {
		$landings[] = $landing['landing_url'];
	}
	return $landings;
}