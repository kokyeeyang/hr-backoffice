<?php

echo PageHelper::printFormListingHeader($pageType);

echo PageHelper::printFormListingBody($pageType, $strSortKey, true, $trainingTemplateArr, false, false);

if(isset($trainingItemArr[0])){   
  echo $this->renderFile(Yii::getPathOfAlias('application.views.layouts') . '/pagination.php', array('objPagination' => $objPagination));
} // - end: if 
?>

</form>
</div>
</div>

<?php 
//output the alert message
echo PageHelper::printFormListingAlertMessage($pageType); 

?>