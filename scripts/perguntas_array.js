const createQuestion0 = () => {
    return [{
        questionNumber: 1,
        questionText: "Primeiramente, o que você quer?",
        answers: [{
                answerNumber: 1,
                answerText: "Organizar ideais!",
                answerType: "culture",
                nextques: createQuestion1()
            },
            {
                answerNumber: 2,
                answerText: "Conhecer o usuário",
                answerType: "thrill",
                nextques: createQuestion4()
            },
            {
                answerNumber: 3,
                answerText: "Protótipos e versões",
                answerType: "wildlife",
                nextques: createQuestion2()
            },
            {
                answerNumber: 4,
                answerText: "Navegabilidade ou interface",
                answerType: "people",
                nextques: createQuestion12()
            },
        ]
    },
];
};

const createQuestion1 = () => {
    return [{
        //se ele clicou em organizar ideias
        questionNumber: 2,
        questionText: "Organizar ideias, interessante! O que você procura nisso?",
        answers: [{
                answerNumber: 1,
                answerText: "Descobrir e explorar hipóteses",
                answerType: "wildlife",
                nextques: 0,
                ferramenta: "Matriz CSD"
            },
            {
                answerNumber: 2,
                answerText: "Ferramenta para organizar e categorizar idéias",
                answerType: "people",
                nextques: 0,
                ferramenta: "Mapa de Afinidade"
            },
            {
                answerNumber: 3,
                answerText: "Gerar possíveis soluções reunindo ideias da equipe",
                answerType: "culture",
                nextques: 0,
                ferramenta: "Brainstorm"
            },
        ]
    },
];
};

const createQuestion2 = () => {
    //se ele clicou em protótipos e versões
    return [{
        questionNumber: 3,
        questionText: "Você deseja...",
        answers: [{
                answerNumber: 1,
                answerText: "Testar ou Avaliar um protótipo com usuários reais?",
                answerType: "thrill",
                nextques: createQuestion3()
            },
            {
                answerNumber: 2,
                answerText: "Testar ou Avaliar um protótipo com usuários reais?",
                answerType: "remote",
                nextques: 0,
                ferramenta: "Teste A/B"
            },
        ]
    },
];
};

const createQuestion3 = () => {
    //se ele clicou em protótipos e versões -> testar ou avaliar com usuarios reais
    return [{
        questionNumber: 4,
        questionText: "Certo! Uma última pergunta, você quer...",
        answers: [{
                answerNumber: 1,
                answerText: "Testar um protótipo com usuários?",
                answerType: "food",
                nextques: 0,
                ferramenta: "Teste de usabilidade"
            },
            {
                answerNumber: 2,
                answerText: "Avaliar usuários após eles usarem um produto?",
                answerType: "culture",
                nextques: 0,
                ferramenta: "SUS"
            },
        ]
    },
];
};

const createQuestion4 = () => {
    //Caso ele selecione conhecer o usuário
    return [{
        questionNumber: 5,
        questionText: "Para conhecer o usuário você precisa...",
        answers: [{
                answerNumber: 1,
                answerText: "Entender suas necessidades",
                answerType: "remote",
                nextques: createQuestion5()
            },
            {
                answerNumber: 2,
                answerText: "Entender seu local de trabalho",
                answerType: "wildlife",
                nextques: createQuestion8()
            },
            {
                answerNumber: 3,
                answerText: "Entender como o usuário utiliza o app",
                answerType: "food",
                nextques: createQuestion10()
            },
            {
                answerNumber: 4,
                answerText: "Entender o raciocínio do usuário",
                answerType: "thrill",
                nextques: 0,
                ferramenta: "Card sorting"
            },
        ]
    },
];
};

const createQuestion5 = () => {
    //Conhecer o usuario -> Entender suas necessidades
    return [{
        questionNumber: 6,
        questionText: "Para entender a necessidade do usuário você precisa...",
        answers: [{
                answerNumber: 1,
                answerText: "De muitos usuários",
                answerType: "wildlife",
                nextques: createQuestion6()
            },
            {
                answerNumber: 2,
                answerText: "De Poucos usuários",
                answerType: "people",
                nextques: 0,
                ferramenta: "Entrevista"
            },
            {
                answerNumber: 3,
                answerText: "Determinar um grupo específico",
                answerType: "remote",
                nextques: 0,
                ferramenta: "Segmentação de mercado"
            },
            {
                answerNumber: 4,
                answerText: "Emoções e Sentimentos",
                answerType: "culture",
                nextques: 0,
                ferramenta: "Análise de sentimento"
            },
            {
                answerNumber: 5,
                answerText: "Usar dados disponíveis",
                answerType: "food",
                nextques: 0,
                ferramenta: "Desk research"
            },
        ]
    },
];
};

const createQuestion6 = () => {
    //Conhecer o usuario -> Entender suas necessidades -> Muitos usuarios
    return [{
        questionNumber: 7,
        questionText: "Você vai precisar envolver na pesquisa mais pessoas além do público-alvo?",
        answers: [{
                answerNumber: 1,
                answerText: "Sim",
                answerType: "people",
                nextques: 0,
                ferramenta: "Design participativo"
            },
            {
                answerNumber: 2,
                answerText: "Não",
                answerType: "food",
                nextques: createQuestion7()
            },
        ]
    },
];
};

const createQuestion7 = () => {
    //Conhecer o usuario -> Entender suas necessidades -> Muitos usuarios -> Não
    return [{
        questionNumber: 8,
        questionText: "Pretende, além de coletar, avaliar os dados?",
        answers: [{
                answerNumber: 1,
                answerText: "Sim!",
                answerType: "remote",
                nextques: 0,
                ferramenta: "Survey"
            },
            {
                answerNumber: 2,
                answerText: "Não!",
                answerType: "culture",
                nextques: 0,
                ferramenta: "Questionário"
            },
        ]
    },
];
};

const createQuestion8 = () => {
    //Conhecer o usuario -> Entender seu local de trabalho
    return [{
        questionNumber: 9,
        questionText: "Esse local seria...",
        answers: [{
                answerNumber: 1,
                answerText: "Individual",
                answerType: "culture",
                nextques: 0,
                ferramenta: "Entrevista"
            },
            {
                answerNumber: 2,
                answerText: "Em grupo",
                answerType: "people",
                nextques: 0,
                ferramenta: "Focous group"
            },
            {
                answerNumber: 3,
                answerText: "No próprio local de trabalho",
                answerType: "wildlife",
                nextques: createQuestion9()
            },
        ]
    },
];
};

const createQuestion9 = () => {
    //Conhecer o usuario -> Entender seu local de trabalho -> Local de trabalho
    return [{
        questionNumber: 10,
        questionText: "No local de trabalho você quer...",
        answers: [{
                answerNumber: 1,
                answerText: "Registrar diariamente as atividades do uso",
                answerType: "thrill",
                nextques: 0,
                ferramenta: "Diary Studies"
            },
            {
                answerNumber: 2,
                answerText: "Estudar o meio em que atuam",
                answerType: "food",
                nextques: 0,
                ferramenta: ["Etnografia", "Estudo de campo"]
            },
            {
                answerNumber: 3,
                answerText: "Observar o uso da aplicação",
                answerType: "culture",
                nextques: 0,
                ferramenta: ["Observação", "Investigação Contextual"]
            },
        ]
    },
];
};

const createQuestion10 = () => {
    //Conhecer o usuario -> Entender como usuario usa o app
    return [{
        questionNumber: 11,
        questionText: "Então, você quer...",
        answers: [{
                answerNumber: 1,
                answerText: "Avaliar a estrutura de um site?",
                answerType: "thrill",
                nextques: 0,
                ferramenta: "Teste de árvore"
            },
            {
                answerNumber: 2,
                answerText: "Avaliar uma aplicação que já existe com usuários reais?",
                answerType: "food",
                nextques: createQuestion11()
            },
        ]
    },
];
};

const createQuestion11 = () => {
    //Conhecer o usuario -> Entender como usuario usa o app -> Avaliar uma aplicação que ja existe
    return [{
        questionNumber: 12,
        questionText: "Pretende realizar várias avaliações enquanto melhora o sistema?",
        answers: [{
                answerNumber: 1,
                answerText: "Sim",
                answerType: "thrill",
                nextques: 0,
                ferramenta: "Rite"
            },
            {
                answerNumber: 2,
                answerText: "Não",
                answerType: "food",
                nextques: 0,
                ferramenta: ["Teste de usabilidade", "In-the-moment snippets"]
            },
        ]
    },
];
};

const createQuestion12 = () => {
    //Navegabilidade
    return [{
        questionNumber: 13,
        questionText: "Falando de navegabilidade ou interface, você gostaria de:",
        answers: [{
                answerNumber: 1,
                answerText: "Testar ou avaliar os fluxos da navegação!",
                answerType: "thrill",
                nextques: 0,
                ferramenta: "Percurso cognitivo"
            },
            {
                answerNumber: 2,
                answerText: "Melhorar a navegabilidade de uma aplicação!",
                answerType: "food",
                nextques: 0,
                ferramenta: "Heuristicas de Nielsen"
            },
            {
                answerNumber: 3,
                answerText: "Testar ou avaliar a estrutura de um site!",
                answerType: "culture",
                nextques: 0,
                ferramenta: "Teste de árvore"
            },
        ]
    },
];
};

// Inicialização
const question12 = createQuestion12();
const question11 = createQuestion11();
const question10 = createQuestion10();
const question9 = createQuestion9();
const question8 = createQuestion8();
const question7 = createQuestion7();
const question6 = createQuestion6();
const question5 = createQuestion5();
const question4 = createQuestion4();
const question3 = createQuestion3();
const question2 = createQuestion2();
const question1 = createQuestion1();
const question0 = createQuestion0();

console.log(question0)