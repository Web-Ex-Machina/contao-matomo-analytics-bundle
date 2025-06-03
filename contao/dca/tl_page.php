<?php

declare(strict_types=1);

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use WEM\MatomoBundle\EventListener\DataContainer\ModuleContainer;
use WEM\UtilsBundle\Classes\Encryption;

$GLOBALS['TL_DCA']['tl_page']['fields']['analytics_remote_url'] = [
    'inputType' => 'text',
    "required" => false,
    'eval' => [
        'rgxp' => 'url',
        'tl_class' => 'w50'
    ],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['analytics_remote_id'] = [
    'exclude' => true,
    "required" => false,
    'options_callback' => [ModuleContainer::class, 'getWebsites'],
    'inputType' => 'select',
    'eval' => [
        'tl_class' => 'w50'
    ],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['analytics_remote_api_key'] = [
    'exclude' => true,
    "required" => false,
    'inputType' => 'text',
    'load_callback' => [[Encryption::class, 'decrypt_b64']],
    'save_callback' => [[Encryption::class, 'encrypt_b64']],
    'eval' => [
        'tl_class' => 'w50'
    ],
    'sql' => "varchar(255) NOT NULL default ''",
];

PaletteManipulator::create()
    ->addLegend('analytics_legend')
    ->addField('analytics_remote_url', 'analytics_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('analytics_remote_api_key', 'analytics_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('analytics_remote_id', 'analytics_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette("root", 'tl_page')
    ->applyToPalette("rootfallback", 'tl_page');
