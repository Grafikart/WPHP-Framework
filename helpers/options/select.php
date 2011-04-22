<tr>
    <th scope="row">
        <label for="<?php echo $id; ?>"><?php echo $name; ?></label>
    </th>
	<td>
		<select name="<?php echo $id; ?>" id="<?php echo $id; ?>"> 
		<?php foreach($options as $id=>$v): ?>
			<option value="<?php echo $id; ?>" <?php if($id==$value){ echo 'selected'; } ?>><?php echo $v; ?></option>
		<?php endforeach; ?>
		</select>
	</td>
</tr>