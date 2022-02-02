<?php

declare(strict_types=1);

namespace RoMo\Translator;

class CommandTranslate{

    /** @var string */
    private string $name;
    private string $description;

    /** @var CommandParameterTranslate[] */
    private array $parameters;

    /** @var string[] */
    private array $usages;
    private array $aliases;

    public function __construct(string $name, array $parameters, string $description, array $usages, array $aliases){
        $this->name = $name;
        var_dump($parameters);
        $this->parameters = $parameters;
        $this->description = $description;
        $this->usages = $usages;
        $this->aliases = $aliases;
    }

    /**
     * @return string
     */
    public function getName() : string{
        return $this->name;
    }

    /**
     * @return CommandParameterTranslate[]
     */
    public function getAllParameters() : array{
        return $this->parameters;
    }

    /**
     * @param int $id
     * @return CommandParameterTranslate
     */
    public function getParameter(int $id) : CommandParameterTranslate{
        if(!isset($this->parameters[$id])){
            return new CommandParameterTranslate("command." . $this->getName() . ".parameter." . $id, "", []);
        }
        return $this->parameters[$id];
    }

    /**
     * @return string
     */
    public function getDescription() : string{
        return $this->description;
    }

    /**
     * @return array
     */
    public function getUsages() : array{
        return $this->usages;
    }

    /**
     * @return array
     */
    public function getAliases() : array{
        return $this->aliases;
    }
}