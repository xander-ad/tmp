<?php
class UsersController implements IController {
    public function indexAction() {
        $fc = FrontController::getInstance();
        $params = $fc->getParams();
        $model = new FileModel();
        $model->name = $params['name'];
        $output = $model->render(USER_DEFAULT_FILE);
        $fc->setBody($output);
    }
}