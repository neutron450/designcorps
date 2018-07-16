<div id="profile-name-address">
	<div id="profile-logo">
		<?php print theme('imagecache', 'client_logo_header', $client_profile_node->field_profile_client_logo[0]['filepath']);
?>
	</div>
	<div id="profile-header-info">
		<div id="profile-header-name">
			<?php print l($client_profile_node->field_profile_name_org[0]['value'], 'user/'. $client_profile_node->uid) ?>
		</div>
		<div id="profile-header-address-1">
			<?php print $client_profile_node->field_profile_address_1_org[0]['value'] ?>
		</div>
		<div id="profile-header-city-state-zip">
			<?php print $client_profile_node->field_profile_city_org[0]['value'] ?>, <?php print $client_profile_node->field_profile_state_org[0]['value'] ?> <?php print $client_profile_node->field_profile_postal_code_org[0]['value'] ?>
		</div>
		<div id="profile-header-website">
			<?php print l($client_profile_node->field_profile_website_org[0]['value'], $client_profile_node->field_profile_website_org[0]['value']) ?>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div id="project-left">
	<div id="project-left-inner">
		<h1>
			Project / <span class="project-title"><?php print $node->title ?> <?php !empty($node->field_job_no[0]['value']) ? print("(". $node->field_job_no[0]['value'] .")") : "" ?></span>
		</h1>
		
		<div id="project-headings">
			<div id="project-deliverables-heading" class="heading">Deliverables</div>
			<div id="project-job-no-heading" class="heading">Job#</div>
			<div class="clear"></div>
		</div>
		
		<div id="project-deliverables-job-no">
			<?php if (!empty($deliverables_tags)) { ?>
			<div id="project-deliverables">
				<?php print $deliverables_tags ?>
			</div>
			<?php } ?>

			<?php if (!empty($node->field_job_no[0]['value'])) { ?>
			<div id="project-job-no">
				<?php print $node->field_job_no[0]['value'] ?>
			</div>
			<?php } ?>
			<div class="clear"></div>
		</div>

		<?php if (!empty($node->content['body']['#value'])) { ?>
		<div id="project-description">
			<h3>DESCRIPTION</h3>
			<?php print $node->content['body']['#value'] ?>
		</div>
		<?php } ?>

		<?php if (!empty($node->field_project_notes[0]['value'])) { ?>
		<div id="project-notes">
			<h3>NOTES</h3>
			<?php print $node->field_project_notes[0]['value'] ?>
		</div>
		<?php } ?>

		<div id="project-attachments">
			<h3>ATTACHMENTS</h3>
			<ul>
				<?php foreach ($node->files as $file) { ?>
					<li><?php print l($file->description, $file->filepath) ?></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>

<div id="project-right">
	<div id="project-semester-status">
		<div id="project-semesters">
			<h2>Semester</h2>
			<ul>
			<?php foreach ($semesters as $semester): ?>
				<li><?php print $semester ?></li>
			<?php endforeach; ?>
			</ul>
		</div>
	</div>

	<div id="project-contacts">
		<div id="primary-contact">
			<h2>Primary Contact</h2>
			<div id="project-contact-name">
				<?php print $client_profile_node->field_profile_first_name_primary[0]['value'] ?> <?php print $client_profile_node->field_profile_last_name_primary[0]['value'] ?>
			</div>
			<div class="project-contact-title">
				<?php print $client_profile_node->field_profile_title_primary[0]['value'] ?>
			</div>
			<div class="project-contact-email">
				<?php print $client_profile_node->field_profile_email_primary[0]['email'] ?>
			</div>
			<div class="project-contact-phone">
				<?php if (!empty($client_profile_node->field_profile_phone_primary[0]['number'])) {
					print(preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $client_profile_node->field_profile_phone_primary[0]['number']));
					!empty($client_profile_node->field_profile_phone_primary[0]['extension']) ? print " x" .$client_profile_node->field_profile_phone_primary[0]['extension'] : "";
				} ?>
			</div>
		</div>
		<?php if (!empty($client_profile_node->field_profile_first_name_second[0]['value'])): ?>
		<div id="secondary-contact">
			<h2>Secondary Contact</h2>
			<div class="project-contact-name">
				<?php print $client_profile_node->field_profile_first_name_second[0]['value'] ?> <?php print $client_profile_node->field_profile_last_name_second[0]['value'] ?>
			</div>
			<div class="project-contact-title">
				<?php print $client_profile_node->field_profile_title_second[0]['value'] ?>
			</div>
			<div class="project-contact-email">
				<?php print $client_profile_node->field_profile_email_second[0]['email'] ?>
			</div>
			<div class="project-contact-phone">
				<?php if (!empty($client_profile_node->field_profile_phone_second[0]['number'])) {
					print(preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $client_profile_node->field_profile_phone_second[0]['number']));
					!empty($client_profile_node->field_profile_phone_second[0]['extension']) ? print " x" .$client_profile_node->field_profile_phone_second[0]['extension'] : "";
				} ?>
			</div>
		</div>
		<?php endif; ?>
	</div>

	<div id="projects">
		<h2>Projects</h2>
		<?php print $related_projects ?>
	</div>

	<div id="milestones">
		<h2>Milestones</h2>
		<?php print $milestones ?>
	</div>

	<div id="assigned-to">
		<h2>Assigned to</h2>
		<div class="assigned-group">
			<?php foreach ($node->field_managers as $manager): ?>
				<div class="assignee">
					<div class="name"><?php print $manager['view'] ?></div>
					<div class="role">Admin</div>
					<div class="clear"></div>
				</div>
			<?php endforeach; ?>
		</div>
		
		<div class="assigned-group">
			<?php foreach ($node->field_clients as $client): ?>
				<div class="assignee">
					<div class="name"><?php print $client['view'] ?></div>
					<div class="role">Client</div>
					<div class="clear"></div>
				</div>
			<?php endforeach; ?>
		</div>
		
		<div class="assigned-group">
			<?php foreach ($node->field_students as $student): ?>
				<div class="assignee">
					<div class="name"><?php print $student['view'] ?></div>
					<div class="role">Student</div>
					<div class="clear"></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div id="profile-uploads">
		<h2>Uploads</h2>
		<h3>Design Examples</h3>
		<div class="upload">
			<a href="<?php print $client_profile_node->field_profile_design_examples[0]['filepath'] ?>">
				<div class="filename"><?php print $client_profile_node->field_profile_design_examples[0]['filename'] ?></div>
				<div class="filesize"><?php print format_size($client_profile_node->field_profile_design_examples[0]['filesize']) ?></div>
				<div class="clear"></div>
			</a>
		</div>

		<h3>Content</h3>
		<div class="upload">
			<a href="<?php print $client_profile_node->field_profile_mandatory_content[0]['filepath'] ?>">
				<div class="filename"><?php print $client_profile_node->field_profile_mandatory_content[0]['filename'] ?></div>
				<div class="filesize"><?php print format_size($client_profile_node->field_profile_mandatory_content[0]['filesize']) ?></div>
				<div class="clear"></div>
			</a>
		</div>

		<h3>Artwork</h3>
		<div class="upload">
			<a href="<?php print $client_profile_node->field_profile_mandatory_artwork[0]['filepath'] ?>">
				<div class="filename"><?php print $client_profile_node->field_profile_mandatory_artwork[0]['filename'] ?></div>
				<div class="filesize"><?php print format_size($client_profile_node->field_profile_mandatory_artwork[0]['filesize']) ?></div>
				<div class="clear"></div>
			</a>
		</div>
	</div>
</div>