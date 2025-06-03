<?php

declare(strict_types=1);

/*
 * Matomo Bundle for Contao Open Source CMS
 * @author     Web Ex Machina
 *
 * @see        https://github.com/Web-Ex-Machina/contao-matomo-analytics-bundle
 * @license    https://www.apache.org/licenses/LICENSE-2.0 Apache 2.0
 */

namespace WEM\MatomoBundle\Controller;

use Contao\CoreBundle\Controller\AbstractBackendController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('%contao.backend.route_prefix%/matomo_analytics', name: self::class, defaults: ['_scope' => 'backend'])]
#[IsGranted('ROLE_ADMIN', message: 'Access restricted to administrators.')]
class BackendMatomoController extends AbstractBackendController
{
    public function __invoke(): Response
    {
        return $this->render('@Contao/matomo_bundle/matomo.html.twig', [
            'error' => 'Oh no, an error!',
            'title' => 'My title',
            'headline' => 'My headline',
            'version' => 'I can overwrite what I want',
            'foo' => 'bar',
        ]);
    }
}
