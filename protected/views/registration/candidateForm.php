<form action="" style="width:50%">
	<div class="row">
		<!-- <div class="common_content_inner_wrapper"> -->
		<div class="tpl_main_wrapper .common_form">
			<div class="row">
				<div id="candidateFormTitle">
			    <div id="candidateFormHeader">
			    	<img src="<?php echo HTTP_MEDIA_IMAGES . '/alllanguages/sagaos_logo.png?sv='.SITE_VERSION;?>" alt="" />
			    	<?php echo Yii::t('app', 'APPLICATION FOR EMPLOYMENT'); ?>
		    	</div>
			    <div id="positionInput">
				    <?php echo Yii::t('app', 'Position applied for'); ?>:
				    <input type="text" name="firstname" class="inputLine">
				  </div>
			  </div>
		    <input type="file" id="pictureBox" onchange="readUrl(picture)" title="Please choose a picture">
		  </div>
		</div>
    <input type="submit" value="Submit">
	</div>
</form>