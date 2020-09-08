function validarSenha() {
    var senha = $('input[name="Senha"]').val();
    var confirmarSenha = $('input[name="Confirmar"]').val();
    if (senha != confirmarSenha) {
        alert("As senhas devem ser iguais!");
        return false;
    }
    return true;
}

function mostrarFormDados() {
    $('#dados')[0].style.display = 'none';
    $('#resultado')[0].style.display = 'none';
    $('#postagensDoUsuario')[0].style.display = 'none';
    $('#formDados')[0].style.display = 'block';
    $('#formImagem')[0].style.display = 'block';
    $('#formSenha')[0].style.display = 'block';
}

function esconderFormDados() {
    $('#dados')[0].style.display = 'block';
    $('#resultado')[0].style.display = 'block';
    $('#postagensDoUsuario')[0].style.display = 'block';
    $('#formDados')[0].style.display = 'none';
    $('#formImagem')[0].style.display = 'none';
    $('#formSenha')[0].style.display = 'none';
}

function mostrarFormEditarPost() {
    $('#editPostButton')[0].style.display = 'none';
    $('#post-content')[0].style.display = 'none';
    $('#editPostForm')[0].style.display = 'block';
}

function esconderFormEditarPost() {
    $('#editPostButton')[0].style.display = 'inline-block';
    $('#post-content')[0].style.display = 'block';
    $('#editPostForm')[0].style.display = 'none';
}