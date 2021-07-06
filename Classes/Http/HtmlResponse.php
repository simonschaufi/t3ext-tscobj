<?php

declare(strict_types=1);

namespace Causal\Tscobj\Http;

use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Http\Stream;

/**
 * A default HTML response object
 *
 * Highly inspired by ZF zend-diactoros
 */
class HtmlResponse extends Response
{
    /**
     * Creates a HTML response object with a default 200 response code
     *
     * @param string $content HTML content written to the response
     * @param int $status status code for the response; defaults to 200.
     * @param array $headers Additional headers to be set.
     */
    public function __construct($content, $status = 200, array $headers = [])
    {
        $body = new Stream('php://temp', 'wb+');
        $body->write($content);
        $body->rewind();
        parent::__construct($body, $status, $headers);

        // Ensure that text/html header is set, if Content-Type was not set before
        if (!$this->hasHeader('Content-Type')) {
            $this->headers['Content-Type'][] = 'text/html; charset=utf-8';
            $this->lowercasedHeaderNames['content-type'] = 'Content-Type';
        }
    }
}
