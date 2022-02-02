<?php

declare(strict_types=1);

namespace RoMo\Translator;

trait TranslatorHolderTrait{

    private static Translator $translator;

    /**
     * @return Translator
     */
    public static function getTranslator() : translator{
        return self::$translator;
    }

    /**
     * @param translator $translator
     */
    public static function setTranslator(Translator $translator) : void{
        self::$translator = $translator;
    }

}
