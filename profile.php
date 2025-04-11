<div class="conteudo" id="profile">
	<?php
		$get = addslashes(trim($_GET['id']));
		$user = $_COOKIE['Logado'];
		
		$res = $db->Get("SELECT * FROM Forum.Login WHERE ID = '".$get."'");
		$row = $res->fetch_object();
		
		$res2 = $db->Get("SELECT Username, STAFF, Level, Fugas, Capturas, Pacotes, VIPTIME1, VIPTIME2, BOOSTER, MissaoAtual FROM cr_dados.Players WHERE Username = '".$row->username."'");
		$row2 = $res2->fetch_object();
		
		$res3 = $db->Get("SELECT * FROM Forum.seguidores WHERE seguindo = '".$get."' AND Usuario = '".$user."'");
		
		$res4 = $db->Get("SELECT * FROM Forum.Seguidores WHERE Seguindo = '".$get."'");


		print '<nav>
			<div id="modal">
				<div class="cabecalho">
					<h2>EDITAR PERFIL</h2>
				</div>
				<div class="prompt">
					<button id="btnavatar" onclick="ChangeAvatar()">Carregar avatar</button>
					<button>Carregar banner</button>
				</div>
				<p id="console"></p>
				<div class="options">
					<button onclick="Cancelar()">Cancelar</button>
				</div>
				<input type="file" id="inputImagem" name="imagem" accept="image/*" style="display: none;">
			</div>

			<div class="perfil">
				'.($row->banner != 'N/A' ? '<img class="banner-perfil" src="'.$row->banner.'" alt="profile banner">' : '<div class="banner-generico"></div>' ).'
			
				<div class="perfil-info">
					<div class="perfil-align">
						<img class="avatar-perfil" src="data:'.$row->avatartype.';base64,'.$row->avatar.'" alt="Profile image">
						<div class="textos">
							<h2>'.$row->username.'</h2>
							<p>Offline</p>
						</div>
						'.($row->username != $user ? '<button id="seguir" onclick="seguir('.$get.', \''.$user.'\')">'.($res3->num_rows > 0 ? "Seguindo" : "+Seguir").'</button>' : '').'
						'.($row->username == $user ? '<button id="editar" onclick="Editar()">Editar</button>' : '').'
					</div>
				</div>
			</div>
			<div class="faixa">
				<ul>
					'.($row2->STAFF == 3 ? '<li><vermelho>Administrador</vermelho></li>' : ($row2->STAFF == 2 ? '<li><verde>Moderador</verde>' : ($row2->STAFF == 1 ? '<li><amarelo>Staff</amarelo></li>' : ''))).'
					'.($row2->BOOSTER == 1 ? '<li><rosa>Booster</rosa></li>' : '').'
					'.($row2->VIPTIME1 > 0 | $row2->VIPTIME2 > 0 ? '<li><amarelo>VIP</amarelo></li>' : '').'
					<li>'.$res4->num_rows.' Seguidores</li>
				</ul>
			</div>
		</nav>
		
		<div class="conteudo-perfil">
			<div class="esquerda">					
				<div class="painel">
					<div class="metricas">
						<h3><img src="img/logo2.png">Metricas</h3>
						<ul>
							<li>Fugas: '.$row2->Fugas.'</li>
							<li>Capturas: '.$row2->Capturas.'</li>
							<li>Drogas Entregues: '.$row2->Pacotes.'</li>
							<li>Missões Cumpridas: '.($row2->MissaoAtual - 1).'</li>
						</ul>
					</div>

					<div class="seguidores">
						<h3><img src="img/logo2.png">Seguidores</h3>
						<ul>';
							$res4 = $db->Get("SELECT * FROM Forum.Seguidores WHERE Seguindo = '".$get."' ORDER BY ID DESC LIMIT 10");
							while($row4 = $res4->fetch_object()){
								$res5 = $db->Get("SELECT * FROM Forum.Login WHERE Username = '".$row4->usuario."'");
								$row5 = $res5->fetch_object();
								print '<li><a href="index.php?page=profile&id='.$row5->id.'" title="Ir para o perfil de '.$row4->usuario.'" ><img src="data:'.$row5->avatartype.';base64,'.$row5->avatar.'"></a></li>';
							}
					print '</ul>
					</div>
				</div>
			</div>
			
			<div class="direita">
				<div class="painel2">';
					$res = $db->Get("SELECT * FROM Forum.Postagens WHERE Autor = '".$row->username."' AND Aprovado = '1' ORDER BY ID DESC");
					if ($res->num_rows > 0){
						while($row4 = $res->fetch_object())
						{
							$res2 = $db->Get("SELECT * FROM Forum.Respostas WHERE Postagem = '".$row4->id."' ORDER BY ID DESC");
							$row2 = $res2->fetch_object();
							$res3 = $db->Get("SELECT * FROM Forum.Curtidas WHERE Postagem = '".$row4->id."' AND Resposta = '-1' ORDER BY ID DESC");
							$row3 = $res3->fetch_object();
							print '<div class="topico">
								<img src="data:'.$row->avatartype.';base64,'.$row->avatar.'" alt="profile image">
								<div class="conteudo-topico">
									<h4><a href="index.php?page=postagem&id='.$row4->id.'">'.$row4->titulo.'</a></h4>
									<p>'.str_replace("\n", "<br>", $row4->conteudo).'</p>
									<ul>
										<li><a href="index.php?page=postagem&id='.$row4->id.'" '.($res2->num_rows > 0 ? 'title="'.$row2->autor.' comentou"' : '').'><img src="img/chat.png">'.$res2->num_rows.' respostas</a></li>
										<li><a '.($res3->num_rows > 0 ? ($res3->num_rows > 1 ? 'title="'.($row3->usuario != $user ? $row3->usuario : 'Você').' e outros '.($res3->num_rows - 1).' usuários curtiram"' : 'title="'.($row3->usuario != $user ? $row3->usuario : 'Você').' curtiu isso"') : '').'><img src="img/like.png">'.$res3->num_rows.' Curtidas</a></li>
										<li><a title="'.date('d/m/Y H:i', strtotime($row4->data)).'"><img src="img/clock.png">'.ucfirst(utf8_encode(strftime('%B %d', strtotime($row4->data)))).'</a></li>
									</ul>
								</div>
							</div>';
						}
					}
				print '</div>
			</div>
		</div>


		<script src="funcoes.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
		<script type="text/javascript">

			document.getElementById("inputImagem").addEventListener("change", function(event){
				let arquivo = event.target.files[0];
				if (arquivo) {
					document.getElementById("btnavatar").innerText = "Alterando avatar...";
					let reader = new FileReader();
					reader.onload = function(e) {
						let base64 = e.target.result.split(",")[1];
						let user = "'.$get.'";
						AjaxSender(JSON.stringify({ func: "changeavatar", imagem: base64, tipo: arquivo.type, userid: user }));
					}
					reader.readAsDataURL(arquivo);
				}
			});

			function ChangeAvatar(){
				document.getElementById("inputImagem").click();
			}

			function Cancelar(){
				let modal = document.getElementById("modal");
				modal.style.display = "none";

				let blur = document.getElementById("blur");
				blur.style.display = "none";
			}

			function Editar(){
				let modal = document.getElementById("modal");
				modal.style.display = "flex";

				let blur = document.getElementById("blur");
				blur.style.display = "block";
			}
		</script>';
	?>
</div>