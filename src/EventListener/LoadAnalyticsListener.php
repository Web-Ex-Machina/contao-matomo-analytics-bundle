<?php

namespace WEM\MatomoBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\FrontendTemplate;
use Contao\Module;
use Contao\Config;

class LoadAnalyticsListener
{
    #[AsHook('parseFrontendTemplate', priority: 100)]
    public function __invoke(string $buffer, string $templateName, FrontendTemplate $template): string
    {

        if (Config::get('analytics_remote_id') !== '' AND Config::get('analytics_remote_id') !== null) {
            $GLOBALS['TL_HEAD'][] =
                "
            <!-- Matomo -->
            <script>
              var _paq = window._paq = window._paq || [];
              _paq.push(['trackPageView']);
              _paq.push(['enableLinkTracking']);
              (function() {
                var u='" . Config::get('analytics_remote_url') . "/';
                _paq.push(['setTrackerUrl', u+'matomo.php']);
                _paq.push(['setSiteId', '" . Config::get('analytics_remote_id') . "']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
              })();
            </script>
            <noscript><p><img referrerpolicy='no-referrer-when-downgrade' src='" . Config::get('analytics_remote_url') . "/matomo.php?idsite=" . Config::get('analytics_remote_id') . "&amp;rec=1' style='border:0;' alt='' /></p></noscript>
            <!-- End Matomo Code -->
            ";
        }
        return $buffer;
    }
}