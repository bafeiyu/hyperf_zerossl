<?php

declare(strict_types=1);

namespace Bafeiyu\HyperfZeroSsl\Provider;

use Bafeiyu\HyperfZeroSsl\AbstractProvider;
use Bafeiyu\HyperfZeroSsl\Constant\ValidationMethodConstant;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class CertificateProvider extends AbstractProvider
{
    /**
     * 创建证书
     * 接口文档地址 https://zerossl.com/documentation/api/create-certificate/
     * @param string $certificateDomains
     * @param string $certificateCsr
     * @param int $certificateValidityDays
     * @param $strictDomains
     * @return ResponseInterface
     */
    public function create(string $certificateDomains,string $certificateCsr,int $certificateValidityDays=75,$strictDomains=''): ResponseInterface
    {
        return $this->request('POST', '/certificates', [
            RequestOptions::FORM_PARAMS => [
                'certificate_domains' => $certificateDomains,
                'certificate_csr' => $certificateCsr,
                'certificate_validity_days' => $certificateValidityDays,
                'strict_domains' => $strictDomains,
            ],
        ]);
    }

    /**
     * 验证域
     * https://zerossl.com/documentation/api/verify-domains/
     * @param string $id
     * @param $validationMethod
     * @param $validationEmail
     * @return ResponseInterface
     */
    public function verify(string $id,$validationMethod=ValidationMethodConstant::EMAIL,$validationEmail=''): ResponseInterface
    {
        $url = '/certificates/'.$id.'/challenges';
        return $this->request('POST', $url, [
            RequestOptions::FORM_PARAMS => [
                'validation_method' => $validationMethod,
                'validation_email' => $validationEmail,
            ],
        ]);
    }

    /**
     * 下载证书
     * https://zerossl.com/documentation/api/download-certificate/
     * @param string $id
     * @param bool $includeCrossSigned
     * @return ResponseInterface
     */
    public function download(string $id,bool $includeCrossSigned): ResponseInterface
    {
        $url = '/certificates/'.$id.'/download';
        return $this->request('GET', $url, [
            RequestOptions::QUERY => [
                'include_cross_signed' => intval($includeCrossSigned),
            ],
        ]);
    }
    /**
     * 内联下载
     * https://zerossl.com/documentation/api/download-certificate-inline/
     * @param string $id
     * @param bool $includeCrossSigned
     * @return ResponseInterface
     */
    public function inlineDownload(string $id,bool $includeCrossSigned): ResponseInterface
    {
        $url = '/certificates/'.$id.'/download/return';
        return $this->request('GET', $url, [
            RequestOptions::QUERY => [
                'include_cross_signed' => intval($includeCrossSigned),
            ],
        ]);
    }
    /**
     * 吊销
     * https://zerossl.com/documentation/api/revoke-certificate/
     * @param string $id
     * @return ResponseInterface
     */
    public function revoke(string $id): ResponseInterface
    {
        $url = '/certificates/'.$id.'/revoke';
        return $this->request('POST', $url, [
            RequestOptions::FORM_PARAMS => [
                'access_key' => $this->config->getAccessKey(),
                'id' => $id,
            ],
        ]);
    }

    /**
     * 取消证书
     * https://zerossl.com/documentation/api/cancel-certificate/
     * @param string $id
     * @return ResponseInterface
     */
    public function cancel(string $id): ResponseInterface
    {
        $url = '/certificates/'.$id.'/cancel';
        return $this->request('GET', $url, [
            RequestOptions::QUERY => [
                'access_key' => $this->config->getAccessKey(),
                'id' => $id,
            ],
        ]);
    }

    /**
     * 验证CTR
     * https://zerossl.com/documentation/api/validate-csr/
     * @param string $ctr
     * @return ResponseInterface
     */
    public function validateCtr(string $ctr): ResponseInterface
    {
        $url = '/validation/csr';
        return $this->request('POST', $url, [
            RequestOptions::FORM_PARAMS => [
                'csr' => $ctr
            ],
        ]);
    }

    /**
     * 获取证书
     * https://zerossl.com/documentation/api/get-certificate/
     * @param string $id
     * @return ResponseInterface
     */
    public function get(string $id): ResponseInterface
    {
        $url = '/certificates/'.$id;
        return $this->request('GET', $url);
    }

    /**
     * 列表查询
     * https://zerossl.com/documentation/api/list-certificates/
     * @param $status
     * @param $type
     * @param $search
     * @param $limit
     * @param $page
     * @return ResponseInterface
     */
    public function listPage($status='',$type='',$search='',$limit=100,$page=1): ResponseInterface
    {
        $data = [
            'limit' => $limit,
            'page' => $page
        ];
        if($status){
            $data['certificate_status'] = $status;
        }
        if($type){
            $data['certificate_type'] = $type;
        }
        if($search){
            $data['search'] = $search;
        }
        return $this->request('GET', '/certificates', [
            RequestOptions::QUERY => $data,
        ]);
    }
}