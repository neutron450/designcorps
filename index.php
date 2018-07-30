<?php

//phpinfo();
//die();

require __DIR__ . '/sites/default/sitevars.inc.php';

// ini_set('error_reporting', E_ERROR & ~E_WARNING);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
ini_set('log_errors', true);
// ini_set("error_log", "/home/penelope/Sites/dcorps/php-error.log");
error_log( " - - - - - - - - - - - - - - - - " );
//echo 'okay';
//die();

/**
 * Silence declaration warnings
 */
if (PHP_MAJOR_VERSION >= 7) {
	set_error_handler(function ($errno, $errstr) {
		return strpos($errstr, 'Declaration of') === 0;
	}, E_WARNING);
}

/**
 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * The routines here dispatch control to the appropriate handler, which then
 * prints the appropriate page.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 */

require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

/* TODO comment cache clearing code before deploying *///
drupal_clear_css_cache();
$tables = array(
	'cache',
	'cache_content',
	'cache_filter',
	'cache_menu',
	'cache_page',
	'cache_views',
);
foreach ($tables as $table) {
	cache_clear_all('*', $table, TRUE);
}
drupal_set_message('Cache cleared.');

/*
TRUNCATE TABLE `cache`;
TRUNCATE TABLE `cache_content`;
TRUNCATE TABLE `cache_filter`;
TRUNCATE TABLE `cache_menu`;
TRUNCATE TABLE `cache_page`;
TRUNCATE TABLE `cache_views`;
*/

$return = menu_execute_active_handler();

// Menu status constants are integers; page content is a string.
if (is_int($return)) {
  switch ($return) {
    case MENU_NOT_FOUND:
      drupal_not_found();
      break;
    case MENU_ACCESS_DENIED:
      drupal_access_denied();
      break;
    case MENU_SITE_OFFLINE:
      drupal_site_offline();
      break;
  }
}
elseif (isset($return)) {
  // Print any value (including an empty string) except NULL or undefined:
  print theme('page', $return);
}

drupal_page_footer();
