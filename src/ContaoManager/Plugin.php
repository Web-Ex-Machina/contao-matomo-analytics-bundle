<?php

declare(strict_types=1);

/*
 * Matomo Bundle for Contao Open Source CMS
 * @author     Web Ex Machina
 *
 * @see        https://github.com/Web-Ex-Machina/contao-matomo-analytics-bundle
 * @license    https://www.apache.org/licenses/LICENSE-2.0 Apache 2.0
 */

namespace WEM\MatomoBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Routing\RoutingPluginInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use WEM\MatomoBundle\MatomoBundle;

class Plugin implements BundlePluginInterface, RoutingPluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [BundleConfig::create(MatomoBundle::class)->setLoadAfter([ContaoCoreBundle::class])];
    }

    public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel)
    {
        return $resolver
            ->resolve(__DIR__ . '/../Controller', 'attribute')
            ->load(__DIR__ . '/../Controller')
        ;
    }
}
