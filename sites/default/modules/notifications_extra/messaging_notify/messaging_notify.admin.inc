<?php
// $Id: messaging_notify.admin.inc,v 1.1.2.2 2010/05/11 01:37:01 jareyero Exp $
/**
 * @file
 * Subscriptions to messaging events
 */

/**
 * Admin settings, configure defaults for sending methods
 */
function messaging_notify_admin_settings() {
  // To what you can subscribe using what
  $form['allowed'] = array(
    '#type' => 'fieldset',
    '#title' => t('Method permissions')
  );
  $form['allowed']['messaging_notify_subscribe'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Allowed subscriptions'),
    '#options' => messaging_method_list(),
    '#default_value' => variable_get('messaging_notify_subscribe', array()),
    '#description' => t('Check the sending methods a user can subscribe to.'),  
  );
  $form['allowed']['messaging_notify_receive'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Allowed sending methods'),
    '#options' => messaging_method_list(),
    '#default_value' => variable_get('messaging_notify_receive', array()),
    '#description' => t('Check the sending methods that can be used for notifications.'),  
  );
  return system_settings_form($form);
}
