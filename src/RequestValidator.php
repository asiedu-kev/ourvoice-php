<?php

namespace Ourvoice\Sdk;

use Ourvoice\Sdk\Values;


class RequestValidator {

    /**
     * @access private
     * @var string The auth token to the Twilio Account
     */
    private $authToken;

    
    public function __construct(string $authToken) {
        $this->authToken = $authToken;
    }

    public function computeSignature(string $url, array $data = []): string {
        // sort the array by keys
        \ksort($data);

        foreach ($data as $key => $value) {
            // convert a single value to an array or remove any duplicates
            $valueArray = \is_array($value) ? \array_unique($value) : array($value);
            // also sort all the values
            \sort($valueArray);

            // append them to the data string with no delimiters
            foreach ($valueArray as $item) {
                $url .= $key . $item;
            }
        }

        // sha1 then base64 the url to the auth token and return the base64-ed string
        return \base64_encode(\hash_hmac('sha1', $url, $this->authToken, true));
    }

    /**
     * Converts the raw binary output to a hexadecimal return
     *
     * @param string $data
     * @return string
     */
    public static function computeBodyHash(string $data = ''): string {
        return \bin2hex(\hash('sha256', $data, true));
    }

    /**
     * The only method the client should be running...takes the Twilio signature, their URL, and the Twilio params and validates the signature
     *
     * @param string $expectedSignature
     * @param string $url
     * @param array|string $data
     * @return bool
     */
    public function validate(string $expectedSignature, string $url, $data = []): bool {
        $parsedUrl = \parse_url($url);

        $urlWithPort = self::addPort($parsedUrl);
        $urlWithoutPort = self::removePort($parsedUrl);
        $validBodyHash = true;  // May not receive body hash, so default succeed

        if (!\is_array($data)) {
            // handling if the data was passed through as a string instead of an array of params
            $queryString = \explode('?', $url);
            $queryString = $queryString[1];
            \parse_str($queryString, $params);

            $validBodyHash = self::compare(self::computeBodyHash($data), Values::array_get($params, 'bodySHA256'));
            $data = [];
        }

       
        $validSignatureWithPort = self::compare(
            $expectedSignature,
            $this->computeSignature($urlWithPort, $data)
        );
        $validSignatureWithoutPort = self::compare(
            $expectedSignature,
            $this->computeSignature($urlWithoutPort, $data)
        );

        return $validBodyHash && ($validSignatureWithPort || $validSignatureWithoutPort);
    }

   
    public static function compare(?string $a, ?string $b): bool {
        if ($a && $b) {
            return hash_equals($a, $b);
        }

        return false;
    }

   
    private static function removePort(array $parsedUrl): string {
        unset($parsedUrl['port']);
        return self::unparse_url($parsedUrl);
    }

    
    private static function addPort(array $parsedUrl): string {
        if (!isset($parsedUrl['port'])) {
            $port = ($parsedUrl['scheme'] === 'https') ? 443 : 80;
            $parsedUrl['port'] = $port;
        }
        return self::unparse_url($parsedUrl);
    }

  
    static function unparse_url(array $parsedUrl): string {
        $parts = [];

        $parts['scheme'] = isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] . '://' : '';
        $parts['user'] = $parsedUrl['user'] ?? '';
        $parts['pass'] = isset($parsedUrl['pass']) ? ':' . $parsedUrl['pass'] : '';
        $parts['pass'] = ($parts['user'] || $parts['pass']) ? $parts['pass'] . '@' : '';
        $parts['host'] = $parsedUrl['host'] ?? '';
        $parts['port'] = isset($parsedUrl['port']) ? ':' . $parsedUrl['port'] : '';
        $parts['path'] = $parsedUrl['path'] ?? '';
        $parts['query'] = isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '';
        $parts['fragment'] = isset($parsedUrl['fragment']) ? '#' . $parsedUrl['fragment'] : '';

        return \implode('', $parts);
    }
}