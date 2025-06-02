<?php

use Contao\Config;

$GLOBALS['TL_HEAD'][] =
"
<!-- Matomo -->
<script>
  var _paq = window._paq = window._paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u='".Config::get('analytics_remote_url')."';
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '".Config::get('analytics_remote_IdSite')."']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img referrerpolicy='no-referrer-when-downgrade' src='".Config::get('analytics_remote_url')."/matomo.php?idsite=".Config::get('analytics_remote_IdSite')."&amp;rec=1' style='border:0;' alt='' /></p></noscript>
<!-- End Matomo Code -->
";