<?php
declare(strict_types=1);
namespace Lib;


function e(?string $texto):string{
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}