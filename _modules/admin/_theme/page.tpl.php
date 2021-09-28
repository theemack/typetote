<html>
<head>
  <title>TypeTote - Admin</title>
  <?php renderAssetsCSS($page_data); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo SiteInfo::baseUrl(); ?>_modules/admin/_theme/css/style.css">
</head>
<body>

<?php if (empty($page_data['utility_page']) or $page_data['utility_page'] !== 'yes') { ?>
<div class="admin-well">
  <div class="admin-col">
    <a href="<?php echo SiteInfo::baseUrl(); ?>admin/"><img class="tt-logo-side" src="<?php echo SiteInfo::baseUrl();?>_modules/admin/img/tt-emb.svg"></a>
    <nav>
      <ul>
        <li><a href="<?php echo SiteInfo::baseUrl(); ?>admin/">Dashboard <i class="fas fa-home"></i></a></li>
        <li><a href="<?php echo SiteInfo::baseUrl(); ?>admin/post">Publish <i class="fas fa-edit"></i></a></li>
        <li><a href="<?php echo SiteInfo::baseUrl(); ?>admin/media">Media <i class="fas fa-photo-video"></i></a></li>
        <li><a href="<?php echo SiteInfo::baseUrl(); ?>admin/category">Categories <i class="fas fa-book"></i></a></li>
        <li><a href="<?php echo SiteInfo::baseUrl(); ?>admin/menu">Menu <i class="fas fa-link"></i></a></li>
        <li><a href="<?php echo SiteInfo::baseUrl(); ?>admin/site-banner"">Site Banner<i class="fas fa-bullhorn"></i></a></li>
        <?php if (checkIfAdmin()) { ?>
          <li><a href="<?php echo SiteInfo::baseUrl(); ?>admin/users">Users <i class="fas fa-user-friends"></i></a></li>
        <?php } ?>
        <li><a href="<?php echo SiteInfo::baseUrl(); ?>admin/settings">Settings <i class="fas fa-cog"></i></a></li>
        <hr>
        <li><a href="<?php echo SiteInfo::baseUrl(); ?>">Back to Site <i class="fas fa-caret-square-left"></i></a></li>
      </ul>
    </nav>
  </div>
  <div class="admin-body">
    <div class="admin-utility">
      <a href="<?php echo SiteInfo::baseUrl(); ?>admin/logout"> Logout <i class="fas fa-power-off"></i></a>
    </div>
    <?php include ($page_content) ?>
    <div class="cc">
      <br>
      <hr>
      <br>
      TypeTote: <a href="https://typetote.com" target="_blank">v<?php include ('version.txt'); ?></a><br><br>
      Icons courtesy of: <a href="https://fontawesome.com">Font Awesome</a>
    </div>

  <?php include('_modules/admin/_templates/session-notice.tpl.php'); ?>
</div>

<?php } else { ?>
  
  <?php include ($page_content) ?>

  <style>
    .admin-col, .admin-utility, .cc, pre {
      display: none
    }

    .admin-body {
      min-height: unset;
      width: 100%;
      padding: 0;
    }

    body {
      border: hidden !important;
      padding: 0;
      margin: 0;
    }
    .cc {
      max-width: 400px;
      margin: auto;
      margin-top: 2rem;
    }
  </style>
<?php } ?>
<?php renderAssetsJS($page_data); ?>

</body>
</html>