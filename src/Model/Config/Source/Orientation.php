<?php

namespace Meanbee\WebAppManifest\Model\Config\Source;

class Orientation implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @inheritdoc
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
