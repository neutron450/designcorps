<?php
	$profile_header_info = '<div id="profile-name-address"><div id="profile-logo">';
	
	// If client
	if (!empty($account_profile->field_profile_name_org[0]['value'])) {
		if (!empty($account_profile->field_profile_client_logo[0]['filepath'])) {
			$profile_header_info .= theme('imagecache', 'client_logo_header', $account_profile->field_profile_client_logo[0]['filepath']);
		} else {
			$profile_header_info .= theme('imagecache', 'client_logo_header', 'sites/designcorps.thislooksnice.com/files/user_profile_photos/default-profile-photo.jpg');
		}
		
		$profile_header_info .= '</div><div id="profile-header-info"><div id="profile-header-name">';
		$profile_header_info .= $account_profile->field_profile_name_org[0]['value'];
		$profile_header_info .= '</div><div id="profile-header-address-1">';
		$profile_header_info .= $account_profile->field_profile_address_1_org[0]['value'];
		$profile_header_info .= '</div><div id="profile-header-city-state-zip">';
		$profile_header_info .= $account_profile->field_profile_city_org[0]['value']. ', '. $account_profile->field_profile_state_org[0]['value'];
		$profile_header_info .= $account_profile->field_profile_postal_code_org[0]['value'];
		$profile_header_info .= '</div><div id="profile-header-website">';
		$profile_header_info .= l($account_profile->field_profile_website_org[0]['value'], $account_profile->field_profile_website_org[0]['value']);
		$profile_header_info .= '</div></div></div>';
	
	// If student or admin
	} else {
		if (!empty($account->picture)) {
			$profile_header_info .= theme('imagecache', 'client_logo_header', $account->picture);
		} else {
			$profile_header_info .= theme('imagecache', 'client_logo_header', 'sites/designcorps.thislooksnice.com/files/user_profile_photos/default-profile-photo.jpg');
		}
		
		$profile_header_info .= '</div><div id="profile-header-info"><div id="profile-header-name">';
		$profile_header_info .= $account_profile->field_profile_first_name_primary[0]['value'] .' '. $account_profile->field_profile_last_name_primary[0]['value'];
		$profile_header_info .= '</div>';
		
		if (isset($semesters)) {
			$profile_header_info .= '<div id="profile-semesters"><ul>';
				foreach ($semesters as $semester):
					$profile_header_info .= '<li>'. $semester .'</li>';
				endforeach;
			$profile_header_info .= '</ul></div>';
		}
		$profile_header_info .= '<div id="profile-header-email-primary">';
		$profile_header_info .= $account_profile->field_profile_email_primary[0]['email'];
		$profile_header_info .= '</div><div id="profile-header-phone-primary">';
		
		if (!empty($account_profile->field_profile_phone_primary[0]['number'])) {
			$profile_header_info .= preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $account_profile->field_profile_phone_primary[0]['number']);
			!empty($account_profile->field_profile_phone_primary[0]['extension']) ? $profile_header_info .= " x". $account_profile->field_profile_phone_primary[0]['extension'] : "";
		}
		
		$profile_header_info .= '</div><div id="profile-header-concentration">';
		$profile_header_info .= ucwords(str_replace('_', ' ', $account_profile->field_profile_concentration[0]['value']));
		$profile_header_info .= '</div>';
		
		if (!empty($account_profile->field_profile_credits[0]['value'])) {
			$profile_header_info .= '<div id="profile-header-credits">';
			$profile_header_info .= $account_profile->field_profile_credits[0]['value'] .'credits</div>';
		}
		$profile_header_info .= '</div>';
	}
$profile_header_info .= '</div>';

drupal_set_content('header', $profile_header_info);