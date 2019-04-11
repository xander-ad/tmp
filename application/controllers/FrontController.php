<?php
class FrontController {
    protected $_controller, $_action, $_params, $_body;
    static $_instance;

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {
        $req = $_SERVER['REQUEST_URI'];
        $splits = explode('/', trim($req,'/'));

        $this->_controller = !empty($splits[0]) ? ucfirst($splits[0]).'Controller' : 'IndexController';
        $this->_action = !empty($splits[1]) ? $splits[1].'Action' : 'indexAction';

        if (!empty($splits[2])) {
            $keys = [];
            $values = [];
            for ($i = 2, $size = count($splits); $i < $size; $i++) {
                if (!($i%2)) {
                    $keys[] = $splits[$i];
                } else {
                    $values[] = $splits[$i];
                }
            }
            $this->_params = array_combine($keys, $values);
        }
    }

    public function route() {
        if (class_exists($this->getController())) {
            $rc = new ReflectionClass($this->getController());
            if ($rc->implementsInterface('IController')) {
                if ($rc->hasMethod($this->getAction())) {
                    $controller = $rc->newInstance();
                    $method = $rc->getMethod($this->getAction());
                    $method->invoke($controller);
                } else {
                    throw new Exception('Action');
                }
            } else {
                throw new Exception('Interface');
            }
        } else {
            throw new Exception('Controller');
        }
    }

    public function getParams() {
        return $this->_params;
    }

    public function getController() {
        return $this->_controller;
    }

    public function getAction() {
        return $this->_action;
    }

    public function getBody() {
        return $this->_body;
    }

    public function setBody($body) {
        $this->_body = $body;
    }
}