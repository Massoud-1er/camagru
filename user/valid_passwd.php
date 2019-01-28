<?php
function is_valid_password($password)
{
    return strlen($password) >= 8 && (
        preg_match('(\pL)u', $password)
        + preg_match('(\pN)u', $password)
        + preg_match('([^\pL\pN])u', $password)
        ) >= 2;
}
?>