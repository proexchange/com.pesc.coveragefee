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

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 *
function coveragefee_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 *
function coveragefee_civicrm_navigationMenu(&$menu) {
  _coveragefee_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _coveragefee_civix_navigationMenu($menu);
} // */

function coveragefee_civicrm_buildForm($formName, &$form) {
  if(is_a($form, 'CRM_Event_Form_Registration_Register')) {
    CRM_Core_Region::instance('price-set-1')->add([
      'template' => "testfield.tpl",
      'name' => 'merchant_fee'
    ]);

    $form->addCheckBox('merchant_fee', 'Merchant Fee', [ 'Merchant Fee (3%)' => 1 ]);
    $form->assign('merchantFeeElements', [ 'merchant_fee' ]);
  }
  else if(is_a($form, 'CRM_Event_Form_Registration_Confirm')) {
/*
    $applyFee = isset($params[0]['merchant_fee']) ? true : false;

    $params = $form->getVar('_params');
    $lineitems = $form->getVar('_lineItem');
    $amount = $form->getVar('_amount');
    $priceSet = $form->getVar('_priceSet');
    $values = $form->getVar('_values');

    $params[0]['amount'] = 1337;
    $lineitems[0][28]['unit_price'] = 1337.000000000;
    $lineitems[0][28]['line_total'] = 1337;
    $amount[0]['amount'] = 1337;
    $priceSet['fields'][13]['options'][28]['amount'] = 1337.000000000;
    $values['fee'][13]['options'][28]['amount'] = 1337.000000000;

    $form->setVar('_totalAmount', 1337);
    $form->setVar('_params', $params);
    $form->setVar('_lineItem', $lineitems);
    $form->setVar('_amount', $amount);
    $form->setVar('_priceSet', $priceSet);
    $form->setVar('_values', $values);

    echo '<pre>';
    print_r($form);
    die();
*/
  }
}

function coveragefee_civicrm_alterContent(&$content, $context, $tplName, &$object) {
  if(!is_a($object, 'CRM_Event_Form_Registration_Confirm')) return;

  $params = $object->get('params');
  $applyFee = isset($params[0]['merchant_fee']) ? true : false;

  if($applyFee)
    $content .= '<div id="applyMerchantFee">&nbsp;</div>';
}
