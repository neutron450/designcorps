<?php
// $Id: node.tpl.php,v 1.1.2.3 2010/01/11 00:08:12 sociotech Exp $
?>

<div id="node-<?php print $node->nid; ?>" class="node <?php print $node_classes; ?>">
  <div class="inner">
    <?php print $picture ?>

    <?php if ($submitted): ?>
    <div class="meta">
      <span class="submitted"><?php print $submitted ?></span>
    </div>
    <?php endif; ?>

    <?php if ($node_top && !$teaser): ?>
    <div id="node-top" class="node-top row nested">
      <div id="node-top-inner" class="node-top-inner inner">
        <?php print $node_top; ?>
      </div><!-- /node-top-inner -->
    </div><!-- /node-top -->
    <?php endif; ?>

    <div class="content clearfix">
      <div class="field field-type-filefield field-field-news-item-image">
    			<?php print $node->field_news_item_image[0]["view"]; ?>
      </div>
      <h2 class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
      <div class="field field-type-date field-field-news-item-post-date">
      		<?php print $node->field_news_item_post_date[0]["view"]; ?>
      </div>
      <?php if($teaser): ?>
        <div class="field field-teaser">
          <?php print $node->teaser; ?>
        </div>
        <div class="field field-more-link">
          <a href="/<?php print $node->path ?>">more ></a>
        </div>
      <?php else : ?>
        <div class="field field-body">
          <?php print $node->content['body']['#value']; ?>
        </div>
      <?php endif; ?>
      <?php if ($terms): ?>
      <div class="terms">
        <?php print $news_item_tags; ?>
      </div>
      <?php endif;?>
    </div>

    

    <?php if ($links): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
    <?php endif; ?>
  </div><!-- /inner -->

  <?php if ($node_bottom && !$teaser): ?>
  <div id="node-bottom" class="node-bottom row nested">
    <div id="node-bottom-inner" class="node-bottom-inner inner">
      <?php print $node_bottom; ?>
    </div><!-- /node-bottom-inner -->
  </div><!-- /node-bottom -->
  <?php endif; ?>
</div><!-- /node-<?php print $node->nid; ?> -->
