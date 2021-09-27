<?php declare(strict_types=1);
/* Copyright (c) 1998-2012 ILIAS open source, Extended GPL, see docs/LICENSE */

/**
 * Class ilObjForumListGUI
 * @author  Alex Killing <alex.killing@gmx.de>
 * $Id$
 * @ingroup ModulesForum
 */
class ilObjForumListGUI extends ilObjectListGUI
{
    public $lng;
    public $user;
    public $access;
    public $settings;
    private int $child_id;

    public function __construct()
    {
        parent::__construct();

        global $DIC;
        $this->lng = $DIC->language();
        $this->user = $DIC->user();
        $this->access = $DIC->access();
        $this->settings = $DIC->settings();
    }

    public function setChildId(int $a_child_id) : void
    {
        $this->child_id = $a_child_id;
    }

    public function getChildId() : int
    {
        return (int) $this->child_id;
    }

    public function init() : void
    {
        $this->static_link_enabled = true;
        $this->delete_enabled = true;
        $this->cut_enabled = true;
        $this->copy_enabled = true;
        $this->subscribe_enabled = true;
        $this->link_enabled = true;
        $this->info_screen_enabled = true;
        $this->type = 'frm';
        $this->gui_class_name = 'ilobjforumgui';

        // general commands array
        $this->commands = ilObjForumAccess::_getCommands();
    }

    public function getProperties() : array
    {
        global $DIC;

        if (!$this->access->checkAccess('read', '', (int) $this->ref_id)) {
            return [];
        }

        $this->lng->loadLanguageModule('forum');

        $props = [];

        $properties = ilObjForumAccess::getStatisticsByRefId((int) $this->ref_id);
        $num_posts_total = $properties['num_posts'];
        $num_unread_total = $properties['num_unread_posts'];

        $num_drafts_total = 0;
        if (ilForumPostDraft::isSavePostDraftAllowed()) {
            $drafts_statistics = ilForumPostDraft::getDraftsStatisticsByRefId((int) $this->ref_id);
            $num_drafts_total = $drafts_statistics['total'];
        }

        $frm_overview_setting = (int) $this->settings->get('forum_overview');
        $num_new_total = 0;
        if ($frm_overview_setting === ilForumProperties::FORUM_OVERVIEW_WITH_NEW_POSTS) {
            $num_new_total = $properties['num_new_posts'];
        }

        $last_post = ilObjForumAccess::getLastPostByRefId((int) $this->ref_id);

        if (!$this->user->isAnonymous()) {
            if ($this->getDetailsLevel() === ilObjectListGUI::DETAILS_ALL) {
                $props[] = [
                    'alert' => false,
                    'property' => $this->lng->txt('forums_articles') . ' (' . $this->lng->txt('unread') . ')',
                    'value' => $num_posts_total . ' (' . $num_unread_total . ')'
                ];
                if ($frm_overview_setting === ilForumProperties::FORUM_OVERVIEW_WITH_NEW_POSTS) {
                    if ($num_new_total > 0) {
                        // New
                        $props[] = [
                            'alert' => false,
                            'property' => $this->lng->txt('forums_new_articles'),
                            'value' => $num_new_total
                        ];
                    }
                }
            }

            if (ilForumPostDraft::isSavePostDraftAllowed() && $num_drafts_total > 0) {
                $props[] = [
                    'alert' => false,
                    'property' => $this->lng->txt('drafts'),
                    'value' => $num_drafts_total
                ];
            }
        } else {
            $props[] = [
                'alert' => false,
                'property' => $this->lng->txt('forums_articles'),
                'value' => $num_posts_total
            ];
        }

        if ($this->getDetailsLevel() === ilObjectListGUI::DETAILS_ALL) {
            if (ilForumProperties::getInstance((int) $this->obj_id)->isAnonymized()) {
                $props[] = [
                    'alert' => false,
                    'newline' => false,
                    'property' => $this->lng->txt('forums_anonymized'),
                    'value' => $this->lng->txt('yes')
                ];
            }
        }

        if (isset($last_post['pos_pk']) && (int) $last_post['pos_pk'] > 0) {
            $lpCont = "<a class=\"il_ItemProperty\" target=\"" . ilFrameTargetInfo::_getFrame('MainContent') .
                "\" href=\"ilias.php?baseClass=ilRepositoryGUI&amp;cmd=viewThread&amp;cmdClass=ilobjforumgui&amp;target=true&amp;pos_pk=" .
                $last_post['pos_pk'] . "&amp;thr_pk=" . $last_post['pos_thr_fk'] . "&amp;ref_id=" .
                (int) $this->ref_id . "#" . $last_post["pos_pk"] . "\">" .
                ilObjForumAccess::prepareMessageForLists($last_post['pos_message']) . "</a> " .
                strtolower($this->lng->txt('from')) . "&nbsp;";

            $ref_id = 0;
            if ($DIC->http()->wrapper()->query()->has('ref_id')) {
                $ref_id = $DIC->http()->wrapper()->query()->retrieve(
                    'ref_id',
                    $DIC->refinery()->kindlyTo()->int()
                );
            }
            $authorinfo = new ilForumAuthorInformation(
                (int) $last_post['pos_author_id'],
                (int) $last_post['pos_display_user_id'],
                (string) $last_post['pos_usr_alias'],
                (string) $last_post['import_name'],
                [
                    'class' => 'il_ItemProperty',
                    'href' => 'ilias.php?baseClass=ilRepositoryGUI&amp;cmd=showUser&amp;cmdClass=ilobjforumgui&amp;ref_id=' . (int) $this->ref_id . '&amp;user=' . $last_post['pos_display_user_id'] . '&amp;offset=0&amp;backurl=' . urlencode('ilias.php?baseClass=ilRepositoryGUI&amp;ref_id=' . $ref_id)
                ]
            );

            $lpCont .= $authorinfo->getLinkedAuthorName();
            $lpCont .= ', ' . ilDatePresentation::formatDate(new ilDateTime($last_post['pos_date'], IL_CAL_DATETIME));

            $props[] = [
                'alert' => false,
                'newline' => true,
                'property' => $this->lng->txt('forums_last_post'),
                'value' => $lpCont
            ];
        }

        return $props;
    }

    public function getCommandFrame($a_cmd) : string
    {
        return ilFrameTargetInfo::_getFrame('MainContent');
    }

    public function getCommandLink($a_cmd) : string
    {
        switch ($a_cmd) {
            case 'thread':
                return 'ilias.php?baseClass=ilRepositoryGUI&amp;cmd=viewThread&amp;cmdClass=ilobjforumgui&amp;ref_id=' . (int) $this->ref_id . '&amp;thr_pk=' . $this->getChildId();

            case 'posting':
                $thread_post = $this->getChildId();
                return 'ilias.php?baseClass=ilRepositoryGUI&amp;cmd=viewThread&amp;cmdClass=ilobjforumgui&amp;target=1&amp;ref_id=' . (int) $this->ref_id . '&amp;thr_pk=' . $thread_post[0] . '&amp;pos_pk=' . $thread_post[1] . '#' . $thread_post[1];

            default:
                return parent::getCommandLink($a_cmd);
        }
    }
}
