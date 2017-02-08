<?php

namespace Meanbee\WebAppManifest\Controller;

class Router implements \Magento\Framework\App\RouterInterface
{
    const MANIFEST_ENDPOINT = "manifest.json";

    /** @var \Magento\Framework\App\ActionFactory $actionFactory */
    protected $actionFactory;

    /** @var \Meanbee\WebAppManifest\Helper\Config $config */
    protected $config;

    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Meanbee\WebAppManifest\Helper\Config $config
    ) {
        $this->actionFactory = $actionFactory;
        $this->config = $config;
    }

    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        if ($this->config->isEnabled() && trim($request->getPathInfo(), "/") == static::MANIFEST_ENDPOINT) {
            $request
                ->setModuleName("webappmanifest")
                ->setControllerName("index")
                ->setActionName("json");

            return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
        }

        return null;
    }
}
