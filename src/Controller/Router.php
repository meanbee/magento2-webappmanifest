<?php

namespace Meanbee\WebAppManifest\Controller;

use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\RequestInterface;
use Meanbee\WebAppManifest\Helper\Config;

class Router implements \Magento\Framework\App\RouterInterface
{
    public const MANIFEST_ENDPOINT = "manifest.json";

    /**
     * @var ActionFactory
     */
    protected $actionFactory;

    /**
     * @var Config
     */
    protected $config;

    /**
     * Construct.
     *
     * @param ActionFactory $actionFactory
     * @param Config        $config
     */
    public function __construct(
        ActionFactory $actionFactory,
        Config $config
    ) {
        $this->actionFactory = $actionFactory;
        $this->config = $config;
    }

    /**
     * Match
     *
     * @param RequestInterface $request
     * @return Forward|null
     */
    public function match(RequestInterface $request)
    {
        if ($this->config->isEnabled() && trim($request->getPathInfo(), "/") == static::MANIFEST_ENDPOINT) {
            $request
                ->setModuleName("webappmanifest")
                ->setControllerName("index")
                ->setActionName("json");
        
            return $this->actionFactory->create(Forward::class);
        }

        return null;
    }
}
