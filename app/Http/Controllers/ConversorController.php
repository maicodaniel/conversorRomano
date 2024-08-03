<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NumeroTipo;

class ConversorController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Conversor.index');
    }

    public function teste(Request $request)
    {

        $real = $request->numero;
        $romano = '';
        $milhar = 0;

        if ($real > 999999){
            $converter = $this->realRomanoMilhao($real);

            $romano = $converter[0];
            $milhar = $converter[1];
        }elseif($real > 3999){
            $converter = $this->realRomanoMilharA($real);

            $romano = $converter[0];
            $milhar = $converter[1];
        }else{
            $converter = $this->realRomanoMilhar($real);
            $romano = $converter;

        }

        $data['status'] = true;
        $data['romano'] = $romano;
        $data['milhar'] = $milhar;

        return $data;


    }


    public function realRomanoMilhar($real)
    {
        $nRom = '';
        $milhar = intdiv($real, 1000);
        if ($milhar > 0){
            for ($i = 1; $i <= $milhar; $i++) {
                $nRom = $nRom.'M';
            }
        }

        $realMod = ($real % 1000);
        $centena = $this->realRomanoCentena($realMod,$nRom);


        $numero = intdiv($real, 1000);



        return $centena;
    }

    public function realRomanoCentena($real,$romano)
    {

        $nRom = $romano;
        $centena = intdiv($real, 100);
        if ($centena > 0){
            $ajuste =  $this->ajusteNumeral($centena, 'C');
            $nRom  = $nRom.$ajuste;
        }

        $realMod = ($real % 100);
        $dezena = $this->realRomanoDezena($realMod,$nRom);

        $numero = intdiv($real, 1000);

        return $dezena;
    }

    public function realRomanoDezena($real,$romano)
    {

        $nRom = $romano;
        $dezena = intdiv($real, 10);
        if ($dezena > 0){

            $ajuste =  $this->ajusteNumeral($dezena, 'X');
            $nRom  = $nRom.$ajuste;
        }

        $realMod = ($real % 10);
        $unidade = $this->realRomanoUnidade($realMod,$nRom);
        $numero = intdiv($real, 1);

        return $unidade;
    }

    public function realRomanoUnidade($real,$romano)
    {

        $nRom = $romano;
        $unidade = intdiv($real, 1);
        if ($unidade > 0){

            $ajuste =  $this->ajusteNumeral($unidade, 'I');
            $nRom  = $nRom.$ajuste;
        }


        $numero = intdiv($real, 1000);

        return $nRom;
    }


    public function realRomanoMilharA($real)
    {
        $nRom = '';
        $milhar = intdiv($real, 1000);



        $centena = $this->realRomanoCentena($milhar,$nRom);

        $numero = intdiv($real, 1000);
        
        $cStrings = mb_strlen(trim($centena));
        $realMod = ($real % 1000);
        $centena = $centena.'+';
        $centena2 = $this->realRomanoCentena($realMod,$centena);

        return [$centena2, $cStrings];
    }

    public function realRomanoMilhao($real)
    {
        $nRom = '';
        $milhao = intdiv($real, 1000000);


        if ($milhao > 0){
            for ($i = 1; $i <= $milhao; $i++) {
                $nRom = $nRom.'M';
            }
        }

        $milhar =  ($real % 1000000);;

        $mil = intdiv($milhar, 1000);

        $centena = $this->realRomanoCentena($mil,$nRom);

        $numero = intdiv($real, 1000);


        $cStrings = mb_strlen(trim($centena));
        $realMod = ($real % 1000);
        $centena = $centena.'+';
        $centena2 = $this->realRomanoCentena($realMod,$centena);


        return [$centena2, $cStrings];
    }


    public function ajusteNumeral($numero, $tipo)
    {

        $numeral = new NumeroTipo();
        $restr = $numeral->getNumber($numero, $tipo);

        $ante = $restr['ante'];
        $ante1 = $restr['ante1'];


        switch ($numero) {
            case 1:
                $base = $tipo;
                break;
            case 2:
                $base = $tipo.$tipo;
                break;
            case 3:
                $base = $tipo.$tipo.$tipo;
                break;
            case 4:
                $base = $tipo.$ante;
                break;
            case 5:
                $base = $ante;
                break;
            case 6:
                $base = $ante.$tipo;
                break;
            case 7:
                $base = $ante.$tipo.$tipo;
                break;
            case 8:
                $base = $ante.$tipo.$tipo.$tipo;
                break;
            case 9:
                $base = $tipo.$ante1;
                break;

            default:
                echo "";
        }

        return $base;
    }

}
