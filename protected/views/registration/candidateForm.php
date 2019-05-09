<link href="candidateForm.css" rel="stylesheet" type="text/css" media="all">
<form action="" id="candidateForm">
	<!-- <div class="row"> -->
		<div id="candidateFormTitle">
	    <div id="candidateFormHeader">
	    	<div class="item_row animate0 bounceIn logo">
		    	<img src="<?php echo HTTP_MEDIA_IMAGES . '/alllanguages/sagaos_logo.png?sv='.SITE_VERSION;?>" alt="" />
		    </div>
	    	<?php echo Yii::t('app', 'APPLICATION FOR EMPLOYMENT'); ?>
    	</div>
	    <div id="positionInput">
		    <?php echo Yii::t('app', 'Position applied for'); ?>:
		    <input type="text" name="firstname" class="inputLine">
		  </div>
	  </div>
    <input type="file" id="pictureBox" onchange="readUrl(picture)" title="Please choose a picture">
  <!-- </div> -->
  <!-- primaryInfoBox is for each of the big boxes to input information -->
  <!-- <div class="row"> -->
	  <div class="primaryInfoBox">
	  	hellllooooo
	  </div>
	<!-- </div> -->
  <input type="submit" value="Submit">
</form>