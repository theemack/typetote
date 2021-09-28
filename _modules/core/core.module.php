<?php
/**
 * The core module is used to do basic route and template rendering.
 */
$theme = new Template();
$site_data = SiteInfo::getSiteData();

// 

// Front Page.
$front_page = new Route();
if ($front_page->getPath() == '') {
  
  // Load override template.
  $override_template = 'page--front.tpl.php';
  $override_file = $site_data['front_theme'] . '/templates/' . $override_template;
  
  if (is_file($override_file)) {
    $page_data['template_type'] = 'file';
    $page_content = $override_file;
  }
  
  $page_data['template_type'] = 'front';
  http_response_code(200);
  include ($theme->loadTheme('main'));
}

// Content page.
$path = new Route();
$template = new Template();
$content = new Entity();
$manifest = $content->readDataFile(SiteInfo::getDataDir() . '/manifests/content_manifests.json');

if (!empty($manifest)){
  foreach ($manifest as $item)
  {
    if ($path->getPath() == $item['path'] && $path->getPath() !== '')
    {
      // Get and build $page_data array.
      $page_data = $content->loadEntity($item['entity_id']);
      $page_data['template_type'] = 'content';

      // This is for the admin bar to call the data.
      if ($item['entity_id']) {
        $GLOBALS['entity_id'] = $item['entity_id'];
      }

      // Here we do a check, if there an override file in the template.
      $override_page_by_path = 'page--' . $page_data['meta']['path'] . '.tpl.php';
      $override_page_by_category = 'page--category--' . $page_data['meta']['category'] . '.tpl.php';
      $override_page_by_entity = 'page--entity--' . $page_data['meta']['entity_type'] . '.tpl.php';
      $theme_template_path = $site_data['front_theme'] . '/templates/';

      // First check if there is a path override.
      if (is_file($theme_template_path . $override_page_by_path)) {
        $page_data['template_type'] = 'file';
        $page_content = $theme_template_path . $override_page_by_path;
      } else {
        
        // If no path override is set, then check by category type.
        if (is_file($theme_template_path . $override_page_by_category)) {
          $page_data['template_type'] = 'file';
          $page_content = $theme_template_path . $override_page_by_category;
        } else {
          
          // If not category ovveride is set, then check by entity type. Otherwise load defualt. 
          if (is_file($theme_template_path . $override_page_by_entity)) {
            $page_data['template_type'] = 'file';
            $page_content = $theme_template_path . $override_page_by_entity;
          }
        }
      }

      http_response_code(200);
      include ($theme->loadTheme('main'));
    }
  }
}

// This renders a content list, i.e. blog index or category index.
$content_list_data = SiteInfo::getSiteContentListData();
foreach ($content_list_data as $list_page) {

  $category = new Route();
  $category->setPath($list_page['path'], function() {

    $site_info = new SiteInfo();
    $site_data = $site_info->getSiteData();
    $theme = new Template();
    $content = new Entity();
    $query = new Route();

    $path_data = $site_info->getSiteContentListData();
    $path = array();
    foreach ($path_data as $item) {
      if ($item['path'] == $query->getPathName()) {
        $path['name'] = $item['name'];
        $path['path'] = $item['path'];

        if (isset($item['description'])){
          $path['description'] = $item['description'];
        }
      }
    }

    $options = array(
      'status' => 'published',
      'type' => 'post',
      'category' => $path['path'],
    );
    
    $content_list = $content->renderEntityList(SiteInfo::getDataDir() . '/manifests/content_manifests.json', $options);
    $page_data['items'] = $content->paginate($content_list);
    $page_data['template_type'] = 'list';
    $page_data['title'] = ucfirst($path['name']);
    $page_data['pagination_num'] = $query->getQuery('pg');
    $page_data['base_url'] = SiteInfo::baseUrl() . $path['path'] .'?';

    if (isset($path['description'])){

      $page_data['cat_description'] = $path['description'];
    };
    
    // Load override template.
    $override_template = 'page--' . $path['path'] . '.tpl.php';
    $override_file = $site_data['front_theme'] . '/templates/' . $override_template;
    if (is_file($override_file)) {
      $page_content = $override_file;
    }
  
    http_response_code(200);
    include ($theme->loadTheme('main'));

  });
}

// Tags
$tags = new Route();
$tags->setQueryPath('tags', function() {

  $site_info = new SiteInfo();
  $site_data = $site_info->getSiteData();
  $template = new Template();

  $query = new Route();
  $tag_data = new Entity();
  $options = array(
    'status' => 'published'
  );
  $raw_data = $tag_data->renderEntityList(SiteInfo::getDataDir() . '/manifests/content_manifests.json',  $options);

  $tag_results = array();
  foreach ($raw_data as $tag) {

    $tags = $tag['meta']['tags'];
    $query_term = $query->getQuery('q');
    if(strpos($tags, $query_term) !== false) {
     $tag_results[] = $tag;
    }
  }

  // If tag results are not empty render page.
  if (!empty($tag_results)) {
    $page_data['items'] = $tag_data->paginate($tag_results);

    $page_data['template_type'] = 'list';
    $page_data['base_url'] = SiteInfo::baseUrl() . 'tags?q=' . $query->getQuery('q');
    $page_data['pagination_num'] = $query->getQuery('pg');
    $page_data['title'] = $template->decodeTag($query->getQuery('q'));
  
    include ($template->loadTheme('main'));
  }
  else {
    http_response_code(404);
  }
});

// Render Sitemap
$sitemap = new Route();
$sitemap->setPath('sitemap', function() {

  header('Content-Type: text/xml');
  echo '<?xml version="1.0" encoding="UTF-8"?>';
  include (SiteInfo::getDataDir() . '/sitemap.xml');

});

// Render RSS feed
$rss = new Route();
$rss->setPath('rss', function() {

  header('Content-Type: text/xml');
  include (SiteInfo::getDataDir() . '/rss.xml');

});


?>
