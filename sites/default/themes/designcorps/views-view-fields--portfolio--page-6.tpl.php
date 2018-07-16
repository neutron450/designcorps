<?php
    print '<div class="view-students-by-semester-row">';
    $view = views_get_view('portfolio');
    $args = Array($fields['nid']->content);
    $display = $view->execute_display('block_6', $args);
  
    print '<div class="views-field-title">'. $fields['title']->content .'</div>';
    print $display['content'];
    print '</div>';
?>