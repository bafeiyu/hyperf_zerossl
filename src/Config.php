<?php

declare(strict_types=1);

namespace Bafeiyu\HyperfZeroSsl;

class Config
{
    /**
     * @var string
     */
    protected $accessKey = '';
    /**
     * @var string
     */
    protected $baseUri = 'http://api.zerossl.com';
    /**
     * @var array
     */
    protected $guzzleConfig = [
        'headers' => [
            'charset' => 'UTF-8',
        ],
        'http_errors' => false,
    ];

    /**
     * @param $config = [
     *     'access_key' => '',
     *     'guzzle_config' => [],
     * ]
     */
    public function __construct(array $config = [])
    {
        isset($config['access_key']) && $this->accessKey = (string) $config['access_key'];
        isset($config['guzzle_config']) && $this->guzzleConfig = (array) $config['guzzle_config'];
    }

    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    public function getGuzzleConfig(): array
    {
        return $this->guzzleConfig;
    }
}
