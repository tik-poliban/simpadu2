<?php
function in_text($nm_var,$caption,$val=NULL,$ro=NULL){
?>  
	<div class="form-group">
		<label for="<?php echo $nm_var; ?>" class="bmd-label-floating"><?php echo $caption; ?></label>
		<input type="text" name="<?php echo $nm_var; ?>"  class="form-control" id="<?php echo $nm_var; ?>"
					<?php if($val!=NULL) ?> value="<?php echo $val;?>" 		>
		<span class="text-warning"><?php echo form_error($nm_var); ?></span>
	</div>
<?php
}
function in_pass($nm_var,$caption,$val=NULL,$ro=NULL){
?>  
	<div class="form-group">
		<label for="<?php echo $nm_var; ?>" class="bmd-label-floating"><?php echo $caption; ?></label>
		<input type="password" name="<?php echo $nm_var; ?>"  class="form-control" id="<?php echo $nm_var; ?>"
					<?php if($val!=NULL) ?> value="<?php echo $val;?>" 		>
		<span class="text-warning"><?php echo form_error($nm_var); ?></span>
	</div>
<?php
}

function in_pd($nm_var,$caption,$isipd,$def){
?>  
      <?php echo form_dropdown($nm_var,$isipd,$def,
			array('title'=>$caption, 'class'=>'selectpicker', 'data-style'=>'select-with-transition', 
			'data-size'=>'7')); ?>

	
<?php 
}  

function in_text_captcha($nm_var, $caption, $captcha, $val = NULL, $ro = NULL)
{
	?>
	<div class="form-group">
		<label for="<?php echo $nm_var; ?>" class="bmd-label-floating"><?php echo $caption; ?></label>
		<div class="input-group">
			<input type="text" name="<?php echo $nm_var; ?>" class="form-control" id="<?php echo $nm_var; ?>" <?php if ($val != NULL) ?> value="<?php echo $val; ?>">
			&nbsp &nbsp
			<?php echo $captcha ?>
		</div>
		<span class="text-warning"><?php echo form_error($nm_var); ?></span>
	</div>
<?php
}
