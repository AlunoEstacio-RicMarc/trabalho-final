function condutorMesmo() {
  const mesmo = document.getElementById("opcao1").checked;
  const outro = document.getElementById("opcao2").checked;

  const campo1 = document.getElementById("cpf-condutor");
  const campo2 = document.getElementById("data-nascimento-condutor");
  const campo3 = document.getElementById("estado-civil-condutor");
  const campo4 = document.getElementById("profissao-condutor");

  if (outro) {
      // Habilitar os campos para edição
      campo1.disabled = false;
      campo2.disabled = false;
      campo3.disabled = false;
      campo4.disabled = false;

      // Limpando os valores dos campos para permitir edição manual
      campo1.value = "";
      campo2.value = "";
      campo3.value = "";
      campo4.value = "";
  } else if (mesmo) {
      // Preencher automaticamente os campos com valores do segurado
      const fonte1 = document.getElementById("cpf-segurado").value;
      const fonte2 = document.getElementById("data-nascimento-segurado").value;
      const fonte3 = document.getElementById("estado-civil-segurado").value;
      const fonte4 = document.getElementById("profissao-segurado").value;

      // Atribuindo o conteúdo das fontes aos campos
      campo1.value = fonte1;
      campo2.value = fonte2;
      campo3.value = fonte3;
      campo4.value = fonte4;

      // Desabilitar os campos para edição
      campo1.disabled = true;
      campo2.disabled = true;
      campo3.disabled = true;
      campo4.disabled = true;
  }

}
function formatarCPF(element) {
  element.addEventListener('input', function () {
      let value = this.value;
      value = value.replace(/\D/g, ""); // Remove caracteres não numéricos
      value = value.replace(/(\d{3})(\d)/, "$1.$2"); // Primeiro ponto
      value = value.replace(/(\d{3})(\d)/, "$1.$2"); // Segundo ponto
      value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2"); // Traço
      this.value = value;
  });
}

document.addEventListener('DOMContentLoaded', function () {
  const cpfInputs = document.querySelectorAll('.cpf-format');
  cpfInputs.forEach(input => formatarCPF(input));
});

function formatarCelular(element) {
  element.addEventListener('input', function () {
      let value = this.value;
      value = value.replace(/\D/g, ""); // Remove caracteres não numéricos
      value = value.replace(/^(\d{2})(\d)/, "($1) $2"); // Adiciona parênteses ao DDD
      value = value.replace(/(\d{5})(\d)/, "$1-$2"); // Adiciona o traço
      this.value = value;
  });
}

// Aplicar a formatação em todos os elementos com a classe .celular-format
document.addEventListener('DOMContentLoaded', function () {
  const celularInputs = document.querySelectorAll('.celular-format');
  celularInputs.forEach(input => formatarCelular(input));
});

function formatarAnoModelo(element) {
  element.addEventListener('input', function () {
      let value = this.value;
      value = value.replace(/\D/g, ""); // Remove caracteres não numéricos
      value = value.replace(/(\d{4})(\d)/, "$1/$2"); // Adiciona a barra após os primeiros 4 dígitos
      this.value = value;
  });
}

// Aplicar a formatação em todos os elementos com a classe .anoModelo
document.addEventListener('DOMContentLoaded', function () {
  const anoModeloInputs = document.querySelectorAll('.anoModelo');
  anoModeloInputs.forEach(input => formatarAnoModelo(input));
});

function formatarPlacaVeiculo(element) {
  element.addEventListener('input', function () {
      let value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, ""); // Remove caracteres não permitidos e força maiúsculas

      // Formatação para o padrão antigo (AAA-1234)
      if (value.length <= 7) {
          value = value.replace(/^([A-Z]{3})(\d{1,4})$/, "$1-$2");
      }
      // Formatação para o padrão novo (AAA1A23)
      if (value.length === 7) {
          value = value.replace(/^([A-Z]{3})(\d)([A-Z])(\d{2})$/, "$1$2$3$4");
      }
      this.value = value;
  });
}

// Aplicar a formatação em todos os elementos com a classe .placaVeiculo
document.addEventListener('DOMContentLoaded', function () {
  const placaInputs = document.querySelectorAll('.placaVeiculo');
  placaInputs.forEach(input => formatarPlacaVeiculo(input));
});

function formatarCEP(element) {
  element.addEventListener('input', function () {
      let value = this.value;
      value = value.replace(/\D/g, ""); // Remove caracteres não numéricos
      value = value.replace(/^(\d{5})(\d)/, "$1-$2"); // Adiciona o traço após os primeiros 5 dígitos
      this.value = value;
  });
}

// Aplicar a formatação em todos os elementos com a classe .cepFormat
document.addEventListener('DOMContentLoaded', function () {
  const cepInputs = document.querySelectorAll('.cepFormat');
  cepInputs.forEach(input => formatarCEP(input));
});
