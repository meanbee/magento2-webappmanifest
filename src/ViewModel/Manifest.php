<?php

namespace Ampersand\WebAppManifest\ViewModel;

use Ampersand\WebAppManifest\Controller\Router;
use Ampersand\WebAppManifest\Helper\Config;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Manifest implements ArgumentInterface
{
    /** @var Config */
    private $config;

    /** @var UrlInterface */
    private $urlBuilder;

    /**
     * @param Config $config
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        Config $config,
        UrlInterface $urlBuilder
    ) {
        $this->config = $config;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return bool
     */
    public function isManifestEnabled(): bool
    {
        return $this->config->isEnabled();
    }

    /**
     * @return string
     */
    public function getManifestUrl(): string
    {
        return $this->urlBuilder->getDirectUrl(Router::MANIFEST_ENDPOINT);
    }
}
