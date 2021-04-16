<?php
$level   = strtolower($this->session->userdata("level"));
if ($level == "admin") {
    $this->load->view("template/main_header_admin");
} elseif ($level == "guru") {
    $this->load->view("template/main_header_guru");
}
