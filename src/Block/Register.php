<?php

namespace Meanbee\WebAppManifest\Block;

use Magento\Framework\View\Element\AbstractBlock;
use Meanbee\WebAppManifest\Helper\Config;
use Magento\Framework\View\Element\Context;

class Register extends AbstractBlock
{

    /**
     * @var Config
     */
    protected $config;

    /**
     * The template for the Web App Manifest registration HTML.
     *
     * @var string $template
     */
    protected $template;

    /**
     * Data Construct.
     *
     * @param Context   $context
     * @param Config    $config
     * @param string    $template
     * @param array     $data
     */
    public function __construct(
        Context $context,
        Config $config,
        string $template,
        array $data
    ) {
        parent::__construct($context, $data);

        $this->config = $config;
        $this->template = $template;
    }

    /**
     * To Html.
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _toHtml()
    {
        if ($this->config->isEnabled()) {
            return sprintf(
                $this->template,
                $this->_urlBuilder->getDirectUrl(\Meanbee\WebAppManifest\Controller\Router::MANIFEST_ENDPOINT)
            );
        }
        return '';
    }
}
