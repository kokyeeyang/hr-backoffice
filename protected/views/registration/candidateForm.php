<form action="" id="candidateForm">
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
	  <div class="primaryInfoBox">
	  	hellllooooo<br>
	  	asaa<br>
	  	asasa<br>
	  	asasa<br>
	  </div>
	<!-- </div> -->
  <input type="submit" value="Submit">
</form>