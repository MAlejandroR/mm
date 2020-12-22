<?php


class Plantilla
{


    public static function mostrarFormularioJugada():string
    {
        $colores = Constantes::COLORES;
        $selectores = ""; //quitamos el warning inicializanso
        for ($n = 0; $n < 4; $n++) {
            $selectores .= "\n<select onchange='cambia_color($n)' name='combinacion$n' id='combinacion$n'>\n";
            foreach ($colores as $color) {
                $selectores .= "<option class ='$color' value='$color'>$color</option>\n";
            }
            $selectores .= "</select>\n";
        }
        return $selectores;
    }

    public static function mostrarClave(array $arrayColores): string
    {
        $htmlClave = "<div class='jugada'>";
        foreach ($arrayColores as $color)
            $htmlClave .= "<span class='Color  $color'>$color</span>";
        $htmlClave .= "</div >";
        return $htmlClave;

    }

    /**
     * @param array $jugada
     * @return string
     * Tengo todas las jugadas en la variable de sesión
     * La última que tenga es la actual
     */
    public static function mostrarJugadas(): string
    {
        //Obtenemos las jugadas de la variable de sesión
        //Muy importante tener claro que tenemos un array indexado de jugadas serializadas


        $jugadas = self::obtenerJugadas();

        $numeroJugadaActual = sizeof($jugadas);

        $coloresActual = $jugadas[0]->getColoresAcertados();
        $posicionesActual = $jugadas[0]->getPosicionesAcertadas();

        //Anotaciones de la jugada actual
        $htmlJugadas = "<h3>Jugada actual $numeroJugadaActual </h3>";

        $htmlJugadas .= "<h3>Resultado : $coloresActual Colores y $posicionesActual posiciones </h3>";

        //Anotaciones de todas las jugadas
        foreach ($jugadas as $numeroJugada => $jugada) {
            $jugada = Constantes::implicitoJugada($jugada);
            $htmlJugadas .= "<div class='jugada'><h3 class=titulo>Jugada $numeroJugada   </h3>\n";
            for ($n = 0; $n < $jugada->getPosicionesAcertadas(); $n++)
                $htmlJugadas .= "<span class='negro'>$n</span>\n";
            for ($n = $jugada->getPosicionesAcertadas(); $n < $jugada->getColoresAcertados(); $n++)
                $htmlJugadas .= "<span class='blanco'>$n</span>\n";
            foreach ($jugada->get_jugada() as $color)
                $htmlJugadas .= "<span class='Color_small  $color'>$color[0]</span>\n";
            $htmlJugadas .= "</div>\n\n";
        }

//
        return $htmlJugadas;
    }

    /**
     * @param array $jugadas
     * @return array
     */
    private static function obtenerJugadas(): array
    {
        $jugadasSerializadas = $_SESSION['jugadas'];
        foreach ($jugadasSerializadas as $jugadaSerializada) {
            $jugadas[] = unserialize($jugadaSerializada);
        }
        $jugadas =array_reverse($jugadas);
        return $jugadas;
    }

    public static function mostrarTodasJugadas(){
        $jugadas = $this->obtenerJugadas();
        foreach ($jugadas as $numJugada => $jugada) {
            $colores = $jugada->
            $msj.="<br /><br /><h2>Valor de la jugada $numJugada :</h2><br />" . mostrar_clave($_SESSION['jugadas'][$i]) . "<br />";
        }

    }


}