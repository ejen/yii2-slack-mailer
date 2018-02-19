<?php

class SlackMailerTest extends \Codeception\Test\Unit
{
    /**
     * @dataProvider messageDataProvider
     */
    public function testSend($testData, $expected)
    {
        Yii::$container->set(\understeam\slack\Client::class, function () {
            return \Codeception\Stub::make(\understeam\slack\Client::class, [
                'init' => null,
                'send' => function () {
                }
            ]);
        });

        $message = new \ejen\slack\mailer\SlackMessage($testData);
        $mailer = new \ejen\slack\mailer\SlackMailer();
        $this->assertEquals($mailer->send($message), $expected);
        Yii::$container->clear(\understeam\slack\Client::class);

        Yii::$container->set(\understeam\slack\Client::class, function () {
            return \Codeception\Stub::make(\understeam\slack\Client::class, [
                'init' => null,
                'send' => function () {
                    throw new Exception();
                }
            ]);
        });
        $message = new \ejen\slack\mailer\SlackMessage($testData);
        $mailer = new \ejen\slack\mailer\SlackMailer();
        $this->assertFalse($mailer->send($message));

        // asdf
        // true
        // false
    }

    public function messageDataProvider()
    {
        return [
            [
                [
                    'charset' => 'sdf',
                    'from' => 'email@email.ru',
                    'to' => 'email@email.ru',
                    'replyTo' => 'email@email.ru',
                    'cc' => 'hz',
                    'bcc' => 'asdasd',
                    'subject' => 'pfujkjdjr',
                    'textBody' => 'sdfsdf',
                    'htmlBody' => 'asdsdf',
                    'sendAsText' => false
                ],
                true
            ],
            [
                [
                    'charset' => 'sdf',
                    'from' => 'email@email.ru',
                    'to' => ['email@email.ru'],
                    'replyTo' => 'email@email.ru',
                    'cc' => 'hz',
                    'bcc' => 'asdasd',
                    'subject' => 'pfujkjdjr',
                    'textBody' => 'sdfsdf',
                    'htmlBody' => 'asdsdf',
                    'sendAsText' => false
                ],
                true
            ],
            [
                [
                    'charset' => 'sdf',
                    'from' => ['email@email.ru'],
                    'to' => ['email@email.ru', 'email1@email1.ru'],
                    'replyTo' => 'email@email.ru',
                    'cc' => 'hz',
                    'bcc' => 'asdasd',
                    'subject' => 'pfujkjdjr',
                    'textBody' => 'sdfsdf',
                    'htmlBody' => 'asdsdf',
                    'sendAsText' => false
                ],
                true
            ],
            [
                [
                    'charset' => 'sdf',
                    'from' => ['email@email.ru', 'email1@email1.ru'],
                    'to' => 'email@email.ru',
                    'replyTo' => 'email@email.ru',
                    'cc' => 'hz',
                    'bcc' => 'asdasd',
                    'subject' => 'pfujkjdjr',
                    'textBody' => 'sdfsdf',
                    'htmlBody' => 'asdsdf',
                    'sendAsText' => false
                ],
                false
            ],
        ];
    }
}
