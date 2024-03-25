<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RutChileno implements Rule
{
    public function passes($attribute, $value)
    {
        $value = strval($value); // Convertir $value a un string
        $value = strtoupper(preg_replace('/\.|,|-/', '', $value));
        $value = str_replace(' ', '', $value);
        $rut = substr($value, 0, -1);
        $dv = substr($value, -1);
        $factor = 2;
        $suma = 0;
        for ($i = strlen($rut) - 1; $i >= 0; $i--) {
            $factor = $factor > 7 ? 2 : $factor;
            if (is_numeric($rut[$i])) {
                $suma += $rut[$i] * $factor++;
            }
        }        $mod = $suma % 11;
        $dvCalc = $mod == 1 ? 'K' : ($mod == 0 ? 0 : 11 - $mod);
        return $dv == $dvCalc;
    
    }
    public function message()
    {
        return 'El :attribute no es un RUT chileno válido.';
    }
}