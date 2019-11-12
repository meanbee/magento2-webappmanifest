<?php

namespace Ampersand\WebAppManifest\Controller\Index;

use Ampersand\WebAppManifest\Api\Data\ManifestInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class Json extends Action
{
    /** @var JsonFactory */
    private $jsonFactory;

    /** @var ManifestInterface */
    private $manifest;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        ManifestInterface $manifest
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->manifest = $manifest;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $manifestData = $this->manifest->getData();

        return $this->jsonFactory->create()->setData($manifestData);
    }
}
