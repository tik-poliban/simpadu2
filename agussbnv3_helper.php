<?php
function input_text($nm_var, $caption, $place, $val = NULL, $ro = NULL)
{  //dipakai di isi.php pada sa
  ?>
  <div class="form-group">
    <label for="<?php echo $nm_var; ?>" class="col-sm-3 control-label"><?php echo $caption; ?></label>
    <div class="col-sm-9">
      <input type="text" name="<?php echo $nm_var; ?>" class="form-control" id="<?php echo $nm_var; ?>" placeholder="<?php echo $place; ?>" <?php if ($val != NULL) ?> value="<?php echo set_value($nm_var, $val); ?>" <?php if ($ro != NULL) echo "Readonly"; ?>>
      <h6><?php echo form_error($nm_var, '<div class="text-yellow">', '</div>'); ?></h6>
    </div>
  </div>
<?php
}

function input_pd($nm_var, $caption, $isipd, $def=NULL)
{  //dipakai di isi.php pada sa
  ?>
  <div class="form-group">
    <label for="<?php echo $nm_var; ?>" class="col-sm-3 control-label"><?php echo $caption; ?></label>
    <div class="col-sm-9">
      <?php
        if($def)
          echo form_dropdown($nm_var, $isipd, set_value($nm_var, $def) , array('class' => 'form-control')); 
        else
          echo form_dropdown($nm_var, $isipd, set_value($nm_var, $nm_var) , array('class' => 'form-control'));           
      ?>
      <h6><?php echo form_error($nm_var, '<div class="text-yellow">', '</div>'); ?></h6>
    </div>
  </div>
<?php
}

function input_number($nm_var, $caption, $place, $val = NULL, $ro = NULL)
{  //dipakai di isi.php pada sa
  ?>
  <div class="form-group number">
    <label for="<?php echo $nm_var; ?>" class="col-sm-3 control-label"><?php echo $caption; ?></label>
    <div class="col-sm-6">
      <INPUT type="number" id="txtNumber" placeholder="<?php echo $place; ?>" class="form-control" onkeypress="return isNumberKey(event)" value="<?php echo set_value($nm_var, $val); ?>" name="<?php echo $nm_var; ?>" <?php if ($ro != NULL) echo "Readonly"; ?>>
      <h6><?php echo form_error($nm_var, '<div class="text-yellow">', '</div>'); ?></h6>
    </div>
  </div>
<?php
  //  onkeypress="return isNumberKey(event)" ditulis di jscode bagian awal.
}


function input_date($nm_var, $ket, $plac, $val = NULL)
{
  ?>
  <div class="form-group">
    <label for=<?php echo $nm_var; ?> class="col-sm-3 control-label"><?php echo $ket; ?></label>
    <div class="col-sm-9 ">
      <div class="input-group date" id="tgl">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" name=<?php echo $nm_var; ?> class="form-control pull-right" value="<?php echo set_value($nm_var, $val); ?>" placeholder=<?php echo $plac; ?>>
      </div>
      <h6><?php echo form_error($nm_var, '<div class="text-yellow">', '</div>'); ?></h6>
    </div>
  </div>
<?php
}

function input_radio($nm_var, $caption, $isi_radio, $val = NULL)
{
  ?>
  <div class="form-group">
    <label for="jk" class="col-sm-3 control-label"><?php echo $caption; ?></label>
    <div class="col-sm-9">
      <?php foreach ($isi_radio as $d) {
          ?>
        <div class="radio">
          <label>
            <?php
                if ($val)
                  echo form_radio($nm_var, $d[0], set_radio($nm_var, $d[0], $d[0] == $val ? TRUE : FALSE));
                else
                  echo form_radio($nm_var, $d[0], set_radio($nm_var, $d[0]));

                echo $d[1];
                // echo " = " . set_radio($nm_var, $d[0], $d[0] == $val ? TRUE : FALSE);
                ?>
          </label>
        </div>
      <?php
        }
        ?>
      <h6><?php echo form_error($nm_var, '<div class="text-yellow">', '</div>'); ?></h6>
    </div>

  </div>
<?php
}

function input_cb($nm_var, $caption, $isi_cb, $val = NULL)
{ //cb  Checkbox
  ?>

  <div class="form-group">
    <?php
      echo '<label>' . $caption . '</label>';
      foreach ($isi_cb as $d) {
        ?>
      <div class="checkbox">
        <label>
          <?php
              if ($val)
                echo form_checkbox($nm_var, $d['key'], set_checkbox($nm_var, $d['key'], ($d['key'] & $val) == $d['key'] ? TRUE : FALSE));
              else
                echo form_checkbox($nm_var, $d['key'], set_checkbox($nm_var, $d['key']));

              echo $d['value'];
              ?>
        </label>
      </div>
    <?php
      }
      ?>
  </div>
  <h6><?php echo form_error($nm_var, '<div class="text-yellow">', '</div>'); ?></h6>
<?php
}

function input_file($nm_var, $caption, $val = NULL, $action_del = NULL)
{
  ?>

  <div class="form-group">
    <label class="col-sm-3 control-label" for=<?php echo $nm_var ?>>
      <?php echo $caption ?>
    </label>
    <div class="col-sm-9">
      <?php if ($val) { ?>
        <div class="input-group">
          <?php echo form_input($nm_var, $val, 'class="form-control" disabled') ?>
          <span class="input-group-btn">
            <a href="<?php echo $action_del ?>" class="btn btn-danger"><i class="fa fa-eraser"></i> Hapus File</a>
          </span>
        </div>
      <?php } else { ?>
        <?php echo form_upload($nm_var, $val, '') ?>
      <?php } ?>
    </div>
  </div>

<?php
}

function input_textarea($nm_var, $caption, $place, $val = NULL, $ro = NULL)
{  
  ?>
  <div class="form-group">
    <label for="<?php echo $nm_var; ?>" class="col-sm-3 control-label"><?php echo $caption; ?></label>
    <div class="col-sm-9 ">
      <textarea name="<?php echo $nm_var; ?>" 
        class="form-control ckeditor" 
        placeholder="<?php echo $place; ?>" 
        <?php if ($ro != NULL) echo "Readonly"; ?> 
        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">      
        <?php if (!NULL) 
          echo set_value($nm_var, $val); 
        ?>
      </textarea>
      <h6><?php echo form_error($nm_var, '<div class="text-yellow">', '</div>'); ?></h6>
    </div>
  </div>
<?php
}
