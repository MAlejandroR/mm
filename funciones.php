<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @param array $colores para genarar la clave
 * @return array una clave con 4 colores aleatorios
 */
function genera_clave($colores) {
    $clave = [];
    $pos = array_rand($colores, 4);

    for ($n = 0; $n < 4; $n++) {
        $clave[] = $colores[$pos[$n]];
    }

    return $clave;
}

/**
 *
 * @return  string $clave el contendio de la clave
 * @param  array la clave
 */
function mostrar_clave($clave) {
    foreach ($clave as $color)
        $msj.= "<div class='Color $color'>$color</div>";
    return $msj;
}

/**
 *
 * @param array $colores colores posibles para jugar
 * @return string  código html con el formulario para hacer la jugada
 */
function mostrar_formulario($colores) {
    $formulario = "<form method = 'POST' action = 'jugar.php'>\n";

    for ($i = 0; $i < 4; $i++) {
        $formulario.=<<<FIN
        \t\t<select id = 'combinacion$i' name = 'combinacion$i'  onchange="cambia_color($i)"  \n>
        \t\t\t<option class='Azul' value='Azul'>Ver colores</option>\n
FIN;
        foreach ($colores as $color) {
            $formulario.="\t\t\t\t\t<option class = '$color' value = '$color'>$color</option>\n";
        }
        $formulario.=" \t\t</select>\n";
    }//End for 4 veces
    $formulario.=<<<FIN
         <br />
         <input type = 'submit' name = 'jugar' value = 'Jugar' />
        </form>
FIN;
    return $formulario;
}

function leer_jugada() {
    for ($n = 0; $n <= 3; $n++) {
        $jugada[] = $_POST['combinacion' . $n];
    }
    return $jugada;
}

/**
 *
 * @param array $jugada
 * @param array $clave
 * @return array coincidencia de colores y de posiciones
 */
function compara_jugada($jugada, $clave) {
    $col = 0;
    $pos = 0;

    for ($n = 0; $n < 4; $n++) {
        if ($jugada[$n] == $clave[$n])
            $pos++;
    }

//Quitamos duplicados
    $jugada = array_unique($jugada);
    foreach ($jugada as $color)
        if (in_array($color, $clave))
            $col++;
    $rtdo = ['col' => $col, 'pos' => $pos];
    return $rtdo;
}

/**
 * @return string texto a mostrar la lista de jugadas realizadas
 *
 * PAra mostrarlo en el orden inverso (de la última jugada a la primera), invertimos el array
 * Ver que para que la jugada salga en ese orden he de visualizar la jugada también invertida
 *  de ahí que el for $n accede a los índices realizando esa resta 3-x
 *
 */
function mostrar_resultados() {
    $jugadas = $_SESSION['jugadas'];
    $resultados = $_SESSION['resultados'];
    $jugadas = array_reverse($jugadas);
    $resultados= array_reverse($resultados);
    $num_jugadas = sizeof($jugadas);

    foreach ($jugadas as $index => $jugada) {
        //Los espación del final para dejar un formato forzado (etiqueta <pre>)
        $msj.="<h4><pre>Jugada ".($num_jugadas- $index)."   ";
        $pos = $resultados [$index]['pos'];
        $col = $resultados [$index]['col'];
        //$msj.="<p>  </p>";
        for ($i = 0; $i < $pos; $i++)
            $msj .= "<span class = 'negro'>$i</span>";
        for ($i = 0; $i < ($col - $pos); $i++)
            $msj .= "<span class = 'blanco'>" . ($pos + $i) . "</span> ";

        for ($n = 0; $n < 4; $n++) {
            $color = $jugada[3-$n];
            $letra = $color[0];

            $msj.="<span class='Color_small $color'>$letra</span>";
        }
        $msj.="</pre></h4>";
    }
    return $msj;
}
