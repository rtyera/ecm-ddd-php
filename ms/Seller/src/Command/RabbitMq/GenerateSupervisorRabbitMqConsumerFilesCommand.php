<?php

declare(strict_types=1);

namespace TyCode\ms\Seller\Command\RabbitMq;

use TyCode\Shared\Domain\Bus\Event\EventSubscriber;
use TyCode\Shared\Infrastructure\Bus\Event\EventSubscriberLocator;
use TyCode\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqQueueNameFormatter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Lambdish\Phunctional\each;

final class GenerateSupervisorRabbitMqConsumerFilesCommand extends Command
{
    private const EVENTS_TO_PROCESS_AT_TIME           = 200;
    private const NUMBERS_OF_PROCESSES_PER_SUBSCRIBER = 1;
    private const SUPERVISOR_PATH                     = __DIR__ . '/../../../build/supervisor';
    protected static $defaultName = 'ecm:seller:rabbitmq:events:generate-supervisor-files';

    private EventSubscriberLocator $locator;

    public function __construct(EventSubscriberLocator $locator)
    {
        $this->locator = $locator;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Generate the supervisor configuration for every RabbitMQ subscriber')
            ->addArgument('command-path', InputArgument::OPTIONAL, 'Path on this is gonna be deployed', '/var/www');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path = (string) $input->getArgument('command-path');

        each($this->configCreator($path), $this->locator->all());

        return 0;
    }

    private function configCreator(string $path): callable
    {
        return function (EventSubscriber $subscriber) use ($path): void {
            $queueName      = RabbitMqQueueNameFormatter::format($subscriber);
            $subscriberName = RabbitMqQueueNameFormatter::shortFormat($subscriber);

            $fileContent = str_replace(
                [
                    '{subscriber_name}',
                    '{queue_name}',
                    '{path}',
                    '{processes}',
                    '{events_to_process}',
                ],
                [
                    $subscriberName,
                    $queueName,
                    $path,
                    self::NUMBERS_OF_PROCESSES_PER_SUBSCRIBER,
                    self::EVENTS_TO_PROCESS_AT_TIME,
                ],
                $this->template()
            );

            file_put_contents($this->fileName($subscriberName), $fileContent);
        };
    }

    private function template(): string
    {
        return <<<EOF
            [program:ecm_{queue_name}]
            command      = {path}/ms/Seller/bin/console ecm:rabbitmq:events:consume --env=prod {queue_name} {events_to_process}
            process_name = %(program_name)s_%(process_num)02d
            numprocs     = {processes}
            startsecs    = 1
            startretries = 10
            exitcodes    = 2
            stopwaitsecs = 300
            autostart    = true
            EOF;
    }

    private function fileName(string $queue): string
    {
        return sprintf('%s/%s.conf', self::SUPERVISOR_PATH, $queue);
    }
}
