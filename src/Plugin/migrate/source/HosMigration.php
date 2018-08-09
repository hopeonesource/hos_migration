<?php

namespace Drupal\hos_migration\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Provides a 'HosMigration' migrate source.
 *
 * @MigrateSource(
 *  id = "hos_message_archives"
 * )
 */
class HosMigration extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    return $this->select('message_archives', 'ms')
      ->fields('ms', array_keys($this->fields()));
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'sent_message_id' => $this->t('sent_message_id'),
      'nid' => $this->t('node id'),
      'uid' => $this->t('user id'),
      'timestamp_when_queued' => $this->t('time stamp when queued'),
      'timestamp_when_sent' => $this->t('time stamp when sent'),
      'message_text' => $this->t('message'),
      'message_send_id' => $this->t('message send id'),
      'phone_number' => $this->t('phone number'),
      'delivery_status_code' => $this->t('delivery status code'),
      'error_code' => $this->t('error code'),
      'delivery_complete_date' => $this->t('delivery complete date'),
      'carrier_id' => $this->t('carrier id'),
      'sms_provider_session_id' => $this->t('sms provider session id'),
    ];
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'sent_message_id' => [
        'type' => 'integer'
      ]
    ];
  }

}
