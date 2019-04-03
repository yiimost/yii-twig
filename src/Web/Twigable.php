<?php

namespace Yii\Bridge\Twig\Web;

use Yii;
use yii\web\Controller;

/**
 * @mixin Controller
 */
trait Twigable
{
    public function render($view, $params = [])
    {
        return Yii::$app->twig->render($view, $params);
    }

    public function renderContent($content)
    {
        throw new InvalidRenderException("Call Controller::render() function.");
    }

    public function renderPartial($view, $params = [])
    {
        throw new InvalidRenderException("Call Controller::render() function.");
    }

    public function renderFile($file, $params = [])
    {
        throw new InvalidRenderException("Call Controller::render() function.");
    }
}
