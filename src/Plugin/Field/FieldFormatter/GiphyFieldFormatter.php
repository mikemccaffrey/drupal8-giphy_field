<?php

/**
 * @file
 * Contains \Drupal\GiphyField\Plugin\Field\FieldFormatter\GiphyFieldFormatter.
 */

namespace Drupal\giphy_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'giphy_field_embed' formatter.
 *
 * @FieldFormatter(
 *   id = "giphy_field_embed",
 *   label = @Translation("Giphy field embed"),
 *   field_types = {
 *     "giphy_field"
 *   }
 * )
 */
class GiphyFieldFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      // 'size' => '450x315',
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = parent::settingsForm($form, $form_state);
    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary[] = t('Giphy Field');
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareView(array $entities_items) {}

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = array();
    $settings = $this->getSettings();

    foreach ($items as $delta => $item) {
      $element[$delta] = array(
        '#markup' => $item->input,
      );
    }
    return $element;
  }

}
