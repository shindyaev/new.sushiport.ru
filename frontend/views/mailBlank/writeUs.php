<h2>Сообщение с сайта Milimon</h2>
<table>
	<tr>
		<td style="width: 400px;">Имя:</td>
		<td><?php echo $data['name']?></td>
	</tr>
	<tr>
		<td style="width: 400px;">Email:</td>
		<td><?php echo $data['email']?></td>
	</tr>
	<?php if (!empty($data['phone'])):?>
	<tr>
		<td style="width: 400px;">Телефон:</td>
		<td><?php echo $data['phone']?></td>
	</tr>
	<?php endif;?>
	<tr>
		<td style="width: 400px;">Сообщение:</td>
		<td><?php echo $data['text']?></td>
	</tr>
</table>
