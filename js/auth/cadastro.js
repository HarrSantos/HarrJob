const formulario = document.querySelector('#cadastroForm');

formulario.addEventListener('submit', function (event) {
    event.preventDefault();

    const dados = new FormData(formulario);

    fetch('../../api/auth/cadastro.php', {
        method: 'POST',
        body: dados
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
            alert(data.mensagem);
            window.location.href = '../vagas/index.php';
        } else {
            alert(data.mensagem);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
    });
});