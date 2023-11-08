<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Quiz de recomendação</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <style>
        body {
  background-color: #f5f5f5;
}

.container {
  width: 500px;
  margin: 0 auto;
}

.row {
  margin-top: 20px;
}

h1 {
  text-align: center;
}

#quiz {
  background-color: white;
  border-radius: 5px;
  padding: 20px;
}

.questao {
  margin-bottom: 10px;
}

.resposta {
  margin-bottom: 10px;
}

.botao {
  background-color: #000;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.botao:hover {
  background-color: #222;
}

    </style>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Quiz de recomendação</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div id="quiz"></div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  <script>
    function gerarPergunta(index) {
        const perguntas = [
            {
            pergunta: "Qual o seu orçamento?",
            respostas: ["Até R$500", "R$500 a R$1.000", "Acima de R$1.000"],
            },
            {
            pergunta: "Qual o seu tipo de uso?",
            respostas: ["Para uso pessoal", "Para trabalho", "Para jogos"],
            },
            {
            pergunta: "Qual o tamanho da tela que você deseja?",
            respostas: ["13 polegadas", "15 polegadas", "17 polegadas"],
            },
        ];

        const pergunta = perguntas[index];

        const html = `
                <div class="questao">
                <h4>${pergunta.pergunta}</h4>
                </div>
                <div class="respostas">
                <span class="math-inline">\{pergunta\.respostas\.map\(\(resposta, i\) \=\> \(
            <button
            type\="button"
            class\="botao"
            value\="</span>{i}"
                    onClick={() => responder(pergunta.respostas[i])}
                    >
                    ${resposta}
                    </button>
                ))}
                </div>
            `;

    return html;
}

function responder(resposta) {
  // Adiciona a resposta à lista de respostas
  respostas.push(resposta);

  // Gera a próxima pergunta
  const proximaPergunta = gerarPergunta(respostas.length - 1);

  // Remove a pergunta atual do DOM
  const perguntaAtual = document.querySelector("#quiz .questao");
  perguntaAtual.remove();

  // Adiciona a próxima pergunta ao DOM
  document.querySelector("#quiz").innerHTML += proximaPergunta;
}

// Inicia o quiz
gerarPergunta(0);


  </script>
</body>
</html>
