<div class="milestone-link">
	<a href="<?php print $fields['path']->content ?>">
		<div class="milestone-due-date">
			<?php print $fields['field_milestone_date_value']->content ?>
		</div>
		<div class="milestone-title">
			<?php print $fields['title']->content ?>
		</div>
		<div class="milestone-client">
			<?php print $fields['field_clients_uid']->content ?>
		</div>
		<div class="milestone-project">
			<?php print $fields['field_project_nid']->content ?>
		</div>
		<div class="milestone-project-job-no">
			<?php print $fields['field_job_no_value']->content ?>
		</div>
		<div class="clear"></div>
	</a>
</div>
<div class="milestone-description">
	<?php print $fields['body']->content ?>
</div>
<div class="milestone-posted-comments">
	<div class="milestone-post-date">
		<?php print $fields['created']->content ?>
	</div>
	<div class="milestone-comment-count">
		<?php print $fields['comment_count']->content ?>
	</div>
	<div class="milestone-actions">
		<div class="milestone-edit">
			<?php print $fields['edit_node']->content ?>
		</div>
		<div class="milestone-delete">
			<?php print $fields['delete_node']->content ?>
		</div>
	</div>
	<div class="clear"></div>
</div>