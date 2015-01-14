<div class="meta-box-item-title">
    <h4><?php echo $name; ?></h4>
</div>
<div class="meta-box-item-content">
    <?php if(!empty($value)): ?>
    <a href="#" class="customaddmedia" style="margin-right:10px; text-decoration:none; ">
        <img src="<?php echo $value; ?>" style="max-height:100px; vertical-align:middle;"/>
    </a>
    <?php endif; ?>
    <input type="text" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $value; ?>" size="75"/>
    <a class="button customaddmedia"
       href="#">
        Upload
    </a>
</div>
<div style="clear:both;"></div>