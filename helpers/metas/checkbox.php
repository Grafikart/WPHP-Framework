<p>
    <input name="<?php echo $id; ?>" type="hidden" value="0"/>
    <input name="<?php echo $id; ?>" id="<?php echo $id; ?>" type="checkbox" class="iphonecheck" value="1"<?php if($value==1) echo ' checked="checked"'; ?>/>
    <label for="<?php echo $id; ?>"><?php echo $name; ?></label>
</p>