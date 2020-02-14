<?php


namespace app\components\exceptions;


use yii\base\ExitException;

class ForbiddenExceptions extends ExitException
{
    /**
     * Конструктор
     * @param string $name Название (выведем в качестве названия страницы)
     * @param string $message Подробное сообщение об ошибке
     * @param int $code Код ошибки
     * @param int $status Статус ответа
     * @param \Exception $previous Предыдущее исключение
     */
    public function __construct($name, $message = null, $code = 0, $status = 500, \Exception $previous = null)
    {
        # Генерируем ответ
        $view = \Yii::$app->getView();
        $response = \Yii::$app->getResponse();
        $response->data = $view->renderFile('@app/views/forbidden.php', [
            'name' => $name,
            'message' => $message,
        ]);

        # Возвратим нужный статус (по-умолчанию отдадим 500-й)
        $response->setStatusCode(403);

        parent::__construct($status, $message, $code, $previous);
    }
}