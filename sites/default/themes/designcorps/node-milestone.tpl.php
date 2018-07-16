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
			<?php print $project_node->title ?> <?php !empty($project_node->field_job_no[0]['value']) ? print("(". $project_node->field_job_no[0]['value'] .")") : "" ?> / <span class="project-title">Milestones</span>
		</h1>
		
		<div id="my-milestones">
			<div id="my-milestones-inner">
				<div id="milestone-headings">
					<div id="milestone-due-date" class="heading">DUE DATE</div>
					<div id="milestone-description" class="heading">DESCRIPTION</div>
					<div id="milestone-client" class="heading">CLIENT</div>
					<div id="milestone-project" class="heading">PROJECT</div>
					<div id="milestone-project-job-no" class="heading">JOB#</div>
					<div class="clear"></div>
				</div>
				<div id="milestone-info">
					<div class="milestone-due-date">
						<?php print $node->field_milestone_date[0]['view'] ?>
					</div>
					<div class="milestone-title">
						<?php print $node->title ?>
					</div>
					<div class="milestone-client">
						<?php print $client_profile_node->title ?>
					</div>
					<div class="milestone-project">
						<?php print $project_node->title ?>
					</div>
					<div class="milestone-project-job-no">
						<?php print $project_node->field_job_no[0]['value'] ?>
					</div>
				</div>
			</div>
		</div>

		<?php if (!empty($node->content['body']['#value'])) { ?>
		<div id="project-description">
			<?php print $node->content['body']['#value'] ?>
		</div>
		<?php } ?>
		
		<div class="post-line">
			<div class="links">
			    <?php print l('Reply', 'comment/reply/'. $node->nid) ?> |
				<?php print l('Edit', 'node/'. $node->nid .'/edit') ?> |
				<?php print l('Delete', 'node/'. $node->nid .'/delete') ?>
			</div>
			<strong>Posted by:</strong> <?php print $node->name ?> at <?php print date('g:ia F d, Y', $node->created) ?>
		</div>

		<div id="project-attachments">
			<h3>ATTACHMENTS <span class="filesize-heading">SIZE</span></h3>
			<?php foreach ($node->files as $file) { ?>
				<div class="file">
					<div class="filename">
						<?php print l($file->description, $file->filepath) ?>
					</div>
					<div class="filesize">
						<?php print format_size($file->filesize) ?>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
		</div>
		
		<?php print $comments ?>
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
			<?php foreach ($managers as $manager): ?>
				<div class="assignee">
					<a href="/user/<?php print $manager->uid ?>">
						<div class="name"><?php print $manager->name ?></div>
						<div class="role">Admin</div>
						<div class="clear"></div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		
		<div class="assigned-group">
			<?php foreach ($clients as $client): ?>
				<div class="assignee">
					<a href="/user/<?php print $client->uid ?>">
						<div class="name"><?php print $client->name ?></div>
						<div class="role">Client</div>
						<div class="clear"></div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		
		<div class="assigned-group">
			<?php foreach ($students as $student): ?>
				<div class="assignee">
					<a href="/user/<?php print $student->uid ?>">
						<div class="name"><?php print $student->name ?></div>
						<div class="role">Student</div>
						<div class="clear"></div>
					</a>
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