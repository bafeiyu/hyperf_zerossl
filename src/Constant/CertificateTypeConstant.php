<?php

declare(strict_types=1);

namespace Bafeiyu\HyperfZeroSsl\Constant;
/**
 * 证书类型
 */
class CertificateTypeConstant
{
    /**
     * 单域 90 天证书
     */
    const single90Days = 1;
    /**
     * 通配符 90 天证书
     */
    const wildcard90Days = 2;
    /**
     * 多域 90 天证书
     */
    const multiDomain90Days = 3;
    /**
     * 单域 1 年期证书
     */
    const single1Year = 4;
    /**
     * 通配符 1 年期证书
     */
    const wildcard1Year = 5;
    /**
     * 多域 1 年期证书
     */
    const multiDomain1Year = 6;
    /**
     * acme90Days
     */
    const acme90Days = 7;
}