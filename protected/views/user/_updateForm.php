<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php if(UserIdentity::isHR()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<?php endif; ?>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<?php if(UserIdentity::isHR()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'college_id'); ?>
		<select name="User[college_id]" id="college_id">
			<?php foreach(College::model()->findAll() as $college): ?>
			<option value="<?=$college->id; ?>" <?php if($model->college_id==$college->id): ?>selected=""<?php endif; ?> >
				<?php echo $college->name; ?>
			</option>
			<?php endforeach; ?>
		</select>
		<?php echo $form->error($model,'college_id'); ?>
	</div>
	<?php endif; ?>

	<?php if(UserIdentity::isSA()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'role_id'); ?>
		<select name="User[role_id]" id="role_id">
			<?php foreach(Role::model()->findAll() as $role): ?>
			<option value="<?=$role->id; ?>" <?php if($model->role_id==$role->id): ?>selected=""<?php endif; ?> >
				<?php echo $role->name; ?>
			</option>
			<?php endforeach; ?>
		</select>
		<?php echo $form->error($model,'role_id'); ?>
	</div>
	<?php endif; ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->