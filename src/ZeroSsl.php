<?php

declare(strict_types=1);

namespace Bafeiyu\HyperfZeroSsl;

use Bafeiyu\HyperfZeroSsl\Exception\InvalidArgumentException;
use Bafeiyu\HyperfZeroSsl\Provider\CertificateProvider;

/**
 * @property CertificateProvider $certificate
 */

class ZeroSsl
{
    protected $alias = [
        'certificate' => CertificateProvider::class,
    ];

    /**
     * @var array
     */
    protected $providers = [];

    /**
     * @var Config
     */
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function __get($name)
    {
        if (! isset($name) || ! isset($this->alias[$name])) {
            throw new InvalidArgumentException("{$name} is invalid.");
        }

        if (isset($this->providers[$name])) {
            return $this->providers[$name];
        }

        $class = $this->alias[$name];
        return $this->providers[$name] = new $class($this, $this->config);
    }


}
