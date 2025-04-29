const apiBaseUrl = 'http://localhost/2025API/amigocanino/api/animais/';

// Carregar animais
async function carregarAnimais() {
    try {
        const resposta = await fetch(apiBaseUrl + 'listar_animais.php');
        const animais = await resposta.json();

        const lista = document.getElementById('lista-animais');
        if (lista) {
            lista.innerHTML = '';

            animais.forEach(animal => {
                const div = document.createElement('div');
                div.classList.add('animal');

                const imagem = document.createElement('img');
                imagem.src = `imagens/${animal.foto}`;
                imagem.alt = animal.nome;
                div.appendChild(imagem);

                const nome = document.createElement('h2');
                nome.textContent = animal.nome;
                div.appendChild(nome);

                const detalhes = document.createElement('p');
                detalhes.innerHTML = `
                    <strong>Idade:</strong> ${animal.idade} anos<br>
                    <strong>Raça:</strong> ${animal.raca}<br>
                    <strong>Porte:</strong> ${animal.porte}<br>
                    <strong>Saúde:</strong> ${animal.saude}
                `;
                div.appendChild(detalhes);

                const botaoAdotar = document.createElement('button');
                botaoAdotar.classList.add('botao-adotar');
                botaoAdotar.textContent = 'Adotar';
                div.appendChild(botaoAdotar);

                lista.appendChild(div);
            });
        }
    } catch (erro) {
        console.error('Erro ao carregar animais:', erro);
    }
}

// Cadastrar novo animal
const formCadastro = document.getElementById('form-cadastro');
if (formCadastro) {
    formCadastro.addEventListener('submit', async (e) => {
        e.preventDefault();

        const animal = {
            nome: document.getElementById('nome').value,
            idade: document.getElementById('idade').value,
            raca: document.getElementById('raca').value,
            porte: document.getElementById('porte').value,
            saude: document.getElementById('saude').value,
            foto: document.getElementById('foto').value
        };

        try {
            const resposta = await fetch(apiBaseUrl + 'cadastrar_animal.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(animal)
            });

            const resultado = await resposta.json();
            alert(resultado.mensagem);

            if (resultado.mensagem.includes('sucesso')) {
                window.location.href = 'index.html';
            }
        } catch (erro) {
            console.error('Erro ao cadastrar animal:', erro);
        }
    });
}

// Se for a página de listagem
if (document.getElementById('lista-animais')) {
    carregarAnimais();
}
