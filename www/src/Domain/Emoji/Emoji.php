<?php

namespace Domain\Emoji;

use Spatie\LaravelData\Data;

class Emoji extends Data
{
    public string $emoji;
    public string $hexcode;
    public string $htmlCode;
    public string $group;
    public string $subgroup;
    public string $annotation;
    public array $tags;
    public array $shortcodes;
    public array|string $emoticons;
    public array|string $directional;
    public array|string $variation;
    public array|string|null $variationBase = null;
    public array|string $unicode;
    public array|string $order;
    public array|string|null $skintone = null;
    public array|string|null $skintoneCombination = null;
    public array|string|null $skintoneBase = null;

    /**
     * @param string $emoji
     * @param string $hexcode
     * @param string $group
     * @param string $subgroup
     * @param string $annotation
     * @param array $tags
     * @param array $shortcodes
     * @param array|string $emoticons
     * @param array|string $directional
     * @param array|string $variation
     * @param array|string|null $variationBase
     * @param array|string $unicode
     * @param array|string $order
     * @param array|string|null $skintone
     * @param array|string|null $skintoneCombination
     * @param array|string|null $skintoneBase
     */
    public function __construct(string $emoji, string $hexcode, string $htmlCode, string $group, string $subgroup, string $annotation, array $tags, array $shortcodes, array|string $emoticons, array|string $directional, array|string $variation, array|string|null $variationBase, array|string $unicode, array|string $order, array|string|null $skintone, array|string|null $skintoneCombination, array|string|null $skintoneBase)
    {
        $this->emoji = $emoji;
        $this->hexcode = strtoupper($hexcode);
        $this->htmlCode = '&#'.strtoupper($htmlCode).';';
        $this->group = $group;
        $this->subgroup = $subgroup;
        $this->annotation = $annotation;
        $this->tags = $tags;
        $this->shortcodes = $shortcodes;
        $this->emoticons = $emoticons;
        $this->directional = $directional;
        $this->variation = $variation;
        $this->variationBase = $variationBase;
        $this->unicode = $unicode;
        $this->order = $order;
        $this->skintone = $skintone;
        $this->skintoneCombination = $skintoneCombination;
        $this->skintoneBase = $skintoneBase;
    }


}
