<?php

namespace Drupal\hos_migration\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;

/**
 * Provides a 'HosMessageText' migrate process plugin that decodes a message
 * text.
 *
 * @MigrateProcessPlugin(
 *  id = "hos_message_text"
 * )
 */
class HosMessageText extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {

    return urldecode($value);
  }
}
