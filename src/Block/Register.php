<?php

namespace Meanbee\WebAppManifest\Block;

class Register extends \Magento\Framework\View\Element\AbstractBlock
{

    /** @var \Meanbee\WebAppManifest\Helper\Config $config */
    protected $config;

    /**
     * The template for the Web App Manifest registration HTML.
     *
     * @var string $template
     */
    protected $template;

    public function __construct(
        \Magento\Framework\View\Element\Context $context,
        \Meanbee\WebAppManifest\Helper\Config $config,
        string $template,
        array $data
    ) {
        parent::__construct($context, $data);

        $this->config = $config;
        $this->template = $template;
    }

    /**
     * @inheritdoc
     */
    protected function _toHtml()
    {
        if ($this->config->isEnabled()) {
            return sprintf(
                $this->template,
                $this->_urlBuilder->getDirectUrl(\Meanbee\WebAppManifest\Controller\Router::MANIFEST_ENDPOINT)
            );
        } else {
            return '';
        }
    }

}
