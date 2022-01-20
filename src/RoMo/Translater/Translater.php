<?php

declare(strict_types=1);

namespace RoMo\Translater;

use pocketmine\plugin\Plugin;

class Translater{

    /** @var array */
    protected array $data;

    public function __construct(Plugin $plugin, string $resourceDirectory, string $dataDirectory, string $language, bool $isDev = false){
        $resourcePath = $resourceDirectory . "resources/messages";
        $dataPath = $dataDirectory . "messages/";

        if(/*!mkdir($dataPath) && */!is_dir($dataPath)){
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dataPath));
        }
        $dir = opendir($resourcePath);

        while(($read = readdir($dir))){
            if($read !== "." && $read !== ".."){
                if(!file_exists($dataPath . "/" . $read) || $isDev){
                $messageFile = $resourcePath . "/" . $read;
                copy($messageFile, $dataPath . "/" . $read);
                }
            }
        }

        $this->data = parse_ini_file($dataPath . $language . ".ini", false);
    }

    public function getPrefix() : string{
        if(!isset($this->data["prefix"])){
            return "prefix ";
        }
        return (string) $this->data["prefix"];
    }

    public function getTranslate(string $id, array $parameters = []) : string{
        if(!isset($this->data[$id])){
            return $id;
        }
        $str = $this->data[$id];

        $count = 1;
        foreach($parameters as $parameter){
            $str = str_replace("&{$count}", (string) $parameter, $str);
            $count++;
        }

        return $str;
    }

    public function getMessage($id, array $parameters = []) : string{
        return $this->getPrefix() . $this->getTranslate($id, $parameters);
    }

    public function getCmd($id) : commandTranslate{
        $commandId = "command.$id";

        $commandName = $this->data[$commandId . ".name"] ?? $id;
        $commandDescription = $this->data[$commandId . ".description"] ?? $id;
        $commandUsageMessage = $this->data[$commandId . ".usageMessage"] ?? $id;

        $aliases = [];

        $count = 1;

        while(isset($this->data[($commandid_count = $commandId . ".aliases.$count")])){
            $aliases[] = $this->data[$commandid_count];
            $count++;
        }

        return new commandTranslate($commandName, $commandDescription, $commandUsageMessage, $aliases);
    }
}