<?php

declare(strict_types=1);

/*
 * Matomo Bundle for Contao Open Source CMS
 * @author     Web Ex Machina
 *
 * @see        https://github.com/Web-Ex-Machina/contao-matomo-analytics-bundle
 * @license    https://www.apache.org/licenses/LICENSE-2.0 Apache 2.0
 */

namespace WEM\MatomoBundle\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(ContaoCoreEvents::BACKEND_MENU_BUILD, priority: -255)]
final readonly class MatomoBackendMenuListener
{
    public function __invoke(): void
    {
        //        $factory = $event->getFactory();
        //        $tree = $event->getTree();
        //
        //        if ($tree->getName() !== 'mainMenu') {
        //            return;
        //        }
        //
        //        $contentNode = $tree->getChild('content');
        //
        //        $node = $factory
        //            ->createItem('my-matomo', ['route' => BackendMatomoController::class])
        //            ->setLabel('Matomo Menu')
        //            ->setLinkAttribute('title', 'Title')
        //            ->setLinkAttribute('class', 'my-matomo')
        //            ->setCurrent(
        //                $this->requestStack->getCurrentRequest()->get('_controller') === BackendMatomoController::class
        //            )
        //        ;
        //
        //        $contentNode->addChild($node);
    }
}
