<?php

namespace App\Libraries\FormValidation\Validations;

class StrLenMaxValidation extends AbstractValidation
{
    private $message = 'O campo %s deve conter no máximo %s caracteres';

    public function validate()
    {
        if(trim($this->value) == ''){
            return;
        }
        
        if (!isset($this->options['size_max'])) {
            throw new \Exception('Informe a quantidade máxima dos caracteres');
        }
        $value = trim($this->value);
        if(mb_strlen($value)>$this->options['size_max']){
            throw new \Exception(sprintf($this->message, $this->description, $this->options['size_max']));
        }
        return;
    }
}
