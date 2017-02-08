<?php

namespace Meanbee\WebAppManifest\Controller\Index;

use Magento\Framework\App\ResponseInterface;

class Json extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\Controller\Result\JsonFactory */
    protected $jsonFactory;

    /** @var \Meanbee\WebAppManifest\Api\Data\ManifestInterface $manifest */
    protected $manifest;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Meanbee\WebAppManifest\Api\Data\ManifestInterface $manifest
    ) {
        parent::__construct($context);

        $this->jsonFactory = $jsonFactory;
        $this->manifest = $manifest;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        return $this->jsonFactory->create()->setData($this->manifest->getData());
    }
}
