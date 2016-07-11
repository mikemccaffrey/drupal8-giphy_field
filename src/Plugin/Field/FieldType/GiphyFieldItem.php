<?php

/**
 * @file
 * Contains \Drupal\giphy_field\Plugin\Field\FieldType\GiphyFieldItem.
 */

namespace Drupal\giphy_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'giphy_field' field type.
 *
 * @FieldType(
 *   id = "giphy_field",
 *   label = @Translation("Giphy Embed"),
 *   description = @Translation("This field takes a link and embeds a Giphy image."),
 *   default_widget = "giphy_field",
 *   default_formatter = "giphy_field_embed"
 * )
 */
class GiphyFieldItem extends FieldItemBase {

  /**
   * Definitions of the contained properties.
   *
   * @var array
   */
  public static $propertyDefinitions;

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'input' => array(
          'description' => 'Giphy URL.',
          'type' => 'varchar',
          'length' => 1024,
          'not null' => FALSE,
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['input'] = DataDefinition::create('string')
      ->setLabel(t('Giphy URL'));
    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('input')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function mainPropertyName() {
    return 'input';
  }
}
