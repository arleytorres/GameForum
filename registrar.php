<?php
    include("DB.php");
    $db = new DB('localhost', 'root', '');
    $db->Conectar();

    $Usuario = $_GET['User'];
    $Email = $_GET['Email'];
    $Senha = $_GET['Senha'];

    $res = $db->Get("SELECT * FROM Forum.Login WHERE username='".$Usuario."'");
    if ($res->num_rows > 0){
        print 'Este username já está registrado.';
        return;
    }

    $res = $db->Get("SELECT * FROM cr_dados.players WHERE username='".$Usuario."'");
    if ($res->num_rows <= 0){
        print 'Este username não existe no LFS';
        return;
    }

    $res = $db->Get("SELECT * FROM Forum.Login WHERE email = '".$Email."'");
    if ($res->num_rows > 0){
        print 'Este email já está sendo usado.';
        return;
    }

    $json = file_get_contents('configs.json');
    $configs = json_decode($json, true);

    $res = $db->Set("INSERT INTO Forum.Login (username, email, senha, avatar, avatartype, banner, entrada) VALUES('".$Usuario."', '".$Email."', '".$Senha."', '".$configs["defaultavatar"]."', 'image/png', 'N/A', '".date('Y-m-d H:i:s', time())."')");
    if ($res == 1) {
        print 'Conta criada com sucesso!';
        setcookie('Logado', $Usuario, (time() + 3000));
        $_COOKIE['Logado'] = $Usuario;
    }
    else print ':( Algo deu errado';
?>