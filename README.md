Данный компонент позволяет отправлять письма в slack-чат, вместо стандартного поведения swiftmailer,
который отправляет их в папку runtime.

Установка
=========

```
conmposer require "ejen/yii2-slack-mailer"
```

Использование
==============
* Установите следующие настройки в локальном конфиге
```
    'components' => [
        'mailer' => [
            'class' => ejen\slack\mailer\SlackMailer::class,
            'webhook' => 'slack webhook url here',
            'messageConfig' => [
                'from' => ['test@test.test' => 'Test'],
            ],
        ],
    ]
```
* Используйте компонент в контроллере следующим образом

```
        Yii::$app
            ->mailer
            ->compose('view_file')
            ->setTo([
                'test1@test.test' => 'Test1',
                'test2@test.test' => 'Test2'
            ])
            // or -> setTo('test1@test.test' => 'Test1')
            // or -> setTo(['test1@test.test' => 'Test1'])
            ->setSubject('Your subject')
            ->send();
```
