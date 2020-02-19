<?php

require_once 'coveragefee.civix.php';
use CRM_Coveragefee_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function coveragefee_civicrm_config(&$config) {
  _coveragefee_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function coveragefee_civicrm_xmlMenu(&$files) {
  _coveragefee_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function coveragefee_civicrm_install() {
  _coveragefee_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function coveragefee_civicrm_postInstall() {
  _coveragefee_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function coveragefee_civicrm_uninstall() {
  _coveragefee_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function coveragefee_civicrm_enable() {
  _coveragefee_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function coveragefee_civicrm_disable() {
  _coveragefee_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function coveragefee_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _coveragefee_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function coveragefee_civicrm_managed(&$entities) {
  _coveragefee_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function coveragefee_civicrm_caseTypes(&$caseTypes) {
  _coveragefee_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function coveragefee_civicrm_angularModules(&$angularModules) {
  _coveragefee_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function coveragefee_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _coveragefee_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function coveragefee_civicrm_entityTypes(&$entityTypes) {
  _coveragefee_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
function coveragefee_civicrm_navigationMenu(&$menu) {
/*
  _coveragefee_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
*/
  _coveragefee_civix_navigationMenu($menu);
}

/**
 * Implements hook_civicrm_buildAmount().
 *
 * If the event of the form being loaded has the coverage fee option
 * applied, calculate the fee and update the price and label.
 *
 * @param string $pageType
 * @param CRM_Core_Form $form
 * @param $amounts
 */
function coveragefee_civicrm_buildAmount($pageType, &$form, &$amounts) {
  $action = $form->getVar('_action') ? $form->getVar('_action') : NULL;

  if ((!$action
        || ($action & CRM_Core_Action::PREVIEW)
        || ($action & CRM_Core_Action::ADD)
        || ($action & CRM_Core_Action::UPDATE)
      )
    && !empty($amounts) && is_array($amounts) &&
      ($pageType == 'event' || $pageType == 'contribute')) {

    $event_id = $form->getVar('_eventId');
    $priceset_id = $form->get('priceSetId');
    $priceset = $form->get('priceSet');
    $values = $form->getVar('_values');
    $submit_values = $form->_submitValues;

    $form->set('_coverageFeeInfo', NULL);
    $coverageFeePercentage = 3;
    $coverageFeeApplied = FALSE;
    $originalAmounts = $amounts;

    if (array_key_exists('_qf_Register_reload', $submit_values))
      $coverageFeeApplied = TRUE;

    if($coverageFeeApplied) {
      CRM_Core_Session::setStatus(html_entity_decode('Thank you blah blah. Press the back button in your browser if you do not want to pay the coverage fee.'), '', 'no-popup');
      foreach ($amounts as $fee_id => &$fee) {
        if (!is_array($fee['options'])) {
          continue;
        }
        foreach ($fee['options'] as $option_id => &$option) {
          $originalLabel = $originalAmounts[$fee_id]['options'][$option_id]['label'];
          $originalAmount = (float)$originalAmounts[$fee_id]['options'][$option_id]['amount'];
          $label = "$originalLabel (Coverage Fee Applied: 3%)";
          $amount = $originalAmount + ($originalAmount * (float)($coverageFeePercentage / 100));
          $option['amount'] = $amount;
          $option['label'] = $label;
        }
      }
    }

    if ($coverageFeeApplied) {
      if (!empty($priceset['fields'])) {
        $priceset['fields'] = $amounts;
        $form->setVar('_priceSet', $priceset);
      }
      $form->set('_coverageFeeInfo', [
        'percentage' => $coverageFeePercentage
      ]);
    }
  }
}

/**
 * Implements hook_civicrm_buildForm().
 *
 * If the event id of the form being loaded has coverage fee option
 * enabled, modify the form to include the apply fee button. Only
 * display the button on the initial registration screen.
 *
 * Works for events and contribution pages.
 *
 * @param string $formName
 * @param CRM_Core_Form $form
 * @return bool
 */
function coveragefee_civicrm_buildForm($formName, &$form) {
  if (!in_array($formName, [
    'CRM_Event_Form_Registration_Register',
    'CRM_Contribute_Form_Contribution_Main'
  ])) {
    return;
  }

  $addCoverageFeeField = FALSE; 

  if(in_array($formName, [
    'CRM_Event_Form_Registration_Register'
  ])) {
    $feeCalculator = new CRM_CoverageFee_FeeCalculator('event', $form->getVar('_eventId'));
    $addCoverageFeeField = $feeCalculator->bShowCoverageFeeField();
  }
  else if(in_array($formName, [
    'CRM_Contribute_Form_Contribution_Main'
  ])) {
    // @TODO: contribution forms
  }

  if ($addCoverageFeeField) {
    _coveragefee_add_button_before_priceSet($form);
  }
}

function _coveragefee_add_button_before_priceSet(&$form) {
  CRM_Core_Region::instance('price-set-1')->add([
    'template' => 'CRM/CoverageFee/coverageFeeButton.tpl',
    'weight' => -1,
    'type' => 'template',
    'name' => 'coverage_fee'
  ]);

  $buttonName = $form->getButtonName('reload');
  $form->addElement('submit', $buttonName, E::ts('Apply'), ['formnovalidate' => 1]);
  $form->assign('coverageFeeElements', [ $buttonName ]);
}

/**
 * Implements hook_civicrm_validateForm().
 *
 * Used in the initial event registration screen.
 *
 * @param string $formName
 * @param array $fields reference
 * @param array $files
 * @param CRM_Core_Form $form
 * @param $errors
 */
function coveragefee_civicrm_validateForm($formName, &$fields, &$files, &$form, &$errors) {
  if (!in_array($formName, [
    'CRM_Event_Form_Registration_Register',
    'CRM_Contribute_Form_Contribution_Main'
  ])) {
    return;
  }

  $coverageFeeInfo = $form->get('_coverageFeeInfo');

  echo '<pre>';
  print_r($coverageFeeInfo);
  print_r($form);
  die();

}
