<div id="rep-work-slideshow">
  <?php
    $view = views_get_view('portfolio');
    $args = Array($node->nid);
    $display = $view->execute_display('block_7', $args);
    print $display['content'];
  ?>
</div>

<?php if ($user_type == 'client') { ?>
  
	<h2 class="title">
		<?php print $node->field_profile_name_org[0]['value'] ?>
	</h2>
	
	<?php if (!empty($industry_tags)) { ?>
		<div id="client-industry-tags">
			<strong>Industry:</strong> <?php print $industry_tags ?>
		</div>
	<?php } ?>

	<?php if (!empty($deliverables_tags)) { ?>
		<div id="client-deliverables">
			<strong>Deliverables:</strong> <?php print $deliverables_tags ?>
		</div>
	<?php } ?>

	<?php if (!empty($designers)) { ?>
		<div id="client-designers">
			<strong>Designer(s):</strong> <?php print $designers ?>
		</div>
	<?php } ?>

	<div id="client-description">
		<?php print $node->field_profile_client_description[0]['value'] ?>
	</div>

<?php } else if ($user_type == 'student') { ?>

  <div id="student-photo">
	  <?php print $node->field_profile_student_photo[0]['view'] ?>
  </div>

  <div id="student-title-semesters-clients">
	  <h2 id="student-title" class="title">
  		<?php print $node->field_profile_first_name_primary[0]['value'] ." ". $node->field_profile_last_name_primary[0]['value'] ?>
  	</h2>
	
  	<ul id="student-semesters">
  	<?php foreach ($semesters as $semester) { ?>
  		<li><?php print $semester ?></li>
  	<?php } ?>
  	</ul>

  	<?php if (!empty($clients)) { ?>
  		<div id="student-clients">
  			<strong>Clients</strong><br />
  			<ul>
  				<?php foreach ($clients as $client) { ?>
  					<li><?php print($client) ?></li>
  				<?php } ?>
  			</ul>
  		</div>
  	<?php } ?>
  </div>

	<?php if (!empty($node->field_profile_quote[0]['view'])) { ?>
		<div id="student-quote">
			<?php print $node->field_profile_quote[0]['view'] ?>
		</div>
	<?php } ?>
	
<?php } ?>
	
