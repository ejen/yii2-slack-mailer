<?php

namespace ejen\yii2_slack_mailer;

use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\mail\BaseMailer;
use Yii;

/**
 * Class Mailer
 * @package ejen\yii2_slack_mailer
 */
class Mailer extends BaseMailer
{
    /**
     * @var array
     */
    public $slackSettings = [];

    public $transport;

    public $messageClass = Message::class;

    /**
     * @param \yii\mail\MessageInterface $message
     * @return bool
     */
    protected function sendMessage($message)
    {
        $slack = Yii::createObject($this->slackSettings);
        $slack->init();

        if (is_array($message->from)) {
            if (count($message->from) === 1) {
                foreach ($message->from as $key => $value) {
                    $from = "$value <$key>";
                }
            } else {
                throw new InvalidConfigException('Можно указать только одного отправителя');
            }
        }

        if (is_string($message->from)) {
            $from = $message->from;
        }

        foreach ((array)$message->to as $key => $value) {
            $to = "$value <$key>";
            $result = $slack->send($message->subject, null, [
                [
                    'text' => $message->textBody,
                    'pretext' => '*От кого:* ' . $from . PHP_EOL . '*Кому:* ' . $to,
                ],
            ]);
        }

        return $result ? true : false;
    }

    /**
     * @param \yii\mail\MessageInterface $message
     * @return bool
     */
    public function send($message)
    {
        if (!$this->beforeSend($message)) {
            return false;
        }

        $address = $message->getTo();
        if (is_array($address)) {
            $address = implode(', ', array_keys($address));
        }
        Yii::info('Sending email "' . $message->getSubject() . '" to "' . $address . '"', __METHOD__);

        $isSuccessful = $this->sendMessage($message);

        $this->afterSend($message, $isSuccessful);

        return $isSuccessful;
    }
}
