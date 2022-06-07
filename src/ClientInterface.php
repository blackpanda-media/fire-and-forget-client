<?php

declare(strict_types=1);

namespace BPM\FireAndForgetClient;

use Psr\Http\Message\RequestInterface;

interface ClientInterface
{
    public function sendRequest(RequestInterface $request): void;
}
