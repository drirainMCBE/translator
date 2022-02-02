<?php

declare(strict_types=1);

namespace RoMo\Translator;

class CommandParameterTranslate{

    /** @var string */
    private string $name;

    /** @var string */
    private string $type;

    /** @var array */
    private array $values;

    public function __construct(string $name, string $type, array $values){
        $this->name = $name;
        $this->type = $type;
        $this->values = $values;
    }

    /**
     * @return string
     */
    public function getType() : string{
        return $this->type;
    }

    /**
     * @return array
     */
    public function getValues() : array{
        return $this->values;
    }

    /**
     * @return string
     */
    public function getName() : string{
        return $this->name;
    }
}