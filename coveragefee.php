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

  // Coverage Fee field for Event Pages
  $entities[] = [
    'module' => 'com.pesc.coveragefee',
    'entity' => 'CustomGroup',
    'params' => [
      'version' => 3,
      'title' => "Event Coverage Fee",
      'extends' => "Event",
      'style' => "Inline",
      'collapse_display' => 0,
      'collapse_adv_display' => 1,
      'is_reserved' => 0,
      'is_public' => 0,
      'name' => "event_coverage_fee"
    ]
  ];

  $entities[] = [
    'module' => 'com.pesc.coveragefee',
    'entity' => 'CustomField',
    'params' => [
      'version' => 3,
      'custom_group_id' => "event_coverage_fee",
      'name' => "event_coverage_fee_percentage",
      'label' => "Event Coverage Fee (percentage)",
      'data_type' => "Int",
      'is_view' => 0,
      'html_type' => "Text"
    ]
  ];

  // Coverage Fee field for Contribution Pages
  $entities[] = [
    'module' => 'com.pesc.coveragefee',
    'entity' => 'CustomGroup',
    'params' => [
      'version' => 3,
      'title' => "Contribution Coverage Fee",
      'extends' => "Contribution",
      'style' => "Inline",
      'collapse_display' => 0,
      'collapse_adv_display' => 1,
      'is_reserved' => 0,
      'is_public' => 0,
      'name' => "contribution_coverage_fee"
    ]
  ];

  $entities[] = [
    'module' => 'com.pesc.coveragefee',
    'entity' => 'CustomField',
    'params' => [
      'version' => 3,
      'custom_group_id' => "contribution_coverage_fee",
      'name' => "contribution_coverage_fee_percentage",
      'label' => "Contribution Coverage Fee (percentage)",
      'data_type' => "Int",
      'is_view' => 0,
      'html_type' => "Text"
    ]
  ];
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

/**
 * Implements hook_civicrm_buildForm().
 *
 * This hook is invoked when building a form. It can be used to set the
 * default values of a form element, to change form elements attributes,
 * and to add new fields to a form.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_buildForm
 *
function coveragefee_civicrm_buildForm($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_pageRun().
 *
 * This hook is called before a CiviCRM page is rendered.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_pageRun
 */
function coveragefee_civicrm_pageRun(&$page) {
  /*
   * ...actually move this to buildForm hook
   */

  $pageName = $page->getVar('_name');
  $eventId = $page->getVar('_id');
  if ($pageName == 'CRM_Event_Page_EventInfo') {
    try {
      $percentage = civicrm_api3('CustomValue', 'getsingle', [
        'entity_id' => $eventId,
        'return' => ["event_coverage_fee:event_coverage_fee_percentage"]
      ])['latest'];
    }
    catch (CiviCRM_API3_Exception $e) {
      $errorMessage = $e->getMessage();
      return;
    }
  }
}
