<?php

// Boostrap Module Functions
function load_files($dir, $type) {
  if (is_dir($dir)){
    $module_list = array_slice(scandir($dir), 1);
    foreach ($module_list as $module) 
    {
      $file = $dir . '/' . $module . '/' . $module . '.' . $type . '.php';    
      if (is_file($file)) 
      { 
        include($file);
      }
    }
  }
}

// Load Modules.
$modules = '_modules';
load_files($modules, 'hooks');
load_files($modules, 'module');

// Load Extensions.
$extensions = '_extensions';
load_files($extensions, 'hooks');
load_files($extensions, 'ext');
 
// Removing this code is a violation of the EULA.
if (!isset(SiteInfo::getSiteData()['license']) or SiteInfo::getSiteData()['license'] == null) {
  $route = new Route();

  // Paths to exclude.
  $tlm_paths = [
    'sitemap',
    'rss',
    'admin'
  ];

  if (!in_array($route->getPath(), $tlm_paths)) {
    include('_tlm.php');
  }
  
}
// ****
?>