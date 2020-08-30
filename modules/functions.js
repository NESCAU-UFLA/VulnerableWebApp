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
    $('#formDados')[0].style.display = 'block';
    $('#formImagem')[0].style.display = 'block';
    $('#formSenha')[0].style.display = 'block';
}

function esconderFormDados() {
    $('#dados')[0].style.display = 'block';
    $('#formDados')[0].style.display = 'none';
    $('#formImagem')[0].style.display = 'none';
    $('#formSenha')[0].style.display = 'none';
}