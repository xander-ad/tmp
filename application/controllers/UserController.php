<?php
class UserController implements IController {
    public function showAction() {
        $fc = FrontController::getInstance();
        $params = $fc->getParams();
        $model = new FileModel(USER_FILE);
        $model->name = $params['name'];
        $output = $model->render(USER_DEFAULT_FILE);
        $fc->setBody($output);
    }

    public function listAction() {
        $fc = FrontController::getInstance();
        $model = new FileModel(USER_FILE);
        $output = $model->render(USER_LIST_FILE);
        $fc->setBody($output);
    }

    public function infoAction() {
        $fc = FrontController::getInstance();
        $params = $fc->getParams();
        $model = new FileModel(USER_FILE);
        $model->name = $params['name'];
        $model->role = $model->list[$model->name];
        $output = $model->render(USER_ROLE_FILE);
        $fc->setBody($output);
    }

    public function addAction() {
        $fc = FrontController::getInstance();
        $model = new FileModel(USER_FILE);
        $model->name = $_POST['name'] ?? false;
        $model->role = $_POST['role'] ?? false;
        if ($model->name && $model->role) {
            if ($model->addUser()) {
                echo "<script>alert('User added')</script>";
            }
        }
        $output = $model->render(USER_ADD_FILE);
        $fc->setBody($output);
    }
}