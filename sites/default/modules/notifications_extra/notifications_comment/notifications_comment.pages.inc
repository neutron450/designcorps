<?php
// $Id: notifications_comment.pages.inc,v 1.1.2.1 2010/03/25 11:54:46 jareyero Exp $
/**
 * @file
 *   Extended comment notifications
 */

/**
 * Admin settings form
 */
function notifications_comment_settings_form() {
  // Only perform notifications_comment for certain node types (default, all)
  $anonymous_problems = '';
  $anonymous_account = user_load(array('uid' => 0));
  foreach (node_get_types('names') as $type => $name) {
    $checkboxes[$type] = check_plain($name);
    $default[] = $type;
    // If they don't have the ability to leave contact info, then we make a report
    if (notifications_content_type_enabled($type, 'comment_reply') && variable_get('comment_anonymous_'. $type, COMMENT_ANONYMOUS_MAYNOT_CONTACT) == COMMENT_ANONYMOUS_MAYNOT_CONTACT) {     
      if (user_access('subscribe to comments', $anonymous_account)) {
        $anonymous_problems[] = l(t('@content-type', array('@content-type' => $name)), 'admin/content/node-type/'. $type);
      }
    }
  }
  if (!empty($anonymous_problems)) {
    drupal_set_message(t('Anonymous commenters have the permission to subscribe to comments but cannot leave their contact information on the following content types: !types.  You should either disable subscriptions on those types here, revoke the permission for anonymous users, or enable anonymous users to leave their contact information in the comment settings.', array('!types' => implode(', ', $anonymous_problems))), 'waring');
  }
  // Build the form
  $available_options = _notifications_comment_options(TRUE);
  $form['registered'] = array(
    '#type' => 'fieldset',
    '#title' => t('Defaults for registered users'),
  );
  $form['registered']['notifications_comment_default_notify'] = array(
    '#type' => 'select',
    '#title' => t('Default state for the notification selection'),
    '#return_value' => 1,
    '#default_value' => variable_get('notifications_comment_default_notify', NOTIFICATIONS_COMMENT_NODE),
    '#description' => t('This flag presets the flag for the follow-up notification on the form that anon users will see when posting a comment'),
    '#options' => $available_options,
  );

  $form['anonymous'] = array(
    '#type' => 'fieldset',
    '#title' => t('Defaults for anonymous users'),
  );
  $form['anonymous']['notifications_comment_anonymous_notify'] = array(
    '#type' => 'select',
    '#title' => t('Default state for the notification selection'),
    '#return_value' => 1,
    '#default_value' => variable_get('notifications_comment_anonymous_notify', NOTIFICATIONS_COMMENT_NODE),
    '#options' => $available_options,
  );
  $form['anonymous']['notifications_comment_anonymous_method'] = array(
    '#type' => 'select',
    '#title' => t('Send method'),
    '#options' => messaging_method_list(),
    '#default_value' => variable_get('notifications_comment_anonymous_method', 'mail'),
    '#description' => t('Only mail methods are supported for now for anonymous users.'),
  );

  return system_settings_form($form);  
}
