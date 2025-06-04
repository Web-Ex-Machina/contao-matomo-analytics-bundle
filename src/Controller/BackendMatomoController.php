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
use Contao\PageModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use WEM\MatomoBundle\Service\MatomoWrapper;
use WEM\UtilsBundle\Classes\Encryption;

#[Route('%contao.backend.route_prefix%/{id}/matomo_analytics', name: self::class, defaults: ['_scope' => 'backend'])]
//#[IsGranted('ROLE_ADMIN', message: 'Access restricted to administrators.')]
class BackendMatomoController extends AbstractBackendController
{

    public function __invoke(Request $request,MatomoWrapper $matomo): Response
    {
        $objContent = PageModel::findById($request->get('id'));


        return $this->render('@Contao/matomo_bundle/matomo.html.twig', [
            'version' => "Matomo ".$matomo->request(method:"API.getMatomoVersion",objContent: $objContent)['value'],
            'objContent' => $objContent,
            'browsers' =>  $matomo->request(method:"DevicesDetection.getBrowsers",objContent: $objContent),
            'insight' => $matomo->request(method:"API.get",objContent: $objContent),
        ]);
    }
}
