<?php if (!defined('BASEPATH')) exit('No direct script accessallowed');

if (!function_exists('send_email')) {
    function send_email($data)
    {
        $ci = &get_instance();
        $ci->load->library('email');
        $from_mail = "poojaob1998@gmail.com";
        $from_name = "7 Organic";
        $ci->email->from($from_mail, $from_name);
        $ci->email->to($data['to']);
        $ci->email->bcc('poojaobiradar@gmail.com');
        $ci->email->subject($data['subject']);
        $ci->email->message($data['message']);
        $ci->email->message($data['message']);
        if ($ci->email->send()) {
            return "sent";
        } else {
           return  $ci->email->print_debugger();
        }
    }
}
