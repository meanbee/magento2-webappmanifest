<?php

namespace Ampersand\WebAppManifest\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Orientation implements OptionSourceInterface
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
            "any"       => __("Any"),
            "natural"   => __("Natural"),
            "portrait"  => __("Portrait"),
            "landscape" => __("Landscape"),
        ];
    }
}
