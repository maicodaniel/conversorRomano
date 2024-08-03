<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumeroTipo extends Model
{

    use HasFactory;


    public string $ante1;
    public string $ante;
    public string $baseNumber;


    public function getNumber($numero, $tipo )
    {


//        dd([$numero, $tipo]);
        switch ($tipo) {
            case 'C':
                $ante ='D';
                $ante1 ='M';
                break;
            case 'X':
                $ante ='L';
                $ante1 ='C';
                break;
            case 'I':
                $ante ='V';
                $ante1 ='X';
                break;

            default:
                echo "";
        }

        $data['tipo'] = $tipo;
        $data['ante'] = $ante;
        $data['ante1'] = $ante1;
        return $data;
    }


    public function getRomano(){


    }


}
