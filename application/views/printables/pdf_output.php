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


