<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\Http\Header\ContentType;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource\Template;

final class TwigTemplate extends Template
{
    public static function set(string $filename, array $parameters = [], StatusCode $statusCode = StatusCode::OK): self
    {
        $httpConfig = HttpConfig::set($statusCode, [
            new ContentType(MimeType::HTML),
        ]);

        return new self($filename, $parameters, $httpConfig);
    }

    protected function type(): string
    {
        return 'twig';
    }
}
