<?php
// TODO: find a better way to do this.
if (isset($page_data['items']['content'][0])) { 

  if (isset($page_data['pagination_num'])) {
    $pag_num = $page_data['pagination_num'];

  } else {
    $pag_num = 0;
  }

  $list = $page_data['items']['content'][$pag_num];
}
?>

<div class="list-well">
<?php if (isset($page_data['title']) and !isset($no_title)) { ?>
  <h1><?php echo $page_data['title']; ?></h1>
<?php } ?>

<?php if (!empty($list)) { ?>
  
  <?php foreach ($list as $item) { ?>

    <article>
      <?php if (!empty($item['meta']['featured_image'])) { ?>
        <a href="<?php echo $item['meta']['path']; ?>"><img class="featured-img" src="<?php echo $item['meta']['featured_image'];?>" alt="Image: <?php echo $item['title']; ?>"></a>
      <?php } ?>
      <h3><a href="<?php echo $item['meta']['path']; ?>"><?php echo $item['title']; ?></a></h3>
      <p><?php echo $item['summary']; ?></p>
      <?php renderTags($item['meta']['tags']); ?>
    </article>

  <?php } ?>

    <?php if (isset($page_data['list']['pagination'][1])) { ?>
        <ul class="pagination">
          <?php foreach ($page_data['list']['pagination'] as $key => $num) { ?>
            <li><a href="<?php echo $page_data['base_url'] .'&pg='.$num ?>"><?php echo $num + 1 ?></a></li>
          <?php }  ?>
        </ul>
    <?php } ?>
  <?php } else { ?>

  <div class="no-content-msg">No content has been created yet.</div>

<?php } ?>
</div>