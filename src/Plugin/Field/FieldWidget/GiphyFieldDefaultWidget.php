<?php

/**
 * @file
 * Contains \Drupal\giphy_field\Plugin\Field\FieldWidget\GiphyFieldDefaultWidget.
 */

namespace Drupal\giphy_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'giphy_field' widget.
 *
 * @FieldWidget(
 *   id = "giphy_field",
 *   label = @Translation("Giphy field widget"),
 *   field_types = {
 *     "giphy_field"
 *   },
 *   settings = {
 *     "placeholder_url" = ""
 *   }
 * )
 */
class GiphyFieldDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = parent::settingsForm($form, $form_state);

    $elements['placeholder_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Placeholder for URL'),
      '#default_value' => $this->getSetting('placeholder_url'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    );

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();

    $placeholder_url = $this->getSetting('placeholder_url');
    if (empty($placeholder_url)) {
      $summary[] = t('No placeholders');
    }
    else {
      if (!empty($placeholder_url)) {
        $summary[] = t('URL placeholder: @placeholder_url', array('@placeholder_url' => $placeholder_url));
      }
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['input'] = $element + array(
      '#type' => 'textfield',
      '#placeholder' => $this->getSetting('placeholder_url'),
      '#default_value' => isset($items[$delta]->input) ? $items[$delta]->input : NULL,
      '#maxlength' => 255,
      '#element_validate' => array(array($this, 'validateInput')),
    );

    if ($element['input']['#description'] == '') {
      $element['input']['#description'] = t('Enter a Giphy URL, such as http://giphy.com/gifs/dkCqKWv3JhTz2.');
    }

    return $element;
  }

  /**
   * Validate video URL.
   */
  public function validateInput(&$element, FormStateInterface &$form_state, $form) {
    // TO-DO
  }

}
