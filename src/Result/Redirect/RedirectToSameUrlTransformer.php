<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Redirect;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Tuzex\Responder\Bridge\HttpFoundation\Response\RedirectResponseFactory;
use Tuzex\Responder\Exception\UnsupportedResultException;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\ResultTransformer;
use Tuzex\Responder\Service\UriProvider;

final class RedirectToSameUrlTransformer implements ResultTransformer
{
    private UriProvider $uriProvider;
    private RedirectResponseFactory $redirectResponseFactory;

    public function __construct(UriProvider $uriProvider, RedirectResponseFactory $redirectResponseFactory)
    {
        $this->uriProvider = $uriProvider;
        $this->redirectResponseFactory = $redirectResponseFactory;
    }

    public function supports(Result $result): bool
    {
        return $result instanceof RedirectToSameUrl;
    }

    /**
     * @param RedirectToSameUrl $result
     */
    public function transform(Result $result): RedirectResponse
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResultException($result, self::class);
        }

        return $this->redirectResponseFactory->create($this->uriProvider->provide(), $result->getHttpConfig());
    }
}
