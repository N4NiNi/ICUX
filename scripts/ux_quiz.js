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
    const resultsuxtool = Array.from(document.getElementsByClassName("uxtool-heading-place"));
    const backgrounddiv = document.getElementById("backgroundID");
    const backgroundresult = document.getElementById("uxtoolbg");
    
    //const desc_choices = Array.from(document.getElementsByClassName("desc-choice-txt"));
    const progressText = document.getElementById("progress-text");
    const progressBar = document.getElementById("progressbar-fg");
    const restartGameBtn = document.getElementById("restart-game-btn");
    const timelinediv = document.getElementById("timeline");
    const labeldiv = document.getElementById("label-timeline");

    const answer_qtd = [document.getElementById("0"), document.getElementById("1"), document.getElementById("2"), document.getElementById("3"), document.getElementById("4")];
    const icons_qtd = [document.getElementById("i-0"), document.getElementById("i-1"), document.getElementById("i-2"), document.getElementById("i-3"), document.getElementById("i-4")];
    const col_qtd = [document.getElementById("col1"), document.getElementById("col2"), document.getElementById("col3"), document.getElementById("col4"), document.getElementById("col5")];
    // declaring consts for Results DOM Objects
    const resultsDiv = document.getElementById("results-div");
    const resultsuxtool_ = document.getElementById("uxtool-heading-place");
    //const resultsImage = document.getElementById("results-image");
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
    let labells = Array.from(document.getElementsByClassName("labelc"));
    let contlabel = 1;
    



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

    function particle(creation_tick,start,end,duration,lifespan,velocity){
        this.creation_tick = creation_tick,
        this.start = start,
        this.age = 0;
        this.end = end,
        this.duration = duration,
        this.lifespan = lifespan,
        this.velocity = velocity,
        this.appearance_params = {
          scale: [2.0,0],
          opacity: [1,0]
        }
      }
      
      const particle_container = document.getElementById("particle_container");
      var particles = [];
      var tick = 0;
      
      
      var start_timestamp, previous_timestamp;
      function doParticles(TS){
        if(start_timestamp === undefined){
          start_timestamp = TS;
        }
        const elapsed = TS - previous_timestamp;
      
        // if(tick % 1 === 0){
        if(previous_timestamp !== TS){
          particle_container.innerHTML = "";
          
          particles.forEach(function(p, i){
            if(p.age < p.lifespan){
              drawParticle(lerp(p.start, p.end, (p.age / p.lifespan)), (p.age / p.lifespan), p.appearance_params);
              p.age += p.velocity * (elapsed * 0.05);
            }
            
            if(tick > p.creation_tick + p.lifespan){
              particles.splice(i,1);
            }
          });
        }
        
        previous_timestamp = TS;
        tick++;
        window.requestAnimationFrame(doParticles);
      }
      window.requestAnimationFrame(doParticles);
      
      
      function createEmitter() {
        var max_particles = 100;
        var max_distance = 300;
        var fixed_position = [45, 30];
        var fixed_position2 = [50, 30];
        var fixed_position3 = [55, 30];
        var fixed_position4 = [60, 30]; // Coordenadas fixas (x, y)
        
        for (let i = 0; i < max_particles; i++) {
          createParticle(fixed_position, max_distance);
          createParticle(fixed_position2, max_distance);
          createParticle(fixed_position3, max_distance);
          createParticle(fixed_position4, max_distance);
        }
      }
      
      function createParticle(start, max_distance){
        var creation_tick = tick;
        var ofs = [start[0],start[1]];
        var end = polarToCartesian((Math.random() * 360), (Math.random() * max_distance), ofs);
        var duration = 100;
        var lifespan = 100;
        var velocity = 0.3;
        
        var part = new particle(creation_tick,start,end,duration,lifespan,velocity);
        particles.push(part);
      }
      
      function drawParticle(pos, age, appearance_params){
        //var fragment_node = document.createDocumentFragment();
        var node = document.createElement("div");
        node.style.left = pos[0] + "%";
        node.style.top = pos[1] + "%";
        var transform_properties = ["translate", "translateX", "translateY", "scale", "scaleX", "scaleY", "scaleZ", "rotate", "rotateX", "rotateY", "rotateZ"];
        Object.keys(appearance_params).forEach(function(k){
          if(transform_properties.includes(k)){
            node.style.transform = k + "(" + lerp([appearance_params[k][0]], [appearance_params[k][1]], age) + ")";
          }else{
            node.style[k] = lerp([appearance_params[k][0]], [appearance_params[k][1]], age);
          }
        });
        
        particle_container.appendChild(node);
      }
      
      function polarToCartesian(angle, length, offset){
        var output = [offset[0],offset[1]];
        var rad = degToRad(angle);
        output[0] += length * Math.cos(rad);
        output[1] += length * Math.sin(rad);
        return output;
      }
      function degToRad(deg){
        return deg * (Math.PI / 180);
      }
      
      function lerp(P, Q, t){
        var output = [];
        if(t < 0){t = 0;}
        if(t > 1){t = 1;}
        
        var i = 0;
        while(i < P.length){
          output.push(P[i] + (t * (Q[i] - P[i])));
          i++;
        }
        return output;
      }
      
      function changeColour(c){
        document.getElementById("particle_container").style.color = (c.includes("#") ? c : "#" + c);
      }
      

    // capturing user name
    username = document.getElementById("name-input");

    if (username.value === "") {
        // alert if no username entered
        alert(`Insira seu nome!`);
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
    function lightenColor(color, factor) {
        // Converte a cor hexadecimal para RGB
        const hexToRgb = (hex) => {
            const bigint = parseInt(hex.slice(1), 16);
            const r = (bigint >> 16) & 255;
            const g = (bigint >> 8) & 255;
            const b = bigint & 255;
            return [r, g, b];
        };
    
        // Converte RGB para hexadecimal
        const rgbToHex = (rgb) => {
            return `#${((1 << 24) + (rgb[0] << 16) + (rgb[1] << 8) + rgb[2]).toString(16).slice(1)}`;
        };
    
        // Calcula a nova cor clareada
        const startColor = hexToRgb(color);
        const endColor = hexToRgb("#1d3ede"); // Cor final (escuro)
        const newColor = startColor.map((channel, i) => {
            const diff = endColor[i] - channel;
            return Math.round(channel + diff * factor);
        });
    
        return rgbToHex(newColor);
    }
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
                col_qtd[answer_qtd.length - i - 1].classList.toggle("hidden");
                answer_qtd[answer_qtd.length - i - 1].classList.toggle("hidden");
                
                
            }
        }

        for(let i=0; i< answers.length; i++){
            if (i == answers.length - 1 && answers.length % 2 != 0) {
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
        let cumprimento;
        const agora = new Date();
        const hora = agora.getHours();

        if (hora > 6 && hora < 12) {
            cumprimento = "Bom dia, " + username.value + ".";
        } else if (hora > 12 && hora < 18) {
            cumprimento = "Boa tarde, " + username.value + ".";
        } else {
            cumprimento = "Boa noite, " + username.value + ".";
        }

        for (let i = 0; i < questionText.length; i++) {
            if (current_Question.questionNumber == 1) {
                questionText[i].innerText = cumprimento + " " + current_Question.questionText;
            } else {
                questionText[i].innerText = current_Question.questionText;
            }
        }


        if(currentQuestion.questionNumber == 1 || currentQuestion.questionNumber == 2 || currentQuestion.questionNumber == 5 || currentQuestion.questionNumber == 13){
            for (let i = 0; i < choices.length; i++) {
                choices[i].classList.remove("squarecard", "circlecard", "rombuscard", "hexacard");
                choices[i].classList.remove("gr-1", "gr-2", "gr-3", "gr-4");
                choices[i].classList.remove("grb-1", "grb-2", "grb-3", "grb-4", "grb-5", "grb-6");
                choices[i].classList.remove("grg-1", "grg-2", "grg-3", "grg-4", "grg-5", "grg-6");
                choices[i].classList.remove("gry-1", "gry-2", "gry-3", "gry-4", "gry-5", "gry-6");
                choices[i].classList.remove("grp-1", "grp-2", "grp-3", "grp-4", "grp-5", "grp-6");
                icons_qtd[i].classList.remove("fa-lightbulb-o", "fa-user", "fa-code-fork", "fa-desktop");
            }
        }

        if(currentQuestion.questionNumber == 1){
            
            choices[0].classList.add("gr-1","squarecard");
            choices[1].classList.add("gr-2","circlecard");
            choices[2].classList.add("gr-3","rombuscard");
            choices[3].classList.add("gr-4","hexacard");



            icons_qtd[0].classList.add("fa-lightbulb-o");
            icons_qtd[1].classList.add("fa-user");
            icons_qtd[2].classList.add("fa-code-fork");
            icons_qtd[3].classList.add("fa-desktop");
            
        }

        if(currentQuestion.questionNumber == 2){
            for (let i = 0; i < choices.length; i++) {
                choices[i].classList.add("squarecard");
                icons_qtd[i].classList.add("fa-lightbulb-o");
            }
            choices[0].classList.add("grb-1");
            choices[1].classList.add("grb-2");
            choices[2].classList.add("grb-3");
            choices[3].classList.add("grb-4");
            choices[4].classList.add("grb-5");
        }

        if(currentQuestion.questionNumber == 5){
            for (let i = 0; i < choices.length; i++) {
                choices[i].classList.add("gr-2","circlecard");
                icons_qtd[i].classList.add("fa-user");
            }
            choices[0].classList.add("grg-1");
            choices[1].classList.add("grg-2");
            choices[2].classList.add("grg-3");
            choices[3].classList.add("grg-4");
            choices[4].classList.add("grg-5");
        }

        if(currentQuestion.questionNumber == 3){
            for (let i = 0; i < choices.length; i++) {
                choices[i].classList.add("gr-3","rombuscard");
                icons_qtd[i].classList.remove("fa-lightbulb-o");
                icons_qtd[i].classList.add("fa-code-fork");
            }
            choices[0].classList.add("grp-1");
            choices[1].classList.add("grp-2");
            choices[2].classList.add("grp-3");
            choices[3].classList.add("grp-4");
            choices[4].classList.add("grp-5");
        }

        if(currentQuestion.questionNumber == 13){
            for (let i = 0; i < choices.length; i++) {
                choices[i].classList.add("gr-4","hexacard");
                icons_qtd[i].classList.add("fa-desktop");
            }
            choices[0].classList.add("gry-1");
            choices[1].classList.add("gry-2");
            choices[2].classList.add("gry-3");
            choices[3].classList.add("gry-4");
            choices[4].classList.add("gry-5");
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
                circletime.id = "circle-" + contlabel;
                circletime.setAttribute('onmouseover', 'changeTextLine()');
                circletime.setAttribute('onmouseout', 'originalText2()');
                circletime.setAttribute('data-currentquestion', currentQuestion.questionNumber);
                circletime.appendChild(icontime);

                timelinediv.insertBefore(circletime, timelinediv.firstChild);

                //labels
                let labeltime = document.createElement('div');
                let icontime2 = document.createElement('p');

                icontime2.innerText = currentQuestion.labelTxt;
                icontime2.classList.add('labeltimetxt');


                labeltime.className = "labelc";
                labeltime.id = "labelc-" + contlabel;
                labeltime.appendChild(icontime2);
                labeldiv.insertBefore(labeltime,labeldiv.firstChild);
                contlabel++;

            }
            timelinecount++; 
            circles = Array.from(document.getElementsByClassName("circle"));
            labells = Array.from(document.getElementsByClassName("labelc"));
            
            backAnswer();
            //console.log(circles);
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
                // Remover todos os círculos acima do círculo clicado
                for(let i = 0; i < index; i++) {
                    if(circles[i].id != 'circle-0'){
                    circles[i].remove();
                    labells[i].remove();
                    }
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

                        

                        tool_match(currentQuestion.answers[target.id].ferramenta, target.lastElementChild.lastElementChild);
                        



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
            return "imgs/helper_question.png";
        }
        if(emotion === "Alegria"){
            return "imgs/helper_happy.png";
        }
        if(emotion === "Levantando"){
            return "imgs/helper_congrats.png";
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
            reacao = verifyemotion("Duvida");
            mascote.src = reacao;
        }
    };
    window.originalText2 = function() {
        
        var circles_out = document.querySelectorAll('.circle');
        circles_out.forEach(function(circle, i) {
            circle.onmouseout = function() {
                for(let i=0; i<questionText.length;i++){
                    questionText[i].innerText = currentQuestion.questionText;
                    reacao = verifyemotion("Duvida");
                    mascote.src = reacao;
                }
                var id_out = circle.id;
                //console.log(id_out);
                // Cortando os primeiros sete caracteres
                var numero_out = id_out.slice(7);
                var labepp_out = document.querySelector('#labelc-' + numero_out);
                labepp_out.style.visibility = 'hidden';
                labepp_out.style.opacity = '0';
            };
        });
    }

    window.changeTextLine = function() {
        // Seleciona todos os elementos com a classe 'circle'
        var circles = document.querySelectorAll('.circle');
    
        // Itera sobre cada elemento
        circles.forEach(function(circle, i) {
            // Adiciona o evento 'onmouseover'
            circle.onmouseover = function() {
                // Verifica o valor de 'data-currentquestion'
                var curQuestion = circle.getAttribute('data-currentquestion');
    
                for(let i=0; i<questionText.length;i++){
                    if (curQuestion == 1) {
                        questionText[i].innerText = "Aqui vai ser armazenado toda sua jornada, esse é o ponto inicial!";
                        reacao = verifyemotion("Alegria");
                        mascote.src = reacao;
                    } else if (curQuestion > 1) {
                        questionText[i].innerText = "Caso não tenha gostado do caminho que seguiu, você pode clicar em um desses círculos para voltar nas perguntas anteriores!";
                        reacao = verifyemotion("Levantando");
                        mascote.src = reacao;
                    }
                }
                // Atualiza o texto do elemento <p> com base no valor de 'data-currentquestion'
                var id = circle.id;

                // Cortando os primeiros sete caracteres
                var numero = id.slice(7)
                var labepp = document.querySelector('#labelc-' + numero);
                labepp.style.visibility = 'visible';
                labepp.style.opacity = '1';
                
            };
        });
    };
    

    // Calculates user personality & reveals results
    function tool_match(id, icon) {
            // Reveals results
            let index;
            let index2;

            index2 = 0;
            index = findUXIndexById(id);
            /*if(id.length > 1){
                index_2 = findUXIndexById(id[1]);
            }*/
            showLoading(function() {
                if(icon.className.includes('fa-lightbulb-o')){
                    backgrounddiv.classList.remove("background-div2");
                    backgrounddiv.classList.add("background-result-blue");

                    backgroundresult.classList.remove("uxtool-infoc-div");
                    backgroundresult.classList.add("background-info-blue");

                    changeColour('1DD5EC');
                    
                }
                if(icon.className.includes('fa-user')){
                    backgrounddiv.classList.remove("background-div2");
                    backgrounddiv.classList.add("background-result-green");

                    backgroundresult.classList.remove("uxtool-infoc-div");
                    backgroundresult.classList.add("background-info-green");
                    
                    changeColour('409933');
                }
                if(icon.className.includes('fa-code-fork')){
                    backgrounddiv.classList.remove("background-div2");
                    backgrounddiv.classList.add("background-result-purple");

                    backgroundresult.classList.remove("uxtool-infoc-div");
                    backgroundresult.classList.add("background-info-purple");
                    changeColour('993399');
                    
                }
                if(icon.className.includes('fa-desktop')){
                    backgrounddiv.classList.remove("background-div2");
                    backgrounddiv.classList.add("background-result-gold");

                    backgroundresult.classList.remove("uxtool-infoc-div");
                    backgroundresult.classList.add("background-info-gold");

                    changeColour('DAA520');
                    
                }
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
        //changeColour('1DD5EC');
        createEmitter();


        // start again game button - reload page
        startAgainBtn.addEventListener('click', function () {
            window.location.reload();
        });

    }

    // Helper Functions for showResults()

    // populates the uxtool results
    function populateUXTOOL(UxToolIndex) {
        //buscar ferramenta com o id
        for(const c of resultsuxtool){
            c.innerText = `${uxtool[UxToolIndex].name}!`;
        }
        
        //resultsImage.src = `${uxtool[UxToolIndex].image}`;
        //resultsImage.alt = uxtool[UxToolIndex].alt;
        resultsTextP1.innerHTML = uxtool[UxToolIndex].desc;
        resultsExec.innerHTML = uxtool[UxToolIndex].exec;


        uxtool[UxToolIndex].text_profissionais.forEach(item => {
            let p = document.createElement('p');
            p.id = 'uxtool-about-text';
            let a = document.createElement('a');
            a.href = item.Link;
            a.target = '_blank';
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
            card.style.width = "15rem";

            let img_card = document.createElement('img');
            img_card.className = 'card-img-top';
            img_card.src = item.image;
            img_card.style.height = '200px';

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