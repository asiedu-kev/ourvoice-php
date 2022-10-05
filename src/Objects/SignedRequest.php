<?php

namespace Ourvoice\Sdk\Objects;

use Ourvoice\Sdk\Exceptions\ValidationException;
use Ourvoice\Sdk\RequestValidator;


class SignedRequest extends Base
{
   
    public $requestTimestamp;

    /**
     * The request body.
     *
     * @var string
     */
    public $body;

    /**
     * The query parameters for the request.
     *
     * @var array
     */
    public $queryParameters = [];

    
    public $signature;

    /**
     * Create a new SignedRequest from PHP globals.
     *
     * @throws ValidationException when a required parameter is missing.
     * @deprecated Use {@link RequestValidator::validateRequestFromGlobals()} instead.
     */
    public static function createFromGlobals(): SignedRequest
    {
        $body = file_get_contents('php://input');
        $queryParameters = $_GET;
        $requestTimestamp = isset($_SERVER['HTTP_OURVOICESDK_REQUEST_TIMESTAMP']) ?
            (int)$_SERVER['HTTP_OURVOICESDK_REQUEST_TIMESTAMP'] : null;
        $signature = $_SERVER['HTTP_OURVOICESDK_SIGNATURE'] ?? null;

        $signedRequest = new self();
        $signedRequest->loadFromArray(compact('body', 'queryParameters', 'requestTimestamp', 'signature'));

        return $signedRequest;
    }

    /**
     * Create a SignedRequest from the provided data.
     *
     * @param string|array $query The query string from the request
     * @param string $signature The base64-encoded signature for the request
     * @param int $requestTimestamp The UNIX timestamp for the time the request was made
     * @param string $body The request body
     * @return SignedRequest
     * @throws ValidationException when a required parameter is missing.
     * @deprecated Use {@link RequestValidator::validateSignature()} instead.
     */
    public static function create($query, string $signature, int $requestTimestamp, string $body): SignedRequest
    {
        if (is_string($query)) {
            $queryParameters = [];
            parse_str($query, $queryParameters);
        } else {
            $queryParameters = $query;
        }

        $signedRequest = new self();
        $signedRequest->loadFromArray(compact('body', 'queryParameters', 'requestTimestamp', 'signature'));

        return $signedRequest;
    }

    /**
     * {@inheritdoc}
     * @throws ValidationException when a required parameter is missing.
     */
    public function loadFromArray($object): self
    {
        if (!isset($object['requestTimestamp']) || !\is_int($object['requestTimestamp'])) {
            throw new ValidationException('The "requestTimestamp" value is missing or invalid.');
        }

        if (!isset($object['signature']) || !\is_string($object['signature'])) {
            throw new ValidationException('The "signature" parameter is missing.');
        }

        if (!isset($object['queryParameters']) || !\is_array($object['queryParameters'])) {
            throw new ValidationException('The "queryParameters" parameter is missing or invalid.');
        }

        if (!isset($object['body']) || !\is_string($object['body'])) {
            throw new ValidationException('The "body" parameter is missing.');
        }

        return parent::loadFromArray($object);
    }
}
