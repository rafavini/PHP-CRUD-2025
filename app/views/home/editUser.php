<h1>Editando</h1>

<form action="<?php echo BASE_URL . 'api/editUser/' . $user['id']; ?>" method="POST">
    <input type="text" name="username" placeholder="insira o nome" value="<?php echo $user["username"]?>">
    <input type="password" name="password" placeholder="insira a senha" value="<?php echo $user["password"]?>">
    <input type="text" name="email" placeholder="insira o email" value="<?php echo $user["email"]?>">

    <label for="adm">Adm</label>
    <input type="radio" id="adm" value="1" name="role" <?= $user['role'] == 1 ? 'checked' : '' ?>>

    <label for="normal">Normal</label>
    <input type="radio" id="normal" value="2" name="role" <?= $user['role'] == 2 ? 'checked' : '' ?>>
    
<button type="submit">Salvar</button>
</form> 