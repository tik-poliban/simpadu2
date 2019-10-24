<?php
function input_text($id,$ket,$plac)
{
?>
	<div class="form-group">
        <label for=<?php echo $id; ?> class="col-sm-3 control-label"><?php echo $ket; ?></label>
        <div class="col-sm-9"><input type="text" name=<?php echo $id; ?> class="form-control" id=<?php echo $id; ?> placeholder="<?php echo $plac; ?>"></div>
    </div>
<?php
}
function input_date($id,$ket,$plac)
{
?>
    <div class="form-group">
        <label for=<?php echo $id; ?> class="col-sm-3 control-label"><?php echo $ket; ?></label>
        <div class="col-sm-9 ">
            <div class="input-group date ">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name=<?php echo $id; ?> class="form-control pull-right" id=<?php echo $id; ?> placeholder=<?php echo $plac; ?>>
            </div>
        </div>
    </div>
<?php
}
function input_text_edit($id,$ket,$plac,$dt)
{
?>
	<div class="form-group">
        <label for=<?php echo $id; ?> class="col-sm-3 control-label"><?php echo $ket; ?></label>
        <div class="col-sm-9">
			<input type="text" name=<?php echo $id; ?> class="form-control" id=<?php echo $id; ?> placeholder=<?php echo $plac; ?> value="<?php echo $dt ?>"></div>
    </div>
<?php
}
function input_date_edit($id,$ket,$plac,$dt)
{
?>
    <div class="form-group">
        <label for=<?php echo $id; ?> class="col-sm-3 control-label"><?php echo $ket; ?></label>
        <div class="col-sm-9 ">
            <div class="input-group date ">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name=<?php echo $id; ?> class="form-control pull-right" id="tgl_lahir" 
                    value="<?php echo $dt ?>" placeholder=<?php echo $plac; ?>>
            </div>
        </div>
    </div>
<?php
}
function input_pd($id,$ket,$datapd,$sel)
{
?>
	<div class="form-group">
        <label for=<?php echo $id; ?> class="col-sm-3 control-label"><?php echo $ket; ?></label>
        <div class="col-sm-9">
         <?php echo form_dropdown($id,$datapd,$sel,array('class'=>'form-control')); ?>                
        </div>
    </div>
<?php	
}

?>