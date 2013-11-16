<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 * 
 */
 
?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  
  <?php if($node->type == 'teaser_to_node'): ?>
  
    <h4><a href="<?php print $rmurl; ?>"><?php print $content['field_teaser_node_header']['#items'][0]['safe_value']; ?></a></h4>
    <h5><?php print $node->title; ?></h5>
  <?php elseif ($title_prefix || $title_suffix || $display_submitted || $unpublished || !$page && $title): ?>
    <header>
        <?php print render($title_prefix); ?>
        <?php if (!$page && $title): ?>
          <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
  
  
        <?php if ($unpublished): ?>
          <mark class="unpublished"><?php print t('Unpublished'); ?></mark>
        <?php endif; ?>
    </header>
  <?php endif; ?>
  
  
  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_teaser_node_header']);
    hide($content['field_teaser_node_link']); // need to add code to reformat link to read "Read More"
    print render($content);
  ?>

  <?php 
    print render($content['links']); 
    
    if ($display_submitted && !$teaser && !$featured): ?>
      <p class="submitted">
        <?php print $user_picture; ?>
        <?php print $submitted; ?>
      </p>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

</article>
