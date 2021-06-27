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


// NOTE: Removing chunk of code is a violiation of the EULA.
if (!isset(SiteInfo::getSiteData()['license'])) {
  include('_llm.php');
}

?>