<?php

/*
 * @Author : Pham Duy Toan
 * Email : ghostkissboy12@gmail.com
 * Using show cms 
 */

class MenuCmsWidget extends CWidget {
    /*
     * $position
     * 0 : top
     * 1 : footer
     */

    public $position;
    public $file;
    public $action_current;

    public function run() {
        $this->getMenu();
    }

    public function getMenu() {

        $arrMenu = $this->BuildMenu($this->position);
        $this->render('cms/' . $this->file, array('menu' => $arrMenu, 'controller' => $this->action_current));
    }

    public function getAllMenu() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.status', STATUS_ACTIVE);
        if ($this->position == 0) {
            $criteria->addInCondition('t.show_footer', array(0, 2));
        }
        if ($this->position == 1) {
            $criteria->addInCondition('t.show_footer', array(1, 2));
        }


//            $criteria->compare('t.show_footer',$this->position);
        $criteria->order = 't.order ASC,t.parent_id ASC';
        $result = Pages::model()->findAll($criteria);
        if ($result)
            return $result;
        return array();
    }

    public function BuildMenu() {
        $arrMenu = $this->getAllMenu();
        $arrTmp = array();
        if (is_array($arrMenu) && count($arrMenu) > 0) {
            foreach ($arrMenu as $k => $menu) {
                if ($this->position == 0) {
                    $arrTmp[$menu->id]['parent'] = $menu;
                } else if ($this->position == 1) {
                    if ($menu->parent_id == 0 || ($menu->show_footer == 2 && $this->position == 0)) {
                        $arrTmp[$menu->id]['parent'] = $menu;
                    } else {
                        $arrTmp[$menu->parent_id][] = $menu;
                    }
                }
            }
        }
        return $arrTmp;
    }

}

?>