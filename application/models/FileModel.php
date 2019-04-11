<?php
class FileModel{

  public $name = '';
  public $list = [];
  public $user = [];

  public function render($file) {
    ob_start();
    include($file);
    return ob_get_clean();
  }
}