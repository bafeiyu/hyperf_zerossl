<?php

declare(strict_types=1);

namespace Bafeiyu\HyperfZeroSsl;

use Bafeiyu\HyperfZeroSsl\Exception\InvalidArgumentException;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\ApplicationContext;

class ZeroSslFactory
{
    public function __invoke()
    {
        $config = ApplicationContext::getContainer()->get(ConfigInterface::class)->get('zerossl', []);
        if (! empty($config['access_key'])) {
            $accessKey = $config['access_key'];
        } else {
            throw new InvalidArgumentException();
        }

        return new ZeroSsl(new Config([
            'access_key' => $accessKey,
            'guzzle_config' => $config['guzzle']['config'] ?? null,
        ]));
    }
}