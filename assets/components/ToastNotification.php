<?php

class ToastNotification
{
    private $msg;
    private $duration;
    private $type;

    public function __construct($msg, $duration = 300, $type = 'info')
    {
        $this->msg = $msg;
        $this->duration = $duration;
        $this->type = $type;
    }

    public function show()
    {
        echo "<div class='toast toast-$this->type' data-duration='$this->duration'>$this->msg</div>";
    }
}
