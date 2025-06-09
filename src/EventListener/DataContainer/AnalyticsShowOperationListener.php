<?php

namespace WEM\MatomoBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Contao\StringUtil;
use Symfony\Component\Routing\RouterInterface;
use WEM\MatomoBundle\Controller\BackendMatomoController;

#[AsCallback(table: 'tl_page', target: 'list.operations.analytics.button')]
readonly class AnalyticsShowOperationListener
{
    public function __construct(
        private RouterInterface $router,
    ) {
    }

    public function __invoke(
        array $row,
        ?string $href,
        string $label,
        string $title,
        ?string $icon,
        string $attributes,
        string $table,
        array $rootRecordIds,
        ?array $childRecordIds,
        bool $circularReference,
        ?string $previous,
        ?string $next,
        DataContainer $dc
    ): string
    {
        //Image::getHtml($icon, $label)
        if (in_array($row['id'], $rootRecordIds) && ($row['analytics_remote_id'] !== null && $row['analytics_remote_id'] !== '')) {
            $route = $this->router->generate(BackendMatomoController::class,['id'=>$row['id']]);
            return "<a href='".$route."' title='".StringUtil::specialchars($title)."' ".$attributes.">A</a>";
        }

        return '';

    }
}