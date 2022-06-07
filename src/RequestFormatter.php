<?php

declare(strict_types=1);

namespace BPM\FireAndForgetClient;

use Psr\Http\Message\RequestInterface;

final class RequestFormatter
{
    public static function toString(RequestInterface $request): string
    {
        $message = sprintf(
            "%s %s HTTP/%s\n",
            $request->getMethod(),
            $request->getRequestTarget(),
            $request->getProtocolVersion()
        );

        if ($request->hasHeader('Host') === false) {
            $message .= 'Host: ' . $request->getUri()->getHost() . "\n";
        }

        foreach ($request->getHeaders() as $name => $values) {
            $message .= $name . ': ' . implode(', ', $values) . "\n";
        }

        return $message . "\n" . $request->getBody();
    }
}
