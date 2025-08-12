<?php


namespace SMG\EmailChecker\Model;

use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\Serializer\Json;
use Psr\Log\LoggerInterface;

class Api
{
    /**
     * @var Curl
     */
    protected $curlClient;
    /**
     * @var string
     */
    protected $urlPrefix = 'https://';

    /**
     * @var string
     */
    protected $apiUrl = 'emailvalidation.abstractapi.com/v1?';
    /**
     * @var string
     */
    protected $apiKey = '5ca6544110b04954b9fe09936b1a2127';
    
    /**
     * @var Json
     */
    protected $json;
    /**
     * @var LoggerInterface
     */
    protected $logger;
    
    /**
     *
     * @param Curl $curl
     * @param LoggerInterface $logger
     * @param Json $json
     */
    public function __construct(
        Curl $curl,
        LoggerInterface $logger,
        Json $json
    ) {
        $this->curlClient = $curl;
        $this->logger = $logger;
        $this->json = $json;
    }

    /**
     *  Validate disposal email checker
     *
     * @param  string $email
     * @return string|bool
     */
    public function emailValidation($email)
    {
        $isDisposalEmail = '';
        $apiUrl = $this->getApiUrl();
        $apikey = $this->getApiKey();
        $apiUrl .= 'api_key='.$apikey .'&email='. $email;
        $options = [
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ];
        $this->getCurlClient()->setOptions($options);
        $this->getCurlClient()->get($apiUrl);

        $curlResposeBody = $this->getCurlClient()->getBody();
        $this->logger->debug($curlResposeBody);
        //$curlResposeBody = '{"error":{"message":"Invalid API key provided.","code":"unauthorized","details":null}}';
        //$curlResposeBody = '{"email":"johnsmith@gmail.com","autocorrect":"","deliverability":"DELIVERABLE","quality_score":0.9,"is_valid_format":{"value":true,"text":"TRUE"},"is_free_email":{"value":true,"text":"TRUE"},"is_disposable_email":{"value":false,"text":"FALSE"},"is_role_email":{"value":false,"text":"FALSE"},"is_catchall_email":{"value":false,"text":"FALSE"},"is_mx_found":{"value":true,"text":"TRUE"},"is_smtp_valid":{"value":true,"text":"TRUE"}}';
        $response = $this->json->unserialize($curlResposeBody);
        
        if (isset($response['error']) && !empty($response['error'])) {
            $isDisposalEmail = $response['error']['message'];
        }
        if (isset($response['deliverability']) && $response['deliverability'] == "UNDELIVERABLE") {
            $isDisposalEmail = false;
        }
        return $isDisposalEmail;
    }
    /**
     * Get Url
     *
     * @return string
     */
    public function getApiUrl()
    {
        return $this->urlPrefix . $this->apiUrl;
    }
    /**
     * Get Key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }
    /**
     * Curl instance
     *
     * @return Curl
     */
    public function getCurlClient()
    {
        return $this->curlClient;
    }
}
