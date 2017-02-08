<?php

namespace Meanbee\WebAppManifest\Helper;

use Magento\Store\Model\ScopeInterface;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_ENABLE = "web/webappmanifest/enable";

    /**
     * Check if Web App Manifest is enabled.
     *
     * @param null|string $scope
     *
     * @return bool
     */
    public function isEnabled($scope = null)
    {
        return $this->scopeConfig->isSetFlag(static::XML_PATH_ENABLE, ScopeInterface::SCOPE_STORE, $scope);
    }
}
