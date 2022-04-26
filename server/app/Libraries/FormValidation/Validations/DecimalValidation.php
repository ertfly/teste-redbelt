<?php

namespace App\Libraries\FormValidation\Validations;

use App\Libraries\Number;

class DecimalValidation extends AbstractValidation
{
    private $message = 'O campo %s deve ser informado um valor decimal válido';

    public function validate()
    {
        if (!isset($this->options['dec'])) {
            throw new \Exception('Informe as casas decimais');
        }
        $decimal = Number::toDecimal($this->value, $this->options['dec']);
        if (trim($this->value) != '' && !is_numeric($decimal)) {
            throw new \Exception(sprintf($this->message, $this->description));
        }
        return;
    }
}
