<?php

declare(strict_types=1);

/*
 * Matomo Bundle for Contao Open Source CMS
 * @author     Web Ex Machina
 *
 * @see        https://github.com/Web-Ex-Machina/contao-matomo-analytics-bundle
 * @license    https://www.apache.org/licenses/LICENSE-2.0 Apache 2.0
 */

namespace WEM\MatomoBundle\EventListener\DataContainer;

use Contao\PageModel;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use WEM\UtilsBundle\Classes\Encryption;

readonly class ModuleContainer
{
    public function __construct(
        private Encryption $encryption,
        private HttpClientInterface $client
    ) {

    }

    public function getWebsites(): array
    {

        $objContent = PageModel::findById($GLOBALS['_GET']['id']);
        // TODO : Best solution for recup the data ?

        if ($objContent->analytics_remote_api_key !== '' && filter_var($objContent->analytics_remote_url, FILTER_VALIDATE_URL) !== false){
            $list = [];
            try {
                $response = $this->client->request(
                    'POST',
                    $objContent->analytics_remote_url . '/index.php',
                    [
                        'query' => [
                            'module' => 'API',
                            'method' => 'SitesManager.getSitesWithAtLeastViewAccess',
                            'format' => 'JSON',
                            'token_auth' => $this->encryption->decrypt_b64($objContent->analytics_remote_api_key),
                        ],
                    ],
                );

                foreach ($response->toArray() as $value) {
                    $list[$value['idsite']] = $value['name'];
                }

                return $list;

            } catch (\Exception $e) {
                return [0 => $e->getMessage()];
            }

        }

        return [];
    }
}
