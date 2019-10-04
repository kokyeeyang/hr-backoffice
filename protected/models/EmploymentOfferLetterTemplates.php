<?php 

class EmploymentOfferLetterTemplates extends AppActiveRecord {
	static $tableName = DB_TBL_PREFIX . 'employment_offer_letter_templates';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			
		];
	}

	public function attributeLabels(){
		return [
			'offer_letter_title' => Yii::t('app', 'offer_letter_title'),
			'offer_letter_description' => Yii::t('app', 'offer_letter_description'),
			'offer_letter_content' => Yii::t('app', 'offer_letter_content'),
			'department' => Yii::t('app', 'department'),
			'is_managerial' => Yii::t('app', 'is_managerial'),
			'offer_letter_content' => Yii::t('app', 'offer_letter_content'),
			'created_date' => Yii::t('app', 'created_date'),
			'created_by' => Yii::t('app', 'created_by'),
			'modified_date' => Yii::t('app', 'modified_date'),
			'modified_by' => Yii::t('app', 'modified_by')
		];
	}
	
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}	

	public function queryForOfferLetterIsManagerial($templateId){
		$sql = 'SELECT is_managerial 

						FROM ' . self::$tableName .

						' WHERE id=' . $templateId;

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		if ($arrData['is_managerial'] == "0"){
			return 'Non manager role';
		} else if ($arrData['is_managerial'] == "1"){
			return 'Managerial role';
		}

	}

	public function queryForOfferLetterTemplate($isManagerial,$department){

		$sql = 'SELECT offer_letter_content 

						FROM ' . self::$tableName .

						' WHERE is_managerial=' . $isManagerial . 

						' AND department LIKE "%' . $department . '%"';

		$objConnection = Yii::app()->db;
		$objCommand = $objConnection->createCommand($sql);
		$arrData = $objCommand->queryRow();

		if ($arrData['offer_letter_content'] != ''){
			return $arrData;
		} else {
			return 'No suitable offer letter has been found. Please create one first.';
		}
	}
}
