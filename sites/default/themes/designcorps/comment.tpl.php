<?php
// $Id: comment.tpl.php,v 1.1 2009/08/19 04:28:07 sociotech Exp $
?>

<?php //print_r($comment) ?>

<div class="comment <?php print $comment_classes ?> clear-block">
  <?php //print $picture ?>
  
  <h3 class="title">
	<?php if ($comment->new): ?>
	  <a id="new"></a>
  	  <span class="new">NEW</span>
	<?php endif; ?>
	<?php print $title ?>
  </h3>
  
  <div class="content">
    <?php print $content ?>
  </div>
  
  <div class="post-date">
	<div class="links">
	    <?php print l('Reply', 'comment/reply/'. $comment->nid .'/'. $comment->cid) ?> |
		<?php print l('Edit', 'comment/edit/'. $comment->cid) ?> |
		<?php print l('Delete', 'comment/delete/'. $comment->cid) ?>
	</div>
	<strong>Posted by:</strong> <?php print $comment->name ?> at <?php print date('g:ia F d, Y', $comment->timestamp) ?>
  </div>
  
</div><!-- /comment -->