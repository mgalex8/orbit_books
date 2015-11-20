<?php

class Image extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_post':
	 * @var integer $id	 
	 * @var string  $url
         * @var string  $type
         * @var string  $original_name
         * @var integer $size
	 */         
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url', 'required'),			
			array('url', 'length', 'max'=>255),                       
                        array('original_name', 'length', 'max'=>255),
                        array('type', 'length', 'max'=>50),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                        'books' => array(self::HAS_MANY, 'Book', 'image_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'url' => 'URL',
                        'size' => 'Size',
                        'type' => 'Type',
                        'original_name' => 'Original Name',
		);
	}        
        
}