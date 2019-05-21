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
</div>