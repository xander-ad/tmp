<?php
class FileModel{

  public $name = '';
  public $role = '';
  public $list = [];

  public function __construct($file=0) {
      if (is_file($file)) {
          $this->list = unserialize(file_get_contents($file));
      }
  }

    public function render($file) {
    ob_start();
    include($file);
    return ob_get_clean();
  }

  public function addUser() {
      if ($this->name && $this->role) {
          $this->list[$this->name] = $this->role;
          file_put_contents(USER_FILE, serialize($this->list));
          return true;
      }
      return false;
  }


}