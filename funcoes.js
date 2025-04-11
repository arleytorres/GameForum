function seguir(profile, username){
    var botao = document.getElementById("seguir");

    if (botao.innerText == "Seguindo") 
        botao.innerText = "+Seguir";
    else 
        botao.innerText = "Seguindo";
    AjaxSender(JSON.stringify({ func: "seguir", perfil: profile, usuario: username }));
}

function like(user, postid, commentid){
    var botao = commentid == -1 ? document.getElementById("img_like") : document.getElementById("img_like" + commentid);
    var count = commentid == -1 ? document.getElementById("span_like") : document.getElementById("span_like" + commentid);

    if (count.style.color == "rgb(255, 36, 0)"){
        count.innerHTML =  Number(count.innerHTML) - 1;
        count.style.color = "#aaaaaa";
        botao.setAttribute("style", "-webkit-filter:sepia(100%) grayscale(100%)");
    }else{
        count.innerHTML =  Number(count.innerHTML) + 1;
        count.style.color = "#ff2400";
        botao.setAttribute("style", "-webkit-filter:sepia(0%) grayscale(0%)");
    }

    if (commentid == -1 || commentid == "-1")
        AjaxSender(JSON.stringify({ func: "likepost", post: postid, usuario: user }));
    else
        AjaxSender(JSON.stringify({ func: "likecomment", post: postid, comment: commentid, usuario: user }));
}

function AjaxSender(corpo) {
    fetch("AjaxFunctions.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: corpo
    })
    .then(response => response.text())
    .then(text => {
        let data;
        try{
            data = JSON.parse(text);
            if (data.redirect) {
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 800);
            }
            else if (data.error) {
                console.log("ERROR:", data.error);
            }
            else
            {
                console.log("Servidor respondeu: ", text);
            }
        }
        catch{}
    })
    .catch(error => console.error("Erro:", error));
}