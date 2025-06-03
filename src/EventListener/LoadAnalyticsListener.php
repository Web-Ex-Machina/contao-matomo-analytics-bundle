<?php

namespace WEM\MatomoBundle\EventListener;

use Contao\ArticleModel;
use Contao\Controller;
use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\FrontendTemplate;
use Contao\Module;
use Contao\Config;
use Contao\PageModel;

class LoadAnalyticsListener
{

    #[AsHook('parseFrontendTemplate', priority: 100)]
    public function __invoke(string $buffer, string $templateName, FrontendTemplate $template): string
    {
        $objContent = PageModel::findById($GLOBALS['objPage']->rootId);
        // TODO : Best solution for recup the data

        if ($objContent === null) {
            return $buffer;
        }

        if ($objContent->analytics_remote_api_key !== '' && $objContent->analytics_remote_url !== '' && $objContent->analytics_remote_id !== '') {
            $GLOBALS['TL_HEAD'][] =
                "
            <!-- Matomo -->
            <script>
              var _paq = window._paq = window._paq || [];
              _paq.push(['trackPageView']);
              _paq.push(['enableLinkTracking']);
              (function() {
                var u='" . $objContent->analytics_remote_url . "/';
                _paq.push(['setTrackerUrl', u+'matomo.php']);
                _paq.push(['setSiteId', '" . $objContent->analytics_remote_id . "']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
              })();
            </script>
            <noscript><p><img referrerpolicy='no-referrer-when-downgrade' src='" . $objContent->analytics_remote_url . "/matomo.php?idsite=" . $objContent->analytics_remote_id . "&amp;rec=1' style='border:0;' alt='' /></p></noscript>
            <!-- End Matomo Code -->
            ";
        }

        return $buffer;
    }
}