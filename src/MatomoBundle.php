<?php

declare(strict_types=1);

/*
 * Matomo Bundle for Contao Open Source CMS
 * @author     Web Ex Machina
 *
 * @see        https://github.com/Web-Ex-Machina/contao-matomo-analytics-bundle
 * @license    https://www.apache.org/licenses/LICENSE-2.0 Apache 2.0
 */

namespace WEM\MatomoBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class MatomoBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void
    {
        $containerConfigurator->import('../config/services.yaml');
    }
}
