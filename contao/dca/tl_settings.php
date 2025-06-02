<?php

declare(strict_types=1);

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use WEM\MatomoBundle\EventListener\DataContainer\ModuleContainer;
use WEM\UtilsBundle\Classes\Encryption;

$GLOBALS['TL_DCA']['tl_settings']['fields']['analytics_remote_url'] = [
    'inputType' => 'text',
    "required" => false,
    'eval' => [
        'rgxp' => 'url',
    ],
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['analytics_remote_id'] = [
    'exclude' => true,
    "required" => false,
    'options_callback' => [ModuleContainer::class, 'getWebsites'],
    'inputType' => 'select',
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['analytics_remote_api_key'] = [
    'exclude' => true,
    "required" => false,
    'inputType' => 'password',
    'load_callback' => [[Encryption::class, 'decrypt_b64']],
    'save_callback' => [[Encryption::class, 'encrypt_b64']],
];

PaletteManipulator::create()
    ->addField('analytics_remote_url', 'analytics_remote_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('analytics_remote_api_key', 'analytics_remote_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('analytics_remote_id', 'analytics_remote_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_settings');

