<?php

declare(strict_types=1);

namespace Auth0\SDK\Test;

use Symfony\Component\Console\Command\Command;

final class Integration {
    private \Auth0\SDK\Auth0 $sdk;
    private \Auth0\SDK\Configuration\SdkConfiguration $config;

    public function __construct(
        \Auth0\SDK\Auth0 $sdk,
        \Auth0\SDK\Configuration\SdkConfiguration $config
    )
    {
        $this->sdk = $sdk;
        $this->config = $config;
    }

    public function mock(): self {
        // spin up mock backend server to return a specified response and status code
        // once the request is made and response is returned, the mock backend server exits

        return $this;
    }

    public function test(): int {
        $endpoint = $this->sdk->management()->jobs();

        // have SDK call the mock endpoint, process the response, and validate it
        return Command::SUCCESS;
    }
}

return new Integration;
