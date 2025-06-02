<?php

declare(strict_types=1);

namespace WEM\MatomoBundle\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\MenuEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RequestStack;
use WEM\MatomoBundle\Controller\BackendMatomoController;

#[AsEventListener(ContaoCoreEvents::BACKEND_MENU_BUILD, priority: -255)]
final readonly class MatomoBackendMenuListener
{
    public function __construct(
//        private RequestStack $requestStack
    ) {
    }

    public function __invoke(MenuEvent $event): void
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
