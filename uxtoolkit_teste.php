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
</head>
<body>
<header id="header" class="fixed-top">
        <nav class="navbar navbar-expand-lg navbar-dark ">
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
    <div id="background-div">
        <div class="flex-center" id="logo-div"><img src="assets/images/quiz_logo_01.svg" alt="The Travel Personality Quiz"></div>

        <!-- Welcome -->
        <div class="text-centre" id="welcome-div">
            <h1 class="small-heading heading-font">UX TOOLKIT!</h1>
            <p>Olá, tudo bem meu nome é XXXX e vou te ajudar a escolher a melhor ferramenta para o seu trabalho!
                <br><br>Farei algumas perguntas e com isso irei te direcionar para melhor ferramenta!
                <br><br>Aperte em iniciar!
            </p>
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
            <div class="" id="progress-div">
                <p id="progress-text"></p>
                <div class="progressbar" id="progressbar-fg"></div>
                <div class="progressbar" id="progressbar-bg"></div>
            </div>

            <div class="" id="answer-div-hide">
                <h2 class="weight-500 body-font" id="question-text">Question</h2>
                <div id="answer-div">
                    <button id="0" class="btn-choice weight-500 flex-center">Answer 1</button>
                    <button id="1" class="btn-choice weight-500 flex-center">Answer 2</button>
                    <button id="2" class="btn-choice weight-500 flex-center">Answer 3</button>
                    <button id="3" class="btn-choice weight-500 flex-center">Answer 4</button>
                    <button id="4" class="btn-choice weight-500 flex-center">Answer 5</button>
                </div>
            </div>
            <div class="hidden" id="answer-tie-div-hide">
                <h2 class="weight-600 body-font" id="tie-break-title">Tie Breaker!</h2>
                <p id="tie-break-text">Uh oh! It seems like you have a split personality!<br>Choose the photo that looks
                    most like your kind of holiday...</p>
                <div class="flex-center" id="answer-tie-div">
                    <button class="btn-choice-tie question-photo culture hidden" id="tie-btn1"
                        aria-label="image of girl standing in front of ancient statues" data-type="culture"></button>
                    <button class="btn-choice-tie question-photo foodie hidden" id="tie-btn2"
                        aria-label="image of girl eating tasty food and smiling" data-type="food"></button>
                    <button class="btn-choice-tie question-photo people hidden" id="tie-btn3"
                        aria-label="image of girl standing on a busy city street" data-type="people"></button>
                    <button class="btn-choice-tie question-photo remote hidden" id="tie-btn4"
                        aria-label="image of man standing in an vast empty valley" data-type="remote"></button>
                    <button class="btn-choice-tie question-photo thrill hidden" id="tie-btn5"
                        aria-label="image of man on a tight-rope high in a ravine" data-type="thrill"></button>
                    <button class="btn-choice-tie question-photo wildlife hidden" id="tie-btn6"
                        aria-label="image of man holding out food to a small alpaca" data-type="wildlife"></button>
                </div>
            </div>


            <div class="" id="restart-button-div">
                <button class="btn-game-main" id="restart-game-btn">Restart Quiz</button>
            </div>
        </div>

        <!-- Results -->
        <div class="hidden" id="results-div">
            <!-- Personality Results -->
            <div class="results-container" id="personality-div">
                <h1 class="text-centre uppercase small-heading heading-font" id="personality-heading">Personality Heading</h1>
                <div id="personality-stats-div">
                    <h2 class="text-centre heading-font">YOUR VITAL STATISTICS</h2>
                    <div class="flex-center" id="stats-key-chart-div">

                        <div id="pie-chart">
                            <canvas id="myChart"></canvas>
                        </div>
                        <div class="uppercase">
                            <div class="stat-key-div">
                                <div class="stat-key"></div>
                                <p><span class="stat-type"></span><span
                                        class="stat-percent weight-600">0%</span></p>
                            </div>
                            <div class="stat-key-div">
                                <div class="stat-key"></div>
                                <p><span class="stat-type"></span><span
                                        class="stat-percent weight-600">0%</span></p>
                            </div>
                            <div class="stat-key-div">
                                <div class="stat-key"></div>
                                <p><span class="stat-type"></span><span
                                        class="stat-percent weight-600">0%</span></p>
                            </div>
                            <div class="stat-key-div">
                                <div class="stat-key"></div>
                                <p><span class="stat-type"></span><span
                                        class="stat-percent weight-600">0%</span></p>
                            </div>
                            <div class="stat-key-div">
                                <div class="stat-key"></div>
                                <p><span class="stat-type"></span><span
                                        class="stat-percent weight-600">0%</span></p>
                            </div>
                            <div class="stat-key-div">
                                <div class="stat-key"></div>
                                <p><span class="stat-type"></span><span
                                        class="stat-percent weight-600">0%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                    <div>
                        <p id="personality-text-p1"></p>
                        <br>
                        <p id="personality-text-p2"></p>
                        <br>
                        <p id="personality-text-p3"></p>
                    </div>
                    

            </div>

            <!-- Country Results - General -->
            <div class="results-container" id="country-info-div">
                <div class="text-centre heading-font">
                    <h2 id="country-heading">WE RECOMMEND:</h2>
                    <h3 id="country-heading-place" class="uppercase">Winning Country</h3>
                </div>

                <img src="assets/images/countries/main/nz_main.jpg" id="results-image" alt="Mt Cook and Lake Tekapo, New Zealand">
                <p id="country-text-para1"></p>
                <br>
                <p id="country-text-para2"></p>
            </div>
            <!-- Country Results - Highlights -->
            <div class="results-container" id="country-highlights-div">
                <h2 class="text-centre small-heading heading-font">HIGHLIGHTS</h2>
                <p class="text-centre">Click on a pin to find out more about what <span id="highlight-country-name"></span> has to offer!</p>
                <div class="results-container" id="country-map-div">
                    <div id="map"></div>
                    <div id="highlight-info-div" class="hidden">
                        <div id="highlight-content-div">
                            <h3 class="weight-700 body-font" id="highlight-title">Highlight name</h3>
                            <p id="highlight-text"></p>
                        </div>
                        <div class="flex-center" id="highlight-photo-div">
                            <img class="highlight-photo" id="highlight-photo-1" src="assets/images/countries/highlights/nz_queenstown1.jpeg" alt="Highlight Photo 1">
                            <img class="highlight-photo" id="highlight-photo-2" src="assets/images/countries/highlights/nz_queenstown2.jpeg" alt="Highlight Photo 2">
                            <img class="highlight-photo" id="highlight-photo-3" src="assets/images/countries/highlights/nz_queenstown3.jpeg" alt="Highlight Photo 3">
                            <img class="highlight-photo" id="highlight-photo-4" src="assets/images/countries/highlights/nz_queenstown4.jpeg" alt="Highlight Photo 4">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Restart Game Button -->
            <div class="text-centre" id="start-again-button-div">
                <p class="weight-600">Want to have another go at the quiz?</p>
                <button class="btn-game-main" id="start-again-btn">Start Again</button>
            </div>
        </div>

        <footer class="rodape2">
            <div id="cloud-div">

            </div>
        </footer>
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

    <script src="scripts\perguntas_array.js"></script>
    <script src="scripts\uxtools_array.js"></script>
    <script src="scripts\personalities_array.js"></script>
    <script src="scripts\personalities_array.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBp3bbw0F5d1sjzp5iet_vlxKb0RrevMCA&callback=initMap">
    </script>

    <script src="scripts\ux_quiz.js"></script>


</body>
</html>