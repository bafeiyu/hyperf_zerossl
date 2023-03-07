<?php

declare(strict_types=1);

namespace Bafeiyu\HyperfZeroSsl\Constant;
/**
 * 证书状态
 */
class CertificateStatusConstant
{
    /**
     * 草稿
     */
    const DRAFT = 'draft';
    /**
     * 待验证
     */
    const PENDING = 'pending_validation';
    /**
     * 已发布
     */
    const ISSUED = 'issued';
    /**
     * 已取消
     */
    const CANCELLED = 'cancelled';
    /**
     * 已吊销
     */
    const REVOKED = 'revoked';
    /**
     * 已过期
     */
    const EXPIRED = 'expired';

    const EXPIRING_SOON ='expiring_soon';
}