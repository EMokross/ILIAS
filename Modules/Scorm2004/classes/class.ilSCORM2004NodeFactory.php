<?php

/* Copyright (c) 1998-2021 ILIAS open source, GPLv3, see LICENSE */

/**
 * Factory for SCORM Editor Tree nodes (Chapters/SCOs/Pages)
 *
 * @author Alex Killing <alex.killing@gmx.de>
 */
class ilSCORM2004NodeFactory
{
    public static function getInstance($a_slm_object, $a_id = 0, $a_halt = true)
    {
        global $DIC;

        $ilDB = $DIC->database();

        $query = "SELECT * FROM sahs_sc13_tree_node WHERE obj_id = " .
            $ilDB->quote($a_id, "integer");
        $obj_set = $ilDB->query($query);
        $obj_rec = $ilDB->fetchAssoc($obj_set);
        $obj = null;
        switch ($obj_rec["type"]) {
            case "chap":
                $obj = new ilSCORM2004Chapter($a_slm_object);
                $obj->setId($obj_rec["obj_id"]);
                $obj->setDataRecord($obj_rec);
                $obj->read();
                break;

            case "seqc":
                $obj = new ilSCORM2004SeqChapter($a_slm_object);
                $obj->setId($obj_rec["obj_id"]);
                $obj->setDataRecord($obj_rec);
                $obj->read();
                break;
                    
            case "sco":
                $obj = new ilSCORM2004Sco($a_slm_object);
                $obj->setId($obj_rec["obj_id"]);
                $obj->setDataRecord($obj_rec);
                $obj->read();
                break;

            case "ass":
                $obj = new ilSCORM2004Asset($a_slm_object);
                $obj->setId($obj_rec["obj_id"]);
                $obj->setDataRecord($obj_rec);
                $obj->read();
                break;

            case "page":
                $obj = new ilSCORM2004PageNode($a_slm_object, 0, $a_halt);
                $obj->setId($obj_rec["obj_id"]);
                $obj->setDataRecord($obj_rec);
                $obj->read();
                break;
        }
        return $obj;
    }
}
