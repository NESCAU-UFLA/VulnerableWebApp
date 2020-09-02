<?php
include_once("../persistence/PostagemDAO.php");
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
        <div class="post-container" style="height: 250px;">
            <?php
            $mensagens = (new PostagemDAO())->recuperarTodos();
            $ehPar = true;
            $color = "";
            foreach ($mensagens as $msg) {
                if ($ehPar)
                    $color = "lightgrey";
                else
                    $color = "white";
                $ehPar = !$ehPar;
                echo '<div class="post-content" style="background-color: '.$color.'">';
                echo '['.$msg[3].'] <a target="_blank" href="perfil.php?user='.$msg[6].'">'.$msg[7].'</a> escreveu:<br/>'.$msg[2];
                echo '</div>';
            }
            ?>
        </div>
        <div style="margin-top: 30px;">
            <form method="POST" action="../controller/postagem.php">
                <input type="hidden" name="Postagem" value="Inserir" />
                <textarea name="Mensagem" placeholder="Escreva aqui ..." style="height: 70px;" required ></textarea><br/><br/>
                <button type="submit">Enviar</button>
            </form>
        </div>
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