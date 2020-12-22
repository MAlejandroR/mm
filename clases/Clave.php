<?php


class Clave
{


    /**
     * @return array 4 colores diferentes de la lista de colores disponibles
     */
    static private function generaClave(): array
    {
        $clave = [];
        $colores = Constantes::COLORES;
        $pos = array_rand($colores, 4);

        for ($n = 0; $n < 4; $n++) {
            $clave[] = $colores[$pos[$n]];
        }

        return $clave;
    }

    static public function getClave()
    {
        if (isset($_SESSION['clave']))
            return $_SESSION['clave'];
        else {
            return self::generaClave();
        }
    }

    static public function getColoresClave()
    {
        $msj = "";
        foreach (Clave::getClave() as $color)
            $msj .= "<div class='Color $color'>$color</div>";
        return $msj;
    }



}