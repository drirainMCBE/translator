<?php

declare(strict_types=1);

namespace RoMo\Translator;

trait TranslatorHolderTrait{

    private Translator $translator;

    /**
     * @return Translator
     */
    public function getTranslator() : translator{
        return $this->translator;
    }

    /**
     * @param translator $translator
     */
    public function setTranslator(Translator $translator) : void{
        $this->translator = $translator;
    }

}
