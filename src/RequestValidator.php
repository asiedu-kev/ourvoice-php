<?php

namespace Ourvoice;

use Ourvoice\Values;


class RequestValidator {

   
    private $authToken;

    
    public function __construct(string $authToken) {
        $this->authToken = $authToken;
    }

    public function computeSignature(string $url, array $data = []): string {
       
        \ksort($data);

        foreach ($data as $key => $value) {
            $valueArray = \is_array($value) ? \array_unique($value) : array($value);
            \sort($valueArray);

            
            foreach ($valueArray as $item) {
                $url .= $key . $item;
            }
        }

        
        return \base64_encode(\hash_hmac('sha1', $url, $this->authToken, true));
    }

    
    public static function computeBodyHash(string $data = ''): string {
        return \bin2hex(\hash('sha256', $data, true));
    }

    public function validate(string $expectedSignature, string $url, $data = []): bool {
        $parsedUrl = \parse_url($url);

        $urlWithPort = self::addPort($parsedUrl);
        $urlWithoutPort = self::removePort($parsedUrl);
        $validBodyHash = true;  
        if (!\is_array($data)) {
            
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
