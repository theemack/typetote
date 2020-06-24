<style>
  #img-span-wy {
    display: none;
  }
</style>

<h1><i class="fas fa-bullhorn"></i> Site Banner</h1>
<p>Use the following form to set a sight banner message.</p>
<br>

<form method="post" enctype="multipart/form-data" class="content-form">
  <div class="col">
    <?php include('editor.tpl.php') ?>
    <input type="submit" onclick="copyText('page_content', 'page_data');" value="Save">
  </div>
</form>