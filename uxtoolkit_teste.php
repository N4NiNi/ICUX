<?php
    include('session_destroy.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UX ToolKit</title>
    <script src="https://kit.fontawesome.com/75c900e0d1.js" crossorigin="anonymous"></script>
    <script>history.scrollRestoration = "manual"</script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\estilo.css">
    <link rel="stylesheet" href="styles\style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="styles\dom-particles.css">

        <!-- Hotjar Tracking Code for Site 5010361 (nome ausente) -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:5010361,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
</head>

<body>

<header id="header" class="">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <div class="logo_bloco mr-auto">
                    <img src="imgs\uxLerisLogo.15a026cd.svg" alt="Logo" class="navbar-logo">
                    <div class="texto_logo">
                        <h1 class="titulo_logo">EUXT</h1>
                        <p class="desc_logo">Exploring User eXperience Tools</p>
                    </div>
                </div>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="menu_op nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">UX Toolkit</a>
                    </li>
                </ul>

            </div>
        </nav>
    </header>
    <!-- Background Gradient & Logo -->
    <div id="backgroundID" class="background-div2">
    <div id="box-id" class="">
       
        <div class="text-centre" id="welcome-div">

            <div class="mascote-balao">
                    <div class="questionbox" id="balloon-mobilex">
                        <div speech-bubble pbottom acenter style="--bbColor:#ffffff" id="balloon-mobile">
                            <h2 class="weight-500 body-font title question-text" id="question-text_inicio">Olá! Sou PedrUX. Vou te acompanhar nas escolhas das técnicas e ferramentas mais adequadas para o seu projeto. Que tal começarmos com o seu nome?</h2>
                        </div>
                    </div>
                    <img src="imgs\helper_happy.png" id="mascote-img_inicio">
                    <div class="questionbox" id="ballon-desktopx">
                        <div speech-bubble pleft abottom style="--bbColor:#ffffff" id="ballon-desktop_inicio">
                            <h2 class="weight-500 body-font title question-text" id="question-text_inicio">Olá! Sou PedrUX. Vou te acompanhar nas escolhas das técnicas e ferramentas mais adequadas para o seu projeto. Que tal começarmos com o seu nome?</h2>
                        </div>
                    </div>
            </div>

            <!-- Name Input & Start Game -->
            <div class="text-centre" id="start-button-div">
                <form id="start-form" method="POST" onsubmit="startGame(event)">
                    <input class="text-centre" id="name-input" type="text" placeholder="Como é seu nome?"
                        aria-label="Enter your name" minlength="2" maxlength="10">
                    <input type="submit" class="btn-game-main weight-500" id="start-game-btn" value="Iniciar">
                </form>
            </div>
        </div>

        <!-- Game -->
        
        <div class="text-centre hidden" id="game-div">
            <!--<div class="" id="progress-div">
                <p id="progress-text"></p>
                <div class="progressbar" id="progressbar-fg"></div>
                <div class="progressbar" id="progressbar-bg"></div>
            </div> -->

            <div class="" id="answer-div-hide">

                <div class="mascote-balao">
                    <div class="questionbox" id="balloon-mobilex">
                        <div speech-bubble pbottom acenter style="--bbColor:#ffffff" id="balloon-mobile">
                            <h2 class="weight-500 body-font title question-text" id="question-text">Question</h2>
                        </div>
                    </div>
                    <img src="imgs\helper_question.png" id="mascote-img">
                    <div class="questionbox" id="ballon-desktopx">
                        <div speech-bubble pleft abottom style="--bbColor:#ffffff" id="balloon-desktop">
                            <h2 class="weight-500 body-font title question-text" id="question-text">Question</h2>
                        </div>
                    </div>
                    
                    
                    
                </div>
                <div class="container">
                    <div class="row" id="answer-timeline">
                        <div class="col-auto" id="label-timeline">
                            
                            <div class="labelc" id="labelc-0">
                                <p class="labeltimetxt">Ponto inicial!</p>
                            </div>
                        </div> 
                        <div class="col-auto">
                            <div id="labelPath">Sua jornada:</div>
                            <div id="timeline">
                                <div id="circle-0" onmouseover="changeTextLine()" onmouseout="originalText2()" class="circle" data-currentquestion="1">
                                    <i class="fa fa-flag-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col" id="answer-div">
                            <!--<button id="0" class="btn-choice weight-500 flex-center">Answer 1</button>
                            <button id="1" class="btn-choice weight-500 flex-center">Answer 2</button>
                            <button id="2" class="btn-choice weight-500 flex-center">Answer 3</button>
                            <button id="3" class="btn-choice weight-500 flex-center">Answer 4</button>
                            <button id="4" class="btn-choice weight-500 flex-center">Answer 5</button> -->


                            <div class="container" id="respostas_cont">
                                <div class="row align-middle">
                                    <div id="col1" class="col-md-6 col-lg-6 column" >
                                        <div id="1-mask" class="btn_mask">
                                            <div onmouseover="changeText(0)" onmouseout="originalText()" id="0" class="cardr squarecard gr-1 btn-choicex" >
                                                <div class="txt">
                                                    <h1 class="btn-choice-txt">BRANDING AND CORPORATE DESIGN</h1>
                                                    
                                                </div>
                                                
                                                <div class="ico-card">
                                                    <i id="i-0" class="fa fa-lightbulb-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="col2" class="col-md-6 col-lg-6 column">
                                    <div id="2-mask" class="btn_mask">
                                        <div onmouseover="changeText(1)" onmouseout="originalText()" id="1" class="cardr circlecard gr-2 btn-choicex">
                                            <div class="txt">
                                                <h1 class="btn-choice-txt">BRANDING AND CORPORATE DESIGN</h1>
                                                
                                            </div>
                                            
                                            <div class="ico-card">
                                            <i id="i-1" class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div  id="col3" class="col-md-6 col-lg-6 column positionr">
                                    <div id="3-mask" class="btn_mask">
                                        <div onmouseover="changeText(2)" onmouseout="originalText()" id="2" class="cardr rombuscard gr-3 btn-choicex">
                                            <div class="txt">
                                                <h1 class="btn-choice-txt">BRANDING AND CORPORATE DESIGN</h1>
                                                
                                            </div>
                                            
                                            <div class="ico-card">
                                                <i id="i-2" class="fa fa-code-fork"></i>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div id="col4" class="col-md-6 col-lg-6 column positionl">
                                    <div id="4-mask" class="btn_mask">
                                        <div onmouseover="changeText(3)" onmouseout="originalText()" id="3" class="cardr hexacard gr-4 btn-choicex">
                                            <div class="txt">
                                                <h1 class="btn-choice-txt">BRANDING AND CORPORATE DESIGN</h1>
                                                
                                            </div>
                                            
                                            <div class="ico-card">
                                                <i id="i-3" class="fa fa-desktop"></i>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div id="col5" class="col-md-6 col-lg-6 column">
                                        <div id="5-mask" class="btn_mask">
                                        <div onmouseover="changeText(4)" onmouseout="originalText()" id="4" class="cardr squarecard gr-1 btn-choicex">
                                            <div class="txt">
                                                <h1 class="btn-choice-txt">BRANDING AND CORPORATE DESIGN</h1>
                                            </div>
                                            
                                            <div class="ico-card">
                                                <i id="i-4" class="fa fa-desktop"></i>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="container" id="box_cont">
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="" id="restart-button-div">
                <button class="btn-game-main" id="restart-game-btn">Restart</button>
            </div>
        </div>

        <!-- Results -->
        <div class="hidden" id="results-div">
            <!-- Results -->

            <!-- uxtool Results - General -->
            <div id="uxtoolbg" class="results-container uxtool-info-div uxtool-infoc-div" onload="createEmitter()">
                <div id="particle_container">
                </div>
                <div class="mascote-balao">
                    <div class="questionbox" id="balloon-mobilex">
                        <div speech-bubble pbottom acenter style="--bbColor:#ffffff" id="result-balloon-mobile" class="resultsbubble">
                            <h2 id="uxtool-heading" class="uxtool-heading">A FERRAMENTA QUE VOCÊ PRECISA É:</h2>
                            <h3 id="uxtool-heading-place" class="uppercase uxtool-heading-place">UXTOOL</h3>
                        </div>
                    </div>
                    <img src="imgs\helper_congrats.png" id="mascote-img">
                    <div class="questionbox" id="ballon-desktopx">
                        <div speech-bubble pleft abottom style="--bbColor:#ffffff" class="resultsbubble" id="balloon-desktop">
                            <h2 id="uxtool-heading" class="uxtool-heading">VOCÊ PRECISA DISSO:</h2>
                            <h3 id="uxtool-heading-place" class="uppercase uxtool-heading-place">UXTOOL</h3>
                        </div>
                    </div> 
                </div>
                
                    <div class="container" id="bloco_what_about">
                        <img src="imgs\helper_question.png" id="mascote-img" style="position: relative; left: 80%; margin-bottom: -94px; width: 10rem;">
                        <h3 class="heading-font" id="uxtool-what-title">O QUE É?</h3>    
                        <div class="exec_center">
                                
                                <div id="what_is">
                                    <p id="uxtool-text-para1"></p>
                                </div>
                            </div>

                    </div>

                <div class="container materiais">
                    <div class="row">
                        <div class="col">
                            <h3 class="heading-font" id="uxtool-materiais-title">MATERIAIS UTILIZADOS</h3>
                        </div>
                    </div>

                    
                    <p id="uxtool-materiais-desc">Para realizar a ferramenta/método você vai precisar de:</p>
                    <div class="centraliza">
                    
                        <div id="materials-box">
                            
                            <div id="materials-cols" class="row" style="--bs-gutter-y: 1.5rem;">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div id="execucao">
                    <h3 class="heading-font" id="uxtool-exec-title">COMO APLICAR?</h3>
                    <div class="exec_center">
                        
                        <div id="exec_content">
                            <p id="uxtool-exec-desc"> Reuna um conjunto de usuários que represente o público-alvo do projeto. Entregue a cada um deles material para desenho (papel, canetas, lápis de cor, etc).</p>
                        </div>

                        <img src="imgs\helper_congrats.png" id="mascote-img" style="z-index: 0; position:relative; rotate:90deg; right:-100px; width: 10rem;">

                    </div>

                    
                </div>
                <div class="container" id="aprenda_mais">
                    <h3 class="heading-font uppercase" id="uxtool-about-title">Aprenda mais!</h3>
                    <div class="centraliza">
                        <div id="about_more">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Restart Game Button -->
            <div class="text-centre" id="start-again-button-div">
                <p class="weight-600">Precisa de outra ajuda?</p>
                <button class="btn-game-main" id="start-again-btn">Refazer</button>
            </div>
        </div>

        

        <footer class="rodape2">
            <div id="cloud-div">

            </div>
        </footer>
    </div>
    </div>
    <footer class="rodape">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col">
                        <div class="logo_bloco mr-auto">
                            <img src="imgs\uxLerisLogo.15a026cd.svg" alt="Logo" class="navbar-logo">
                            <div class="texto_logo">
                            <h1 class="titulo_logo">EUXT</h1>
                            <p class="desc_logo">Exploring User eXperience Tools</p>
                        </div>
                        
                    </div>
                    </div>

                    <div class="col">
                    <p class="text-center ">© EUXT 2023 - All Rights Reserved.</p>
                    </div>

                    <div class="col">
                        <p class="text-center">BEETS</p>
                    </div>

                </div>
            </div>
        </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script src="scripts\dom-particles.js" defer></script>
    <script src="scripts\loading.js"></script>
    <script src="scripts\perguntas_array.js"></script>
    <script src="scripts\uxtools_array.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

    <script src="scripts\ux_quiz.js"></script>

    
</body>
<!-- Loading -->

</html>