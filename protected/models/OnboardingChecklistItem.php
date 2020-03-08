<?php

/**
  This is the model class for table "onboarding_checklist_items"
 */
class OnboardingChecklistItem extends AppActiveRecord {

    static $tableName = DB_TBL_PREFIX . 'onboarding_checklist_items';

    public function tableName() {
        return self::$tableName;
    }

    public function rules() {
        return [
        ];
    }

    public function attributeLabels() {
        return [
            'description' => Yii::t('app', 'description'),
            'department_owner' => Yii::t('app', 'department_owner'),
            'is_offboarding_item' => Yii::t('app', 'is_offboarding_item'),
            'status' => Yii::t('app', 'status'),
            'is_managerial' => Yii::t('app', 'is_managerial')
        ];
    }

    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function findAllOnboardingItems($strSortBy, $intPage, $numPerPage) {
        $sql = 'SELECT ECI.id, ECI.title, D.title AS department_owner, ';
        $sql .= 'CASE WHEN ECI.is_offboarding_item = 0 THEN "No" ';
        $sql .= 'WHEN ECI.is_offboarding_item = 1 ';
        $sql .= 'THEN "Yes" ';
        $sql .= 'END AS "is_offboarding_item", ';
        $sql .= 'CASE WHEN ECI.status = 0 THEN "Inactive" ';
        $sql .= 'WHEN ECI.status = 1 ';
        $sql .= 'THEN "Active" ';
        $sql .= 'END AS "status", ';
        $sql .= 'CASE WHEN ECI.is_managerial = 0 THEN "Non-managerial" ';
        $sql .= 'WHEN ECI.is_managerial = 1 ';
        $sql .= 'THEN "Managerial" ';
        $sql .= 'END AS "is_managerial" ';
        $sql .= 'FROM ' . self::$tableName . ' ECI ';
        $sql .= 'INNER JOIN department D ';
        $sql .= 'ON ECI.department_owner = D.id';

        if (isset($_POST['label_filter']) && $_POST['label_filter'] != false) {
            $sql .= ' WHERE ECI.title LIKE "%' . $_POST['label_filter'] . '%"';
        }

        //on first load, sort data by created_date, after that sort by whatever
        if ($_POST == false && !isset($_POST["sort_key"])) {
            $strSortBy = 'ECI.created_date DESC';
        }

        if ($_POST != false && $_POST["sort_key"] == false) {
            $strSortBy = 'ECI.created_date DESC';
        }

        $sql .= ' ORDER BY ' . $strSortBy;
        $sql .= ' LIMIT ' . CommonHelper::calculatePagination($intPage, $numPerPage) . ', ' . $numPerPage;

        $objConnection = Yii::app()->db;
        $objCommand = $objConnection->createCommand($sql);
        $arrData = $objCommand->queryAll($sql);
        if (!empty($arrData)) {
            return $arrData;
        } else {
            return false;
        }
    }

    public function deleteOnboardingItem($deleteOnboardingItemIds) {
        foreach ($deleteOnboardingItemIds as $deleteOnboardingItemId) {
            $condition = 'id = ' . $deleteOnboardingItemId;
            $deleteItem = OnboardingChecklistItem::model()->deleteAll($condition);

            if ($deleteItem == null) {
                echo 'Please delete this item from the onboarding checklist first';
            }
        }
    }

    public function queryForOnboardingItemTitles() {
        $sql = 'SELECT id, title FROM ' . self::$tableName;
        $sql .= ' WHERE status = 1';

        $objConnection = Yii::app()->db;
        $objCommand = $objConnection->createCommand($sql);
        $arrData = $objCommand->queryAll($sql);

        return $arrData;
    }

    public function findOnboardingItemDetails($onboardingItemId) {
        $sql = 'SELECT OCI.description, D.title AS department_owner, ';
        $sql .= 'CASE WHEN OCI.is_offboarding_item = 1 THEN "Yes" ';
        $sql .= 'WHEN OCI.is_offboarding_item = 0 THEN "No" ';
        $sql .= 'END AS "is_offboarding_item", ';
        $sql .= 'CASE WHEN OCI.is_managerial = 1 THEN "Yes" ';
        $sql .= 'WHEN OCI.is_managerial = 0 THEN "No" ';
        $sql .= 'END AS "is_managerial" ';
        $sql .= 'FROM ' . self::$tableName . ' OCI ';
        $sql .= 'INNER JOIN department D ';
        $sql .= 'ON OCI.department_owner = D.id';
        $sql .= ' WHERE OCI.id = ' . $onboardingItemId;

        $objConnection = Yii::app()->db;
        $objCommand = $objConnection->createCommand($sql);
        $arrData = $objCommand->queryAll($sql);

        return $arrData;
    }

    //looking for all onboarding items belonging to a particular onboarding checklist template
    public function findAllOnboardingItemsInTemplate($departmentId, $templateId) {
        $sql = 'SELECT OCI.id, OCI.title, OCI.description, D.title AS department_owner, ';
        $sql .= 'CASE WHEN OCI.is_offboarding_item = 1 ';
        $sql .= 'THEN "Yes" ';
        $sql .= 'WHEN OCI.is_offboarding_item = 0 ';
        $sql .= 'THEN "No" ';
        $sql .= 'END AS "is_offboarding_item", ';
        $sql .= 'CASE WHEN OCI.is_managerial = 1 ';
        $sql .= 'THEN "Yes" ';
        $sql .= 'WHEN OCI.is_managerial = 0 ';
        $sql .= 'THEN "No" ';
        $sql .= 'END AS "is_managerial" ';
        $sql .= 'FROM ' . self::$tableName . ' OCI ';
        $sql .= 'INNER JOIN onboarding_checklist_items_mapping OCIM ';
        $sql .= 'ON OCI.id = OCIM.checklist_item_id ';
        $sql .= 'INNER JOIN onboarding_checklist_template OCT ';
        $sql .= 'ON OCIM.checklist_template_id = OCT.id ';
        $sql .= 'INNER JOIN department D ';
        $sql .= 'ON OCI.department_owner = D.id ';
        
        //not too sure
        $sql .= 'INNER JOIN onboarding_checklist_templates_mapping OCTM ';
        $sql .= 'ON D.id = OCTM.department_id ';
        $sql .= 'WHERE OCIM.checklist_template_id = ' . $templateId;
        $sql .= 'AND OCTM.department_id = ' . $departmentId;
        
        var_dump($sql);exit;
        //end not too sure
        
        $objConnection = Yii::app()->db;
        $objCommand = $objConnection->createCommand($sql);
        $arrData = $objCommand->queryAll($sql);

        if (!empty($arrData)) {
            return $arrData;
        } else {
            return false;
        }
    }

    //find onboarding items to assign to new hirees
    public function findOnboardingItems($departmentId, $isManagerial) {
        $sql = 'SELECT OCI.id, OCI.title, OCI.description, D.title AS department_owner, ';
        $sql .= 'CASE WHEN OCI.is_offboarding_item = 1 ';
        $sql .= 'THEN "Yes" ';
        $sql .= 'WHEN OCI.is_offboarding_item = 0 ';
        $sql .= 'THEN "No" ';
        $sql .= 'END AS "is_offboarding_item", ';
        $sql .= 'CASE WHEN OCI.is_managerial = 1 ';
        $sql .= 'THEN "Yes" ';
        $sql .= 'WHEN OCI.is_managerial = 0 ';
        $sql .= 'THEN "No" ';
        $sql .= 'END AS "is_managerial" ';
        $sql .= 'FROM ' . self::$tableName . ' OCI ';
        $sql .= 'INNER JOIN onboarding_checklist_items_mapping OCIM ';
        $sql .= 'ON OCI.id = OCIM.checklist_item_id ';
        $sql .= 'INNER JOIN onboarding_checklist_template OCT ';
        $sql .= 'ON OCIM.checklist_template_id = OCT.id ';
        $sql .= 'INNER JOIN department D ';
        $sql .= 'ON OCI.department_owner = D.id ';
        $sql .= 'WHERE OCI.is_managerial = ' . $isManagerial;
        $sql .= ' AND OCIM.department_id = ' . $departmentId;
    }

}
