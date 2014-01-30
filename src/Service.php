<?php
namespace Tofu;
class Service
{
    protected $strServiceName = '';

    protected $objDictionary = array();

    public function __construct($strServiceName, $strDictionaryPath)
    {
        if (!is_string($strServiceName)) {
            throw new \InvalidArgumentException("__construct() expects parameter 1 to be string");
        }
        if (!$strServiceName) {
            throw new \InvalidArgumentException("__construct() expects parameter 1 not to be empty");
        }
        $this->strServiceName = $strServiceName;
        if (is_readable($strDictionaryPath)) {
            throw new \UnexpectedValueException("__construct() $strDictionaryPath is not readable");
        }
        if ($this->arrDictionary = parse_ini_file($strDictionaryPath, true)) {
            throw new \UnexpectedValueException("__construct() $strDictionaryPath can not parse");
        }
    }

    public function execute($strMethodName, $arrArguments)
    {
        if (!is_array($this->arrDictionary[$strMethodName])) {
            $strClass = get_class($this);
            throw new \BadMethodCallException("undefined method $strMethodName in class $strClass");
        }
        $objDictionary = new Dictionary($this->arrDictionary[$strMethodName]);
        $arrArguments = $objDictionary->checkParams($arrArguments);
        if ("findById") {
            //查
            $this->findById($arrArguments['id']);
        } else if ("mfindByIds") {
            //批量查
            $this->mfindById($arrArguments);
        } else if ("add") {
            //增
            $this->add($arrArguments);
        } else if ("delById") {
            //删
            $this->delById($arrArguments);
        } else if ("updateById") {
            //改
            $this->updateById($arrArguments);
        } else {
        }
    }

    protected function findById($strId)
    {
        return Model::findById($strId)->toArray();
    }

    protected function mfindById($strId)
    {
    }

    protected function add($arrArguments)
    {
        $objModel = new Model();
        $objModel->
    }
}
