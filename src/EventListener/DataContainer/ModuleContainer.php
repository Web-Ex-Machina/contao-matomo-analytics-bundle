<?php

namespace WEM\MatomoBundle\EventListener\DataContainer;

use Contao\Config;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use WEM\UtilsBundle\Classes\Encryption;

readonly class ModuleContainer
{
    public function __construct(
        private Encryption          $encryption,
        private HttpClientInterface $client
    ) {

    }

    public function getWebsites(): array

    {
        if (
            (Config::get('analytics_remote_url') !== '' AND Config::get('analytics_remote_url') !== null)
            AND
            (Config::get('analytics_remote_api_key') !== '' AND Config::get('analytics_remote_api_key') !== null)
        ){
            try {
                $response = $this->client->request(
                    'POST',
                    Config::get('analytics_remote_url') . '/index.php', [
                    'query' => [
                        'module' => 'API',
                        'method' => 'SitesManager.getSitesWithAtLeastViewAccess',
                        'format' => 'JSON',
                        'token_auth' => $this->encryption->decrypt_b64(Config::get('analytics_remote_api_key')),
                        ],
                    ],
                );

                $list=[];

                foreach ($response->toArray() as $value) {
                    $list[$value['idsite']] = $value['name'];
                }

                return $list;

            }catch (\Exception $e) {

            }

        }
        return [];
    }
}