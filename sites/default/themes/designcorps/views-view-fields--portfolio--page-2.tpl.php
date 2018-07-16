<?php
  if(!empty($fields['path']->content)) {
    $url = $fields['path']->content;
  }
?>
<a href="<?php print $url ?>" class="client-logo" style="background: url('/<?php print $fields['field_profile_client_logo_fid']->content ?>') top left no-repeat">
  <span class="views-field-client-logo-name-semester">
    <span class="views-field-client-name"><?php print $fields['field_profile_name_org_value']->content; ?></span><br/>
    <span class="views-field-client-semester"><?php print $fields['field_profile_semesters_nid']->content; ?></span>
  </span>
</a>
<script type="text/javascript">
  $(document).ready(function(){
  	$('h1.title').hide();
  });
</script>