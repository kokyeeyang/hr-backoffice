<div class="form-wrapper">
  <form method="post" action="<?php echo $this->createUrl('registration/saveCandidate') ?>" id="candidateForm" name="candidateForm">
    <div class="container">
      <label>
        <img src="<?php echo HTTP_MEDIA_IMAGES . '/alllanguages/sagaos_logo.png?sv='.SITE_VERSION;?>" alt="" />
        <?php echo Yii::t('app', 'APPLICATION FOR EMPLOYMENT'); ?>
      </label>
      <input type="file" name="profilePicture" id="pictureBox" onchange="readUrl(picture)" title="Please choose a picture">
    </div>
    <div class="container">
      <h1>Personal Particulars</h1>
      <div class="childContainer">
        <div class="title">
          <?php echo Yii::t('app', 'Full Name as per NRIC'); ?><br>
          (<?php echo Yii::t('app', 'IN BLOCK LETTERS'); ?>):
        </div>
        <div class="userInput">
          <input type="text" class="inputLine" name="fullName">
        </div>
      </div>
      <div class="childContainer">
        <div class="title">
          <?php echo Yii::t('app', 'Correspondence Address'); ?>:
        </div>
        <div class="userInput">
          <input type="text" class="inputLine" name="address">
        </div>
      </div>
      <div class="childContainer">
        <div class="title">
          <?php echo Yii::t('app', 'Contact No'); ?>:
        </div>
        <div class="userInput">
          <input type="text" class="inputLine" name="contactNo">
        </div>
      </div>
    </div>
  </form>
</div>








