<?php

declare(strict_types=1);

namespace BPM\FireAndForgetClient;

use Psr\Http\Message\RequestInterface;

final class HttpClient implements ClientInterface
{
    public function sendRequest(RequestInterface $request): void
    {
        $uri     = $request->getUri();
        $port    = $uri->getPort();
        $isHttps = $uri->getScheme() === 'https';

        if ($port === null) {
            $port = $isHttps ? 443 : 80;
        }

        $socket  = fsockopen(($isHttps ? 'tls://' : '') . $uri->getHost(), $port);
        $message = RequestFormatter::toString($request);

        fwrite($socket, $message);
        fclose($socket);
    }
}
