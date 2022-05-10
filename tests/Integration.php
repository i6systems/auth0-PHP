<?php

declare(strict_types=1);

define('AUTH0_TESTS_DIR', dirname(__FILE__));

require_once implode(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, '..', 'vendor', 'autoload.php']);

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class IntegrationTests extends Application
{
    protected function getDefaultInputDefinition(): InputDefinition
    {
        $definition = parent::getDefaultInputDefinition();
        return $definition;
    }
}

$app = new IntegrationTests();
$config = null;
$sdk = null;

class RunIntegration extends Command
{
    protected static $defaultName = 'run';
    protected static $defaultDescription = 'Run an integration test';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = implode(DIRECTORY_SEPARATOR, explode('::', $input->getArgument('file'))) . '.php';
        $path = realpath((implode(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, 'Integration', $file])));

        if ($path === false) {
            return Command::INVALID;
        }

        $integration = include($path);

        // $config = new \Auth0\SDK\Configuration\SdkConfiguration();
        // $sdk = new \Auth0\SDK\Auth0($config);

        $integration->mock();

        try {
            return $integration->test();
        } catch (\Throwable $th) {
            return Command::FAILURE;
        }
    }

    protected function configure(): void
    {
        $this->addArgument('file', InputArgument::REQUIRED, 'Integration test to run');
    }
}

$app->add(new RunIntegration());

$app->run();
