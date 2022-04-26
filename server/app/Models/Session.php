<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    const APP_IOS = 'IOS';
    const APP_ANDROID = 'ANDROID';

    protected $table = 'sessions';

    protected $fillable = [
        'token',
        'user_id',
        'app',
        'version',
        'lat',
        'lng',
        'setting',
        'created_at',
        'updated_at',
        'token_push',
    ];

    private $arrSetting;
    public function initSetting()
    {
        if (!$this->arrSetting) {
            $this->arrSetting = @json_decode($this->setting, true);
            if (!$this->arrSetting) {
                $this->arrSetting = [];
            }
        }
    }
    public function addItem($key, $value)
    {
        $this->initSetting();
        $this->arrSetting[$key] = $value;
        $this->setting = json_encode($this->arrSetting);
    }

    public function rmItem($key)
    {
        $this->initSetting();
        if (isset($this->arrSetting[$key])) {
            unset($this->arrSetting[$key]);
        }
    }

    public function getItem($key, $defaultValue = null)
    {
        $this->initSetting();
        if (!isset($this->arrSetting[$key])) {
            return $defaultValue;
        }

        if (!is_array($this->arrSetting[$key]) && trim($this->arrSetting[$key]) == '') {
            return $defaultValue;
        }

        return $this->arrSetting[$key];
    }
}
