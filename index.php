<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resenhando Mangás</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ALFABETO PATH SVG:
        M = moveto (move from one point to another point)
        L = lineto (create a line)
        H = horizontal lineto (create a horizontal line)
        V = vertical lineto (create a vertical line)
        C = curveto (create a curve)
        S = smooth curveto (create a smooth curve)
        Q = quadratic Bézier curve (create a quadratic Bézier curve)
        T = smooth quadratic Bézier curveto (create a smooth quadratic Bézier curve)
        A = elliptical Arc (create a elliptical arc)
        Z = closepath (close the path)

        Números: significam a posição nos eixos x e y
-->

    <div id="base_menu">
        <div id="logo_menu">
            <a href="index.php">
                <!-- logos para mostrar no nav do lado -->
                <img src="./fotos/logo.png" alt="logo Resenhando Mangás" id="logo" style="height: 70px;">
                <img src="./fotos/Resenhando.png" alt="texto resenhando mangás" id="logo2" style="height: 80px; width: 250px;">

                <!-- código para criar o botão X -->
                <button class="ml-auto -mr-2 rounded custom-opacity relative md-btn flex items-center px-3 overflow-hidden accent text rounded-full !px-0 ml-auto -mr-2" style="min-height: 2.5rem; min-width: 2.5rem; background-color: gray;">
                    <span class="flex relative items-center justify-center font-medium select-none w-full pointer-events-none" style="justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="icon" style="color: currentcolor;">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6 6 18M6 6l12 12"></path>
                        </svg>
                    </span>
                </button>
            </a>
        </div>

        <div id="home">
            <a href="index.php" class="link_menu">
                <div>
                    <!-- esse código cria o desenho, se modificar os números do path modifica o desenho fonte: mangadex 
                    isso é tipo o turtle do python... link para saber sobre svg: https://www.w3schools.com/graphics/svg_intro.asp-->

                    <!-- o xmlns é por que svg é um "dialeto" XML. O link depois dele é para o svg ser identificado -->
                    <!-- path é para criar os desenhos usando várias linhas retas ou curvadas -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="feather feather-home icon" viewBox="0 0 24 24" style="color: currentcolor;">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <path d="M9 22V12h6v10"></path>
                    </svg>
                </div>
                <div class="texto_menu">Home</div>
            </a>
        </div>

        <div>
            <div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="icon" style="color: currentcolor;">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 21-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <div class="texto_menu">Menu</div>
                </div>
            </div>

            <a href="./listar.php?objeto=obra" class="link_menu">
                <div>
                    <div>Obras</div>
                </div>
            </a>

            <a href="./listar.php?objeto=resenha" class="link_menu">
                <div>
                    <div>Resenhas</div>
                </div>
            </a>

            <a href="./listar.php?objeto=autor" class="link_menu">
                <div>
                    <div>Autores</div>
                </div>
            </a>

            <a href="./resenhista/index.php" class="link_menu">
                <div>
                    <div>Resenhistas</div>
                </div>
            </a>
        </div>

        <div>
            <div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="feather feather-book-open icon" viewBox="0 0 24 24" style="color: currentcolor;">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2zm20 0h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                    <div class="texto_menu">Mangás</div>
                </div>
            </div>

            <!-- arrumar o href depois do obra -->
            <a href="./obra/index.php" class="link_menu">
                <div>
                    <div>Pesquisar mangás</div>
                </div>
            </a>

            <a href="./obra/index.php" class="link_menu">
                <div>
                    <div>Mangás adicionados</div>
                </div>
            </a>

            <!-- arrumar o href depois quando fizer o php para mostrar os recentes, ou então mudar para mostrar apenas as resenhas, sla -->
            <a href="./resenhista/index.php" class="link_menu">
                <div>
                    <div>Resenhas recentes</div>
                </div>
            </a>
        </div>

        <div>
            <div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="icon" style="color: currentcolor;">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3 21 5-5m-4-4 8 8c3-3 1-5 1-5l6-6h2l-6-6v2l-6 6s-2-2-5 1"></path>
                    </svg>
                    <div class="texto_menu">Desenvolvedores</div>
                </div>
            </div>

            <a href="./devs/about.html" class="link_menu">
                <div>
                    <div>Sobre nós</div>
                </div>
            </a>

            <a href="./devs/contato.html" class="link_menu">
                <div>
                    <div>Contate-nos</div>
                </div>
            </a>

            <a href="./devs/termos.html" class="link_menu">
                <div>
                    <div>Termos</div>
                </div>
            </a>
        </div>
    </div>

<br><br>
    <a href="./login/">Logar</a> <br>
    <a href="./cadastro">Cadastro</a> <br>

    
</body>
</html>