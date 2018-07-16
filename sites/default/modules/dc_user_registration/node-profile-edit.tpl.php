<pre>
<?php
	//print_r($form['#parameters'][2]->name);
	print_r($user_type);
	//print $form['field_profile_role']['#default_value'][0]['value'];
?>
</pre>

<?php print drupal_render($form['title']) ?>

<?php if ($form['user_type']['#value'] == 'client'): ?>
<fieldset>
	<legend>Organization</legend>
	<?php print drupal_render($form['field_profile_name_org']) ?>
	<?php print drupal_render($form['field_profile_address_1_org']) ?>
	<?php print drupal_render($form['field_profile_address_2_org']) ?>
	<?php print drupal_render($form['field_profile_city_org']) ?>
	<?php print drupal_render($form['field_profile_state_org']) ?>
	<?php print drupal_render($form['field_profile_postal_code_org']) ?>
	<?php print drupal_render($form['field_profile_website_org']) ?>
</fieldset>
<?php endif; ?>

<fieldset>
	<legend>Primary Contact</legend>
	<?php
		print drupal_render($form['field_profile_first_name_primary']);
		print drupal_render($form['field_profile_last_name_primary']);
	if ($form['user_type']['#value'] == 'client'):
		print drupal_render($form['field_profile_title_primary']);
	endif;
	if ($form['user_type']['#value'] == 'student'):
		print drupal_render($form['field_profile_address_1_primary']);
		print drupal_render($form['field_profile_address_2_primary']);
		print drupal_render($form['field_profile_city_primary']);
		print drupal_render($form['field_profile_state_primary']);
		print drupal_render($form['field_profile_postal_code_primar']);
		print drupal_render($form['field_profile_website_primary']);
	endif;
		print drupal_render($form['field_profile_email_primary']);
		print drupal_render($form['field_profile_phone_primary']);
	?>
</fieldset>

<?php if ($form['user_type']['#value'] == 'client'): ?>
	<fieldset>
		<legend>Secondary Contact</legend>
		<?php print drupal_render($form['field_profile_first_name_second']) ?>
		<?php print drupal_render($form['field_profile_last_name_second']) ?>
		<?php print drupal_render($form['field_profile_title_second']) ?>
		<?php print drupal_render($form['field_profile_email_second']) ?>
		<?php print drupal_render($form['field_profile_phone_second']) ?>
	</fieldset>
<?php endif;

if ($form['user_type']['#value'] == 'client'):
	print drupal_render($form['field_profile_semester_client']);
endif;
if ($form['user_type']['#value'] == 'student'):
	print drupal_render($form['field_profile_semester_student']);
	print drupal_render($form['field_profile_concentration']);
	print drupal_render($form['field_profile_credits']);
endif;

if ($form['user_type']['#value'] == 'client' || $form['user_type']['#value'] == 'student'):
	print drupal_render($form['field_profile_semesters']);
endif;

if ($form['user_type']['#value'] == 'client'): ?>
	<fieldset>
		<legend>Design Brief</legend>
		<?php print drupal_render($form['field_profile_org_description']) ?>
		<?php print drupal_render($form['field_profile_mission']) ?>
		<?php print drupal_render($form['field_profile_501c3_status']) ?>
		<?php print drupal_render($form['field_profile_project_descriptio']) ?>
		<?php print drupal_render($form['field_profile_objectives']) ?>
		<?php print drupal_render($form['field_profile_single_message']) ?>
		<?php print drupal_render($form['field_profile_creative_consider']) ?>
		<?php print drupal_render($form['field_profile_existing_guideline']) ?>
		<?php print drupal_render($form['field_profile_comp_context_ind']) ?>
	</fieldset>
	
	<?php
		print drupal_render($form['field_profile_deliverables']);
		print drupal_render($form['field_profile_audience']);
		print drupal_render($form['field_profile_timeline_deadline']);
		print drupal_render($form['field_profile_budget']);
		print drupal_render($form['field_profile_approvals']);
	?>
	<div class="form-item" id="edit-field-profile-vendor-contact-0-value-wrapper">
		<label for="edit-field-profile-vendor-contact-0-value">Please list any vendors with whom you would prefer to work or are required to work, along with their contact information. You may also indicate if you
would like Design Corps to recommend vendors.</label>
		<textarea cols="60" rows="5" name="field_profile_vendor_contact[0][value]" id="edit-field-profile-vendor-contact-0-value" class="form-textarea resizable"></textarea>
	</div>

	<fieldset>
		<legend>Uploads</legend>
		<?php print drupal_render($form['field_profile_design_examples']) ?>
		<?php print drupal_render($form['field_profile_mandatory_content']) ?>
		<?php print drupal_render($form['field_profile_mandatory_artwork']) ?>
	</fieldset>
<?php endif; ?>

<?php if ($form['user_type']['#value'] == 'student') {
	print drupal_render($form['field_profile_info_notes_student']);
	print drupal_render($form['field_profile_student_photo']);
	print drupal_render($form['field_profile_portfolio']);
	print drupal_render($form['field_profile_rep_work']);
	print drupal_render($form['field_profile_quote']);
} else if ($form['user_type']['#value'] == 'client') {
	print drupal_render($form['field_profile_info_notes_client']);
} ?>

<?php if (in_array('admin', array_values($user->roles)) || in_array('superadmin', array_values($user->roles))) { ?>
	<fieldset>
		<legend>Admin Only</legend>
		<?php
			if ($form['user_type']['#value'] == 'client') {
				print drupal_render($form['field_profile_client_logo']);
				print drupal_render($form['taxonomy']);
				print drupal_render($form['field_profile_status']);
				print drupal_render($form['field_profile_designers']);
				print drupal_render($form['field_profile_client_description']);
				print drupal_render($form['field_profile_rep_work']);
				print drupal_render($form['field_profile_featured_client']);
			}
			
			if ($form['user_type']['#value'] == 'client' || $form['user_type']['#value'] == 'student'):
				print drupal_render($form['field_profile_rep_work_approved']);
			endif; ?>
			<?php
				print drupal_render($form['path']);
				print drupal_render($form['author']);
 				print drupal_render($form['options']);
			?>
	</fieldset>
<?php } ?>

<?php print drupal_render($form['form_build_id']) ?>
<?php print drupal_render($form['form_id']) ?>
<?php print drupal_render($form['form_token']) ?>
<?php print drupal_render($form['buttons']) ?>