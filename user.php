<?php
class User {
    public $id;
    public $keycode;

    function __construct($id, $keycode) {
        $this->id = $id;
        $this->keycode = $keycode;
    }

    public function expose() {
        return get_object_vars($this);
    }
}
?>
