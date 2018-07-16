<?php
  if(!empty($fields['featured_item_link_path']->content)) {
    $url = $fields['featured_item_link_path']->content;
  }
  else {
    $url = $fields['path']->content;
  }
?>
<a href="<?php print $url ?>" class="views-field-title-description-bar" style="background: url('<?php print $fields['field_profile_rep_work_fid']->content ?>') top left no-repeat">
  <span class="views-field-title-description">
    <span class="views-field-title"><?php print $fields['title']->content; ?></span>
    <span class="views-field-description"><?php print $fields['field_profile_rep_work_data']->content; ?></span>
  </span>
</a>