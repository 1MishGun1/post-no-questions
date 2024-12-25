<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $preview
 * @property string $description
 * @property int $user_id
 * @property int|null $category_id
 * @property int $status_id
 * @property int|null $like
 * @property int|null $dislike
 * @property string|null $photo
 * @property string $create_at
 * @property string|null $comment_admin
 * @property int|null $comment_id
 *
 * @property Category $category
 * @property Comment $comment
 * @property Status $status
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    public $imageFile;
    const NO_PHOTO = 'no_image_post.png';

    const SCENARIO_COMMENT = '';
    const SCENARIO_CATEGORY = '';
    const SCENARIO_CANCEL = '';

    public bool $check = false;

    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'preview', 'description', 'user_id', 'status_id'], 'required'],
            [['description'], 'string'],
            [['user_id', 'category_id', 'status_id', 'like', 'dislike', 'comment_id'], 'integer'],
            [['create_at'], 'safe'],
            ['check', 'boolean'],
            [['title', 'preview', 'photo', 'comment_admin'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::class, 'targetAttribute' => ['comment_id' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            
            ['comment_admin', 'required', 'on' => self::SCENARIO_CANCEL],
            ['comment', 'required', 'on' => self::SCENARIO_COMMENT],
            ['category_id', 'required', 'on' => self::SCENARIO_CATEGORY],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер поста',
            'title' => 'Навание',
            'preview' => 'Превью',
            'description' => 'Описание',
            'user_id' => 'Полователь',
            'comment_id' => 'Комментарии',
            'category_id' => 'Категория',
            'status_id' => 'Статус',
            'like' => 'Лайки',
            'dislike' => 'Дизлайки',
            'photo' => 'Изображение',
            'create_at' => 'Дата создания',
            'comment_admin' => 'Причина отмены',
            'comment' => 'Своя категория',
            'imageFile' => 'Изображение',
            'check' => 'Своя тема',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Comment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComment()
    {
        return $this->hasOne(Comment::class, ['id' => 'comment_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            $fileName = Yii::$app->user->id
                            . '_'
                            . time()
                            . '_'
                            . Yii::$app->security->generateRandomString()
                            . '.'
                            . $this->imageFile->extension;
            $this->imageFile->saveAs('img/' . $fileName);
            $this->photo = $fileName;
            return true;
        } else {
            return false;
        }
    }
}
