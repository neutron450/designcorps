<!-- <pre>
<?php
	//print_r($form['field_profile_501c3_status']);
?>
</pre> -->
<?php
	$error_messages = $_SESSION['messages']['error'];
	
	if(!empty($error_messages)) {
	  print '<div id="register-error-messages" class="messages error">';
	  print '<p style="font-weight: bold; padding: 10px 0 0 10px">Please correct the following errors:</p>';
	  print '<ul>';
  	foreach($error_messages as $error) {
  	  print "<li>". $error ."</li>";
  	}
  	print '</ul>';
  	print '</div>';
  	unset($error_messages);
	}
	
	if (!user_is_anonymous()) {
		global $user;
	}
?>

<?php if (arg(2) == 'client' || arg(2) == 'student' || arg(4) == 'client' || arg(4) == 'student') { ?>
<p>All fields are required unless otherwise noted.</p>

<div class="hidden-label">
<?php print drupal_render($form['name']) ?>
<?php print drupal_render($form['mail']) ?>
</div>

<?php if (arg(2) == 'client' || arg(4) == 'client'): ?>
<fieldset class="hidden-label">
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

<fieldset class="hidden-label">
	<legend>Primary Contact</legend>
	<?php
		print drupal_render($form['field_profile_first_name_primary']);
		print drupal_render($form['field_profile_last_name_primary']);
	if (arg(2) == 'client' || arg(4) == 'client'):
		print drupal_render($form['field_profile_title_primary']);
	endif;
	if (arg(2) == 'student' || arg(4) == 'student'):
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

<?php if (arg(2) == 'client' || arg(4) == 'client'): ?>
	<fieldset class="hidden-label">
		<legend>Secondary Contact</legend>
		<?php print drupal_render($form['field_profile_first_name_second']) ?>
		<?php print drupal_render($form['field_profile_last_name_second']) ?>
		<?php print drupal_render($form['field_profile_title_second']) ?>
		<?php print drupal_render($form['field_profile_email_second']) ?>
		<?php print drupal_render($form['field_profile_phone_second']) ?>
	</fieldset>
<?php endif; ?>

<?php if (arg(2) == 'client' || arg(4) == 'client'):
	print drupal_render($form['field_profile_semester_client']);
endif;
if (arg(2) == 'student' || arg(4) == 'student'):
	print drupal_render($form['field_profile_semester_student']);
	print drupal_render($form['field_profile_concentration']);
	print drupal_render($form['field_profile_credits']);
endif; ?>

<?php if (arg(2) == 'client' || arg(4) == 'client'): ?>
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
		print drupal_render($form['field_profile_timeline_deadline']); ?>
		<div class="hidden-label">
	<?php print drupal_render($form['field_profile_budget']); ?>
		</div>
	<?php
		print drupal_render($form['field_profile_approvals']); ?>
		<div class="form-item" id="edit-field-profile-vendor-contact-0-value-wrapper">
			<label for="edit-field-profile-vendor-contact-0-value">Please list any vendors with whom you would prefer to work or are required to work, along with their contact information. You may also indicate if you
	would like Design Corps to recommend vendors. (Optional)</label>
			<textarea cols="60" rows="5" name="field_profile_vendor_contact[0][value]" id="edit-field-profile-vendor-contact-0-value" class="form-textarea resizable"></textarea>
		</div>
	
	<fieldset>
		<legend>Uploads</legend>
		<?php print drupal_render($form['field_profile_design_examples']) ?>
		<?php print drupal_render($form['field_profile_mandatory_content']) ?>
		<?php print drupal_render($form['field_profile_mandatory_artwork']) ?>
	</fieldset>
<?php endif; ?>

<?php if (arg(2) == 'student') {
	print drupal_render($form['field_profile_info_notes_student']);
} else {
	print drupal_render($form['field_profile_info_notes_client']);
}

if (arg(2) == 'student') {
	print drupal_render($form['field_profile_portfolio']);
}
	if (!user_is_anonymous() && 
	   (in_array('admin', array_values($user->roles)) || $user->uid == 1)) {
		print drupal_render($form['notify']);
	}
	print drupal_render($form['form_build_id']);
	print drupal_render($form['form_token']);
	print drupal_render($form['form_id']);
	print drupal_render($form['submit']);

// If an admin who is logged in and looking to create a new admin user
} else if (!user_is_anonymous() && 
		  (in_array('admin', array_values($user->roles)) || $user->uid == 1) && 
		  arg(3) == 'create' && arg(4) == 'admin') {
	print("<pre>");
	//print_r($form['account']);
	print("</pre>");
	print drupal_render($form['account']['name']);
	print drupal_render($form['account']['mail']);
	print drupal_render($form['account']['pass']);
?>	
<fieldset>
	<legend>Primary Contact</legend>
	<?php
		print drupal_render($form['field_profile_first_name_primary']);
		print drupal_render($form['field_profile_last_name_primary']);
		/* print drupal_render($form['field_profile_address_1_primary']);
		print drupal_render($form['field_profile_address_2_primary']);
		print drupal_render($form['field_profile_city_primary']);
		print drupal_render($form['field_profile_state_primary']);
		print drupal_render($form['field_profile_postal_code_primar']);
		print drupal_render($form['field_profile_website_primary']); */
		print drupal_render($form['field_profile_email_primary']);
		print drupal_render($form['field_profile_phone_primary']);
	?>
</fieldset>
<?php
	print drupal_render($form['account']['status']);
	print drupal_render($form['account']['roles_assign']);
	print drupal_render($form['account']['notify']);
	print drupal_render($form['form_build_id']);
	print drupal_render($form['form_token']);
	print drupal_render($form['form_id']);
	print drupal_render($form['submit']);
	
// If an admin who is logged in and looking to create a user
} else if (isset($user->roles) && (in_array('admin', array_values($user->roles)) || $user->uid == 1)) { ?>
	<p>Create a new user:</p>
	<ul>
		<!-- <li><a href="/admin/user/user/create/student">Student</a></li> -->
		<!-- <li><a href="/admin/user/user/create/client">Client</a></li> -->
		<li><a href="/admin/user/user/create/admin">Admin</a></li>
	</ul>
<?php } else { ?>
<p>Apply as a <a href="/user/register/student">student</a> or <a href="/user/register/client">client.</p>
<?php } ?>

<script type="text/javascript">
	if (Drupal.jsEnabled) {
	    $(document).ready(function()
	    {
	        var lab1 = $('#user-register label');
	        lab1.each(function() { $(this).html($(this).html().replace(":", "")); });
			var lab2 = $('span.form-required');
			lab2.each(function() { $(this).html($(this).html().replace("*", "")); });
	    });
	}
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $("input:text").labelify({
      text: "label"
    });
	$(".normal-label label").css("display","inherit");
  });
</script>