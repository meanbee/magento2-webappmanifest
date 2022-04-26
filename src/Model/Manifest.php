<?php

namespace Meanbee\WebAppManifest\Model;

use Magento\Framework\UrlInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Meanbee\WebAppManifest\Api\Data\ManifestInterface;

class Manifest implements ManifestInterface
{

    public const XML_PATH_STORE_INFO_SHORT_NAME = "web/webappmanifest/short_store_name";
    public const XML_PATH_STORE_INFO_NAME = "web/webappmanifest/store_name";
    public const XML_PATH_STORE_INFO_DESCRIPTION = "web/webappmanifest/description";
    public const XML_PATH_STORE_INFO_START_URL = "web/webappmanifest/start_url";
    public const XML_PATH_DISPLAY_THEME_COLOR = "web/webappmanifest/theme_color";
    public const XML_PATH_DISPLAY_BACKGROUND_COLOR = "web/webappmanifest/background_color";
    public const XML_PATH_DISPLAY_DISPLAY_TYPE = "web/webappmanifest/display_type";
    public const XML_PATH_DISPLAY_ORIENTATION = "web/webappmanifest/orientation";
    public const XML_PATH_ICONS_ICON_48 = "web/webappmanifest/icon_48";
    public const XML_PATH_ICONS_ICON_72 = "web/webappmanifest/icon_72";
    public const XML_PATH_ICONS_ICON_96 = "web/webappmanifest/icon_96";
    public const XML_PATH_ICONS_ICON_128 = "web/webappmanifest/icon_128";
    public const XML_PATH_ICONS_ICON_192 = "web/webappmanifest/icon_192";
    public const XML_PATH_ICONS_ICON_384 = "web/webappmanifest/icon_384";
    public const XML_PATH_ICONS_ICON_512 = "web/webappmanifest/icon_512";

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var array
     */
    protected $data;

    /**
     * Construct.
     *
     * @param ScopeConfigInterface  $scopeConfig
     * @param UrlInterface          $urlBuilder
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        UrlInterface $urlBuilder
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->urlBuilder = $urlBuilder;
        $this->data = [];

        $this->populate();
    }

    /**
     * @inheritdoc
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Populate the Manifest data from configuration.
     *
     * @return $this
     */
    public function populate()
    {
        $this->populateStoreInformation();
        $this->populateDisplayOptions();
        $this->populateIconsAvailable();

        return $this;
    }

    /**
     * Populate the manifest with store information.
     *
     * @return $this
     */
    protected function populateStoreInformation()
    {
        $this->populateFromConfig("short_name", static::XML_PATH_STORE_INFO_SHORT_NAME);
        $this->populateFromConfig("name", static::XML_PATH_STORE_INFO_NAME);
        $this->populateFromConfig("description", static::XML_PATH_STORE_INFO_DESCRIPTION, true);
        $startUrl = './';
        $path = $this->scopeConfig->getValue(static::XML_PATH_STORE_INFO_START_URL, ScopeInterface::SCOPE_STORE);
        if ($path) {
            $startUrl = $this->urlBuilder->getDirectUrl($path);
        }
        $this->data["start_url"] = $startUrl;
        $this->data["scope"] = '/';
        $this->data["gcm_sender_id"] = '103953800507';

        return $this;
    }

    /**
     * Populate the manifest with display settings.
     *
     * @return $this
     */
    protected function populateDisplayOptions()
    {
        $this->populateFromConfig("theme_color", static::XML_PATH_DISPLAY_THEME_COLOR, true);
        $this->populateFromConfig("background_color", static::XML_PATH_DISPLAY_BACKGROUND_COLOR, true);
        $this->populateFromConfig("display", static::XML_PATH_DISPLAY_DISPLAY_TYPE);
        $this->populateFromConfig("orientation", static::XML_PATH_DISPLAY_ORIENTATION);

        return $this;
    }

    /**
     * Populate the manifest with app icon definitions.
     *
     * @return $this
     */
    protected function populateIconsAvailable()
    {
        $icon48 = $this->scopeConfig->getValue(static::XML_PATH_ICONS_ICON_48, ScopeInterface::SCOPE_STORE);
        if ($icon48) {
            $this->populateIcon($icon48, "48x48");
        }

        $icon72 = $this->scopeConfig->getValue(static::XML_PATH_ICONS_ICON_72, ScopeInterface::SCOPE_STORE);
        if ($icon72) {
            $this->populateIcon($icon72, "72x72");
        }

        $icon96 = $this->scopeConfig->getValue(static::XML_PATH_ICONS_ICON_96, ScopeInterface::SCOPE_STORE);
        if ($icon96) {
            $this->populateIcon($icon96, "96x96");
        }

        $icon128 = $this->scopeConfig->getValue(static::XML_PATH_ICONS_ICON_128, ScopeInterface::SCOPE_STORE);
        if ($icon128) {
            $this->populateIcon($icon128, "192x192");
        }

        $icon384 = $this->scopeConfig->getValue(static::XML_PATH_ICONS_ICON_384, ScopeInterface::SCOPE_STORE);
        if ($icon384) {
            $this->populateIcon($icon384, "384x384");
        }

        $icon512 = $this->scopeConfig->getValue(static::XML_PATH_ICONS_ICON_512, ScopeInterface::SCOPE_STORE);
        if ($icon512) {
            $this->populateIcon($icon512, "512x512");
        }
    }

    /**
     * Populate the manifest with app icon definitions.
     *
     * @param string $icon
     * @param string $sizes
     *
     * @return $this
     */
    protected function populateIcon($icon, $sizes)
    {
        $url = implode("", [
            $this->urlBuilder->getBaseUrl(["_type" => UrlInterface::URL_TYPE_MEDIA]),
            "webappmanifest/icons/",
            $icon,
        ]);
        $this->data["icons"][] = [
            "src" => $url,
            "sizes" => $sizes,
            "type" => "image/png",
            "purpose" => "any",
        ];
        $this->data["icons"][] = [
            "src" => $url,
            "sizes" => $sizes,
            "type" => "image/png",
            "purpose" => "maskable",
        ];
    }

    /**
     * Populate a manifest value from System Configration.
     *
     * @param string    $key
     * @param string    $configPath
     * @param bool      $ifExists Only populate the value if it's not empty (default: false)
     *
     * @return $this
     */
    protected function populateFromConfig($key, $configPath, $ifExists = false)
    {
        $value = $this->scopeConfig->getValue($configPath, ScopeInterface::SCOPE_STORE);

        if (!$ifExists || !empty($value)) {
            $this->data[$key] = $value;
        }

        return $this;
    }
}
