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

function coveragefee_civicrm_buildAmount($pageType, &$form, &$amount) {
  if (!empty($form->get('mid'))) {
    // Don't apply pro-rated fees to renewals
    return;
  }

  //sample to modify priceset fee
  $priceSetId = $form->get('priceSetId');
  if (!empty($priceSetId)) {
    $feeBlock = &$amount;
    if (!is_array($feeBlock) || empty($feeBlock)) {
      return;
    }

    if ($pageType == 'event') {
      // pro-rata membership per month
      // membership year is from 1st Jan->31st Dec
      // Subtract 1/12 per month so in Jan you pay full amount,
      //  in Dec you pay 1/12
      // 12 months in year, min 1 month so subtract current numeric month from 13 (gives 12 in Jan, 1 in December)
      $monthNum = date('n');
      $monthsToPay = 13-$monthNum;

      foreach ($feeBlock as &$fee) {
        if (!is_array($fee['options'])) {
          continue;
        }
        foreach ($fee['options'] as &$option) {
          // We only have one amount for each membership, so this code may be overkill,
          // as it checks every option displayed (and there is only one).
          if ($option['amount'] > 0) {
            // Only pro-rata paid memberships!
            $option['amount'] = $option['amount'] * ($monthsToPay / 12);
            if ($monthsToPay == 1) {
              $option['label'] .= ' - Pro-rata: Dec only';
            }
            elseif ($monthsToPay < 12) {
              $dateObj = DateTime::createFromFormat('!m', $monthNum);
              $monthName = $dateObj->format('M');
              $option['label'] .= ' - Pro-rata: ' . $monthName . ' to Dec';
            }
          }
        }
      }
      // FIXME: Somewhere between 4.7.15 and 4.7.23 the above stopped working and we have to do the following to make the confirm page show the correct amount.
      $form->_priceSet['fields'] = $feeBlock;
    }
  }
}

function coveragefee_civicrm_buildForm($formName, &$form) {
  $formId = (int)$form->get('id');

  // Event Registration Form
  if(is_a($form, 'CRM_Event_Form_Registration_Register')) {
    if($formId === 8) {
      $templatePath = realpath(dirname(__FILE__)."/templates");
      CRM_Core_Region::instance('price-set-1')->add([
        'template' => "{$templatePath}/testfield.tpl",
        'name' => 'merchant_fee'
      ]);

      // $form->add('text', 'merchant_fee');
      $form->addCheckBox('merchant_fee', 'Merchant Fee', [ 'Merchant Fee (3%)' => 1 ]);
/*
      $errorMessage = $form->get('merchantFeeCodeErrorMsg');
      if ($errorMessage) {
        $form->setElementError('merchantFee', $errorMessage);
      }
      $form->set('merchantFeeCodeErrorMsg', NULL);
*/
      $form->assign('merchantFeeElements', [ 'merchant_fee' ]);
    }
  }

  // Event Confirmation Form
  else if(is_a($form, 'CRM_Event_Form_Registration_Confirm')) {
    if($formId === 8) {
      $params = $form->get('params')[0];
      $applyMerchantFee = isset($params['merchant_fee']) ? true : false;
    }
  }

  // Contribution Form
  else if(is_a($form, 'CRM_Contribute_Form_Contribution_Main')) {
    if($formId === 3) { }
  }
}

function coveragefee_civicrm_validateForm($formName, &$fields, &$files, &$form, &$errors) {
  $formId = (int)$form->get('id');

  if(is_a($form, 'CRM_Event_Form_Registration_Register')) {
    if($formId === 8) {
/*
echo '<pre>';
print_r($fields);
die();
      $merchantFeeInfo = $form->get('_merchantFeeInfo');
      if ($merchantFeeInfo && gettype($merchantFeeInfo) !== 'integer') {
        $errors['merchantFee'] = E::ts('The merchant fee must be a number.');
        return;
      }
*/
    }
  }
}

function coveragefee_civicrm_preProcess($formName, $form) {
  $formId = (int)$form->get('id');

  if(is_a($form, 'CRM_Event_Form_Registration_Register')) {
    if($formId === 8) { }
  }
}
