<?php

namespace WEM\MatomoBundle\EventListener\DataContainer;

use Contao\Backend;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Contao\Image;
use Contao\PageModel;
use Contao\StringUtil;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\RouterInterface;

//use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

#[AsCallback(table: 'tl_page', target: 'list.operations.analytics.button')]
readonly class AnalyticsShowOperationListener
{
    public function __construct(
        //private AuthorizationCheckerInterface $authorizationChecker,
        private readonly RouterInterface $router,
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
        if (in_array($row['id'], $rootRecordIds)) {
            if ($row['analytics_remote_id'] !== null && $row['analytics_remote_id'] !== '') {
                $route = $this->router->generate("WEM\MatomoBundle\Controller\BackendMatomoController",['id'=>$row['id']]);
                return "<a href='".$route."' title='".StringUtil::specialchars($title)."' ".$attributes.">A</a>";
            }
        }
        return '';

    }
}