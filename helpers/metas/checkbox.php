<div class="meta-box-item-title">
    <h4><?php echo $name; ?></h4>
</div>
<div class="meta-box-item-content">
    <input name="<?php echo $id; ?>" type="hidden" value="0"/>
    <input name="<?php echo $id; ?>" id="<?php echo $id; ?>" type="checkbox" class="iphonecheck" value="1"<?php if($value==1) echo ' checked="checked"'; ?>/>
</div>