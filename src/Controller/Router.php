<?php

namespace Ampersand\WebAppManifest\Controller;

use Ampersand\WebAppManifest\Helper\Config;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{
    const MANIFEST_ENDPOINT = "manifest.json";

    /** @var ActionFactory */
    private $actionFactory;

    /** @var Config */
    private $config;

    public function __construct(
        ActionFactory $actionFactory,
        Config $config
    ) {
        $this->actionFactory = $actionFactory;
        $this->config = $config;
    }

    /**
     * @param RequestInterface $request
     * @return ActionInterface|null
     */
    public function match(RequestInterface $request): ?ActionInterface
    {
        if ($this->config->isEnabled() && trim($request->getPathInfo(), "/") === self::MANIFEST_ENDPOINT) {
            $request
                ->setModuleName("webappmanifest")
                ->setControllerName("index")
                ->setActionName("json");

            return $this->actionFactory->create(\Magento\Framework\App\Action\Forward::class);
        }

        return null;
    }
}
