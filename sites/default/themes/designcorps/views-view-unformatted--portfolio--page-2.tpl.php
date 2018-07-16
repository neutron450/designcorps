<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php $i = 1; ?>
<?php foreach ($rows as $id => $row): ?>
  <?php if ($i == 3) {
    $i = 0;
    $no_margin = ' style="margin-right: 0;"';
  } ?>
  <div class="<?php print $classes[$id]; ?>"<?php print $no_margin ?>>
    <?php print $row; ?>
  </div>
  <?php 
    $i++;
    unset($no_margin);
  ?>
<?php endforeach; ?>