<?php

#[Attribute(Attribute::TARGET_PROPERTY)]
class Rango
{
    public function __construct(
        public ?float $min = null,
        public ?float $max = null
    ) {}
}