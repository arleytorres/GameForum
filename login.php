<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | COP&ROBBER</title>
    <link rel="shortcut icon" type="x-icon" href="img/logo2.png">
    <link rel="stylesheet" href="style/login.css">
	<link rel="stylesheet" href="style/responsivo.css">
</head>
<body>
    <div class="main">
        <div class="esquerda">
            <h1>Em Desenvolvimento!</h1>
            <img src="desenvolvimento.svg" alt="desenvolvimento">
        </div>
        <div class="direita">
            <div class="painel">
                <h2>LOGIN</h2>
                <form method="POST" action="index.php?page=atividade">
                    <input type="hidden" name="acao" value="logar">
                    
                    <div class="textfield">
                        <label for="usuario">Usuário</label>
                        <input type="text" name="usuario" placeholder="Usuário">
                    </div>
                    <div class="textfield">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" placeholder="Senha">
                    </div>
                    <input type="submit" name="btn-login" value="Entrar">
                </form>
				
				<div class="botao">
					<button onclick="CreateConta()">Criar nova conta</button>
				</div>
            </div>
        </div>
    </div>

    <script>
        function CreateConta(){
            location.href='criarConta.php';
        }
    </script>
</body>