<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//namespace Symfony\Component\Mailer;

require "vendor/symfony/event-dispatcher/EventDispatcherInterface.php";
require "vendor/symfony/mailer/event/MessageEvent.php";
require "vendor/symfony/mailer/Exception/TransportExceptionInterface.php";
require "vendor/symfony/mailer/Messenger/SendEmailMessage.php";
require "vendor/symfony/mailer/Transport/TransportInterface.php";
//require "vendor/symfony/mailer/Messenger/Exception\HandlerFailedException;
//require "vendor/symfony/mailer/Messenger/MessageBusInterface;
//require "vendor/symfony/mime/RawMessage.php";

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class Mailer implements MailerInterface
{
    private TransportInterface $transport;
    //private ?MessageBusInterface $bus;
    private ?EventDispatcherInterface $dispatcher;

    public function __construct(TransportInterface $transport, EventDispatcherInterface $dispatcher = null)
    {
        $this->transport = $transport;
        //$this->bus = $bus;
        $this->dispatcher = $dispatcher;
    }

    public function send(RawMessage $message, Envelope $envelope = null): void
    {
            $this->transport->send($message, $envelope);

        $stamps = [];
        if (null !== $this->dispatcher) {
            // The dispatched event here has `queued` set to `true`; the goal is NOT to render the message, but to let
            // listeners do something before a message is sent to the queue.
            // We are using a cloned message as we still want to dispatch the **original** message, not the one modified by listeners.
            // That's because the listeners will run again when the email is sent via Messenger by the transport (see `AbstractTransport`).
            // Listeners should act depending on the `$queued` argument of the `MessageEvent` instance.
            $clonedMessage = clone $message;
            $clonedEnvelope = null !== $envelope ? clone $envelope : Envelope::create($clonedMessage);
            $event = new MessageEvent($clonedMessage, $clonedEnvelope, (string) $this->transport, true);
            $this->dispatcher->dispatch($event);
            $stamps = $event->getStamps();
        }

        try {
            $this->bus->dispatch(new SendEmailMessage($message, $envelope), $stamps);
        } catch (Exception $e) {
            foreach ($e->getNestedExceptions() as $nested) {
                if ($nested instanceof TransportExceptionInterface) {
                    throw $nested;
                }
            }
            throw $e;
        }
    }
}