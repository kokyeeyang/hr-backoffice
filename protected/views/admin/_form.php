<?php
$objForm = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'admin-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        )
);
?>
<table class="widget_table">		
    <thead>
        <tr>
            <th colspan="2"><?php echo Yii::t('app', 'Note') . ': *' . Yii::t('app', 'Required fields'); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="col1"><?php echo $objForm->labelEx($objModel, 'admin_username'); ?></td>
            <td class="col2">: <?php echo $objForm->textField($objModel, 'admin_username', array('class' => 'common', 'size' => 60, 'maxlength' => 16)); ?> (<?php echo Yii::t('app', 'Please enter an alphanumeric username with 3-16 characters.'); ?>)</td>
        </tr>
        <tr>
            <td><?php echo Yii::t('app', 'Password'); ?><?php if (Yii::app()->controller->action->id == 'add') { ?> *<?php } ?></td>
            <td>: <?php echo $objForm->passwordField($objModel, 'admin_password', array('class' => 'common', 'size' => 60, 'maxlength' => 20)); ?> (<?php echo Yii::t('app', 'Please enter an alphanumeric password with 6-20 characters.'); ?>)</td>
        </tr>
        <tr>
            <td><?php echo Yii::t('app', 'Confirm Password'); ?><?php if (Yii::app()->controller->action->id == 'add') { ?> *<?php } ?></td>
            <td>: <?php echo CHtml::passwordField('admin_password_confirm', '', array('class' => 'common', 'size' => 60, 'maxlength' => 20)); ?> (<?php echo Yii::t('app', 'Please enter an alphanumeric password with 6-20 characters.'); ?>)</td>
        </tr>
        <tr>
            <td><?php echo $objForm->labelEx($objModel, 'admin_display_name'); ?></td>
            <td>: <?php echo $objForm->textField($objModel, 'admin_display_name', array('class' => 'common', 'size' => 60, 'maxlength' => 50)); ?></td>
        </tr>
        <tr>
            <td><?php echo $objForm->labelEx($objModel, 'admin_status'); ?></td>
            <td>: <?php echo $objForm->radioButtonList($objModel, 'admin_status', array('1' => Admin::getStatusLabel(Admin::ACTIVE), '0' => Admin::getStatusLabel(Admin::INACTIVE)), array('separator' => ' ')); ?></td>
        </tr>
        <tr>
            <td><?php echo $objForm->labelEx($objModel, 'admin_email_address'); ?></td>
            <td>: <?php echo $objForm->textField($objModel, 'admin_email_address', array('class' => 'common', 'size' => 60, 'maxlength' => 50)); ?></td>
        </tr>
        <tr>
            <td><?php echo $objForm->labelEx($objModel, 'admin_priv'); ?></td>
            <td>: <?php echo $objForm->dropDownList($objModel, 'admin_priv', Admin::$arrPriv); ?></td>
        </tr>
        <tr>
            <td> Departments </td>
            <td>
                : 
                <select name="admin_department">
                    <?php
                    $departmentId = DepartmentEnum::DEPARTMENT_ID;
                    $departmentIdArr = Department::model()->queryForDepartmentDetails($departmentId);
                    foreach ($departmentIdArr as $departmentIdObj) {
                        $selectedStatus = $objModel->admin_department == $departmentIdObj['id'] ? "selected" : "";
                        $departmentTitle = Department::model()->queryForDepartmentTitle($departmentIdObj['id']);
                        ?>
                        <option value="<?php echo $departmentIdObj['id']; ?>" <?php echo $selectedStatus ?>><?php echo $departmentTitle['title']; ?></option>
<?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php if (Yii::app()->controller->action->id == 'add') { ?>
        <center><?php echo get_button(Yii::t('app', 'Submit'), 80, '', '', 'grey', 'btnSubmitAdminForm'); ?></center>
        <?php
    } else {
        ?>
        <div class="form_button_common_wrapper">
            <div class="col">
                <?php echo get_button(Yii::t('app', 'Return'), 80, '', '', 'grey', 'btnGetAdminList', '', '', $this->createUrl('admin/list')); ?>
            </div>
            <div class="col">
                <div class="separator">&nbsp;</div>
            </div>			
            <div class="col">
                <?php echo get_button(Yii::t('app', 'Submit'), 80, '', '', 'grey', 'btnSubmitAdminForm'); ?>
            </div>
            <div class="clear"><!--clear--></div>
        </div>
        <?php } // - end: if else 
    ?>					
</td>
</tr>				
</tbody>
</table>
<?php $this->endWidget(); ?>