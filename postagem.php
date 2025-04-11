<div class="conteudo" id="postagem">
	<div class="ads">
		<img src="img/adversiment.gif" alt="ads">
	</div>
	
	<?php
		$get = addslashes(trim($_GET['id']));
		$user = $_COOKIE['Logado'];
		$res = $db->Get("SELECT * FROM Forum.Postagens WHERE ID = '".$get."'");
		$row = $res->fetch_object();
		
		$res2 = $db->Get("SELECT * FROM Forum.Login WHERE Username = '".$row->autor."'");
		$row2 = $res2->fetch_object();
		
		$res3 = $db->Get("SELECT * FROM Forum.Respostas WHERE Postagem = '".$get."' ORDER BY ID DESC");
		
		$res4 = $db->Get("SELECT * FROM Forum.Curtidas WHERE Postagem = '".$get."' AND Resposta = '-1' ORDER BY ID DESC");
		$row4 = $res4->fetch_object();

		$res5 = $db->Get("SELECT * FROM cr_dados.Players WHERE Username = '".$row->autor."'");
		$row5 = $res5->fetch_object();
		
		$res6 = $db->Get("SELECT * FROM cr_dados.Players WHERE Username = '".$user."'");
		$row6 = $res6->fetch_object();
		
		if ($row6->STAFF == 3){
			print '<div class="painel-staff">
				<form method="POST" action="index.php?page=atividade">
					<input type="hidden" name="Tipo" value="Postagens">
					<input type="hidden" name="Id" value="'.$get.'">
					<input type="hidden" name="Categoria" value="'.$row->categoria.'">
					'.($row->aprovado == 0 ? '<input type="submit" name="acao" value="Aprovar">' : '').'
					<input type="submit" name="acao" value="Excluir">
				</form>
			</div>';
		}
		
		print '<div class="topico">
			<div class="esquerda">
				<div class="perfil">
					<img src="data:'.$row2->avatartype.';base64,'.$row2->avatar.'" alt="profile image">
					<h2><a href="index.php?page=profile&id='.$row2->id.'" title="Ir para o perfil de '.$row->autor.'">'.$row->autor.'</a></h2>
					<p>'.($row5->STAFF == 3 ? '<vermelho>Administrador</vermelho>' : ($row5->STAFF == 2 ? '<verde>Moderador</verde>' : ($row5->STAFF == 1 ? '<amarelo>Staff</amarelo>' : 'Jogador'))).'</p>
				</div>
			</div>
			<div class="direita">
				<div class="cabecalho">
					<p><a href="index.php">Inicio</a> > <a href="index.php?page='.$row->categoria.'">'.ucfirst($row->categoria).'</a> > <a href="index.php?page=postagem&id='.$get.'">'.$row->titulo.'</a></p>
					<p title="'.date('d/m/y H:i', strtotime($row->data)).'">Postado em '.ucfirst(utf8_encode(strftime('%B %d, %Y', strtotime($row->data)))).'</p>
				</div>
				<div class="conteudo">
					<h3>'.$row->titulo.'</h3>
					<p>'.str_replace("\n", "<br>", $row->conteudo).'</p>
					<button id="curtidas" '.($res4->num_rows > 0 ? ($res4->num_rows > 1 ? 'title="'.($row4->usuario != $_COOKIE["Logado"] ? $row4->usuario : 'Você').' e outros '.($res4->num_rows - 1).' usuários curtiram"' : 'title="'.($row4->usuario != $_COOKIE["Logado"] ? $row4->usuario : 'Você').' curtiu isso"') : '' ).' onclick="like(\''.$user.'\', '.$get.', -1)"><img id="img_like" src="img/like.png"><span id="span_like">'.$res4->num_rows.'</span></button>';
					$res = $db->Get("SELECT * FROM Forum.Curtidas WHERE Postagem = '".$get."' AND Usuario = '".$_COOKIE['Logado']."'");
					if ($res->num_rows > 0){
						print '<script type="text/javascript">
							var botao = document.getElementById("img_like");
							var count = document.getElementById("span_like");
							count.style.color = "#ff2400";
							botao.setAttribute("style", "-webkit-filter:sepia(0%) grayscale(0%)");
						</script>';
					}
				print '</div>
			</div>
		</div>
		
		<div class="respostas">
			<form method="POST" action="index.php?page=atividade">
				<input type="hidden" name="acao" value="comentar">
				<input type="hidden" name="Postagem" value="'.$get.'">
				<input type="text" maxlength=500 name="Conteudo" placeholder="Comentário">
				<input type="submit" name="botao" value="ENVIAR">
			</form>';
		
			while($row3 = $res3->fetch_object()){
				$res4 = $db->Get("SELECT * FROM Forum.Login WHERE Username = '".$row3->autor."'");
				$row4 = $res4->fetch_object();
				
				$res5 = $db->Get("SELECT * FROM cr_dados.Players WHERE Username = '".$row3->autor."'");
				$row5 = $res5->fetch_object();

				$res6 = $db->Get("SELECT * FROM Forum.Curtidas WHERE Postagem = '".$get."' AND Resposta = '".$row3->id."'");

				$res7 = $db->Get("SELECT * FROM Forum.Curtidas WHERE Postagem = '".$get."' AND Resposta = '".$row3->id."' AND Usuario = '".$user."'");

				$title = 'Curtir';
				if ($res6->num_rows > 0){
					$row6 = $res6->fetch_object();
					if ($res6->num_rows == 1){
						$title = ''.$row6->usuario.' curtiu isso';
					}
					else{
						$title = ''.$row6->usuario.' e outros '.($res6->num_rows - 1).' usuários curtiram';
					}
				}
				
				print '<div class="comentario">
						<div class="esquerda">
							<img src="data:'.$row4->avatartype.';base64,'.$row4->avatar.'" alt="profile image">
							<h4><a href="index.php?page=profile&id='.$row4->id.'" title="Ir para o perfil de '.$row3->autor.'">'.$row3->autor.'</a></h4>
							<p>'.($row5->STAFF == 3 ? '<vermelho>Administrador</vermelho>' : ($row5->STAFF == 2 ? '<verde>Moderador</verde>' : ($row5->STAFF == 1 ? '<amarelo>Staff</amarelo>' : 'Jogador'))).'</p>
						</div>
						<div class="centro">
							<p>'.str_replace("\n", "<br>", $row3->conteudo).'</p>
						</div>
						<div class="direita">
							<button id="curtir'.$row3->id.'" class="curtidas" onclick="like(\''.$user.'\', '.$get.', '.$row3->id.')" title="'.$title.'"><img id="img_like'.$row3->id.'" src="img/like.png"><span id="span_like'.$row3->id.'">0</span></button>
						</div>
					</div>';

				if ($res6->num_rows > 0) {
					print '<script type="text/javascript">
					var count = document.getElementById("span_like'.$row3->id.'");
					count.innerText = '.$res6->num_rows.';';

					if ($res7->num_rows > 0) {
						print 'var botao = document.getElementById("img_like'.$row3->id.'");
						count.style.color = "#ff2400";
						botao.setAttribute("style", "-webkit-filter:sepia(0%) grayscale(0%)");';
					}
					print '</script>';
				}
			}
		print '</div>';
?>
</div>