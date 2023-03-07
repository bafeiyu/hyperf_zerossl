<?php

declare(strict_types=1);

namespace Bafeiyu\HyperfZeroSsl\Constant;

class ValidationMethodConstant
{
    /**
     * 电子邮件验证
     */
    const EMAIL = 'EMAIL';
    /**
     * CNAME 验证
     */
    const CNAME_CSR_HASH = 'CNAME_CSR_HASH';
    /**
     * HTTP 文件上传
     */
    const HTTP_CSR_HASH = 'HTTP_CSR_HASH';
    /**
     * HTTPS 文件上传
     */
    const HTTPS_CSR_HASH = 'HTTPS_CSR_HASH';
}