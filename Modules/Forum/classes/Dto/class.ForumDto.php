<?php declare(strict_types=1);

/* Copyright (c) 1998-2021 ILIAS open source, Extended GPL, see docs/LICENSE */

class ForumDto
{
    private int $top_pk;
    private int $top_frm_fk;
    private string $top_name;
    private string $top_description;
    private int $top_num_posts;
    private int $top_num_threads;
    private string $top_last_post;
    private int $top_mods;
    private string $top_date;
    private int $visits;
    private ?string $top_update = null;
    private int $update_user;
    private int $top_usr_id;

    public function getTopPk() : int
    {
        return $this->top_pk;
    }

    public function setTopPk(int $top_pk) : void
    {
        $this->top_pk = $top_pk;
    }

    public function getTopFrmFk() : int
    {
        return $this->top_frm_fk;
    }

    public function setTopFrmFk(int $top_frm_fk) : void
    {
        $this->top_frm_fk = $top_frm_fk;
    }

    public function getTopName() : string
    {
        return $this->top_name;
    }

    public function setTopName(string $top_name) : void
    {
        $this->top_name = trim($top_name);
    }

    public function getTopDescription() : string
    {
        return $this->top_description;
    }

    public function setTopDescription(string $top_description) : void
    {
        $this->top_description = nl2br($top_description);
    }

    public function getTopNumPosts() : int
    {
        return $this->top_num_posts;
    }

    public function setTopNumPosts(int $top_num_posts) : void
    {
        $this->top_num_posts = $top_num_posts;
    }

    public function getTopNumThreads() : int
    {
        return $this->top_num_threads;
    }

    public function setTopNumThreads(int $top_num_threads) : void
    {
        $this->top_num_threads = $top_num_threads;
    }

    public function getTopLastPost() : string
    {
        return $this->top_last_post;
    }

    public function setTopLastPost(string $top_last_post) : void
    {
        $this->top_last_post = $top_last_post;
    }

    public function getTopMods() : int
    {
        return $this->top_mods;
    }

    public function setTopMods(int $top_mods) : void
    {
        $this->top_mods = $top_mods;
    }

    public function getTopDate() : string
    {
        return $this->top_date;
    }

    public function setTopDate(string $top_date) : void
    {
        $this->top_date = $top_date;
    }

    public function getVisits() : int
    {
        return $this->visits;
    }

    public function setVisits(int $visits) : void
    {
        $this->visits = $visits;
    }

    public function getTopUpdate() : ?string
    {
        return $this->top_update;
    }

    public function setTopUpdate(?string $top_update) : void
    {
        $this->top_update = $top_update;
    }

    public function getUpdateUser() : int
    {
        return $this->update_user;
    }

    public function setUpdateUser(int $update_user) : void
    {
        $this->update_user = $update_user;
    }

    public function getTopUsrId() : int
    {
        return $this->top_usr_id;
    }

    public function setTopUsrId(int $top_usr_id) : void
    {
        $this->top_usr_id = $top_usr_id;
    }

    /**
     * expects db record from frm_data
     * @param array $record
     * @return static
     */
    public static function getInstanceFromArray(array $record) : self
    {
        $instance = new self;

        $instance->setTopPk((int) $record['top_pk']);
        $instance->setTopFrmFk((int) $record['top_frm_fk']);
        $instance->setTopName((string) $record['top_name']);
        $instance->setTopDescription((string) $record['top_description']);
        $instance->setTopNumPosts((int) $record['top_num_posts']);
        $instance->setTopNumThreads((int) $record['top_num_threads']);
        $instance->setTopLastPost((string) $record['top_last_post']);
        $instance->setTopMods((int) $record['top_mods']);
        $instance->setTopDate((string) $record['top_date']);
        $instance->setVisits((int) $record['visits']);
        $instance->setTopUpdate((string) $record['top_update']);
        $instance->setUpdateUser((int) $record['update_user']);
        $instance->setTopUsrId((int) $record['top_usr_id']);

        return $instance;
    }

    public static function getEmptyInstance() : self
    {
        return new self;
    }
}
