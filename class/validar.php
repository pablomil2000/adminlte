<?php

class Validar
{
    static public function vlt_String_pre($str)
    {
        if ($str != '') {
            $str = trim(htmlspecialchars(filter_var($str, FILTER_SANITIZE_STRING)));
            return $str;
        }
        return false;
    }

    static public function vlt_String($str)
    {
        if ($str != '') {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $str)) {
                return Validar::vlt_String_pre($str);
            }
        }
        return false;
    }

    static public function vlt_String_eng($str)
    {
        if ($str != '') {
            if (preg_match('/^[a-zA-Z0-9 ]+$/', $str)) {
                return Validar::vlt_String_pre($str);
            }
        }
        return false;
    }


    static public function vlt_Email($str)
    {
        if ($str != '') {
            $str = trim(htmlspecialchars(filter_var($str, FILTER_SANITIZE_EMAIL)));
            return $str;
        }
        return false;
    }

    static public function vlt_Int($int)
    {
        if (preg_match('/^[0-9]*$/', $int)) {
            if ($int != '') {
                return $int;
            }
        }
        return false;
    }
}
