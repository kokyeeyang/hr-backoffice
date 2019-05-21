<div class="grid_block">
  <div class="display_inline_block">
    <div class="lables">
      <span><?php echo Yii::t('app', 'Name of School/College/University'); ?></span><br>
    </div>
    <div class="lables2">
      <input type="text" name="schoolName[]" class="educationSectionInput"><br>
    </div>
  </div>
  <div class="display_inline_block">
    <div class="lables">
      <span><?php echo Yii::t('app', 'Year from'); ?></span><br>
    </div>
    <div class="lables2">
      <input type="year" name="startYear[]" class="educationSectionInput"><br>
    </div>
  </div>
  <div class="display_inline_block">
    <div class="lables">
      <span><?php echo Yii::t('app', 'Year to'); ?></span><br>
    </div>
    <div class="lables2">
      <input type="year" name="endYear[]" class="educationSectionInput"><br>
    </div>
  </div>
  <div class="display_inline_block">
    <div class="lables">
      <span><?php echo Yii::t('app', 'Qualification & Subject Obtained'); ?></span><br>
    </div>
    <div class="lables2">
      <input type="text" name="qualification[]" class="educationSectionInput"><br>
    </div>
  </div>
  <div class="display_inline_block">
    <div class="lables">
      <span><?php echo Yii::t('app', 'Grade/CGPA'); ?></span><br>
    </div>
    <div class="lables2">
      <input type="text" name="cgpa[]" class="educationSectionInput"><br>
    </div>
  </div>
</div>