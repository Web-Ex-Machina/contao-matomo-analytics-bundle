<?php

declare(strict_types=1);

namespace WEM\MatomoBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Contao\Image;
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
        $image_light = Image::getHtml(src:"/bundles/matomo/img/reports-light.svg", alt:"Analytics",attributes: "class=color-scheme--light");
        $image_dark = Image::getHtml(src:"/bundles/matomo/img/reports-dark.svg", alt:"Analytics",attributes: "class=color-scheme--dark");

        $is_in_array = in_array($row['id'], $rootRecordIds);
        $is_configured = ($row['analytics_remote_id'] !== null && $row['analytics_remote_id'] !== '');

        if ( $is_in_array && $is_configured ) {
            $route = $this->router->generate(BackendMatomoController::class,['id'=>$row['id']]);
            return "<a href='".$route."' title='".StringUtil::specialchars($title)."' ".$attributes.">".$image_light.$image_dark."</a>";
        }

        return '';

    }
}
