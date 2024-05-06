<?php

declare(strict_types=1);

namespace TyCode\ms\Shop\Command\RabbitMq;

use TyCode\Shared\Infrastructure\Bus\Event\EventSubscriberLocator;
use TyCode\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqEventsConsumer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Lambdish\Phunctional\repeat;

final class ConsumeRabbitMqEventsCommand extends Command
{
    protected static $defaultName = 'ecm:shop:rabbitmq:events:consume';
    private RabbitMqEventsConsumer $consumer;
    private EventSubscriberLocator $locator;

    public function __construct(
        RabbitMqEventsConsumer $consumer,
        EventSubscriberLocator $locator
    ) {
        $this->consumer = $consumer;
        $this->locator = $locator;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Consume domain events from the RabbitMQ')
            ->addArgument('queue', InputArgument::REQUIRED, 'Queue name')
            ->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of events to process');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $queueName       = (string) $input->getArgument('queue');
        $eventsToProcess = (int) $input->getArgument('quantity');
        repeat($this->consumer($queueName), $eventsToProcess);

        return 0;
    }

    private function consumer(string $queueName): callable
    {
        return function () use ($queueName): void {
            $subscriber = $this->locator->withRabbitMqQueueNamed($queueName);
            $this->consumer->consume($subscriber, $queueName);
        };
    }
}
