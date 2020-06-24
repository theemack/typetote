<?php if ($page_data['template_type'] == 'content') { ?>
  <h1><?php echo $page_data['title']; ?></h1>
  <div><?php echo $page_data['body']; ?></div>
  <?php renderTags($page_data['meta']['tags']); ?>
<?php } ?>