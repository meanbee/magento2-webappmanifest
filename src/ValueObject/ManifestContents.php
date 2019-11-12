<?php

namespace Ampersand\WebAppManifest\ValueObject;

class ManifestContents
{
    /** @var string */
    private $shortName;
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var string */
    private $startUrl;
    /** @var string */
    private $themeColor;
    /** @var string */
    private $backgroundColor;
    /** @var string */
    private $display;
    /** @var string */
    private $orientation;
    /** @var array */
    private $icons;

    /**
     * @param string|null $shortName
     * @param string|null $name
     * @param string|null $description
     * @param string|null $startUrl
     * @param string|null $themeColor
     * @param string|null $backgroundColor
     * @param string|null $display
     * @param string|null $orientation
     * @param array|null $icons
     */
    public function __construct(
        ?string $shortName = null,
        ?string $name = null,
        ?string $description = null,
        ?string $startUrl = null,
        ?string $themeColor = null,
        ?string $backgroundColor = null,
        ?string $display = null,
        ?string $orientation = null,
        ?array $icons = []
    ) {
        $this->shortName = $shortName;
        $this->name = $name;
        $this->description = $description;
        $this->startUrl = $startUrl;
        $this->themeColor = $themeColor;
        $this->backgroundColor = $backgroundColor;
        $this->display = $display;
        $this->orientation = $orientation;
        $this->icons = $icons;
    }

    /**
     * @param string|null $shortName
     * @param string|null $name
     * @param string|null $description
     * @param string|null $startUrl
     * @param string|null $themeColor
     * @param string|null $backgroundColor
     * @param string|null $display
     * @param string|null $orientation
     * @param array|null $icons
     * @return ManifestContents
     */
    public static function fromConfigData(
        ?string $shortName = null,
        ?string $name = null,
        ?string $description = null,
        ?string $startUrl = null,
        ?string $themeColor = null,
        ?string $backgroundColor = null,
        ?string $display = null,
        ?string $orientation = null,
        ?array $icons = []
    ): self {
        return new self(
            $shortName,
            $name,
            $description,
            $startUrl,
            $themeColor,
            $backgroundColor,
            $display,
            $orientation,
            $icons
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $beforeFilter = [
            'short_name' => $this->shortName,
            'name' => $this->name,
            'description' => $this->description,
            'start_url' => $this->startUrl,
            'theme_color' => $this->themeColor,
            'background_color' => $this->backgroundColor,
            'display' => $this->display,
            'orientation' => $this->orientation,
            'icons' => $this->icons,
        ];

        return array_filter($beforeFilter);
    }
}
