<?php

/**
 * Implementation of HOOK_theme().
 */
function designcorps_theme(&$existing, $type, $theme, $path) {

  $hooks['user_register'] = array(
      'arguments' => array('form' => NULL),
      // and if I use a template file, ie: user-register.tpl.php
      'template' => 'user-register',
  );
  $hooks['user_login_block'] = array(
      'template' => 'user-login-block',
      'arguments' => array('form' => NULL),
      // other theme registration code...
    );
  return $hooks;
}

function designcorps_menu_item_link($link) {
  // Do not render tab or link for "Create new account" pointing to "user/register".
  if ($link['title'] == t('Create new account') && $link['path'] == 'user/register') return;

  if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }

  return l($link['title'], $link['href'], $link['localized_options']);
}

function designcorps_preprocess_node(&$variables) {
  $node = $variables['node'];

  // Set user account page title as org name (client) or first and last name (student/admin)
  if (user_is_anonymous() && arg(0) == 'user') {
	if (!empty($node->field_profile_name_org[0]['value'])) {
		drupal_set_title($node->field_profile_name_org[0]['value']);
	} else {
		drupal_set_title($node->field_profile_first_name_primary[0]['value'] ." ". $node->field_profile_last_name_primary[0]['value']);
	}
  } else if ($node->type == 'profile') {
	// If a client
	if (!empty($node->field_profile_name_org[0]['value'])) {
		$variables['user_type'] = "client";
		//drupal_set_title($node->field_profile_name_org[0]['value']);

		if (isset($node->taxonomy)) {
			//$tags = taxonomy_node_get_terms_by_vocabulary($node, 1);
			$all_terms = taxonomy_node_get_terms($node);
			$variables['industry_tags'] = '';
			$variables['deliverables_tags'] = '';

			foreach ($all_terms as $term) {
				if ($term->vid == 4) {
					$variables['industry_tags'] .= ' '. l($term->name, 'portfolio/client-type/'. $term->name) .',';
				}

				if ($term->vid == 5) {
					$variables['deliverables_tags'] .= ' '. l($term->name, 'portfolio/medium/'. $term->name) .',';
				}
			}

			$variables['industry_tags'] = substr($variables['industry_tags'], 1, -1);
			$variables['deliverables_tags'] = substr($variables['deliverables_tags'], 1, -1);
		}

		if (!empty($node->field_profile_designers)) {
			$variables['designers'] = '';

			foreach ($node->field_profile_designers as $designer) {
				$query = "SELECT n.nid AS nid FROM {node} n WHERE n.type = '%s' AND n.uid = %d";
				$result = db_query($query, $node->type, $designer['uid']);
				$row = db_fetch_object($result);
				$designer_user_profile = node_load($row->nid);
				$variables['designers'] .= ' '. l($designer_user_profile->field_profile_first_name_primary[0]['value'] ." ". $designer_user_profile->field_profile_last_name_primary[0]['value'], drupal_get_path_alias("node/". $row->nid)) .',';
			}

			$variables['designers'] = substr($variables['designers'], 1, -1);
		}

		/* if (strlen($node->field_profile_design_examples[0]['filename']) > 25) {
			$filename = $node->field_profile_design_examples[0]['filename']. " ";
	        $filename = substr($filename, 0, 25);
	        $filename = substr($filename, 0 , strrpos($filename,' '));
	        $variables['node']->field_profile_design_examples[0]['filename'] = $filename. "...";
		}

		if (strlen($node->field_profile_mandatory_content[0]['filename']) > 25) {
			$filename = $node->field_profile_mandatory_content[0]['filename']. " ";
	        $filename = substr($filename, 0, 25);
	        $filename = substr($filename, 0 , strrpos($filename,' '));
	        $variables['node']->field_profile_mandatory_content[0]['filename'] = $filename. "...";
		}

		if (strlen($node->field_profile_mandatory_artwork[0]['filename']) > 25) {
			$filename = $node->field_profile_mandatory_artwork[0]['filename']. " ";
	        $filename = substr($filename, 0, 25);
	        $filename = substr($filename, 0 , strrpos($filename,' '));
	        $variables['node']->field_profile_mandatory_artwork[0]['filename'] = $filename. "...";
		} */
	} else { // a student
		$variables['user_type'] = "student";
		//drupal_set_title($node->field_profile_first_name_primary[0]['value'] ." ". $node->field_profile_last_name_primary[0]['value']);

		$clients = array();
		$query = "SELECT n.nid AS nid FROM {content_field_students} n WHERE n.field_students_uid = %d";
		$result = db_query($query, $node->uid);

		while ($row = db_fetch_object($result)) {
			$client_query = "SELECT n.field_clients_uid AS field_clients_uid FROM {content_field_clients} n WHERE n.nid = %d";
			$client_result = db_query($client_query, $row->nid);

			while ($client_row = db_fetch_object($client_result)) {
				if (!in_array($client_row->field_clients_uid, $clients)) {
					$clients[] = $client_row->field_clients_uid;
				}
			}
		}

		$variables['semesters'] = array();

		if (!empty($node->field_profile_semesters[0]['nid'])) {
			foreach ($node->field_profile_semesters as $semester) {
				$query = "SELECT n.title AS title FROM {node} n WHERE n.nid = %s";
				$result = db_query($query, $semester['nid']);
				$row = db_fetch_object($result);
				$variables['semesters'][] = $row->title;
			}
		}

		//$variables['primary_semester_year'] = "'" .substr($variables['semesters'][0], -2, 2);

		foreach ($clients as $client_uid) {
			$query = "SELECT n.nid AS nid FROM {node} n WHERE n.type = '%s' AND n.uid = %d";
			$result = db_query($query, $node->type, $client_uid);
			$row = db_fetch_object($result);
			$client_user_profile = node_load($row->nid);
			$variables['clients'][] = l($client_user_profile->field_profile_name_org[0]['value'], $client_user_profile->path);
		}
	}

	//$project_node = node_load($node->field_project[0]['nid']);

	//print $project_node->field_referenced_users[0]['value'];

	//$ref_users = explode(', ', $project_node->field_referenced_users[0]['value']);

	/* print_r($ref_users);
	print("<br />");
	print($user->uid); */

	/* print("<pre>");
	print_r($node);
	print("</pre>"); */

	/* if (!in_array($user->uid, $ref_users) &&
		$user->uid !== 1) {
		drupal_set_title("Access Denied");

		$vars['content'] = '<p>You do not have access to this content.</p>';
		$vars['links'] = '';

	} */
  }

  if ($node->type == 'project' || $node->type == 'milestone') {
	  if ($node->type == 'project') {
		  if (isset($node->taxonomy)) {
			  //$tags = taxonomy_node_get_terms_by_vocabulary($node, 1);
			  $all_terms = taxonomy_node_get_terms($node);
			  $variables['deliverables_tags'] = '';

			  foreach ($all_terms as $term) {
				  if ($term->vid == 5) {
					  $variables['deliverables_tags'] .= ' '. $term->name .',';
				  }
			  }

			  $variables['deliverables_tags'] = substr($variables['deliverables_tags'], 1, -1);
		  }

		  // Grab client profile node to display project contact info
		  $query = "SELECT n.nid AS nid FROM {node} n WHERE n.type = '%s' AND n.uid = %d";
		  $result = db_query($query, 'profile', $node->field_clients[0]['uid']);
		  $row = db_fetch_object($result);
		  $variables['client_profile_node'] = node_load($row->nid);

		  // Milestones
		  $view = views_get_view('assigned_milestones');
		  $view->set_display('block_2');
		  $view->set_arguments(array($node->nid));
		  $variables['milestones'] = $view->preview();
	  }

	  if ($node->type == 'milestone') {
	  	  $variables['comments'] = $variables['comment_form'] = '';
		  if (module_exists('comment') && isset($variables['node'])) {
		    $variables['comments'] = comment_render($variables['node']);
		    $variables['comment_form'] = drupal_get_form('comment_form',
		    array('nid' => $variables['node']->nid));
		  }
		  $variables['node']->comment = 0;

		  // Grab project node to display project info
		  $variables['project_node'] = node_load($node->field_project[0]['nid']);

		  $variables['managers'] = array();
		  foreach ($variables['project_node']->field_managers as $manager) {
			$variables['managers'][] = user_load($manager['uid']);
		  }

		  $variables['clients'] = array();
		  foreach ($variables['project_node']->field_clients as $client) {
			$variables['clients'][] = user_load($client['uid']);
		  }

		  $variables['students'] = array();
		  foreach ($variables['project_node']->field_students as $student) {
			$variables['students'][] = user_load($student['uid']);
		  }

		  /* $query = "SELECT n.nid AS nid FROM {node} n WHERE n.type = '%s' AND n.uid = %d";
		  $result = db_query($query, 'profile', $variables['project_node']->field_clients[0]['uid']);
		  $row = db_fetch_object($result);
		  $variables['client_profile_node'] = node_load($row->nid); */

	  	  // Grab client profile node to display project contact info
		  $query = "SELECT n.nid AS nid FROM {node} n WHERE n.type = '%s' AND n.uid = %d";
		  $result = db_query($query, 'profile', $variables['project_node']->field_clients[0]['uid']);
		  $row = db_fetch_object($result);
		  $variables['client_profile_node'] = node_load($row->nid);

		  // Milestones
		  $view = views_get_view('assigned_milestones');
		  $view->set_display('block_2');
		  $view->set_arguments(array($variables['project_node']->nid));
		  $variables['milestones'] = $view->preview();
	  }

	  // Semester(s)
	  $query = "SELECT n.title AS title FROM node n WHERE n.nid = %s";
	  $result = db_query($query, $variables['client_profile_node']->field_profile_semesters[0]['nid']);
	  $variables['semesters'] = array();

	  while ($row = db_fetch_object($result)) {
		  $variables['semesters'][] = $row->title;
	  }

	  // Related projects
	  $view = views_get_view('projects');
	  $view->set_display('block_3');
	  $view->set_arguments(array($variables['client_profile_node']->uid));
	  $variables['related_projects'] = $view->preview();
  }

  if ($node->type == 'news_item') {
	  if (isset($node->taxonomy)) {
		  $all_terms = taxonomy_node_get_terms($node);
		  $variables['news_item_tags'] = '';

		  foreach ($all_terms as $term) {
			  if ($term->vid == 3) {
				  $variables['news_item_tags'] .= ' '. l($term->name, drupal_get_path_alias(taxonomy_term_path($term))) .',';
			  }
		  }
		  $variables['news_item_tags'] = substr($variables['news_item_tags'], 1, -1);
	  }
  }
}


function designcorps_preprocess_user_profile(&$variables) {
  // Add template suggestions based on roles
  /* if (in_array('role1', $variables['account']->roles)) {
    $variables['template_files'][] = 'user-profile-role1';
  } */
	$account = $variables['account'];

	$view = views_get_view('assigned_milestones');
	$view->set_display('block_1');
	$view->set_arguments(array($account->uid));
	$variables['assigned_milestones'] = $view->preview();

	$view = views_get_view('projects');
	if (in_array('student', array_values($account->roles))) {
		$view->set_display('block_2');
	} else {
		$view->set_display('block_4');
	}
	$view->set_arguments(array($account->uid));
	$variables['my_clients'] = $view->preview();

	$view = views_get_view('comments');
	$view->set_display('block_1');
	$view->set_arguments(array($account->name));
	$variables['recent_comments'] = $view->preview();

	$query = "SELECT
					f.filename,
					f.filepath,
					f.timestamp
				FROM
					comments c,
					comment_upload cu,
					files f
				WHERE
					c.cid = cu.cid AND
					cu.fid = f.fid AND
					c.uid = %s";

	$result = db_query($query, $account->uid);
	$my_uploads = array();

	while ($row = db_fetch_object($result)) {
		$variables['my_uploads'][] = array('filename' => $row->filename, 'filepath' => $row->filepath, 'timestamp' => $row->timestamp);
	}

	//if (in_array('client', array_values($account->roles))) {
	$query = "SELECT n.nid AS nid FROM node n WHERE n.type = '%s' AND n.uid = %d LIMIT 1";
	$result = db_query($query, 'profile', $account->uid);
	$row = db_fetch_object($result);
	$variables['account_profile'] = node_load($row->nid);
	if (!empty($variables['account_profile']->field_profile_website_org[0]['value'])) {
		$account_profile_url = strtolower($variables['account_profile']->field_profile_website_org[0]['value']);
		if (strpos($account_profile_url, "http://") == 0) {
			$variables['account_profile_url'] = 'http://'. $account_profile_url;
		}
	}

	echo '<pre>';
	print_r($variables['node']);
	echo '</pre>';

	if (!empty($variables['account_profile']) && !empty($variables['account_profile']->field_profile_semesters[0]['nid'])) {
		$query = "SELECT n.title AS title FROM node n WHERE n.nid = %s";
		$result = db_query($query, $variables['account_profile']->field_profile_semesters[0]['nid']);
		$variables['semesters'] = array();

		while ($row = db_fetch_object($result)) {
			$variables['semesters'][] = $row->title;
		}
	}

	// Related projects
	$view = views_get_view('projects');
	$view->set_display('block_3');
	$view->set_arguments(array($account->uid));
	$variables['related_projects'] = $view->preview();
	//}
}

?>