<?php 
//output the content header
echo PageHelper::printFormListingHeader($pageType); 

//output the body content, the function does not include </form>, </div>, </div>
echo PageHelper::printFormListingBody($pageType, $strSortKey, true, $onboardingChecklistTemplatesArr, true, $objPagination, false);

if(isset($departmentArr[0])){		
	echo $this->renderFile(Yii::getPathOfAlias('application.views.layouts') . '/pagination.php', array('objPagination' => $objPagination));
} // - end: if 
?>

<!-- these 3 tags must be here to enclose the pagination file above -->
</form>
</div>
</div>

<?php 
//output the alert message
echo PageHelper::printFormListingAlertMessage($pageType); 
?>