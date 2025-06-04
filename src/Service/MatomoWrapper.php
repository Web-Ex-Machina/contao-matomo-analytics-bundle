<?php

declare(strict_types=1);

/*
 * Matomo Bundle for Contao Open Source CMS
 * @author     Web Ex Machina
 *
 * @see        https://github.com/Web-Ex-Machina/contao-matomo-analytics-bundle
 * @license    https://www.apache.org/licenses/LICENSE-2.0 Apache 2.0
 */

namespace WEM\MatomoBundle\Service;

use Contao\CoreBundle\Controller\AbstractBackendController;
use Contao\PageModel;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use WEM\UtilsBundle\Classes\Encryption;

class MatomoWrapper extends AbstractBackendController
{
    public function __construct(
        private readonly Encryption $encryption,
        private readonly HttpClientInterface $client,
    )
    {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws \Exception
     */
    public function request(string $method, $objContent): array
    {
        if ($objContent->analytics_remote_api_key !== '' && filter_var($objContent->analytics_remote_url, FILTER_VALIDATE_URL) !== false){
            return $this->client->request(
                'POST',
                $objContent->analytics_remote_url . '/index.php',
                [
                    'query' => [
                        'module' => 'API',
                        'method' => $method,
                        'format' => 'JSON',
                        'token_auth' => $this->encryption->decrypt_b64($objContent->analytics_remote_api_key),
                        'idSite' => 20, //$objContent->analytics_remote_id,
                        'period' => 'month',
                        'date' => 'today',
                        'language' => $GLOBALS['TL_LANGUAGE']
                    ],
                ],
            )->toArray();
        }
        throw new \Exception('Analytics API not initialized.');

    }
}