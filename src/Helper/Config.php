<?php

namespace Ampersand\WebAppManifest\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    const XML_PATH_ENABLE = "web/webappmanifest/enable";

    /**
     * @param string|null $scope
     * @return bool
     */
    public function isEnabled(string $scope = null): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLE, ScopeInterface::SCOPE_STORE, $scope);
    }
}
