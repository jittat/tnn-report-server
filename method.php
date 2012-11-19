<?php 
/**
 * @package tnn-report.server
 * @subpackage api
 * @copyright Copyright (C) 2012 Thai Netizen Network Developer. All rights reserved.
 * @license GNU General Public License version 2 or later; see COPYING
 */

defined( '_VALID_ACCESS' ) or die( 'Direct Access to this location is not allowed.' );

function listClients() {
	global $clients;
	return responseDynamicList('clients',$clients);

}

function listServers() {
	global $servers;
	return responseDynamicList('servers',$servers);
}

function listLandings() {
	$landings = getLandings(true);
	$conn = getPDOConnection();
	return responseDynamicList('landings',$landings);
}