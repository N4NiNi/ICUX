// Start Game Button - activates all game functionality
function startGame(event) {

    // declaring consts for Welcome Page DOM Objects
    const welcomeDiv = document.getElementById("welcome-div");

    // declaring consts for Game DOM Objects
    const gameDiv = document.getElementById("game-div");
    const questionText = document.getElementById("question-text");
    const choices = Array.from(document.getElementsByClassName("btn-choice"));
    const progressText = document.getElementById("progress-text");
    const progressBar = document.getElementById("progressbar-fg");
    const restartGameBtn = document.getElementById("restart-game-btn");

    const answer_qtd = [document.getElementById("0"), document.getElementById("1"), document.getElementById("2"), document.getElementById("3"), document.getElementById("4")];

    // declaring consts for Results DOM Objects
    const resultsDiv = document.getElementById("results-div");
    const resultsuxtool = document.getElementById("uxtool-heading-place");
    const resultsImage = document.getElementById("results-image");
    const resultsTextP1 = document.getElementById("uxtool-text-para1");
    const resultsAboutMore = document.getElementById("about_more");
    const resultsMaterialDiv = document.getElementById("materials-cols");
    const resultsExec = document.getElementById("uxtool-exec-desc");

    const startAgainBtn = document.getElementById("start-again-btn");
    // declaring other variables
    let maxQuestions = 10;
    let username;
    //let currentQuestion_ = question0;
    let currentQuestion = ux_pergunta[0]; 



    // Username submission & Start Quiz Functionality ------------------------------------------ //

    // Handle form submission
    event.preventDefault();

    // Scroll to top of page
    scrollToTop();

    // helper function to move back to the top of the page
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // capturing user name
    username = document.getElementById("name-input");

    if (username.value === "") {
        // alert if no username entered
        alert(`Please enter your name to play, real or imaginary!`);
    } else {
        // starts gameplay
        welcomeDiv.classList.toggle("hidden");
        gameDiv.classList.toggle("hidden");
        addQuestionContent(0);
        handleAnswer();
        // adds restart button - reload page
        restartGameBtn.addEventListener('click', function () {
            window.location.reload();
        });
    }


    // Quiz Functionality --------------------------------------------------------------------- //

    // Populate the questions and answers & move on progress bar
    function addQuestionContent(index) {
        let current_Question = currentQuestion;
        let answers = current_Question.answers;

        for(let i=0; i < answer_qtd.length; i++){
            answer_qtd[i].classList.remove("hidden");
        }

        let qtd_question = answer_qtd.length - answers.length;
        if(answers.length < answer_qtd.length){
            for(let i=0; i < qtd_question; i++){
                answer_qtd[answer_qtd.length - i - 1].classList.toggle("hidden");
            }
        }

        //console.log(currentQuestion);
        
        // populate question
        questionText.innerText = current_Question.questionText;
        // populate answers
        
        for (let i = 0; i < answers.length; i++) {
            choices[i].innerText = answers[i].answerText;
        }
        // set progress bar
        let questionNumber = current_Question.questionNumber;
        //progressText.innerHTML = `Question ${questionNumber} of ${maxQuestions}`;
        //progressBar.style.width = `${questionNumber / maxQuestions * 100}%`;
    }

    // User selects answer
    function handleAnswer() {
        choices.forEach(choice => {
            choice.addEventListener('click', () => {
                selectAndSubmit(choice);
                setTimeout(scrollToTop, 500);
            });
        });
    }


    // Helper functions for handleAnswer

    // Handles answer selection
    // Adapted from https://www.sitepoint.com/community/t/select-one-button-deselect-other-buttons/348053 */
    function selectAndSubmit(target) {
        choices.forEach(choice => {
            // adds a 'selected' class to selected answer & removes from others
            choice.classList.remove("selected");
            if (choice == target) {
                choice.classList.add("selected");
                // Verifique se a pergunta atual tem a propriedade nextques
                setTimeout(function () {
                    console.log(currentQuestion.answers[target.id].nextques);
                    if (currentQuestion.answers[target.id].nextques != null) {
                        // Atualiza a pergunta atual com a próxima pergunta
                        let idx = currentQuestion.answers[target.id].nextques - 1;
                        currentQuestion = ux_pergunta[idx];
                        addQuestionContent(0);
                        choice.classList.remove("selected");
                        enableButtons();
                        
                    } else {
                        // Então ja chegou na resposta
                        console.log(currentQuestion.answers[target.id].ferramenta)
                        tool_match(currentQuestion.answers[target.id].ferramenta)

                    }
                }, 500);
        } else {
            // disable other buttons during timeout (prevent logging duplicate results)
            choice.disabled = true;
        }

        });
    }

    // Helper Functions for selectAndSubmit


    // re-enable the buttons after question answered
    function enableButtons() {
        choices.forEach(choice => {
            choice.disabled = false;
        });
    }

    // Calculates user personality & reveals results
    function tool_match(id) {
            // Reveals results
            let index;
            let index2;

            index2 = 0;
            index = findUXIndexById(id);
            /*if(id.length > 1){
                index_2 = findUXIndexById(id[1]);
            }*/
            showLoading(function() {
                showResults(index); // Chama showResults após o término do carregamento
            });
            //showLoading();
            //showResults(index);
    }

    // Helper functions for findTopPersonality

    // Function to check for number of times an element occurs in an array
    // function adapted from https://linuxhint.com/count-array-element-occurrences-in-javascript/#:~:text=To%20count%20element%20occurrences%20in,%E2%80%9Cfor%2Dof%E2%80%9D%20loop.
    function elementCount(arr, element) {
        return arr.filter((currentElement) => currentElement == element).length;
    }


    // Results Page Functionality ------------------------------------------------------------------------------ //

    // Reveal Results
    function showResults(id) {

        // hide game div & reveal results divs, scroll to top of page
        gameDiv.classList.toggle("hidden");
        resultsDiv.classList.toggle("hidden");
        scrollToTop();
        // popular ferramenta recomendada
        populateUXTOOL(id);


        // start again game button - reload page
        startAgainBtn.addEventListener('click', function () {
            window.location.reload();
        });

    }

    // Helper Functions for showResults()

    // populates the uxtool results
    function populateUXTOOL(UxToolIndex) {
        //buscar ferramenta com o id

        console.log(UxToolIndex);
        resultsuxtool.innerText = `${uxtool[UxToolIndex].name}!`;
        resultsImage.src = `${uxtool[UxToolIndex].image}`;
        resultsImage.alt = uxtool[UxToolIndex].alt;
        resultsTextP1.innerHTML = uxtool[UxToolIndex].desc;
        resultsExec.innerHTML = uxtool[UxToolIndex].exec;


        uxtool[UxToolIndex].text_profissionais.forEach(item => {
            let p = document.createElement('p');
            p.id = 'uxtool-about-text';
            let a = document.createElement('a');
            a.href = item.Link;
            a.textContent = item.Descricao;
            p.appendChild(a);
            resultsAboutMore.appendChild(p);
        });

        uxtool[UxToolIndex].materiais.forEach(item => {
            let cardcol = document.createElement('div');
            cardcol.id = 'card-col';
            cardcol.className = 'col';

            let card = document.createElement('div');
            card.className = 'card';
            card.style.width = "18rem";

            let img_card = document.createElement('img');
            img_card.className = 'card-img-top';
            img_card.src = item.image;

            let card_body = document.createElement('div');
            card_body.className = 'card-body';

            let materialTitle = document.createElement('h5');
            materialTitle.id = 'uxtool-materiais-title';
            materialTitle.className = 'card-title';
            materialTitle.innerText = item.nome_material;
            //criar div com id card-col e class col
                //criar div com class card e style: width: 18 rem;
                    //criar img pegando o caminho do material e class card-img-top
                    //criar div com class card-body
                        //criar h5 com id uxtool-materiais-title e class card-title

            card_body.appendChild(materialTitle);
            card.appendChild(img_card);
            card.appendChild(card_body);
            cardcol.appendChild(card);
            resultsMaterialDiv.appendChild(cardcol);
            
        });



        //resultsTextP2.innerText = uxtool[UxToolIndex].text[1];
    }

    function findUXIndexById(id) {
        let id_n = parseInt(id, 10);
        for (let i = 0; i < uxtool.length; i++) {
            console.log(uxtool[i].id);
            if (uxtool[i].id == id_n) {
                console.log("achei familia");
                return i; // Retorna o índice quando encontra o id
            }
        }
        return -1; // Retorna -1 se o ID não for encontrado
    }

}