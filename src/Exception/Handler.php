<?php 

namespace Yasmin\Exception;

class Handler  {

    public static array $handlers = [];

    private static function getHandler(\Exception $e) {
        $desiredName = (new \ReflectionClass($e))->getName();
        foreach(self::$handlers as $name => $handler) {
            $methodRef = new \ReflectionFunction($handler);
            $param = $methodRef->getParameters()[0];
            if($desiredName == $param->getType()->getName()) {
                return $handler;
            }
        }
        return self::$handlers['default'];
    }

    private static function handler(\Exception $e) {
        $handler = self::getHandler($e);
        call_user_func_array($handler, [$e]);
    }

    public static function setDefaultHandlers() {
        self::set('exception/framework', function (\Yasmin\Exception $e) {
            \jsonResponse([
                'code' => $e->getCodeString(),
                'message' => $e->getMessage()
            ])->send();
        });
        
        self::set('exception/database', function (\Yasmin\Exception\DatabaseException $e) {
            \jsonResponse([
                'code' => $e->getCodeString(),
                'message' => $e->getMessage(),
                'sql' => [
                    'state' => $e->getState(),
                    'query' => $e->getSql()
                ]
            ])->send();
        });
        
        self::set('exception/http', function (\Yasmin\Exception\HttpException $e) {
            \jsonResponse([
                'code' => $e->getCodeString(),
                'message' => $e->getMessage(),
                'request' => [
                    'uri' => $e->getUri(),
                    'method' => $e->getMethod()
                ]
            ])->send();
        });

        self::set('default', function (\Exception $e) {
            \jsonResponse([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ])->send();
        });
    }

    public static function listen() {
        set_exception_handler(function (\Exception $e) {
            self::handler($e);
        });
    }

    public static function set(string $name, callable | string | array $function) {
        self::$handlers[$name] = $function;
    }

    public static function unset(string $name) {
        unset(self::$handlers[$name]);
    }

}