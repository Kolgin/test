<?php

namespace app\models;

use Yii;
use yii\base\Model;
//use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class MailerForm extends Model
{
    public $fromEmail;
    public $fromName;
    public $subject;
    public $body;
    public $imagePath;
    /**
     * @var UploadedFile
     */
    public $passportFace;
    public $passportMade;
    public $passportRegistration;
    public $idСodeFace;
    public $interPassportFace;
    public $propertyRightsOne;
    public $propertyRightsTwo;
    public $techPassport1;
    public $techPassport2;
    public $techPassport3;
    public $techPassport4;
    public $techPassport5;


    public function rules()
    {
        return [
            [['fromEmail', 'fromName',  'subject', 'body'], 'required'],
            ['fromEmail', 'email']
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
            $this->passportFace->saveAs('uploads/' . $this->passportFace->baseName . '.' . $this->passportFace->extension);
            $this->passportMade->saveAs('uploads/' . $this->passportMade->baseName . '.' . $this->passportMade->extension);
            $this->passportRegistration->saveAs('uploads/' . $this->passportRegistration->baseName . '.' . $this->passportRegistration->extension);
            $this->idСodeFace->saveAs('uploads/' . $this->idСodeFace->baseName . '.' . $this->idСodeFace->extension);
            $this->interPassportFace->saveAs('uploads/' . $this->interPassportFace->baseName . '.' . $this->interPassportFace->extension);
            $this->propertyRightsOne->saveAs('uploads/' . $this->propertyRightsOne->baseName . '.' . $this->propertyRightsOne->extension);
            $this->propertyRightsTwo->saveAs('uploads/' . $this->propertyRightsTwo->baseName . '.' . $this->propertyRightsTwo->extension);
            $this->techPassport1->saveAs('uploads/' . $this->techPassport1->baseName . '.' . $this->techPassport1->extension);
            $this->techPassport2->saveAs('uploads/' . $this->techPassport2->baseName . '.' . $this->techPassport2->extension);
            $this->techPassport3->saveAs('uploads/' . $this->techPassport3->baseName . '.' . $this->techPassport3->extension);
            $this->techPassport4->saveAs('uploads/' . $this->techPassport4->baseName . '.' . $this->techPassport4->extension);
            $this->techPassport5->saveAs('uploads/' . $this->techPassport5->baseName . '.' . $this->techPassport5->extension);

//            $users = ['vovik425@gmail.com','dn170894kva1@gmail.com'];
//            foreach ($users as $user) {
//                $messages[] = Yii::$app->mailer->compose()
//                    // ...
//                    ->setTo($user);
//            }
//            Yii::$app->mailer->sendMultiple($messages);

            Yii::$app->mailer->compose()
                ->setTo("vovik425@gmail.com")
                ->setFrom([$this->fromEmail => $this->fromName])
                ->setSubject($this->subject)
//                ->setTextBody($this->body)
                ->setHtmlBody('<b style="color: #0000aa">'.$this->body.'</b>')
                ->setHtmlBody('<b style="color: #0000aa">'.$this->body.'</b>')
                ->attach('uploads/' . $this->passportMade->baseName . '.' . $this->passportMade->extension)
                ->attach('uploads/' . $this->passportRegistration->baseName . '.' . $this->passportRegistration->extension)
                ->attach('uploads/' . $this->idСodeFace->baseName . '.' . $this->idСodeFace->extension)
                ->attach('uploads/' . $this->interPassportFace->baseName . '.' . $this->interPassportFace->extension)
                ->attach('uploads/' . $this->propertyRightsOne->baseName . '.' . $this->propertyRightsOne->extension)
                ->attach('uploads/' . $this->propertyRightsTwo->baseName . '.' . $this->propertyRightsTwo->extension)
                ->attach('uploads/' . $this->techPassport1->baseName . '.' . $this->techPassport1->extension)
                ->attach('uploads/' . $this->techPassport2->baseName . '.' . $this->techPassport2->extension)
                ->attach('uploads/' . $this->techPassport3->baseName . '.' . $this->techPassport3->extension)
                ->attach('uploads/' . $this->techPassport4->baseName . '.' . $this->techPassport4->extension)
                ->attach('uploads/' . $this->techPassport5->baseName . '.' . $this->techPassport5->extension)

                ->send();

            Yii::$app->mailer->compose()
                ->setTo("made70@bk.ru")
                ->setFrom([$this->fromEmail => $this->fromName])
                ->setSubject($this->subject)
//                ->setTextBody($this->body)
                ->setHtmlBody('<b style="color: #0000aa">'.$this->body.'</b>')
                ->attach('uploads/' . $this->passportFace->baseName . '.' . $this->passportFace->extension)
                ->attach('uploads/' . $this->passportMade->baseName . '.' . $this->passportMade->extension)
                ->attach('uploads/' . $this->passportRegistration->baseName . '.' . $this->passportRegistration->extension)
                ->attach('uploads/' . $this->idСodeFace->baseName . '.' . $this->idСodeFace->extension)
                ->attach('uploads/' . $this->interPassportFace->baseName . '.' . $this->interPassportFace->extension)
                ->attach('uploads/' . $this->propertyRightsOne->baseName . '.' . $this->propertyRightsOne->extension)
                ->attach('uploads/' . $this->propertyRightsTwo->baseName . '.' . $this->propertyRightsTwo->extension)
                ->attach('uploads/' . $this->techPassport1->baseName . '.' . $this->techPassport1->extension)
                ->attach('uploads/' . $this->techPassport2->baseName . '.' . $this->techPassport2->extension)
                ->attach('uploads/' . $this->techPassport3->baseName . '.' . $this->techPassport3->extension)
                ->attach('uploads/' . $this->techPassport4->baseName . '.' . $this->techPassport4->extension)
                ->attach('uploads/' . $this->techPassport5->baseName . '.' . $this->techPassport5->extension)

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
                ->setTo("vovik425@gmail.com")
                ->setFrom([$this->fromEmail => $this->fromName])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->setHtmlBody('<b style="color: #0000aa">'.$this->body.'</b>')
                ->send();

            return true;
        }
        return false;
    }

    public function attributeLabels()
    {
        return [
            'fromEmail' => 'Ваша почта',
            'fromName' => 'Ваша Фамилия',
            'subject' => 'Ваш телефон',
            'body' => 'Коментарий',
            'passportFace' => 'Первая страница паспорта',
            'passportMade' => 'Вторая страница паспорта',
            'passportRegistration' => 'Регистрация',
            'idСodeFace' => 'ИНН',
            'interPassportFace' => 'Загран паспорт',
            'propertyRightsOne' => 'Имущественные права 1 страница',
            'propertyRightsTwo' => 'Имущественные права 2 страница',
            'techPassport1' => 'Техпаспорт первая страница',
            'techPassport2' => 'Техпаспорт вторая страница',
            'techPassport3' => 'Техпаспорт третья страница',
            'techPassport4' => 'Техпаспорт четвертая страница',
            'techPassport5' => 'Техпаспорт пятая страница',
        ];
    }


}