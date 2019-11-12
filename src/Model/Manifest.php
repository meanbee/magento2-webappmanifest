<?php

namespace Ampersand\WebAppManifest\Model;

use Ampersand\WebAppManifest\Api\Data\ManifestInterface;
use Ampersand\WebAppManifest\ValueObject\ManifestContents;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\ScopeInterface;

class Manifest implements ManifestInterface
{
    const XML_PATH_STORE_INFO_SHORT_NAME = 'web/webappmanifest/short_store_name';
    const XML_PATH_STORE_INFO_NAME = 'web/webappmanifest/store_name';
    const XML_PATH_STORE_INFO_DESCRIPTION = 'web/webappmanifest/description';
    const XML_PATH_STORE_INFO_START_URL = 'web/webappmanifest/start_url';
    const XML_PATH_DISPLAY_THEME_COLOR = 'web/webappmanifest/theme_color';
    const XML_PATH_DISPLAY_BACKGROUND_COLOR = 'web/webappmanifest/background_color';
    const XML_PATH_DISPLAY_DISPLAY_TYPE = 'web/webappmanifest/display_type';
    const XML_PATH_DISPLAY_ORIENTATION = 'web/webappmanifest/orientation';
    const XML_PATH_ICONS_ICON = 'web/webappmanifest/icon';
    const XML_PATH_ICONS_SIZES = 'web/webappmanifest/icon_sizes';

    /** @var ScopeConfigInterface */
    private $scopeConfig;

    /** @var UrlInterface */
    private $urlBuilder;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        UrlInterface $urlBuilder
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        $manifestData = ManifestContents::fromConfigData(
            $this->populateFromConfig(self::XML_PATH_STORE_INFO_SHORT_NAME),
            $this->populateFromConfig(self::XML_PATH_STORE_INFO_NAME),
            $this->populateFromConfig(self::XML_PATH_STORE_INFO_DESCRIPTION),
            $this->populateStartUrl(),
            $this->populateFromConfig(self::XML_PATH_DISPLAY_THEME_COLOR),
            $this->populateFromConfig(self::XML_PATH_DISPLAY_BACKGROUND_COLOR),
            $this->populateFromConfig(self::XML_PATH_DISPLAY_DISPLAY_TYPE),
            $this->populateFromConfig(self::XML_PATH_DISPLAY_ORIENTATION),
            $this->populateIcons()
        );

        return $manifestData->toArray();
    }

    /**
     * @return array
     */
    protected function populateIcons(): array
    {
        if ($icon = $this->populateFromConfig(self::XML_PATH_ICONS_ICON)) {
            $url = implode('', [
                $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]),
                'webappmanifest/icons/',
                $icon,
            ]);

            $sizes = $this->populateFromConfig(self::XML_PATH_ICONS_SIZES);

            return [['src' => $url, 'sizes' => $sizes]];
        }

        return [];
    }

    /**
     * @return string
     */
    private function populateStartUrl(): string
    {
        if ($path = $this->populateFromConfig(self::XML_PATH_STORE_INFO_START_URL)) {
            return $this->urlBuilder->getDirectUrl($path);
        }

        return $this->urlBuilder->getBaseUrl();
    }


    /**
     * @param string $config_path
     * @return $this
     */
    private function populateFromConfig(string $config_path): self
    {
        return $this->scopeConfig->getValue($config_path, ScopeInterface::SCOPE_STORE);
    }
}
