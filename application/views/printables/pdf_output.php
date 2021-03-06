<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	width: 90%;
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
.head{
	text-align: center;
}
</style>

<p></p>
<?php if ($Head): ?>
	<h3 class = "head"><?php echo $Head?></h3>
<?php endif ?>
<p></p>
<p></p>
<?php if ($content): ?>
	<table class="gridtable">
		<tr>
			<th>Username</th>
			<th>First Name</th>
			<th>Middle Name</th>
			<th>Last Name</th>
			<th>Status</th>
		</tr>
		<?foreach($content as $key => $v):?>
			<tr>
				<td><?=$v->username?></td>
				<td><?=$v->f_name?></td>
				<td><?=$v->m_name?></td>
				<td><?=$v->l_name?></td>
				<td><?=$v->userStatus?></td>
			</tr>
		<?endforeach?>
	</table>
<?php endif ?>


<?php if ($classes): ?>
	<?foreach($classes as $key => $v):?>
		<h4 class = "head"><?=$key?></h4>
		<table class="gridtable">
			<tr>
				<th>Class</th>
				<th>Code</th>
				<th>Created Date</th>
				<!-- <th>Status</th> -->
			</tr>
				<?foreach($v as $k => $val):?>
					<tr>
						<td><?=$val->class?></td>
						<td><?=$val->code?></td>
						<td><?=date('F d, Y', strtotime($val->created_at))?></td>
						<!-- <td></td> -->
					</tr>
				<?endforeach?>
		</table>
	<?endforeach?>
<?php endif ?>


<?php if ($students_class): ?>
	<?foreach($students_class as $key => $v):?>
		<h2 class = "head"><?=$v['class']?></h2>
		<h4 class = "head">Instructor: <?=$v['teacher']?></h4>
		<table class="gridtable">
			<tr>
				<th>Username</th>
				<th>First Name</th>
				<th>Middle Name</th>
				<th>Last Name</th>
				<th>Status</th>
			</tr>
				<?php if ($v['students']): ?>
					<?foreach($v['students'] as $k => $val):?>
						<tr>
							<td><?=$val->username?></td>
							<td><?=$val->f_name?></td>
							<td><?=$val->m_name?></td>
							<td><?=$val->l_name?></td>
							<td><?=$val->userStatus?></td>
						</tr>
					<?endforeach?>	
				<?else:?>
				<tr><td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td></tr>
				<?php endif ?>
		</table>
	<?endforeach?>
<?php endif ?>


<?php if ($mystudent): ?>
	<table class="gridtable">
			<tr>
				<th>Username</th>
				<th>First Name</th>
				<th>Middle Name</th>
				<th>Last Name</th>
				<th>Status</th>
			</tr>
				<?foreach($mystudent as $k => $val):?>
					<tr>
						<td><?=$val->username?></td>
						<td><?=$val->f_name?></td>
						<td><?=$val->m_name?></td>
						<td><?=$val->l_name?></td>
						<td><?=$val->userStatus?></td>
					</tr>
				<?endforeach?>	
		</table>
	
<?php endif ?>


