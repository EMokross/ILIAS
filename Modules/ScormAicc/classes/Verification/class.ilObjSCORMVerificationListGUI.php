<?php declare(strict_types=1);

/* Copyright (c) 1998-2009 ILIAS open source, Extended GPL, see docs/LICENSE */

/**
 * Class ilObjSCORMVerificationListGUI
 * @author Jörg Lützenkirchen <luetzenkirchen@leifos.com>
 */
class ilObjSCORMVerificationListGUI extends ilObjectListGUI
{
    public function init() : void
    {
        $this->delete_enabled = true;
        $this->cut_enabled = true;
        $this->copy_enabled = true;
        $this->subscribe_enabled = false;
        $this->link_enabled = false;
        $this->info_screen_enabled = false;
        $this->type = 'scov';
        $this->gui_class_name = ilObjSCORMVerificationGUI::class;

        $this->commands = ilObjSCORMVerificationAccess::_getCommands();
    }
    
    public function getProperties() : array
    {
        global $DIC;
        $lng = $DIC['lng'];
        
        return [
            [
                'alert' => false,
                'property' => $lng->txt('type'),
                'value' => $lng->txt('wsp_list_scov')
            ]
        ];
    }
}
