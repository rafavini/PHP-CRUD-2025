<?php

class MenuComponent {
    public static function render() {
        ?>
        <nav>
            <ul>
                <li><a href="<?php BASE_URL?>home">Início</a></li>
                <li><a href="<?php BASE_URL?>produtos">Produtos</a></li>

                <?php if (checkRole(Roles::ADM)): ?>
                    <li><a href="<?php BASE_URL?>cadastro">Gerenciar Usuários</a></li>
                    <li><a href="<?php BASE_URL?>config">Configurações</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php
    }
}
