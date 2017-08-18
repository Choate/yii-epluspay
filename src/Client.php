<?php

namespace choate\yii\epluspay;

use choate\epluspay\base\RequestInterface;
use yii\base\Component;
use choate\epluspay\base\SignatureInterface;
use yii\helpers\ArrayHelper;
use \choate\epluspay\Client AS EPlusPayClient;

class Client extends Component
{
    /**
     * @var string
     */
    private $channelNo;

    /**
     * 加密对象
     *
     * @var SignatureInterface
     */
    private $encryption;

    /**
     * 语言 zh_CH 或 en_US
     *
     * @var string
     */
    private $lang;

    /**
     * 公钥编码
     *
     * @var string
     */
    private $publicKeyNo;

    /**
     * 服务器地址
     *
     * @var string
     */
    private $serverUrl;

    /**
     * @var EPlusPayClient
     */
    private $ePlusPayClient;

    /**
     * @return string
     */
    public function getChannelNo()
    {
        return $this->channelNo;
    }

    /**
     * @param string $channelNo
     */
    public function setChannelNo($channelNo)
    {
        $this->channelNo = $channelNo;
    }

    /**
     * @return SignatureInterface
     */
    public function getEncryption()
    {
        return $this->encryption;
    }

    /**
     * @param SignatureInterface|array $encryption
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function setEncryption($encryption)
    {
        if (is_array($encryption)) {
            $params = ArrayHelper::remove($encryption, 'params', []);
            $encryption = \Yii::createObject($encryption, $params);
        }

        if ($encryption instanceof SignatureInterface) {
            $this->encryption = $encryption;
        }
    }

    /**
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     */
    public function setLang(string $lang)
    {
        $this->lang = $lang;
    }

    /**
     * @return string
     */
    public function getPublicKeyNo()
    {
        return $this->publicKeyNo;
    }

    /**
     * @param string $publicKeyNo
     */
    public function setPublicKeyNo($publicKeyNo)
    {
        $this->publicKeyNo = $publicKeyNo;
    }

    /**
     * @return string
     */
    public function getServerUrl()
    {
        return $this->serverUrl;
    }

    /**
     * @param string $serverUrl
     */
    public function setServerUrl($serverUrl)
    {
        $this->serverUrl = $serverUrl;
    }

    public function init()
    {
        $this->ePlusPayClient = new EPlusPayClient($this->getChannelNo(), $this->getServerUrl(), $this->getPublicKeyNo(), $this->getLang(), $this->getEncryption());
    }

    public function run(RequestInterface $request) {
        $this->getEPlusPayClient()->run($request);
    }

    /**
     * @return EPlusPayClient
     */
    public function getEPlusPayClient() {
        return $this->ePlusPayClient;
    }
}