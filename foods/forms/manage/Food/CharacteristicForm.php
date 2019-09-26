<?php

namespace foods\forms\manage\Food;

use foods\entities\Food\Characteristic;
use foods\helpers\CharacteristicHelper;
use yii\base\Model;

/**
 * @property array $variants
 */
class CharacteristicForm extends Model
{
    public $name;
    public $type;
    public $required;
    public $default;
    public $textVariants;
    public $sort;

    private $_characteristic;

    public function __construct(Characteristic $characteristic = null, $config = [])
    {
        if ($characteristic) {
            $this->name = $characteristic->name;
            $this->type = $characteristic->type;
            $this->required = $characteristic->required;
            $this->default = $characteristic->default;
            $this->textVariants = implode(PHP_EOL, $characteristic->variants);
            $this->sort = $characteristic->sort;
            $this->_characteristic = $characteristic;
        } else {
            $this->sort = Characteristic::find()->max('sort');
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'type', 'sort'], 'required'],
            [['required'], 'boolean'],
            [['default'], 'string', 'max' => 255],
            [['textVariants'], 'string'],
            [['sort'], 'integer'],
            [['name'], 'unique', 'targetClass' => Characteristic::class, 'filter' => $this->_characteristic ? ['<>', 'id', $this->_characteristic->id] : null]
        ];
    }

    public function typesList()
    {
        return CharacteristicHelper::typeList();
    }
    public function getVariants()
    {
        return preg_split('#\s+#i', $this->textVariants);
    }
}
