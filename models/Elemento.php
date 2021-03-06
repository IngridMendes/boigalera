<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "elemento".
 *
 * @property integer $idelemento
 * @property string $nome
 * @property integer $tempo
 * @property string $descricao
 * @property integer $tipo_idtipo
 *
 * @property Tipo $tipoIdtipo
 * @property ParteContemElemento[] $parteContemElementos
 * @property Parte[] $parteIdpartes
 */
class Elemento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'elemento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tempo', 'tipo_idtipo', 'item_iditem'], 'integer'],
            [['descricao'], 'string'],
            [['tipo_idtipo'], 'required'],
            [['nome'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idelemento' => 'Idelemento',
            'nome' => '',
            'tempo' => 'Tempo',
            'descricao' => '',
            'tipo_idtipo' => 'Tipo Idtipo',
            'item_iditem' => 'Id Item',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoIdtipo()
    {
        return $this->hasOne(Tipo::className(), ['idtipo' => 'tipo_idtipo']);
    }

    public function getItemIditem()
    {
        return $this->hasOne(Item::className(), ['iditem' => 'item_iditem']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParteContemElementos()
    {
        return $this->hasMany(ParteContemElemento::className(), ['elemento_idelemento' => 'idelemento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParteIdpartes()
    {
        return $this->hasMany(Parte::className(), ['idparte' => 'parte_idparte'])->viaTable('parte_contem_elemento', ['elemento_idelemento' => 'idelemento']);
    }
}
