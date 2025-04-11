<div class="conteudo" id="tops">
	<h2>TOPS</h2>
	<?php
		switch (addslashes(trim($_GET['id']))){
			case '1':
				$res = $db->Get("SELECT Username, Capturas FROM cr_dados.Players ORDER BY Capturas DESC LIMIT 100");
					print '<p>Jogadores melhores ranqueados na categoria Capturas</p>
					<nav>
						<table>
							<tr>
								<th>Username</th>
								<th>Capturas</th>
							</tr>';
								while ($row = $res->fetch_object())
								{
									print '<tr class="tops-list">
										<td>'.$row->Username.'</td>
										<td>'.$row->Capturas.'</td>
									</tr>';
								}
						print '</table>
					</nav>';
				break;
				
			case '2':
				$res = $db->Get("SELECT Username, Pacotes, Drogas FROM cr_dados.Players ORDER BY Pacotes DESC LIMIT 100");
					print '<p>Jogadores melhores ranqueados na categoria Drogas</p>
					<nav>
						<table>
							<tr>
								<th>Username</th>
								<th>Drogas Entregues</th>
								<th>Drogas Encontradas</th>
							</tr>';
								while ($row = $res->fetch_object())
								{
									print '<tr class="tops-list">
										<td>'.$row->Username.'</td>
										<td>'.$row->Pacotes.'</td>
										<td>'.$row->Drogas.'</td>
									</tr>';
								}
						print '</table>
					</nav>';
				break;
				
			case '3':
				$res = $db->Get("SELECT Username, Fugas FROM cr_dados.Players ORDER BY Fugas DESC LIMIT 100");
					print '<p>Jogadores melhores ranqueados na categoria Fugas</p>
					<nav>
						<table>
							<tr>
								<th>Username</th>
								<th>Fugas</th>
							</tr>';
								while ($row = $res->fetch_object())
								{
									print '<tr class="tops-list">
										<td>'.$row->Username.'</td>
										<td>'.$row->Fugas.'</td>
									</tr>';
								}
						print '</table>
					</nav>';
				break;
				
			case '4':
				$res = $db->Get("SELECT Username, Level FROM cr_dados.Players ORDER BY Level DESC LIMIT 100");
					print '<p>Jogadores melhores ranqueados na categoria Nivel</p>
					<nav>
						<table>
							<tr>
								<th>Username</th>
								<th>Nivel</th>
							</tr>';
								while ($row = $res->fetch_object())
								{
									print '<tr class="tops-list">
										<td>'.$row->Username.'</td>
										<td>'.$row->Level.'</td>
									</tr>';
								}
						print '</table>
					</nav>';
				break;
			case '5':
				$res = $db->Get("SELECT Username, Assaltos, Protecoes FROM cr_dados.Players ORDER BY Assaltos DESC LIMIT 100");
					print '<p>Jogadores melhores ranqueados na categoria Lojas</p>
					<nav>
						<table>
							<tr>
								<th>Username</th>
								<th>Assaltadas</th>
								<th>Protegidas</th>
							</tr>';
								while ($row = $res->fetch_object())
								{
									print '<tr class="tops-list">
										<td>'.$row->Username.'</td>
										<td>'.$row->Assaltos.'</td>
										<td>'.$row->Protecoes.'</td>
									</tr>';
								}
						print '</table>
					</nav>';
				break;
			case '6':
				$res = $db->Get("SELECT Username, Pontos FROM cr_dados.Players ORDER BY Pontos DESC LIMIT 100");
					print '<p>Jogadores melhores ranqueados na categoria Pontos</p>
					<nav>
						<table>
							<tr>
								<th>Username</th>
								<th>Pontos</th>
							</tr>';
								while ($row = $res->fetch_object())
								{
									print '<tr class="tops-list">
										<td>'.$row->Username.'</td>
										<td>'.$row->Pontos.'</td>
									</tr>';
								}
						print '</table>
					</nav>';
				break;
		}
	?>
    <aside>
    </aside>
</div>