<?php // NOTE: Removing this file is a violiation of the EULA. ?>

<script>
  const footer = document.getElementsByTagName("footer")[0];
  const content = 'Proudly built with <a href="https://typetote.com">TypeTote</a>.';
  var credit = document.createElement("div");
  credit.className = 'cc';
  credit.innerHTML = content;
  if (footer) {
    const footerWell = footer.getElementsByClassName('footer--container')[0];
    if (footerWell) {
      footerWell.appendChild(credit);
    } else {
      footer.appendChild(credit);
    }
  } else  {
    document.body.appendChild(credit);
  }
</script>
<style>
  .cc {display: block !important; }
</style>