<?php

/**
 * JavaScript callbacks for the userref_access module
 *
 * @file: userref_access.js.inc
 * @author: Elliott Foster
 * @copyright: NewMBC 2010
 */

function userref_access_js() {
  $ret = array(
    'status' => TRUE,
    'data' => '',
  );

  $form_state = array('storage' => NULL, 'submitted' => FALSE);
  $form_build_id = $_POST['form_build_id'];

  $form = form_get_cache($form_build_id, $form_state);

  if ($_POST['userref_access']) {
    $acc = db_fetch_object(db_query("SELECT * FROM {userref_access} WHERE field_id='%s'", $form['#field']['field_name']));
    $form['field']['userref_access_perms'] = array(
      '#type' => 'checkboxes',
      '#title' => t('Permissions'),
      '#options' => array(1 => t('View'), 2 => t('Update'), 4 => t('Delete')),
      '#default_value' => array($acc->grant_view, ($acc->grant_edit * 2), ($acc->grant_delete * 4)),
      '#prefix' => '<div id="userref-access-perm-wrapper">',
      '#suffix' => '</div>',
    );
  }
  else {
    unset($form['field']['userref_access_perms']);
  }

  form_set_cache($form_build_id, $form, $form_state);
  $form += array(
    '#post' => $_POST,
    '#programmed' => FALSE,
  );

  // Rebuild the form.
  $form = form_builder('organic_lists_settings', $form, $form_state);

  if ($_POST['userref_access']) {
    $ret['data'] = drupal_render($form['field']['userref_access_perms']);
  }

  drupal_json($ret);
}
