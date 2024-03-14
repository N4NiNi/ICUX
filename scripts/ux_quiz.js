// Start Game Button - activates all game functionality
function startGame(event) {

    event.preventDefault();
    $.get("start_session.php", function(data) {
        // Armazenar o ID da sessão
        sessionStorage.setItem("sessionId", data);

        // Resto do código...
    });

    const secm = sessionStorage.getItem('sessionId');


    // declaring consts for Welcome Page DOM Objects
    const welcomeDiv = document.getElementById("welcome-div");

    // declaring consts for Game DOM Objects
    const gameDiv = document.getElementById("game-div");
    const boxDiv = document.getElementById("box-id");
    const mascote = document.getElementById("mascote-img");
    const questionText = Array.from(document.getElementsByClassName("question-text"));
    const choices = Array.from(document.getElementsByClassName("btn-choicex"));
    const choicestxt = Array.from(document.getElementsByClassName("btn-choice-txt"));
    
    //const desc_choices = Array.from(document.getElementsByClassName("desc-choice-txt"));
    const progressText = document.getElementById("progress-text");
    const progressBar = document.getElementById("progressbar-fg");
    const restartGameBtn = document.getElementById("restart-game-btn");
    const timelinediv = document.getElementById("timeline");

    const answer_qtd = [document.getElementById("0"), document.getElementById("1"), document.getElementById("2"), document.getElementById("3"), document.getElementById("4")];
    const icons_qtd = [document.getElementById("i-0"), document.getElementById("i-1"), document.getElementById("i-2"), document.getElementById("i-3"), document.getElementById("i-4")];
    const col_qtd = [document.getElementById("col1"), document.getElementById("col2"), document.getElementById("col3"), document.getElementById("col4"), document.getElementById("col5")];
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
    let iconid = 0;
    let timelinecount = 0;
    let circles = Array.from(document.getElementsByClassName("circle"));
    



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
        boxDiv.classList.toggle("box-div");
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
            col_qtd[i].classList.remove("hidden");
            answer_qtd[i].classList.remove("hidden");
            col_qtd[i].classList.add("col-md-6", "col-lg-6");
            


            
        }

        let qtd_question = answer_qtd.length - answers.length;
        if(answers.length < answer_qtd.length){
            for(let i=0; i < qtd_question; i++){
                console.log(answers.length);
                col_qtd[answer_qtd.length - i - 1].classList.toggle("hidden");
                answer_qtd[answer_qtd.length - i - 1].classList.toggle("hidden");
                console.log(i);
                
                
            }
        }

        for(let i=0; i< answers.length; i++){
            if (i == answers.length - 1 && answers.length % 2 != 0) {
                    console.log("entrei");
                    col_qtd[i].classList.remove("col-md-6", "col-lg-6");
                    col_qtd[i].classList.add("col-md-12", "col-lg-12");
                    boxDiv.style.backgroundPositionY = "-20px";
            }else{
                col_qtd[i].classList.remove("col-md-12", "col-lg-12");
                col_qtd[i].classList.add("col-md-6", "col-lg-6");
            }
            if(answers.length < 5){
                boxDiv.style.backgroundPositionY = "-230px";
            }else{
                boxDiv.style.backgroundPositionY = "-30px";
            }
        }

        
        // populate question
        

        for(let i=0; i < questionText.length; i++){
            questionText[i].innerText = current_Question.questionText;
        }
        // populate answers
        
        for (let i = 0; i < answers.length; i++) {
            //choices[i].innerText = answers[i].answerText;
            choicestxt[i].innerText = answers[i].answerText;
        }
        // set progress bar
        let questionNumber = current_Question.questionNumber;
        //progressText.innerHTML = `Question ${questionNumber} of ${maxQuestions}`;
        //progressBar.style.width = `${questionNumber / maxQuestions * 100}%`;
        if(index != 1){
            if(timelinecount != 0){
                let circletime = document.createElement('div');
                let icontime = document.createElement('i');

                icontime.className = icons_qtd[iconid].className;
                
                circletime.className = "circle";
                circletime.setAttribute('data-currentquestion', currentQuestion.questionNumber);
                circletime.appendChild(icontime);

                timelinediv.insertBefore(circletime, timelinediv.firstChild);
            }
            timelinecount++;
            circles = Array.from(document.getElementsByClassName("circle"));
            
            backAnswer();
            console.log(circles);
            //timelinediv.appendChild(circletime);
        }




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

    function backAnswer(){
        circles.forEach((circle, index) => {
            circle.addEventListener('click', () => {
                let id_question = findQuestionID(circle.dataset.currentquestion);
                currentQuestion = ux_pergunta[id_question];
                addQuestionContent(1);
                setTimeout(scrollToTop, 500);
                console.log(index);
                console.log("---");
                // Remover todos os círculos acima do círculo clicado
                for(let i = 0; i < index; i++) {
                    circles[i].remove();
                }
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
                registerAnswer(secm,currentQuestion.answers[target.id].answerID, currentQuestion.answers[target.id].ferramenta);
                iconid = target.id;
                // Verifique se a pergunta atual tem a propriedade nextques
                setTimeout(function () {
                    if (currentQuestion.answers[target.id].nextques != null) {
                        // Atualiza a pergunta atual com a próxima pergunta
                        let idx = currentQuestion.answers[target.id].nextques - 1;
                        currentQuestion = ux_pergunta[idx];
                        addQuestionContent(0);
                        choice.classList.remove("selected");
                        //enableButtons();
                        
                    } else {
                        // Então ja chegou na resposta
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

    function verifyemotion(emotion){
        if(emotion == "Normal"){
            return "imgs/helper.webp";
        }
        if(emotion === "Duvida"){
            return "imgs/helper.webp";
        }
        if(emotion === "Alegria"){
            return "imgs/helper_happy.png";
        }
        if(emotion === "Levantando"){
            return "imgs/helper.webp";
        }
    }

    window.changeText = function(id) {
        let answers = currentQuestion.answers;
        let reacao;
        for(let i=0; i<questionText.length;i++){
            questionText[i].innerText = answers[id].roboText;
            reacao = verifyemotion(answers[id].reacao);
            mascote.src = reacao;
        }
    }
    
    window.originalText = function() {
        for(let i=0; i<questionText.length;i++){
            questionText[i].innerText = currentQuestion.questionText;
            reacao = verifyemotion("Normal");
            mascote.src = reacao;
        }
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
        boxDiv.classList.toggle("box-div");
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
            if (uxtool[i].id == id_n) {
                return i; // Retorna o índice quando encontra o id
            }
        }
        return -1; // Retorna -1 se o ID não for encontrado
    }

    function findQuestionID(id) {
        let id_n = parseInt(id, 10);
        for (let i = 0; i < ux_pergunta.length; i++) {
            if (ux_pergunta[i].questionNumber == id_n) {
                return i; // Retorna o índice quando encontra o id
            }
        }
        return -1; // Retorna -1 se o ID não for encontrado
    }

    function registerAnswer(sessionId,answerId, uxToolId) {
        $.post("register_answer.php", { session_id: sessionId, answer_id: answerId, ux_tool_id: uxToolId });
    }

    function getTimeline() {
        $.get("get_timeline.php", { session_id: sessionId }, function(data) {
            // Aqui você pode gerar a linha do tempo com os dados recebidos
        });
    }

}