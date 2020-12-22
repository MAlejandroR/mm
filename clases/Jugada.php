<?php


class Jugada
{

    private $jugada = [];
    private $posicionesAcertadas=0;
    private $coloresAcertados=0;

    public function __construct(){
        for ($n = 0; $n < 4; $n++) {
            $this->jugada[] = $_POST["combinacion" . $n];
        }
        $this->coloresAcertados=0;
        $this->posicionesAcertadas=0;
    }

    public function comparaJugada($clave){
        foreach ($this->jugada  as $posicion=>$color) {
            if ($color == $clave[$posicion])
                $this->posicionesAcertadas++;
        }
        //quitamos duplicados
        $jugada = array_unique($this->jugada);
        foreach ($jugada as $color)
        if (in_array($color, $clave))
            $this->coloresAcertados++;
    }

    public function get_jugada(){
        return $this->jugada;
    }

    /**
     * @return int
     */
    public function getPosicionesAcertadas(): int
    {
        return $this->posicionesAcertadas;
    }

    /**
     * @return int
     */
    public function getColoresAcertados(): int
    {
        return $this->coloresAcertados;
    }
    public function getColoresJugada(): int
    {
        $msj = "";
        foreach ($this->jugada as $color)
            $msj .= "<div class='Color $color'>$color</div>";
        return $msj;
    }



}