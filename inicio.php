<div class="slider">
    <div id="banners">
        <img src="img/banner1.png">
        <img src="img/banner2.png">
        <img src="img/banner3.png">
        <img src="img/banner4.png">
        <img src="img/banner5.png">
		<img src="img/banner6.png">
		<img src="img/banner7.png">
		<img src="img/banner8.png">
    </div>

    <script type="text/javascript">
        var count2 = -95.5;
        setInterval(() => {
            document.getElementById('banners').style.marginLeft = count2 + "vw";
            if (count2 <= (-632)){
                count2 = 0;
            }else{
                count2 = count2 - 95.5;
            }
        }, 7500);
    </script>
</div>

<div class="conteudo" id="inicio">
    <nav>
        <div class="topico">
            <div class="titulo">
                <img src="img/topico.png">
                <h3>Inicio</h3>
            </div>

            <?php	
                $user = $_COOKIE["Logado"];
				$res = $db->Get("SELECT * FROM Forum.Postagens WHERE Categoria='EVENTOS' AND Aprovado = '1' ORDER BY ID DESC");
					print '<div class="conteudo-topico">
						<div class="categoria">
							<img src="img/logo2.png">
							<div class="descricao">
								<h4><a href="index.php?page=eventos">Eventos</a></h4>
								<p>Eventos organizados no servidor</p>
							</div>
						</div>';
						if ($res->num_rows > 0){
							$row = $res->fetch_object();
							$res2 = $db->Get("SELECT * FROM Forum.Login WHERE Username = '".$row->autor."'");
							$row2 = $res2->fetch_object();
							print '<div class="postagem">
								<a class="profilelink" href="index.php?page=profile&id='.$row2->id.'"><img src="data:'.$row2->avatartype.';base64,'.$row2->avatar.'" title="Ir para o perfil de '.$row->autor.'"></a>
								<div class="author">
									<h5><a href="index.php?page=postagem&id='.$row->id.'">'.$row->titulo.'</a></h5>
									<p>Por <a href="index.php?page=profile&id='.$row2->id.'" title="Ir para o perfil de '.$row->autor.'">'.$row->autor.'</a>, <a title="'.date('d/m/Y H:i', strtotime($row->data)).'">'.ucfirst(utf8_encode(strftime('%B %d', strtotime($row->data)))).'</a></p>
								</div>
							</div>';
						}
					print '</div>';
			
                $res = $db->Get("SELECT * FROM Forum.Postagens WHERE Categoria='REGRAS' AND Aprovado = '1' ORDER BY ID DESC");
                    print '<div class="conteudo-topico">
                        <div class="categoria">
                            <img src="img/logo2.png">
                            <div class="descricao">
                                <h4><a href="index.php?page=regras">Regras</a></h4>
                                <p>Seção de regras do servidor</p>
                            </div>
                        </div>';
						if ($res->num_rows > 0){
							$row = $res->fetch_object();
							$res2 = $db->Get("SELECT * FROM Forum.Login WHERE Username = '".$row->autor."'");
							$row2 = $res2->fetch_object();
							print '<div class="postagem">
								<a class="profilelink" href="index.php?page=profile&id='.$row2->id.'"><img src="data:'.$row2->avatartype.';base64,'.$row2->avatar.'" title="Ir para o perfil de '.$row->autor.'"></a>
								<div class="author">
									<h5><a href="index.php?page=postagem&id='.$row->id.'">'.$row->titulo.'</a></h5>
									<p>Por <a href="index.php?page=profile&id='.$row2->id.'" title="Ir para o perfil de '.$row->autor.'">'.$row->autor.'</a>, <a title="'.date('d/m/Y H:i', strtotime($row->data)).'">'.ucfirst(utf8_encode(strftime('%B %d', strtotime($row->data)))).'</a></p>
								</div>
							</div>';
						}
                    print '</div>';

                $res = $db->Get("SELECT * FROM Forum.Postagens WHERE Categoria='TUTORIAIS' ORDER BY ID DESC");
				print '<div class="conteudo-topico">
                        <div class="categoria">
                            <img src="img/logo2.png">
                            <div class="descricao">
                                <h4><a href="index.php?page=tutoriais">Tutoriais</a></h4>
                                <p>Seção de tutoriais do servidor</p>
                            </div>
                        </div>';
						
                if ($res->num_rows > 0){
                    $row = $res->fetch_object();
					$res2 = $db->Get("SELECT * FROM Forum.Login WHERE Username = '".$row->autor."'");
					$row2 = $res2->fetch_object();
                        print '<div class="postagem">
                            <a class="profilelink" href="index.php?page=profile&id='.$row2->id.'"><img src="data:'.$row2->avatartype.';base64,'.$row2->avatar.'" title="Ir para o perfil de '.$row->autor.'"></a>
                            <div class="author">
                                <h5><a href="index.php?page=postagem&id='.$row->id.'">'.$row->titulo.'</a></h5>
                                <p>Por <a href="index.php?page=profile&id='.$row2->id.'" title="Ir para o perfil de '.$row->autor.'">'.$row->autor.'</a>, <a title="'.date('d/m/Y H:i', strtotime($row->data)).'">'.ucfirst(utf8_encode(strftime('%B %d', strtotime($row->data)))).'</a></p>
                            </div>
                        </div>';
				}
				print '</div>';
            ?>
        </div>

        <div class="topico">
            <div class="titulo">
                <img src="img/topico.png">
                <h3>Servidor</h3>
            </div>

            <?php
                $res = $db->Get("SELECT * FROM Forum.Postagens WHERE Categoria='DENUNCIAS' AND Aprovado = '1' ORDER BY ID DESC");
				print '<div class="conteudo-topico">
                        <div class="categoria">
                            <img src="img/logo2.png">
                            <div class="descricao">
                                <h4><a href="index.php?page=denuncias">Denuncias</a></h4>
                                <p>Denuncie jogadores que violaram regras</p>
                            </div>
                        </div>';
                if ($res->num_rows > 0){
                    $row = $res->fetch_object();
					$res2 = $db->Get("SELECT * FROM Forum.Login WHERE Username = '".$row->autor."'");
					$row2 = $res2->fetch_object();
						print '<div class="postagem">
                            <a class="profilelink" href="index.php?page=profile&id='.$row2->id.'"><img src="data:'.$row2->avatar.';base64,'.$row2->avatar.'" title="Ir para o perfil de '.$row->autor.'"></a>
                            <div class="author">
                                <h5><a href="index.php?page=postagem&id='.$row->id.'">'.$row->titulo.'</a></h5>
                                <p>Por <a href="index.php?page=profile&id='.$row2->id.'" title="Ir para o perfil de '.$row->autor.'">'.$row->autor.'</a>, <a title="'.date('d/m/Y H:i', strtotime($row->data)).'">'.ucfirst(utf8_encode(strftime('%B %d', strtotime($row->data)))).'</a></p>
                            </div>
                        </div>';
				}
				print '</div>';
				
				$res = $db->Get("SELECT * FROM Forum.Postagens WHERE Categoria='BUGS' AND Aprovado = '1' ORDER BY ID DESC");
				print '<div class="conteudo-topico">
                        <div class="categoria">
                            <img src="img/logo2.png">
                            <div class="descricao">
                                <h4><a href="index.php?page=bugs">Bugs & Problemas</a></h4>
                                <p>Reporte erros encontrados</p>
                            </div>
                        </div>';
                if ($res->num_rows > 0){
                    $row = $res->fetch_object();
					$res2 = $db->Get("SELECT * FROM Forum.Login WHERE Username = '".$row->autor."'");
					$row2 = $res2->fetch_object();
						print '<div class="postagem">
                            <a class="profilelink" href="index.php?page=profile&id='.$row2->id.'"><img src="data:'.$row2->avatartype.';base64,'.$row2->avatar.'" title="Ir para o perfil de '.$row->autor.'"></a>
                            <div class="author">
                                <h5><a href="index.php?page=postagem&id='.$row->id.'">'.$row->titulo.'</a></h5>
                                <p>Por <a href="index.php?page=profile&id='.$row2->id.'" title="Ir para o perfil de '.$row->autor.'">'.$row->autor.'</a>, <a title="'.date('d/m/Y H:i', strtotime($row->data)).'">'.ucfirst(utf8_encode(strftime('%B %d', strtotime($row->data)))).'</a></p>
                            </div>
                        </div>';
				}
				print '</div>';

                $res = $db->Get("SELECT * FROM Forum.Postagens WHERE Categoria='SUGESTOES'");
				print '<div class="conteudo-topico">
                        <div class="categoria">
                            <img src="img/logo2.png">
                            <div class="descricao">
                                <h4><a href="index.php?page=sugestoes">Sugestoes</a></h4>
                                <p>Envie sugestoes para melhor o nosso servidor</p>
                            </div>
                        </div>';
                if ($res->num_rows > 0){
                    $row = $res->fetch_object();
					$res2 = $db->Get("SELECT * FROM Forum.Login WHERE Username = '".$row->autor."'");
					$row2 = $res2->fetch_object();
                        print '<div class="postagem">
                            <a class="profilelink" href="index.php?page=profile&id='.$row2->id.'"><img src="data:'.$row2->avatartype.';base64,'.$row2->avatar.'" title="Ir para o perfil de '.$row->autor.'"></a>
                            <div class="author">
                                <h5><a href="index.php?page=postagem&id='.$row->id.'">'.$row->titulo.'</a></h5>
                                <p>Por <a href="index.php?page=profile&id='.$row2->id.'" title="Ir para o perfil de '.$row->autor.'">'.$row->autor.'</a>, <a title="'.date('d/m/Y H:i', strtotime($row->data)).'">'.ucfirst(utf8_encode(strftime('%B %d', strtotime($row->data)))).'</a></p>
                            </div>
                        </div>';
				}
				print '</div>';
            ?>
        </div>
    </nav>

    <aside>
        <div class="topico">
                <div class="titulo">
                    <img src="img/archive.png">
                    <h3>Ultimas Postagens</h3>
                </div>

                <?php
					$res = $db->Get("SELECT * FROM cr_dados.Players WHERE Username = '".$user."'");
					$row = $res->fetch_object();
					
					$res2 = $db->Get(($row->STAFF == 3 ? "SELECT * FROM Forum.Postagens ORDER BY ID DESC" : "SELECT * FROM Forum.Postagens WHERE Aprovado = '1' ORDER BY ID DESC"));
                    if ($res2->num_rows > 0){
                        $id = 0;
                        while ($row2 = $res2->fetch_object()){
							$res3 = $db->Get("SELECT * FROM Forum.Login WHERE Username = '".$row2->autor."'");
							$row3 = $res3->fetch_object();
                            print '<div class="conteudo-topico" '.($row2->aprovado == 0 ? 'id="aprovar"' : '').'>
                                <div class="categoria">
                                    <a href="index.php?page=profile&id='.$row3->id.'"><img src="data:'.$row3->avatartype.';base64,'.$row3->avatar.'" title="Ir para o perfil de '.$row2->autor.'"></a>
                                    <div class="descricao">
                                        <h4>'.($row2->aprovado == 0 ? '<img src="img/aviso.png" title="Aguardando Aprovação!">' : '').'<a href="index.php?page=postagem&id='.$row2->id.'">'.$row2->titulo.'</a></h4>
                                        <p>Por <a href="index.php?page=profile&id='.$row3->id.'" title="Ir para o perfil de '.$row2->autor.'">'.$row2->autor.'</a><br>Criado <a title="'.date('d/m/Y H:i', strtotime($row2->data)).'">'.ucfirst(utf8_encode(strftime('%B %d', strtotime($row2->data)))).'</a></p>
                                    </div>
                                </div>
                            </div>';
                            $id = $id + 1;
                            if ($id >= 5) break;
                        }
                    }
                ?>
            </div>
    </aside>
</div>