// Funções de máscara para CPF, Celular e Placa
function mascaraCPF(campo) {
    var cpf = campo.value.replace(/\D/g, '');
    if (cpf.length <= 11) {
        campo.value = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
    }
}

function mascaraCelular(campo) {
    var celular = campo.value.replace(/\D/g, '');
    if (celular.length <= 11) {
        campo.value = celular.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
    }
}

function mascaraPlaca(campo) {
    var placa = campo.value.replace(/\D/g, '');
    if (placa.length <= 7) {
        campo.value = placa.replace(/([A-Z]{3})(\d{1,4})([A-Z]{1})/, '$1-$2$3');
    }
}

function habilitarEdicao() {
    // Habilita todos os campos de input
    var inputs = document.querySelectorAll('input, select');
    inputs.forEach(function(input) {
        input.disabled = false;
    });

    // Mostra o botão de enviar e esconde o botão de editar
    document.getElementById('btn-enviar').style.display = 'block';
    document.getElementById('btn-editar').style.display = 'none';
}

// Confirmação de envio
document.getElementById('form-edit').onsubmit = function(e) {
    e.preventDefault(); // Previne o envio do formulário

    var confirmar = confirm("Você tem certeza que deseja atualizar os dados?");
    if (confirmar) {
        this.submit(); // Envia o formulário caso o usuário confirme
    }
};
