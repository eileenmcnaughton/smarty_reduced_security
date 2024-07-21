<?php
/*
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC. All rights reserved.                        |
 |                                                                    |
 | This work is published under the GNU AGPLv3 license with some      |
 | permitted exceptions and without any warranty. For full license    |
 | and copyright information, see https://civicrm.org/licensing       |
 +--------------------------------------------------------------------+
 */

/**
 *
 * @package CRM
 * @copyright TTTP
 *
 */

/**
 * @param $params
 * @param $smarty
 * @return string|void
 */
function smarty_function_crmAPIWithPermissionBypass($params, &$smarty) {
  $entity = $params['entity'];
  $action = CRM_Utils_Array::value('action', $params, 'get');
  try {
    CRM_Core_Smarty_UserContentPolicy::assertTagAllowed('crmAPI');
  }
  catch (Exception $e) {
    $isGet = substr(strtolower($action), 0, 3) !== 'get';
    $blockedEntities = ['paymentprocessor'];
    // if people want to add more restrictions or less then patch-welcme on this.
    $mungedEntity = strtolower(str_replace('_','', (string) $entity));
    if (!$isGet
      || in_array($mungedEntity, $blockedEntities, TRUE)
    ) {
      throw $e;
    }
    \Civi::log()->warning('the api was called in a way that permits permission bypass with ' . $entity . '.' . $action);
  }

  if (!array_key_exists('entity', $params)) {
    throw new CRM_Core_Exception("assign: missing 'entity' parameter");
  }
  $params['sequential'] = CRM_Utils_Array::value('sequential', $params, 1);
  $var = $params['var'] ?? NULL;
  CRM_Utils_Array::remove($params, 'entity', 'action', 'var');

  $result = civicrm_api3($entity, $action, $params);
  if (!$var) {
    return json_encode($result);
  }
  if (!empty($params['json'])) {
    $smarty->assign($var, json_encode($result));
  }
  else {
    $smarty->assign($var, $result);
  }
}
