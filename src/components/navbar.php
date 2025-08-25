<!-- navbar.php -->
<nav class="navbar">
    <ul>
        <li class=""><a href="/home">Home</a></li>
        <li class=""><a href="/sobre">Sobre</a></li>
        <li class=""><a href="/contato">Contato</a></li>
        <li class=""><a href="/blog">Blog</a></li>
        <?php if ($_SESSION["userAuth"]): ?>
            <li class="user">Olá, <?= $_SESSION["userAuth"]["username"] ?></li>
        <?php endif; ?>
    </ul>
</nav>
