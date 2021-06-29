<?php

$admin_settings = new Route();
$admin_settings->setPath('admin/settings', function() {

  $site_info = new Entity();
  if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $site_info_data = $_POST;

    // Format to lowercase / Machine Names
    $site_info_data['admin_email'] = strtolower($_POST['admin_email']);
    $site_info_data['blog_name'] = $_POST['blog_name'];
    $blog_path = strtolower($site_info_data['blog_name']);
    $site_info_data['sec_key_1'] = $_POST['sec_key_1'];
    $site_info_data['sec_key_2'] = $_POST['sec_key_2'];
    $site_info_data['blog_path'] = str_replace(' ', '-', $blog_path);

    // Add logic here if security questions were changed. Auto log out the user.

    // Here we need to check if the site licnese is valid. In the case of a bad value, we still just 
    if ($site_info_data['license'] !== null && !empty($site_info_data['license'])) {

      $entered_key = base64_encode($site_info_data['license']);
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "http://tlm.typetote.com/?mmgv=" . $entered_key ,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
      ));

      $response = curl_exec($curl);
      curl_close($curl);
      $results = json_decode($response,true);

      // If the result is valid save data.
      if ($results['type'] == 'valid') {
        $site_info->saveSetting('site_info.json', $site_info_data);
        header("Refresh:0");
      } else  {
        echo '<div class="error-msg">The license you entered appears to be invalid.</div>';
      }
    } else {
      $site_info->saveSetting('site_info.json', $site_info_data);
      header("Refresh:0");
    }

  }

  $template = new Template();
  $page_content = $template->renderTemplateFile('_modules/admin', 'site-settings-form.tpl.php');
  $page_data = $site_info->readDataFile(SiteInfo::getDataDir() . '/settings/site_info.json');

  $custom_themes = array();
  $themes = preg_grep('/^([^.])/', scandir('_themes'));
  foreach ($themes as $theme) {
    $i['name'] = $theme;
    $i['path'] = '_themes/' . $theme;
    $custom_themes[] = $i;
  }

  $core_themes = array(
    array('name' => 'motek', 'path' => '_modules/core/_themes/motek'),
    array('name' => 'tundra', 'path' => '_modules/core/_themes/tundra')
  );

  $page_data['themes'] = array_merge($core_themes, $custom_themes);
  include ($template->loadTheme('admin'));
});

?>