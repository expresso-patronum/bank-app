
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Baloo+2:wght@500&display=swap');

* {
    font-family: 'Baloo 2', cursive;
}
body{
    background-image: url('folhas2.jpg');
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    position: relative;
}

div{
    background-color: rgb(204,211,211);
    width: 25%;
    border-radius: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin:auto;
    margin-top: 6%;
}
form{
 
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

input{
    margin-bottom: 15%;
   margin-top: 15%;
   padding: 2%;
   margin-left:10%;
   margin-right: 10%;
}

button{
    margin-bottom: 15%;
    margin-top: 15%;
    margin-left:10%;
   margin-right: 10%;
   background-color: rgb(32,105,92);
   color: #FFFF;
   width: 100%;
   height: 60px;
   border: none;
   border-radius: 10px;
}

</style>

</head>
<body>
<div>    
    
<form method='post' action='/logar'>
<h1>Login</h1>
<input placeholder="Username" name="username" id="username" type="text"/>
<input placeholder="Senha" name="senha" id="senha" type="password"/>
<button type="submit">Logar</button>
Não tem uma conta? <a href="/cadastro">Cadastre-se</a>
<br>
</form>
</div>
<?php


?>    
</body>
</html>
