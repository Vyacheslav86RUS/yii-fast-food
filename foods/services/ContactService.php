<?php

namespace foods\services;

use foods\forms\ContactForm;
use yii\mail\MailerInterface;

class ContactService
{
    private $adminEmail;
    private $mailer;

    public function __construct($adminEmail, MailerInterface $mailer)
    {
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
    }

    public function send(ContactForm $form)
    {
        $sent = $this->mailer
            ->compose()
            ->setTo($this->adminEmail)
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Не получилось отправить письмо');
        }
    }
}
