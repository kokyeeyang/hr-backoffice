<div class="grid_block">
  <div class="display_inline_block">
    <div class="lables">
      <span><?php echo Yii::t('app', 'Name of Company'); ?></span><br>
    </div>
    <div class="lables2">
      <input type="text" name="companyName[]">
    </div>
  </div>
  <div class="display_inline_block">
    <div class="lables">
      <?php echo Yii::t('app', 'From'); ?>
    </div>
    <div class="lables2">
      <input type="year" name="startDate[]" placeholder="E.g: 01/2018 for Jan 2018">
    </div>
  </div>
  <div class="display_inline_block">
    <div class="lables">
      <?php echo Yii::t('app', 'To'); ?>
    </div>
    <div class="lables2">
      <input type="year" name="endDate[]" placeholder="E.g: 01/2018 for Jan 2018">
    </div>
  </div>
  <div class="display_inline_block">
    <div class="lables">
      <?php echo Yii::t('app', 'Position Held'); ?>
    </div>
    <div class="lables2">
      <input type="text" name="positionHeld[]">
    </div>
  </div>
  <div class="display_inline_block">
    <div class="lables">
      <?php echo Yii::t('app', 'Final Salary'); ?>
    </div>
    <div class="lables2">
      <input type="text" name="endingSalary[]">
    </div>
  </div>
  <div class="display_inline_block">
    <div class="lables">
      <?php echo Yii::t('app', 'Allowances'); ?>
    </div>
    <div class="lables2">
      <input type="text" name="allowances[]">
    </div>
  </div>
  <div class="display_inline_block">
    <div class="lables">
      <?php echo Yii::t('app', 'Reason for leaving'); ?>
    </div>
    <div class="lables2">
      <input type="text" name="leaveReason[]">
    </div>
  </div>
  <div class="display_inline_block">
    <div class="lables">
      <?php echo Yii::t('app', 'Have you ever been terminated/dismissed/suspended from the service of any employer'); ?>?<br>
      <?php echo Yii::t('app', 'If yes, please give details'); ?><br>
      <input type="text" name="terminationDetails" class="inputLine" id="terminationReason" style="display:none;"><br><br>
    </div>
    <div class="lables2">
      <input type="radio" name="terminatedBefore" value="1"> Yes<br>
      <input type="radio" name="terminatedBefore" value="0"> No<br>
    </div>
  </div>
</div>