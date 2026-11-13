<?php
declare(strict_types=1);
namespace Core;


function e(?string $texto):string{
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}