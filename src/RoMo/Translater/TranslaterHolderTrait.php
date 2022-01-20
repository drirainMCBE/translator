<?php

declare(strict_types=1);

namespace RoMo\Translater;

trait TranslaterHolderTrait{

    private Translater $translater;

    /**
     * @return Translater
     */
    public function getTranslater() : Translater{
        return $this->translater;
    }

    /**
     * @param Translater $translater
     */
    public function setTranslater(Translater $translater) : void{
        $this->translater = $translater;
    }

}
