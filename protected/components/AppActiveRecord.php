<?php
class AppActiveRecord extends CActiveRecord {
	var $lang_id = LANG_ID;
	static $num_per_page = null;
	
	/**
	 * @return the language ID
	 */
	public function getLangId()
	{	
		return $this -> lang_id;
	}
	
	/**
	 * To set the language ID
	 */
	public function setLangId($intLangId)
	{	
		$this -> lang_id = $intLangId;
	}
	
	/***
	Function: getPageRecords
	Desc	: Note - the pagination applied in Yii is a zero-based pagination(i.e. page 1 stands for the 1st page). 
	*/
	public static function getPageRecords($intPage, $sql, $sql_count)
	{	
		$num_per_page	= (self::$num_per_page !== null) ? (int)self::$num_per_page : (int)Yii::app()->params['numPerPage'];
		$arrData 		= array('records' => null, 'pagination' => null);
		$intPage		= (int)$intPage;
		
		if($intPage < 0){
			$intPage = 0;
		} // - end: if
		
		if($intPage === 0){
			$intOffset = 0;
		}
		else{
			$intOffset = (int)((($intPage + 1) * $num_per_page) - $num_per_page);
		} // - end: if
		
		$objPagination	= new CPagination((int)(self::model()->countBySql($sql_count)));
		$objPagination->setPageSize($num_per_page);
		$objPagination->setCurrentPage($intPage);

		$objConnection 			= Yii::app()->db;
        $objCommand				= $objConnection->createCommand($sql . ' LIMIT ' . $intOffset . ',' . $num_per_page);
		$arrData['records']		= $objCommand->queryAll();
		$arrData['pagination']	= $objPagination;
		
		return $arrData;
	}
		
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
?>