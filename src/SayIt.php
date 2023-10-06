<?php

namespace App;

class SayIt
{
    public function __construct(
        private string $what = "",
    ) {

    }

    public function speak(): void
    {
        echo "{$this->what}!!!!!!";
    }
}
