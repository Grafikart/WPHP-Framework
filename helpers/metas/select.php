<div class="meta-box-item-title">
    <h4><?php echo $name; ?></h4>
</div>
<div class="meta-box-item-content">
    <select name="<?php echo $id; ?>" id="<?php echo $id; ?>">
		<?php foreach($options as $id=>$v): ?>
			<option value="<?php echo $id; ?>" <?php if($id==$value){ echo 'selected'; } ?>><?php echo $v; ?></option>
		<?php endforeach; ?>
	</select><br />
</div>