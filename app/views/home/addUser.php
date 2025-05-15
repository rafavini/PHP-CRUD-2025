<h1>cadastro</h1>

<form action="<?php BASE_URL?>api/addUser" method="POST">
    <input type="text" name="username" placeholder="insira o nome">
    <input type="password" name="password" placeholder="insira a senha">
    <input type="text" name="email" placeholder="insira o email">

    <label for="">Adm</label>
    <input type="radio" id="role" value="1" name="role">
    <label for="">Normal</label>
    <input type="radio" id="role" value="2" name="role">
    
<button type="submit">Criar</button>
</form> 