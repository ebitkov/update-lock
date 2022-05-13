<?php

namespace Ebitkov\UpdateLockBundle\EventSubscriber;

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelInterface;
use Twig\Environment;

class RequestSubscriber implements EventSubscriberInterface
{
    private Environment $twig;


    public function __construct(Environment $twig, KernelInterface $kernel)
    {
        $this->twig = $twig;

        // load custom env file
        $rootDir = $kernel->getProjectDir();
        (new Dotenv())->loadEnv($rootDir . '/.app_lock');
    }

    public function onKernelRequest(RequestEvent $event)
    {
        if ($_ENV['APP_LOCKED'] === 'true') {
            // Sperren der gesamten Seite, wenn Composer aktualisiert
            $event->setResponse(new Response($this->twig->render('@EbitkovUpdateLock/locked_app.html.twig'), 503));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.request' => 'onKernelRequest',
        ];
    }
}