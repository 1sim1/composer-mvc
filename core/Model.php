<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public array $errors = [];

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                // Se la proprietà esiste, allora viene assegnato il valore corrente
                // $value a tale proprietà utilizzando la sintassi delle
                // variabili variabili ($this->{$key} = $value).
                $this->{$key} = $value;
            }
        }
    }
    abstract public function rules(): array;
    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
            }
        }
    }

    public function addError(string $attribute, string $rule)
    {
        //TODO time 01:50:10
        //prova push
    }
}
