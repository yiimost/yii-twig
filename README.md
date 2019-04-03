For use:
1) Add trait into Controller
2) Add this config in your app

```php
'twig' => [
    'class' => Yii\Bridge\Twig\Twig::class,
    'environment' => [
        'debug' => YII_DEBUG,
        'cache' => '@runtime/twig/cache',
    ],
],
```

Don't call this functions:
```
renderContent()
renderPartial()
renderFile()
```

Use inheritance and including instead.

Difference from official yii-twig package: It's simple and doesn't use yii-like way templating that is why it's more quickly.
