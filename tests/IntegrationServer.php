<?php

declare(strict_types=1);

/**
 * This script accepts a mocked endpoint response, delivers the response and then exits.
 */

// Ensure the script was started from the CLI
if (php_sapi_name() !== 'cli-server') {
    throw new Exception("This script must be started from the command line.");
}

define('AUTH0_TESTS_DIR', dirname(__FILE__));

require_once implode(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, '..', 'vendor', 'autoload.php']);

$request = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

// $file = implode(DIRECTORY_SEPARATOR, $input->getArgument('file'));
// $path = realpath((implode(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, 'Integration', $file])));

// if ($path === false) {
//     return Command::INVALID;
// }

// $integration = include($path);
// $integration->mock();
// return $integration->test();

var_dump($request);
exit;
