<?php

namespace Meanbee\WebAppManifest\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class DisplayType implements OptionSourceInterface
{
    /**
     * To Option Array.
     *
     * @return array
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
     * Get options in "key=>value" format.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            "browser"    => __("Web Page"),
            "minimal-ui" => __("Minimal UI"),
            "standalone" => __("Standalone App"),
            "fullscreen" => __("Fullscreen App"),
        ];
    }
}
