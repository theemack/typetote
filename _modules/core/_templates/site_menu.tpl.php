<ul>
<?php foreach ($menu_data as $menu ) { 
  // Render hack to remove single slash from home nav.
  if($menu['path'] == '/') {
    $menu['path'] = str_replace('/', '', $menu['path']);
  }
  $path = new Route();
  ?>

  <?php if ($path->getPath() == '' and strpos($menu['path'], '#') !== false) { ?>

    <li><a href="<?php echo $menu['path']; ?>" id="menu-<?php echo str_replace('#', '', $menu['path']);?>-link"><?php echo $menu['name']; ?></a></li>

  <?php } else if ( strpos($menu['path'], 'http') !== false) { ?>

    <li><a href="<?php echo $menu['path']; ?>"><?php echo $menu['name']; ?></a></li>

  <?php } else if ( strpos($menu['path'], '@') !== false) { ?>

    <li><a href="mailto:<?php echo $menu['path']; ?>"><?php echo $menu['name']; ?></a></li>

  <?php } else { ?>

    <li><a href="<?php echo SiteInfo::baseUrl() . $menu['path']; ?>"><?php echo $menu['name']; ?></a></li>

  <?php } ?>
<?php } ?>
</ul>