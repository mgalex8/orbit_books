<?php

class Book extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_post':
	 * @var integer $id	 
	 * @var string  $name
         * @var string  $author
         * @var integer $publishing_year
         * @var string  $description
         * @var integer $genre_id
         * @var integer $image_id	 
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
		return '{{books}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, author, description, genre_id', 'required'),			
			array('name', 'length', 'max'=>150),
                        array('author', 'length', 'max'=>100),
                        array('description', 'length', 'max'=>2000), 
                        array('publishing_year', 'numerical', 'max'=>9999),
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
                        'genre' => array(self::BELONGS_TO, 'Genre', 'genre_id'),
                        'image' => array(self::BELONGS_TO, 'Image', 'image_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Наименование',
			'author' => 'Автор',
			'publiching_year' => 'Год издания',
                        'description' => 'Описание',			
		);
	}	
        
        
}