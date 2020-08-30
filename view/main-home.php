<?php
    // Se a página for aberta por outra página que não seja a home, voltamos à página inicial
    if (!isset($_SESSION['isChild']))
        header("Location: index.php");
    $user = unserialize($_SESSION['usuario']);
?>
<div style="display: flex;">
    <div class="column shadow-box" style="width: 200px;">
        a
    </div>
    <div class="column shadow-box" style="width: 300px;">
        a
    </div>
    <div class="column shadow-box" style="width: 200px;">
        <div class="user-img" style="margin-top: 10px;">
            <?php echo '<img src="../uploads/'.$user->getFoto().'" />'; ?>
        </div>
        <h3>
            <?php echo "Bem-vindo, ".$user->getNome()."!";?>
        </h3><br/>
        <div>
            <a href="editar-dados.php">
                <button>Ver perfil</button>
            </a><br/><br/>
            <form method="POST" action="../controller/usuario.php">
                <input type="hidden" name="Usuario" value="Logout" />
                <button type="submit">Desconectar</button>
            </form>
        </div>
    </div>
</div>