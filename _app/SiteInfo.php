<?php

class SiteInfo {

// Method to get site data.

  // Get Base Url.
  public static function baseUrl() {

    $dir = basename(dirname($_SERVER['PHP_SELF']));
    if ($dir == null) {
      return '//' . $_SERVER['SERVER_NAME'] . '/';
    }
    else {
      return '//' . $_SERVER['SERVER_NAME'] . '/' . $dir . '/';
    }
  }

  public static function getSiteData() {
    
    $data = Entity::readDataFile('_data/settings/site_info.json');
    return $data;
  }

}