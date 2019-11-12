<?php

namespace Ampersand\WebAppManifest\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class DisplayType implements OptionSourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->toArray() as $value => $label) {
            $options[] = ["value" => $value, "label" => $label];
        }

        return $options;
    }

    /**
     * @return array
     */
    private function toArray(): array
    {
        return [
            "browser"    => __("Web Page"),
            "minimal-ui" => __("Minimal UI"),
            "standalone" => __("Standalone App"),
            "fullscreen" => __("Fullscreen App"),
        ];
    }
}
