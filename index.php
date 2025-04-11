<?php
include("DB.php");
$db = new DB('localhost', 'root', '');
$db->Conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="img/logo2.png">
    <?php 		
		$titulo = isset($_REQUEST['page']) ? addslashes(trim($_REQUEST['page'])) : 'inicio';
		if (isset($titulo) & $titulo != 'inicio'){
			if ($titulo === 'profile'){
				$res = $db->Get("SELECT Username FROM Forum.Login WHERE ID = '".addslashes(trim($_GET['id']))."'");
				$row = $res->fetch_object();
				print '<title>'.$row->Username.' | COP&ROBBER</title>';
			}else if ($titulo === 'postagem'){
				$res = $db->Get("SELECT Titulo FROM Forum.Postagens WHERE ID = '".addslashes(trim($_GET['id']))."'");
				$row = $res->fetch_object();
				print '<title>'.$row->Titulo.' | COP&ROBBER</title>';
			}else{
				print '<title>'.ucfirst($titulo).' | COP&ROBBER</title>';
			}
		}else{
			print '<title>COP&ROBBER | Live For Speed</title>'; 
		}
	?>
 
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/menutopo.css">
    <link rel="stylesheet" href="style/bans.css">
    <link rel="stylesheet" href="style/download.css">
	<link rel="stylesheet" href="style/configuracoes.css">
    <link rel="stylesheet" href="style/profile.css">
    <link rel="stylesheet" href="style/tops.css">
	<link rel="stylesheet" href="style/categorias.css">
	<link rel="stylesheet" href="style/postagem.css">
	<link rel="stylesheet" href="style/novopost.css">
	<link rel="stylesheet" href="style/responsivo.css">
</head>
<body>
    <?php
        print '<script src="funcoes.js"></script>';
        $user = isset($_COOKIE["Logado"]) ? $_COOKIE["Logado"] : null;
        $request = isset($_REQUEST['page']) ? strtolower(addslashes(trim($_REQUEST['page']))) : null;
        
        if ($request != 'atividade' && $request != 'login' && $request != 'logout'){
            if ($user == null) {
                print "<script>location.href='login.php'</script>";
                goto fim_do_codigo;
            }
            else if ($request == null){
                print "<script>location.href='?page=inicio'</script>";
                goto fim_do_codigo;
            }
        }
        else if ($request == 'logout')
        {
            if ($user != null){
                setcookie('Logado', null, time() - 3600, '/');
                print "<script>location.href='?page=inicio'</script>";
            }
        }
    ?>

    <div class="main">
        <div id="blur"></div>
        <div class="menu-topo">
            <h1><a href="index.php"><img src="img/logo.png" title="COP&ROBBER" alt="Logotipo"></a></h1>
			<input type="checkbox" id="button-menu">
			<label for="button-menu">&#9776;</label>
			
            <p id="letreiro">O melhor servidor de policia e ladrão do Live For Speed!</p>

            <ul>
                <li><a href="index.php?page=inicio">Inicio</a></li>
                <li><a href="index.php?page=bans">Bans</a></li>
                <li><a href="index.php?page=downloads">Downloads</a></li>
                <li><a>Tops</a>
                    <ul>
                        <li><a href="?page=tops&id=1">Capturas</a></li>
                        <li><a href="?page=tops&id=2">Drogas</a></li>
                        <li><a href="?page=tops&id=3">Fugas</a></li>
                        <li><a href="?page=tops&id=4">Nivel</a></li>
                        <li><a href="?page=tops&id=5">Lojas</a></li>
                        <li><a href="?page=tops&id=6">Pontos</a></li>
                    </ul>
                </li>
				<?php
                    if (isset($user))
                    {
                        $res = $db->Get("SELECT * FROM Forum.Login WHERE Username = '".$user."'");
                        $row = $res->fetch_object();
                        print '<li class="MinhaConta"><a><img src="data:'.$row->avatartype.';base64,'.$row->avatar.'">'.$_COOKIE['Logado'].'</a>
                                <ul>
                                    <li><a href="index.php?page=profile&id='.$row->id.'">Minha Conta</a></li>
                                    <li><a href="index.php?page=configs">Configurações</a></li>
                                    <li><a href="index.php?page=logout">Sair</a></li>
                                </ul>
                            </li>';
                    }
				?>
            </ul>
        </div>

        <?php
			setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
			date_default_timezone_set('America/Sao_Paulo');
            switch($request){
                case 'login': include('login.php'); break;
                case 'inicio': include('inicio.php'); break;
                case 'bans': include('bans.php'); break;
                case 'downloads': include('downloads.php'); break;
                case 'configs': include('configuracoes.php'); break;
                case 'tops': include('Tops.php'); break;
                case 'profile': include('profile.php'); break;
                case 'postagem': include('postagem.php'); break;
                case 'criar': include('novopost.php'); break;
                case 'atividade': include('atividade.php'); break;
                
                case 'eventos': include('categorias.php'); break;
                case 'regras': include('categorias.php'); break;
                case 'tutoriais': include('categorias.php'); break;
                case 'denuncias': include('categorias.php'); break;
                case 'bugs': include('categorias.php'); break;
                case 'sugestoes': include('categorias.php'); break;
            }
        ?>
        
        <div class="rodape">
            <div class="esquerda">
                <img src="img/logo.png" alt="logotipo">
            </div>
            <div class="centro">
                <text><img src="img/link.png">LINKS SECUNDÁRIOS</text>
                <ul>
                    <li><a href="https://forum.lfspro.net" title="Ir para o fórum LFSPro" target="_blank">ProStudios</a></li>
                    <li><a href="https://discord.gg/JbHFbdV" title="Ir para o discord Okaru Drift" target="_blank">Okaru Drift</a></li>
                    <li><a href="https://discord.gg/vpY8RbJGgb" title="Ir para o discord Speed Tweak" target="_blank">Speed Tweak</a></li>
                </ul>
            </div>
            <div class="direita">
                <text><img src="img/world.png">COMUNIDADES</text>
                <div class="redes-sociais">
                    <a href="https://discord.gg/A87JPV5JS7" target="_blank" title="Ir para o discord"><img src="img/discord.png"></a>
                    <a href="https://instagram.com/alpharacingoficial" target="_blank" title="Ir para o instagram"><img src="img/instagram.png"></a>
					<a href="https://www.youtube.com/@alpharacing2776" target="_blank" title="Ir para o youtube"><img src="img/youtube.png"></a>
                </div>
            </div>
			<a href="#top" class="topbutton" title="Ir para o topo">^</a>
        </div>
    </div>

    <script type="text/javascript">
        var count = 13;
        setInterval(() => {
            document.getElementById('letreiro').style.fontSize = count + "px";
            if (count > 12){
                count = 12;
            }else{
                count = count + 1;
            }
        }, 2000);
    </script>

    <?php
        fim_do_codigo:
    ?>
</body>
</html>