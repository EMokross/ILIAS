<?php

/* Copyright (c) 1998-2021 ILIAS open source, GPLv3, see LICENSE */

/**
 * Derived task data object
 *
 * @author Alexander Killing <killing@leifos.de>
 */
class ilDerivedTask
{
    protected string $title;

    protected int $ref_id;

    protected int $deadline;

    protected int $starting_time;

    protected int $wsp_id;

    protected string $url = '';

    /**
     * Constructor
     */
    public function __construct(string $title, int $ref_id, int $deadline, int $starting_time, int $wsp_id)
    {
        $this->title = $title;
        $this->ref_id = $ref_id;
        $this->deadline = $deadline;
        $this->starting_time = $starting_time;
        $this->wsp_id = $wsp_id;
    }

    /**
     * Get ref id
     *
     * @return int
     */
    public function getRefId() : int
    {
        return $this->ref_id;
    }

    /**
     * Get wsp id
     *
     * @return int
     */
    public function getWspId() : int
    {
        return $this->wsp_id;
    }

    /**
     * @return int
     */
    public function getDeadline() : int
    {
        return $this->deadline;
    }

    /**
     * @return int
     */
    public function getStartingTime() : int
    {
        return $this->starting_time;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    public function withUrl(string $url) : self
    {
        $clone = clone $this;
        $clone->url = $url;

        return $clone;
    }

    public function getUrl() : string
    {
        return $this->url;
    }
}
