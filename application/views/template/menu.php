<?php
$level   = strtolower($this->session->userdata("level"));
if ($level == "admin") {
    $this->load->view("template/menu_admin");
} elseif ($level == "guru") {
    $this->load->view("template/menu_guru");
} else {
    $this->load->view("template/admin");
}
