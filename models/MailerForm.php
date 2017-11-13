<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class MailerForm extends ActiveRecord
{
    public $fromEmail;
    public $fromName;
    public $toEmail;
    public $subject;
    public $body;
    public $imagePath;
    /**
     * @var UploadedFile
     */
    public $imageFile;

//    public static function tableName(){
//        return '{{mailerform}}';
//    }

    public function rules()
    {
        return [
            [['fromEmail', 'fromName', 'toEmail', 'subject', 'body'], 'required'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            ['fromEmail', 'email'],
            ['toEmail', 'email']
        ];
    }


//    public function getData()
//    {
//        $mailerform = MailerForm::find()->all();
//    }

    public function uploadAndSend()
    {
        //Не можнт отпраить отдельно потому что, можно только один раз обратиться к данным метода пост ИМХО
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            Yii::$app->mailer->compose()
                ->setTo($this->toEmail)
                ->setFrom([$this->fromEmail => $this->fromName])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->setHtmlBody('<b style="color: #0000aa">'.$this->body.'</b>')
                ->attach('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension)
                ->send();
            return true;
        } else {
            return false;
        }
    }

    public function sendEmail()
    {
        if ($this->validate()) {

            Yii::$app->mailer->compose()
                ->setTo($this->toEmail)
                ->setFrom([$this->fromEmail => $this->fromName])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->setHtmlBody('<b style="color: #0000aa">'.$this->body.'</b>')
                ->attach('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension)
                ->send();

            return true;
        }
        return false;
    }
}