<ul>
<?php foreach ($menu_data as $menu ) { 
  // Render hack to remove single slash from home nav.
  if($menu['path'] == '/') {
    $menu['path'] = str_replace('/', '', $menu['path']);
  }
  $front_page = new Route();
  ?>

  <?php if ($front_page->getPath() == '' and strpos($menu['path'], '#') !== false) { ?>

    <li><a href="<?php echo $menu['path']; ?>" id="menu-<?php echo str_replace('#', '', $menu['path']);?>-link"><?php echo $menu['name']; ?></a></li>

<<<<<<< HEAD
  <?php } else if (substr( $menu['path'], 0, 4 ) === "http") {?>

    <li><a href="<?php echo $menu['path']; ?>"><?php echo $menu['name']; ?></a></li>

=======
>>>>>>> master
  <?php } else { ?>

    <li><a href="<?php echo SiteInfo::baseUrl() . $menu['path']; ?>"><?php echo $menu['name']; ?></a></li>

  <?php } ?>
<?php } ?>
</ul>