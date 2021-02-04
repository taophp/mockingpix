<?php
namespace Taophp;

class Config
{
    protected $configuration = [];

    public function loadPhpConfFile($configurationFile)
    {
        $defaultConf = [];
        $defaultConfigurationFile = substr($configurationFile,-3).'.default.php';

        if (\is_readable($defaultConfigurationFile)) {
            $defaultConf = include $defaultConfigurationFile;
        }
        if (\is_readable($configurationFile)) {
            $configuration = include $configurationFile;
        }
        if (!empty($defaultConf)) {
            $this->configuration = $defaultConf;
            foreach ($configuration as $k => $v) {
                $this->configuration[$k] = $v;
            }
        }else{
            $this->configuration = $configuration;
        }
    }

    public function get($key)
    {
        return array_key_exists($key,$this->configuration) ? $this->configuration[$key] : null;
    }
}