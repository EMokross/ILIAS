<?php
/* Copyright (c) 1998-2017 ILIAS open source, Extended GPL, see docs/LICENSE */

/**
 * Class ilPDSelectedItemsBlockGroup
 */
class ilPDSelectedItemsBlockGroup
{
    /**
     * @var bool
     */
    protected $has_icon = false;

    /**
     * @var string
     */
    protected $icon_path = '';

    /**
     * @var string
     */
    protected $label = '';

    /**
     * @var array
     */
    protected $items = array();

    /**
     * @return string
     */
    public function getLabel() : string
    {
        return $this->label;
    }

    /**
     * @return bool
     */
    public function hasIcon() : bool
    {
        return strlen($this->icon_path) > 0;
    }

    /**
     * @string
     */
    public function getIconPath() : string
    {
        return $this->icon_path;
    }

    /**
     * @param array[] $items
     */
    public function setItems(array $items) : void
    {
        $this->items = $items;
    }

    /**
     * @param array $item
     */
    public function pushItem(array $item) : void
    {
        $this->items[] = $item;
    }

    /**
     * @param bool $has_icon
     */
    public function setHasIcon(bool $has_icon) : void
    {
        $this->has_icon = $has_icon;
    }

    /**
     * @param string $icon_path
     */
    public function setIconPath(string $icon_path) : void
    {
        $this->icon_path = $icon_path;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label) : void
    {
        $this->label = $label;
    }

    /**
     * @return array
     */
    public function getItems() : array
    {
        return $this->items;
    }
}
