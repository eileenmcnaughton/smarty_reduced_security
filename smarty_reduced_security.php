<?php

require_once 'smarty_reduced_security.civix.php';

use CRM_SmartyReducedSecurity_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function smarty_reduced_security_civicrm_config(&$config): void {
  _smarty_reduced_security_civix_civicrm_config($config);
  $smarty = CRM_Core_Smarty::singleton();
  if (method_exists($smarty, 'getVersion')) {
    require_once 'CRM/Core/Smarty/plugins/function.crmAPIWithPermissionBypass.php';
    if ($smarty->getVersion() === 2) {
      $smarty->addPluginsDir(__DIR__ . '/CRM/Core/Smarty/plugins/');

    }
    $smarty->registerPlugin('function', 'crmAPIWithPermissionBypass', 'smarty_function_crmAPIWithPermissionBypass');
  }
  else {
    // do nothing - not relevant. It is insecure.
  }
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function smarty_reduced_security_civicrm_install(): void {
  _smarty_reduced_security_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function smarty_reduced_security_civicrm_enable(): void {
  _smarty_reduced_security_civix_civicrm_enable();
}
