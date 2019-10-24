<?php
function input_text($nm_var,$caption,$place,$val=NULL,$ro=NULL){  //dipakai di isi.php pada sa
?>  
  <div class="form-group">
    <label for="<?php echo $nm_var; ?>" class="col-sm-3 control-label"><?php echo $caption; ?></label>
    <div class="col-sm-8">
      <input type="text" name="<?php echo $nm_var; ?>" class="form-control" id="<?php echo $nm_var; ?>" 
             placeholder="<?php echo $place; ?>" <?php if($val!=NULL) ?> value="<?php echo $val;?>" 
             <?php if($ro!=NULL) echo "Readonly";?> >
      <h6><?php echo form_error($nm_var,'<div class="text-yellow">', '</div>'); ?></h6>
    </div>
  </div>
<?php
}

function input_pd($nm_var,$caption,$isipd,$def){  //dipakai di isi.php pada sa
?>  
  <div class="form-group">
    <label for="<?php echo $nm_var; ?>" class="col-sm-3 control-label"><?php echo $caption; ?></label>
    <div class="col-sm-8">
      <?php echo form_dropdown($nm_var,$isipd,$def,array('class'=>'form-control')); ?>
      <h6><?php echo form_error($nm_var,'<div class="text-yellow">', '</div>'); ?></h6>      
    </div>
  </div>
<?php 
}  

 

function input_date($id,$ket,$plac){
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
function input_radio($id,$cap){
?>

              <div class="form-group">
                <label for="jk" class="col-sm-3 control-label"><?php echo $cap; ?></label>
                <div class="col-sm-9">
				<?php foreach($id as $d){ ?>
                  <div class="radio">
                    <label><?php echo form_radio($d[0], $d[1], $d[2]); ?> <?php echo $d[3]; ?> </label>
                  </div>
				<?php } ?>
                </div>
              </div>
<?php
}
?>