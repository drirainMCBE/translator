<?php

declare(strict_types=1);

namespace RoMo\Translator;

use pocketmine\plugin\Plugin;

class Translator{

    /** @var array */
    protected array $data;

    public function __construct(Plugin $plugin, string $resourceDirectory, string $dataDirectory, string $language, bool $isDev = false){
        $resourcePath = $resourceDirectory . "resources/messages";
        $dataPath = $dataDirectory . "messages/";

        if(!is_dir($dataPath)){
            mkdir($dataPath);
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

        //파라미터 로드
        $parameters = [];
        $count = 1;
        while(isset($this->data[($commandIdCount = $commandId . ".parameter." . $count)])){
            $name = $this->data[$commandIdCount];
            $type = $this->data[$commandIdCount . ".type"] ?? "";
            $options = [];
            $optionCount = 1;
            while(isset($this->data[($commandIdOptionCount = $commandIdCount . ".option." . $optionCount)])){
                $options[] = $this->data[$commandIdOptionCount];
                $optionCount++;
            }
            $parameters[$count] = new CommandParameterTranslate($name, $type, $options);
            $count++;
        }

        //사용법 로드
        $usages = [];
        $count = 1;
        while(isset($this->data[($commandIdCount = $commandId . ".usageMessage." . $count)])){
            $usages[$count] = $this->data[$commandIdCount];
            $count++;
        }

        //별명 로드
        $aliases = [];
        $count = 1;
        while(isset($this->data[($commandIdCount = $commandId . ".aliases." . $count)])){
            $aliases[] = $this->data[$commandIdCount];
            $count++;
        }

        return new CommandTranslate($commandName, $parameters, $commandDescription, $usages, $aliases);
    }
}
