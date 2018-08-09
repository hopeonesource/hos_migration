<?php

use \Drupal\hos_migration\sql\MessageArchives;

/**
 * Implements hook_drush_command().
 */
function hos_migration_drush_command() {
  $items = array();
  $items['hos_migration_msg_arch'] = [
    'description' => 'Migrates message archives',
    'aliases' => ['hsarc'],
  ];
  $items['hos_migration_test_connection'] = [
    'description' => 'Test HOS d7 database connection',
    'aliases' => ['hosdb'],
  ];
  return $items;
}

function drush_hos_migration_msg_arch(){
  print('archives'."\n");
  $db = getDatabaseConnection('migrate');
  $messageArchives = new MessageArchives($db);
  $results = $messageArchives->query()->execute();
  resetConnection();

  $db = getDatabaseConnection();
//$values = [2, 2, 'Free winter shelter', 3, 5, 98765342, 'ytsydfshfsdhinserted'];
  $count = 1;
  foreach ($results as $result){
    $provider = $result->sms_provider_session_id;
    print($provider.' **: '.$count."\n");
    $values = [
      $result->uid, $result->nid, urldecode($result->message_text), $result->timestamp_when_queued,
      $result->timestamp_when_sent, $result->phone_number, isset($provider)? $provider : ''
    ];
    $db->insert('message_archives')->fields([
        'uid','nid','message_text','timestamp_when_queued','timestamp_when_sent',
        'phone_number', 'sms_provider_session_id'
      ])->values($values)->execute();
    $count++;
  }
  resetConnection();
}
function drush_hos_migration_test_connection(){
  print('Test DB connection'."\n");

}
function getDatabaseConnection($key='default'){
  \Drupal\Core\Database\Database::setActiveConnection($key);
  $db = \Drupal\Core\Database\Database::getConnection();

  return $db;
}
function resetConnection(){
  \Drupal\Core\Database\Database::setActiveConnection();
}
function createArchiveNodes(){

}