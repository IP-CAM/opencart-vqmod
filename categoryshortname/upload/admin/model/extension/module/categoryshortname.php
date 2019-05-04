<?php

/*
 * IT IS NOT FREE, YOU SHOULD BUY / REFISTER A LICENSE AT HTTPS://MMOSolution.COM
 * CONTACT: toan@MMOSOLUTION.COM 
 * AUTHOR: MMOSOLUTION TEAM AT VIETNAM
 * All code within this file is copyright MMOSOLUTION.COM TEAM | FOUNDED @2012
 * You can not copy or reuse code within this file without written permission.
*/

 class ModelExtensionModuleCategoryShortName extends Model {

    public function install() {
        //
        $query = $this->db->query("SELECT * FROM information_schema.columns WHERE table_schema = '".DB_DATABASE."'  AND table_name = '".DB_PREFIX."category' AND column_name = 'short_name'");
        if($query->num_rows == 0){
            $this->db->query("ALTER TABLE ".DB_PREFIX."category ADD COLUMN short_name char(3) DEFAULT '' COMMENT '分类的短类别'");
        }
    }

    public function uninstall() {
        $query = $this->db->query("SELECT * FROM information_schema.columns WHERE table_schema = '".DB_DATABASE."'  AND table_name = '".DB_PREFIX."category' AND column_name = 'short_name'");
        if($query->num_rows > 0){
            $this->db->query( "alter table ".DB_PREFIX."category drop column short_name");
        }

    }

}

?>