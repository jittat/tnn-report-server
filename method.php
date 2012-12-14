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
  $conn = getPDOConnection();
  $landings = getLandings(true);
  return responseDynamicList('landings',$landings);
}

function addBlock() {
  if(!isset($_POST['block_url']))
    return responseStatus(100,'Incomplete parameters');
  $block_url = $_POST['block_url'];
  
  if(isset($_POST['addr']))
    $addr = $_POST['addr'];
  else {
    if(isset($_SERVER['REMOTE_ADDR']))
      $addr = $_SERVER['REMOTE_ADDR'];
    else
      return responseStatus(100,'Remore address not found');
  }

  $landing_url = isset($_POST['landing_url']) ? $_POST['landing_url'] : '';
  $comment = isset($_POST['comment']) ? $_POST['comment'] : '';

  if(saveBlock($block_url, $addr, $landing_url, $comment))
    return responseStatus(0,'OK');
  else
    return responseStatus(100,'Error saving block url');
}

