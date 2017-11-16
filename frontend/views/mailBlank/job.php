<h2>Анкета соискателя</h2>
<table>
	<tr>
		<td style="width: 400px;">ФИО:</td>
		<td><?php echo $data['name']?></td>
	</tr>
	<tr>
		<td>Национальность:</td>
		<td><?php echo $data['nationality']?></td>
	</tr>
	<tr>
		<td>Дата рождения:</td>
		<td><?php echo $data['BDay'].".".$data['BMonth'].".".$data['BYear']?></td>
	</tr>
	<tr>
		<td>Телефон:</td>
		<td><?php echo $data['phone']?></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><?php echo $data['email']?></td>
	</tr>
	<tr>
		<td>Фактический адрес проживания:</td>
		<td><?php echo $data['addr']?></td>
	</tr>
	<tr>
		<td>Предыдущее или настоящее место работы(учебы):</td>
		<td><?php echo $data['lastJob']?></td>
	</tr>
	<tr>
		<td>Где желаете работать:</td>
		<td><?php echo $data['place']?></td>
	</tr>
	<tr>
		<td>Работу в ресторанах на каждый день рассматриваю как:</td>
		<td><?php echo $data['workType']?></td>
	</tr>
	<tr>
		<td>Желаемая должность:</td>
		<td><?php echo $data['profession']?></td>
	</tr>
	<tr>
		<td>Желаемый график работы:</td>
		<td><?php echo $data['grafic']?></td>
	</tr>
	
</table>
