<?php

trait Identificable{
    public function getId(): string{
        return $this->getPrefijoId().random_int(1000,9999);
    }
    abstract protected function getPrefijoId():string;
}