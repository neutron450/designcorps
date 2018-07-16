<?php
	if (in_array('student', array_values($user->roles)) || in_array('client', array_values($user->roles)) || in_array('admin', array_values($user->roles)) || $user->uid == 1) {
		//print_r(node_load($row->nid));
		if (isset($account_profile) && !empty($account_profile)): ?>
			<div id="profile-name-address">
			
			<?php // If client ?>
			<?php if (!empty($account_profile->field_profile_name_org[0]['value'])) { ?>
					<div id="profile-logo">
						<?php if (!empty($account_profile->field_profile_client_logo[0]['filepath'])) {
							print theme('imagecache', 'client_logo_header', $account_profile->field_profile_client_logo[0]['filepath']);
						} else {
							print theme('imagecache', 'client_logo_header', 'sites/default/files/user_profile_photos/default-profile-photo.jpg');
						} ?>
					</div>
					<div id="profile-header-info">
						<div id="profile-header-name">
							<?php print $account_profile->field_profile_name_org[0]['value'] ?>
						</div>
						<div id="profile-header-address-1">
							<?php print $account_profile->field_profile_address_1_org[0]['value'] ?>
						</div>
						<div id="profile-header-city-state-zip">
							<?php print $account_profile->field_profile_city_org[0]['value'] ?>, <?php print $account_profile->field_profile_state_org[0]['value'] ?> <?php print $account_profile->field_profile_postal_code_org[0]['value'] ?>
						</div>
						<div id="profile-header-website">
							<?php print l($account_profile->field_profile_website_org[0]['value'], $account_profile_url) ?>
						</div>
					</div>
				</div>
			
			<?php // If student or admin ?>
			<?php } else { ?>
				<div id="profile-logo">
					<?php if (!empty($account->picture)) {
						print theme('imagecache', 'client_logo_header', $account->picture);
					} else {
						print theme('imagecache', 'client_logo_header', 'sites/default/files/user_profile_photos/default-profile-photo.jpg');
					} ?>
				</div>
				<div id="profile-header-info">
					<div id="profile-header-name">
						<?php print $account_profile->field_profile_first_name_primary[0]['value'] ?> <?php print $account_profile->field_profile_last_name_primary[0]['value'] ?>
					</div>
					<?php if (isset($semesters)): ?>
						<div id="profile-semesters">
							<ul>
							<?php foreach ($semesters as $semester): ?>
								<li><?php print $semester ?></li>
							<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
					<div id="profile-header-email-primary">
						<?php print $account_profile->field_profile_email_primary[0]['email'] ?>
					</div>
					<div id="profile-header-phone-primary">
						<?php if (!empty($account_profile->field_profile_phone_primary[0]['number'])) {
							print(preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $account_profile->field_profile_phone_primary[0]['number']));
							!empty($account_profile->field_profile_phone_primary[0]['extension']) ? print " x" .$account_profile->field_profile_phone_primary[0]['extension'] : "";
						} ?>
					</div>
					<div id="profile-header-concentration">
						<?php print ucwords(str_replace('_', ' ', $account_profile->field_profile_concentration[0]['value'])) ?>
					</div>
					<?php if (!empty($account_profile->field_profile_credits[0]['value'])): ?>
						<div id="profile-header-credits">
							<?php print $account_profile->field_profile_credits[0]['value'] ?> credits
						</div>
					<?php endif; ?>
				</div>
			<?php } ?>
			</div>
			
			<div id="profile-design-brief">
				<?php if (!empty($account_profile->field_profile_name_org[0]['value']) && (in_array('admin', array_values($user->roles)) || in_array('student', array_values($user->roles)) || $user->uid == 1)) { ?>				
					<div id="profile-design-brief-left">
						<div id="profile-design-brief-left-inner">
							<h1>
								Client / <span class="project-title">Design Brief</span>
							</h1>
					
							<div id="profile-org-description" class="profile-field">
								<div class="profile-field-label">Please provide a brief description of your organization.</div>
								<?php print $account_profile->field_profile_org_description[0]['value'] ?>
							</div>
							<div id="profile-org-description" class="profile-field">
								<div class="profile-field-label">What is your organization's mission?</div>
								<?php print $account_profile->field_profile_mission[0]['value'] ?>
							</div>
							<div id="profile-org-description" class="profile-field">
								<div class="profile-field-label">Please provide a brief overview of your project.</div>
								<?php print $account_profile->field_profile_project_descriptio[0]['value'] ?>
							</div>
							<div id="profile-objectives" class="profile-field">
								<div class="profile-field-label">What are the main objectives of the project?</div>
								<?php print $account_profile->field_profile_objectives[0]['value'] ?>
							</div>
							<div id="profile-single-message" class="profile-field">
								<div class="profile-field-label">How would you define the single message you are trying to communicate with this project?</div>
								<?php print $account_profile->field_profile_single_message[0]['value'] ?>
							</div>
							<div id="profile-creative-consider" class="profile-field">
								<div class="profile-field-label">Are there any specific creative considerations or constraints?</div>
								<?php print $account_profile->field_profile_creative_consider[0]['value'] ?>
							</div>
							<div id="profile-existing-guideline" class="profile-field">
								<div class="profile-field-label">Will the project need to work within an existing set of brand guidelines?</div>
								<?php print $account_profile->field_profile_existing_guideline[0]['value'] ?>
							</div>
							<div id="profile-comp-context-ind" class="profile-field">
								<div class="profile-field-label">Please list and describe some competitors or similar organizations that engage in work related to yours.</div>
								<?php print $account_profile->field_profile_comp_context_ind[0]['value'] ?>
							</div>
				
							<h3>DELIVERABLES</h3>
							<div id="profile-deliverables" class="profile-field">
								<div class="profile-field-label">Please provide a detailed and prioritized list of all deliverables, along with projected quantities of each component.</div>
								<?php print $account_profile->field_profile_deliverables[0]['value'] ?>
							</div>
				
							<div id="profile-audience" class="profile-field">
								<div class="profile-field-label">What is/are the target audience(s) for this project?</div>
								<?php print $account_profile->field_profile_audience[0]['value'] ?>
							</div>
							<div id="profile-timeline-deadline" class="profile-field">
								<div class="profile-field-label">Please provide a list of any important dates on your end that should be considered.</div>
								<?php print $account_profile->field_profile_timeline_deadline[0]['value'] ?>
							</div>
							<div id="profile-budget" class="profile-field">
								<div class="profile-field-label">What is your production budget for this project?</div>
								<?php print $account_profile->field_profile_budget[0]['value'] ?>
							</div>
							<div id="profile-approvals" class="profile-field">
								<div class="profile-field-label">Who will need to approve the design or budget of this project, other than the primary contact?</div>
								<?php print $account_profile->field_profile_approvals[0]['value'] ?>
							</div>
							<div id="profile-vendor-contact" class="profile-field">
								<div class="profile-field-label">Please list any vendors with whom you would prefer to work or are required to work, along with their contact information. You may also indicate if you
			would like Design Corps to recommend vendors.</div>
								<?php print $account_profile->field_profile_vendor_contact[0]['value'] ?>
							</div>
						</div>
					<?php } ?>	
					<div id="my-milestones">
						<div id="my-milestones-inner">
							<h2>My Milestones</h2>
							<div id="milestone-headings">
								<div id="milestone-due-date" class="heading">DUE DATE</div>
								<div id="milestone-description" class="heading">DESCRIPTION</div>
								<div id="milestone-client" class="heading">CLIENT</div>
								<div id="milestone-project" class="heading">PROJECT</div>
								<div id="milestone-project-job-no" class="heading">JOB#</div>
								<div class="clear"></div>
							</div>
							<?php print $assigned_milestones ?>
						</div>
					</div>
				</div>
				<div id="profile-design-brief-right">
					<?php if (!empty($account_profile->field_profile_name_org[0]['value']) && (in_array('admin', array_values($user->roles)) || in_array('student', array_values($user->roles)) || $user->uid == 1)) { ?>
					<div id="profile-semester-status">
						<?php if (isset($semesters) && !empty($semesters)): ?>
							<div id="profile-semesters">
								<h2>Semester</h2>
								<ul>
								<?php foreach ($semesters as $semester): ?>
									<li><?php print $semester ?></li>
								<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>
						
						<div id="profile-status">
							<h2>Status</h2>
							<p><?php print $account_profile->field_profile_status[0]['value'] ?></p>
						</div>
					</div>
			
					<div id="profile-contacts">
						<div id="primary-contact">
							<h2>Primary Contact</h2>
							<div id="profile-contact-name">
								<?php print $account_profile->field_profile_first_name_primary[0]['value'] ?> <?php print $account_profile->field_profile_last_name_primary[0]['value'] ?>
							</div>
							<div class="profile-contact-title">
								<?php print $account_profile->field_profile_title_primary[0]['value'] ?>
							</div>
							<div class="profile-contact-email">
								<?php print $account_profile->field_profile_email_primary[0]['email'] ?>
							</div>
							<div class="profile-contact-phone">
								<?php if (!empty($account_profile->field_profile_phone_primary[0]['number'])) {
									print(preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $account_profile->field_profile_phone_primary[0]['number']));
									!empty($account_profile->field_profile_phone_primary[0]['extension']) ? print " x" .$account_profile->field_profile_phone_primary[0]['extension'] : "";
								} ?>
							</div>
						</div>
						<?php if (!empty($account_profile->field_profile_first_name_second[0]['value'])): ?>
						<div id="secondary-contact">
							<h2>Secondary Contact</h2>
							<div class="profile-contact-name">
								<?php print $account_profile->field_profile_first_name_second[0]['value'] ?> <?php print $account_profile->field_profile_last_name_second[0]['value'] ?>
							</div>
							<div class="profile-contact-title">
								<?php print $account_profile->field_profile_title_second[0]['value'] ?>
							</div>
							<div class="profile-contact-email">
								<?php print $account_profile->field_profile_email_second[0]['email'] ?>
							</div>
							<div class="profile-contact-phone">
								<?php if (!empty($account_profile->field_profile_phone_second[0]['number'])) {
									print(preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $account_profile->field_profile_phone_second[0]['number']));
									!empty($account_profile->field_profile_phone_second[0]['extension']) ? print " x" .$account_profile->field_profile_phone_second[0]['extension'] : "";
								} ?>
							</div>
						</div>
						<?php endif; ?>
					</div>
					
					<div id="projects">
						<h2>Projects</h2>
						<?php print $related_projects ?>
					</div>
					
					<div id="profile-uploads">
						<h2>Uploads</h2>
						<h3>Design Examples</h3>
						<div class="upload">
							<a href="/<?php print $account_profile->field_profile_design_examples[0]['filepath'] ?>">
								<div class="filename"><?php print $account_profile->field_profile_design_examples[0]['filename'] ?></div>
								<div class="filesize"><?php print format_size($account_profile->field_profile_design_examples[0]['filesize']) ?></div>
								<div class="clear"></div>
							</a>
						</div>
	
						<h3>Content</h3>
						<div class="upload">
							<a href="/<?php print $account_profile->field_profile_mandatory_content[0]['filepath'] ?>">
								<div class="filename"><?php print $account_profile->field_profile_mandatory_content[0]['filename'] ?></div>
								<div class="filesize"><?php print format_size($account_profile->field_profile_mandatory_content[0]['filesize']) ?></div>
								<div class="clear"></div>
							</a>
						</div>
	
						<h3>Artwork</h3>
						<div class="upload">
							<a href="/<?php print $account_profile->field_profile_mandatory_artwork[0]['filepath'] ?>">
								<div class="filename"><?php print $account_profile->field_profile_mandatory_artwork[0]['filename'] ?></div>
								<div class="filesize"><?php print format_size($account_profile->field_profile_mandatory_artwork[0]['filesize']) ?></div>
								<div class="clear"></div>
							</a>
						</div>
					</div>
					<?php } ?>
					
					<div id="content-page-user-right">
						<?php if (empty($account_profile->field_profile_name_org[0]['value'])) { ?>
							<div id="my-clients">
								<h2>My Clients</h2>
								<?php print $my_clients ?>
							</div>
						<?php } ?>
						<div id="my-recent-comments">
							<h2>My Recent Comments</h2>
							<?php print $recent_comments ?>
						</div>
						<div id="my-recent-uploads">
							<h2>My Recent Uploads</h2>
							<?php if (isset($my_uploads)) {
								foreach ($my_uploads as $upload): ?>
									<div class="upload">
										<div class="filename">
											<?php print l($upload['filename'], $upload['filepath']) ?>
										</div>
										<div class="post-date">
											Posted by <?php print $account->name ?> at <?php print date('g:ia F d, Y', $upload['timestamp']) ?>
										</div>
									</div>
								<?php endforeach;
							} else { ?>
								<p>You have no recent uploads.</p>
							<?php } ?>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		<?php endif; ?>
<?php
	} else { ?>
		<div id="new-user-apply">
			<ul>
				<li><a href="/user/register/client">Start a New Client Application ></a></li>
				<li><a href="/user/register/student">Start a New Student Application ></a></li>
			</ul>
		</div>
	<?php }
?>