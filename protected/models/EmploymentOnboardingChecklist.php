<?php 

class EmploymentOnboardingChecklist extends AppActiveRecord
{
	static $tableName = DB_TBL_PREFIX . 'employment_onboarding_checklist';

	public function tableName(){
		return self::$tableName;
	}

	public function rules(){
		return [
			['full_name, id_no, offer_letter, induction_form, insurance_form, workplace_guideline, necessary_documents, access_card, personal_particulars, organization_chart, introduction_sessions, understanding_of_role, important_sites, hours, employment_conditions, training_schedule, good_conduct_certificate, communications_door_access, live_chats, payroll_panda']
		];
	}

	public function attributeLabels(){
		return [
			'full_name' => Yii::t('app', 'Full Name'),
			'id_no' => Yii::t('app', 'Id No'),
			'offer_letter' => Yii::t('app', 'Offer Letter'),
			'induction_form' => Yii::t('app', 'Induction Form'),
			'insurance_form' => Yii::t('app', 'Insurance Form'),
			'workplace_guideline' => Yii::t('app', 'Workplace Guideline'),
			'necessary_documents' => Yii::t('app', 'Necessary Documents'),
			'access_card' => Yii::t('app', 'Access Card'),
			'personal_particulars' => Yii::t('app', 'Personal Particulars'),
			'organization_chart' => Yii::t('app', 'Organization Chart'),
			'introduction_sessions' => Yii::t('app', 'Introduction Sessions'),
			'understanding_of_role' => Yii::t('app', 'Understanding Of Role'),
			'important_sites' => Yii::t('app', 'Important Sites'),
			'hours' => Yii::t('app', 'Hours'),
			'employment_conditions' => Yii::t('app', 'Employment Conditions'),
			'training_schedule' => Yii::t('app', 'Training Schedule'),
			'good_conduct_certificate' => Yii::t('app', 'Good Conduct Certificate'),
			'communications_door_access' => Yii::t('app', 'Communications Door Access'),
			'live_chats' => Yii::t('app', 'Live Chats'),
			'payroll_panda' => Yii::t('app', 'Payroll Panda')
		];
	}

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}	

	public function queryForCandidateOnboardingChecklist($candidateId){
		
	}
}