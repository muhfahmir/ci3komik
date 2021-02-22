<?php

function logged_in()
{
    $ci = get_instance();
    if ($ci->session->userdata('email')) {
        return true;
    } else {
        return false;
    }
}

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        $ci->session->set_flashdata('message3', '<div class="alert alert-danger" role="alert">Mohon Login terlebih dahulu!</div>');
        redirect('auth');
    }
}
