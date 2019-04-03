<?php
declare(strict_types=1);

namespace Yii\Bridge\Twig;

use Twig\Environment;
use Twig\Extension\CoreExtension;
use Twig\Loader\FilesystemLoader;
use Yii;
use yii\base\Configurable;

class Twig implements Configurable
{
    private $environment;

    public function __construct(array $config = [])
    {
        $config = array_merge([
            'environment' => [],
            'extensions' => [],
        ], $config);

        if (isset($config['environment']['cache'])) {
            $config['environment']['cache'] = Yii::getAlias($config['environment']['cache']);
        }

        $loader = new FilesystemLoader(Yii::getAlias('@app/views'));
        $this->environment = new Environment($loader, $config['environment']);

        $extensions = [
            // new Yii\Bridge\Twig\Extension\FormExtension(),
            // new Yii\Bridge\Twig\Extension\RoutingExtension(),
        ];

        foreach ($config['extensions'] as $extensions) {
            $extensions[] = new $extensions;
        }

        $this->environment->setExtensions($extensions);

        /** @var CoreExtension $coreExtension */
        $coreExtension = $this->environment->getExtension('Twig\Extension\CoreExtension');
        $formatter = Yii::$app->formatter;

        //FixMe: set interfal format. Now it's null.
        $coreExtension->setDateFormat($formatter->dateFormat);
        $coreExtension->setTimezone($formatter->timeZone);
        //FixMe: set count decimal. Now it's zero.
        $coreExtension->setNumberFormat(0, $formatter->decimalSeparator, $formatter->thousandSeparator);
    }

    public function render(string $name, array $parameters = []): string
    {
        return $this->environment->load($name)->render($parameters);
    }
}
