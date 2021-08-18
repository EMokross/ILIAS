<?php

/* Copyright (c) 1998-2021 ILIAS open source, GPLv3, see LICENSE */

/**
 * Class ilLMLayout
 *
 * Handles Layout Section of Page, Structure and Media Objects (see ILIAS DTD)
 *
 * @author Alex Killing <alex.killing@gmx.de>
 */
class ilLMLayout
{
    public $keep_with_previous;
    public $keep_with_next;
    public $css_url;
    public $ver_align;
    public $hor_align;
    public $target_frame;
    public $width;
    public $height;

    /**
    * Constructor
    * @access	public
    */
    public function __construct()
    {
    }

    /**
    * set keep with previous
    *
    * @param	boolean		$a_keep
    */
    public function setKeepWithPrevious($a_keep)
    {
        $this->keep_with_previous = $a_keep;
    }


    /**
    * get keep with previous
    */
    public function getKeepWithPrevious()
    {
        return $this->keep_with_previous;
    }


    /**
    * set keep with next
    *
    * @param	boolean		$a_keep
    */
    public function setKeepWithNext($a_keep)
    {
        $this->keep_with_next = $a_keep;
    }


    /**
    * get keep with next
    */
    public function getKeepWithNext()
    {
        return $this->keep_with_next;
    }


    /**
    * set css url
    *
    * @param	string		$a_url		CSS URL
    */
    public function setCssUrl($a_url)
    {
        $this->css_url = $a_url;
    }


    /**
    * get css url
    */
    public function getCssUrl()
    {
        return $this->css_url;
    }

    /**
    * set horizontal align
    *
    * @param	string		$a_align		left | center | right
    */
    public function setHorizontalAlign($a_align)
    {
        $this->hor_align = $a_align;
    }

    /**
    * get horizontal align
    */
    public function getHorizontalAlign()
    {
        return $this->hor_align;
    }

    /**
    * set vertical align
    *
    * @param	string		$a_align		top | middle | bottom
    */
    public function setVerticalAlign($a_align)
    {
        $this->ver_align = $a_align;
    }

    /**
    * get vertical align
    */
    public function getVerticalAlign()
    {
        return $this->ver_align;
    }


    /**
    * set target frame ?????
    *
    * @param	string		$a_align		Media | FAQ | Glossary
    */
    public function setTargetFrame($a_frame)
    {
        $this->target_frame = $a_frame;
    }

    /**
    * get target frame ?????
    */
    public function getTargetFrame()
    {
        return $this->target_frame;
    }

    /**
    * set width
    *
    * @param	string		$a_width		width
    */
    public function setWidth($a_width)
    {
        $this->width = $a_width;
    }

    /**
    * get width
    */
    public function getWidth()
    {
        return $this->width;
    }

    /**
    * set height
    *
    * @param	string		$a_height		height
    */
    public function setHeight($a_height)
    {
        $this->height = $a_height;
    }

    /**
    * get height
    */
    public function getHeight()
    {
        return $this->height;
    }
}
