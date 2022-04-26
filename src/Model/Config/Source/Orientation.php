<?php

namespace Meanbee\WebAppManifest\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Orientation implements OptionSourceInterface
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
            "any"       => __("Any"),
            "natural"   => __("Natural"),
            "portrait"  => __("Portrait"),
            "landscape" => __("Landscape"),
        ];
    }
}
