<?php

declare(strict_types=1);

namespace Bafeiyu\HyperfZeroSsl;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Bafeiyu\HyperfZeroSsl\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Hyperf\Utils\Codec\Json;

abstract class AbstractProvider
{

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var ZeroSsl
     */
    protected $zeroSsl;

    public function __construct(ZeroSsl $zeroSsl, Config $config)
    {
        $this->zeroSsl = $zeroSsl;
        $this->config = $config;
    }

    public function request($method, $uri, array $options = []): ResponseInterface
    {
        $accessKey = $this->config->getAccessKey();
        $accessKey && $options[RequestOptions::QUERY]['access_key'] = $accessKey;
        return $this->client()->request($method, $uri, $options);
    }

    public function client(): Client
    {
        $config = array_merge($this->config->getGuzzleConfig(), [
            'base_uri' => $this->config->getBaseUri(),
        ]);

        return new Client($config);
    }

    protected function checkResponseIsOk(ResponseInterface $response): bool
    {
        if ($response->getStatusCode() !== 200) {
            return false;
        }

        return (string) $response->getBody() === 'ok';
    }

    protected function handleResponse(ResponseInterface $response): array
    {
        $statusCode = $response->getStatusCode();
        $contents = (string) $response->getBody();
        if ($statusCode !== 200) {
            throw new RequestException($contents, $statusCode);
        }
        return Json::decode($contents);
    }

    protected function filter(array $input): array
    {
        $result = [];
        foreach ($input as $key => $value) {
            if ($value !== null) {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
