<?php

declare(strict_types=1);

namespace Bafeiyu\HyperfZeroSsl;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                ZeroSsl::class => ZeroSslFactory::class,
            ],
            'publish' => [
                [
                    'id' => 'zerossl',
                    'description' => 'The config for zerossl.',
                    'source' => __DIR__ . '/../publish/zerossl.php',
                    'destination' => BASE_PATH . '/config/autoload/zerossl.php',
                ],
            ],
        ];
    }
}
