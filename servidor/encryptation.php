<?php

function encrypt($text, $salt) {
    $text = $salt . $text;
    $hash = hash('sha256', $text);
    return $hash;
}

