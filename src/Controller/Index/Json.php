<?php

namespace Meanbee\WebAppManifest\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Meanbee\WebAppManifest\Api\Data\ManifestInterface;

class Json extends \Magento\Framework\App\Action\Action
{
    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var ManifestInterface
     */
    protected $manifest;

    /**
     * Construct.
     *
     * @param Context           $context
     * @param JsonFactory       $jsonFactory
     * @param ManifestInterface $manifest
     */
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
     * @inheritdoc
     */
    public function execute()
    {
        return $this->jsonFactory->create()->setData($this->manifest->getData());
    }
}
