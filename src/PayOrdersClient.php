<?php

namespace choate\yii\epluspay;

use choate\epluspay\base\RequestInterface;
use choate\epluspay\PayOrdersClient as EPlusPayPayOrderClient;
use yii\base\Component;
use yii\di\Instance;

class PayOrdersClient extends Component
{
    /**
     * @var \choate\yii\epluspay\Client
     */
    private $client;

    /**
     * 回调地址
     *
     * @var string
     */
    private $notifyUrl;

    /**
     * @var EPlusPayPayOrderClient
     */
    private $ePlusPayPayOrdersClient;

    /**
     * 商铺ID
     *
     * @var string
     */
    private $shopId;

    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client)
    {
        $this->client = Instance::ensure($client, 'choate\yii\epluspay\Client');
    }

    /**
     * @return string
     */
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    /**
     * @param string $notifyUrl
     */
    public function setNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;
    }

    public function getEPlusPayPayOrdersClient()
    {
        return $this->ePlusPayPayOrdersClient;
    }

    /**
     * @return string
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * @param string $shopId
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;
    }

    public function init()
    {
        if ($this->getShopId()) {

        }

        $this->ePlusPayPayOrdersClient = new EPlusPayPayOrderClient($this->getShopId(), $this->getNotifyUrl(), $this->getClient()->getEPlusPayClient());
    }

    public function run(RequestInterface $request)
    {
        return $this->getEPlusPayPayOrdersClient()->run($request);
    }

}