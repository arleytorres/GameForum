<div class="conteudo" id="novopost">
	<?php
		$pagina = strtolower(addslashes(trim($_GET['id'])));
		print '<div class="cabecalho">
					<h2><img src="img/world.png"><a href="index.php">Inicio</a> > <a href="index.php?page='.$pagina.'">'.ucfirst($pagina).'</a> > <a>Criar</a></h2>	
				</div>
		
		<div class="ads">
			<img src="img/adversiment.gif" alt="adversiment">
		</div>
		
		<div class="menu">
			<form method="POST" action="index.php?page=atividade">
				<input type="hidden" name="acao" value="criarpost">
				<input type="hidden" name="categoria" value="'.$pagina.'">
				<label for="titulo">Titulo <warning>OBRIGATÓRIO</warning></label>
				<input type="text" name="titulo">
				<label for="conteudo">Conteúdo <warning>OBRIGATÓRIO</warning></label>
				<textarea row="10" col="5" maxlength="10000" class="conteudo" name="conteudo"></textarea>
				<input type="submit" value="ENVIAR">
			</form>
		</div>';
	?>
</div>