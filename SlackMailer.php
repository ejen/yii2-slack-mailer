<?php

namespace ejen\slack\mailer;

use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\mail\BaseMailer;
use Yii;

/**
 * Class SlackMailer
 * @package ejen\slack\mailer
 */
class SlackMailer extends BaseMailer
{
    /**
     * @var array
     */
    public $slackSettings = [
        'httpclient' => [
            'class' => \yii\httpclient\Client::class,
        ],
        'class' => \understeam\slack\Client::class,
        'username' => 'yii2-slack-mailer',
    ];

    public $webhook;

    public $transport = null;

    public $messageClass = SlackMessage::class;

    /**
     * @param \yii\mail\MessageInterface $message
     * @return bool
     */
    protected function sendMessage($message)
    {
        $this->slackSettings['url'] = $this->webhook;
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

        $to = '';
        foreach ((array)$message->to as $key => $value) {
            $delimiter = $key ? ',' : '';
            $to .= $delimiter . "$value <$key>";
        }

        try {
            $slack->send($message->subject, null, [
                [
                    'text' => $message->toString(),
                    'pretext' => '*От кого:* ' . $from . PHP_EOL . '*Кому:* ' . $to,
                ],
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
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

        try {
            $isSuccessful = $this->sendMessage($message);
        } catch (\Exception $e) {
            return false;
        }

        $this->afterSend($message, $isSuccessful);

        return $isSuccessful;
    }
}
