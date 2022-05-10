<?php

declare(strict_types=1);

namespace Auth0\SDK\Test;

final class Response {
    public function configure(): self {
        return $this;
    }

    public function respond(): self {
        http_response_code(200);

        echo json_encode([
            'something' => 'yadda'
        ], JSON_PRETTY_PRINT);

        return $this;
    }
}

return new Response;
