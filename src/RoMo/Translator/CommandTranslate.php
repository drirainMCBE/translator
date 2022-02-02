<?php

declare(strict_types=1);

namespace RoMo\Translator;

class CommandTranslate{

    /** @var string */
    private string $name;
    private string $description;
    private string $usage;

    /** @var array */
    private array $aliases;

    public function __construct(string $name, string $description, string $usage, array $aliases){
        $this->name = $name;
        $this->description = $description;
        $this->usage = $usage;
        $this->aliases = $aliases;
    }

    /**
     * @return string
     */
    public function getName() : string{
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription() : string{
        return $this->description;
    }

    /**
     * @return string
     */
    public function getUsage() : string{
        return $this->usage;
    }

    /**
     * @return array
     */
    public function getAliases() : array{
        return $this->aliases;
    }
}