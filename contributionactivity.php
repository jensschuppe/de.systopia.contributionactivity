<?php
/*-------------------------------------------------------+
| Contribution Activity Coupler                          |
| Copyright (C) 2016 SYSTOPIA                            |
| Author: B. Endres (endres@systopia.de)                 |
+--------------------------------------------------------+
| This program is released as free software under the    |
| Affero GPL license. You can redistribute it and/or     |
| modify it under the terms of this license which you    |
| can read by viewing the included agpl.txt or online    |
| at www.gnu.org/licenses/agpl.html. Removal of this     |
| copyright header is strictly prohibited without        |
| written permission from the original author(s).        |
+--------------------------------------------------------*/

require_once 'contributionactivity.civix.php';


/**
 * POST hook implementation to adjust a contribution's activity date
 * upon receive_date changes.
 */
function contributionactivity_civicrm_post($op, $objectName, $objectId, &$objectRef) {
  if ($op == 'edit' && $objectName == 'Contribution') {
    // find relevant activities...
    $activity_type_id = (int) CRM_Core_OptionGroup::getValue('activity_type', 'Contribution', 'name');
    $activities = civicrm_api3('Activity', 'get', array('activity_type_id' => $activity_type_id, 'source_record_id' => $objectId));

    // ... and update the date of all of them 
    foreach ($activities['values'] as $activity_id => $activity) {
      $update = array(
        'id'                 => $activity['id'],
        'activity_date_time' => date('Ymdhis', strtotime($objectRef->receive_date))
      );
      civicrm_api3('Activity', 'create', $update);
    }
  }
}


/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function contributionactivity_civicrm_config(&$config) {
  _contributionactivity_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function contributionactivity_civicrm_xmlMenu(&$files) {
  _contributionactivity_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function contributionactivity_civicrm_install() {
  _contributionactivity_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function contributionactivity_civicrm_uninstall() {
  _contributionactivity_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function contributionactivity_civicrm_enable() {
  _contributionactivity_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function contributionactivity_civicrm_disable() {
  _contributionactivity_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function contributionactivity_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _contributionactivity_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function contributionactivity_civicrm_managed(&$entities) {
  _contributionactivity_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function contributionactivity_civicrm_caseTypes(&$caseTypes) {
  _contributionactivity_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function contributionactivity_civicrm_angularModules(&$angularModules) {
_contributionactivity_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function contributionactivity_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _contributionactivity_civix_civicrm_alterSettingsFolders($metaDataFolders);
}
