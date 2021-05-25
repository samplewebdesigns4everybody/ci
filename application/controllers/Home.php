<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        $this->load->helper('url');
    }

    public function index()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        } else {
            redirect(site_url("home/dashboard"), "refresh");
        }
    }

    public function login()
    {
        //$this->session->unset_userdata("admin_user_logged_in");
        $page_data['page_name'] = "login";
        $page_data['page_title'] = "Login";
        $this->load->view("backend/index", $page_data);
    }

    public function login_verfication()
    {
        if (isset($_POST['email'])) {
            $email = $this->input->post("email");
            $password = $this->input->post("password");
            $data = array("email" => $email, "password" => $password);
            $res = $this->home_model->login($data);
            if ($res) {
                redirect(site_url("home/dashboard"), "refresh");
            } else {
                redirect(site_url("home/login"), "refresh");
            }
        }
    }

    public function forgot()
    {
        if (isset($_POST['email'])) {
            $email = $this->input->post("email");
            $res = $this->home_model->email_verification($email);
            if ($res) {
                $this->session->set_userdata("password_reset_email", $email);
                //$otp=random_string("alnum",6);
                //
                redirect(site_url("home/otp_verify"), "refresh");
            } else {
                redirect(site_url("home/forgot"), "refresh");
            }
        } else {
            $page_data['page_name'] = "forgot";
            $page_data['page_title'] = "Forgot Password";
            $this->load->view("backend/index", $page_data);
        }
    }

    public function send_otp_mail($data)
    {
        $to = $data['email'];
        $subject = "7 Organic Password reset";
        $message = "<h1>hello your OTP is " . $data['otp'] . " <h1>";
        $data_list = array(
            "to" => $to,
            "subject" => $subject,
            "message" => $message
        );
        $res = send_email($data_list);
        return $res;
    }

    public function email_verify()
    {
        if ($this->session->userdata('password_reset')) {
            $email = $this->session->userdata("password_reset");
        } else {
            $email = $this->input->post("email");
        }
        $res = $this->home_model->email_verification($email);
        if ($res == false) {
            $this->session->set_flashdata('error_message', "Invalid email");
            //redirect(site_url('home/forgot'), "refresh");


        } else {
            $data = array("email" => $email, "otp" => $res);
            $output = $this->send_otp_mail($data);
            //print_r($output);
            //echo "hsxyg";
            $this->session->set_flashdata('flash_message', "otp has sent to registered email");
            $this->session->set_userdata("password_reset", $email);
            redirect(site_url('home/otp_verify'), "refresh");
        }
    }

    public function otp_verify()
    {
        if (isset($_POST['otp'])) {
            $otp = $this->input->post("otp");
            $email = $this->session->userdata("password_reset");
            $this->db->where("email", $email);
            $this->db->where("otp", $otp);
            $res = $this->db->get("user_otp");
            if ($res->num_rows() > 0) {
                redirect(site_url("home/reset"), 'refresh');
            } else {
                $this->session->set_flashdata('error_message', "invalid OTP");
                redirect(site_url("home/otp_verify"), "refresh");
            }
        } else {

            $page_data['page_name'] = "otp_verify";
            $page_data['page_title'] = "OTP Verification ";
            $this->load->view("backend/index", $page_data);
        }
    }

    public function reset()
    {
        if (!$this->session->userdata("password_reset")) {
            redirect(site_url("home/login"), "refresh");
        }
        if (isset($_POST['password'])) {
            $password = $this->input->post("password");
            $confirm = $this->input->post("confirm_password");
            $email = $this->session->userdata("password_reset");

            if ($password === $confirm) {

                $data = array("password" => $password);
                $this->db->where("email", $email);
                $this->db->update("admin", $data);

                $this->session->set_flashdata('flash_message', "password reset successful");
                $this->session->unset_userdata("password_reset");
                redirect(site_url("home/login"), "refresh");
            } else {
                $this->session->set_flashdata('error_message', "password and confirm password do not match");
                redirect(site_url('home/reset'), "refresh");
            }
        } else {
            $page_data['page_name'] = "reset";
            $page_data['page_title'] = "Reset ";
            $this->load->view("backend/index", $page_data);
        }
    }

    function Sendmail()
    {
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.googlemail.com";
        $config['smtp_port'] = "587";  //465
        $config['charset']    = 'utf-8';

        $config['smtp_user'] = "varshasabannavar@gmail.com";
        $config['smtp_pass'] = "9900430808";
        $config['validation'] = TRUE;

        $message = "<h1>hello this is your password reset mail </h1>";

        $config['mailtype'] = "html";
        $ci = &get_instance();
        $ci->load->library('email', $config);
        $ci->email->set_newline("\r\n");
        $ci->email->from("varshasabannavar@gmail.com");
        $ci->email->to("varshasabannavar@gmail.com");
        $ci->email->subject("Reset password");
        $ci->email->message($message);
        if ($ci->email->send()) {
            return true;
        }
        echo $this->email->print_debugger();
        // $this->load->view('backend/otp');
    }

    public function dashboard()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $page_data['total_user'] = $this->home_model->get_users();
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $page_data['posts'] = $this->home_model->fetchtable();
        $page_data['page_name'] = "dashboard";
        $page_data['page_title'] = "Dashboard";
        $this->load->view("backend/index", $page_data);
    }

    public function profile()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);

        if (isset($_POST['admin_id'])) {
            $firstname = $this->input->post("firstname");
            $lastname = $this->input->post("lastname");
            $email = $this->input->post("email");
            $phone = $this->input->post("phone");
            $gender = $this->input->post("gender");
            $admin_id = $this->input->post("admin_id");


            if (!isset($_FILES['profile']) || $_FILES['profile']['error'] == UPLOAD_ERR_NO_FILE) {
                $image_path = $this->input->post("url");
                $image = $this->input->post("url");
                //echo "imagepath- old_url".$image_path;

            } else {
                $images = $this->profile_fileupload($_FILES['profile'], "profile");
                //$images=$this->profile_upload();
                $image = $images['file_name'];
                $image_path = "uploads/profile/" . $image;
                //echo "image path-file upload ".$image_path;

            }
            if ($image == "error") {
                $this->session->set_flashdata('error_message', "error occured");
                redirect(site_url("home/profile"), "refresh");
            } else {
                $data = array(
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "email" => $email,
                    "phone" => $phone,
                    "gender" => $gender,
                    "profile_pic" => $image_path
                );
                $res = $this->home_model->update_profile($data, $admin_id);
                if ($res === "0") {
                    $this->session->set_flashdata('flash_message', "updated");
                } else if ($res === "1") {
                    $this->session->set_flashdata('error_message', "error occured");
                }
                redirect(site_url("home/profile"), "refresh");
                //print_r($data);
            }
        } else {
            $user = $this->session->userdata("admin_data");
            $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
            $page_data['page_name'] = "profile";
            $page_data['page_title'] = "Profile";
            $this->load->view("backend/index", $page_data);
        }
    }

    public function add_category()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data1['admin'] = $this->home_model->get_admin($user["admin_id"]);

        $page_data1['category'] = $this->home_model->get_category();
        if (isset($_POST["cat_name"])) {
            $cat_name = $this->input->post("cat_name");
            $parent = $this->input->post("parent");
            $data = array(
                "cat_name" => $cat_name,
                "parent_category" => $parent
            );
            $res = $this->home_model->add_category($data, $cat_name);
            if ($res === "0") {
                $this->session->set_flashdata('error_message', "Category Already Added");
                redirect(site_url('home/add_category'), 'refresh');
            } else if ($res === "1") {
                $this->session->set_flashdata('flash_message', "Category Added Successfully");
                redirect(site_url('home/view_category'), 'refresh');
            } else {
                $this->session->set_flashdata('error_message', "Something Went Wrong. Please try after sometime");
                redirect(site_url('home/add_category'), 'refresh');
            }
        } else {

            $page_data['category'] = $this->home_model->get_category();
            $page_data1['page_name'] = "add_category";
            $page_data1['page_title'] = "Add Category";
            $this->load->view("backend/index", $page_data1);
        }
    }

    public function view_category()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $page_data['category'] = $this->home_model->get_category();
        $page_data['page_name'] = "view_category";
        $page_data['page_title'] = "View Category";
        $this->load->view("backend/index", $page_data);
    }

    public function edit_category($cat_id = 0)
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $data['cat_id'] = $cat_id;

        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $page_data['category'] = $this->home_model->get_category($cat_id);

        $page_data['categoryall'] = $this->home_model->get_category();

        if (isset($_POST['cat_id'])) {
            $cat_name = $this->input->post("cat_name");
            $parent = $this->input->post("parent");
            $cat_id = $this->input->post("cat_id");

            $data = array(
                "cat_name" => $cat_name,
                "parent_category" => $parent
            );

            $res = $this->home_model->edit_category($data, $cat_id);
            if ($res === "0") {
                $this->session->set_flashdata('flash_message', "updated");
            } else if ($res === "1") {
                $this->session->set_flashdata('error_message', "error occured");
            }
            redirect(site_url("home/view_category"), "refresh");
        } else {
            $this->home_model->edit_category($data, $cat_id);
            $page_data['categoryall'] = $this->home_model->get_category();
            $page_data['page_name'] = "edit_category";
            $page_data['page_title'] = "Edit Category";
            $this->load->view("backend/index", $page_data);
        }
    }

    public function delete_category($id = 0)
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $data['cat_id'] = $id;
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $this->home_model->delete_category($id);
        $page_data['category'] = $this->home_model->get_category();
        $page_data['page_name'] = "view_category";
        $page_data['page_title'] = "View Category";
        $this->load->view("backend/index", $page_data);
    }
    public function add_banner()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        if (isset($_POST['heading1'])) {
            $heading1 = $this->input->post("heading1");
            $heading2 = $this->input->post("heading2");
            $link = $this->input->post("link");

            if (!isset($_FILES['banner']) || $_FILES['banner']['error'] == UPLOAD_ERR_NO_FILE) {
                $image_path = $this->input->post("url");
                $image = $this->input->post("url");
            } else {
                $images = $this->banner_fileupload($_FILES['banner'], "banner");
                //$images=$this->profile_upload();
                $image = $images['file_name'];
                $image_path = "uploads/banner/" . $image;
            }
            if ($image == "error") {
                $this->session->set_flashdata('error_message', "error occured");
                redirect(site_url("home/add_banner"), "refresh");
            } else {
                $data = array(
                    "heading1" => $heading1,
                    "heading2" => $heading2,
                    "link" => $link,
                    "slide_image" => $image_path
                );
                $res = $this->home_model->add_banner($data);
                if ($res === "0") {
                    $this->session->set_flashdata('error_message', "Banner Already Added");
                    redirect(site_url('home/add_banner'), 'refresh');
                } else if ($res === "1") {
                    $this->session->set_flashdata('flash_message', "Banner Added Successfully");
                    redirect(site_url('home/view_banner'), 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', "Something Went Wrong. Please try after sometime");
                    redirect(site_url('home/add_banner'), 'refresh');
                }
            }
        } else {
            $page_data['page_name'] = "add_banner";
            $page_data['page_title'] = "Add Banner";
            $this->load->view("backend/index", $page_data);
        }
    }


    public function view_banner()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $page_data['sliders'] = $this->home_model->get_banner();
        $page_data['page_name'] = "view_banner";
        $page_data['page_title'] = "View Banner";
        $this->load->view("backend/index", $page_data);
    }

    public function delete_banner($id = 0)
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $data['id'] = $id;
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $this->home_model->delete_banner($id);
        $page_data['sliders'] = $this->home_model->get_banner();
        $page_data['page_name'] = "view_Banner";
        $page_data['page_title'] = "View Banner";
        $this->load->view("backend/index", $page_data);
    }

    public function edit_banner($id = 0)
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }

        $data['id'] = $id;
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);

        $page_data['sliders'] = $this->home_model->get_banner($id);


        if (isset($_POST['id'])) {
            $heading1 = $this->input->post("heading1");
            $heading2 = $this->input->post("heading2");
            $link = $this->input->post("link");



            if (!isset($_FILES['banner']) || $_FILES['banner']['error'] == UPLOAD_ERR_NO_FILE) {
                $image_path = $this->input->post("url");
                $image = $this->input->post("url");
                //echo "imagepath- old_url".$image_path;

            } else {
                $images = $this->banner_fileupload($_FILES['banner'], "banner");
                //$images=$this->profile_upload();
                $image = $images['file_name'];
                $image_path = "uploads/banner/" . $image;
                //echo "image path-file upload ".$image_path;

            }
            if ($image == "error") {
                $this->session->set_flashdata('error_message', "error occured");
                redirect(site_url("home/view_banner"), "refresh");
            } else {
                $data = array(
                    "heading1" => $heading1,
                    "heading2" => $heading2,
                    "link" => $link,
                    "slide_image" => $image_path
                );
                $res = $this->home_model->edit_banner($data, $id);
                if ($res === "0") {
                    $this->session->set_flashdata('flash_message', "updated");
                } else if ($res === "1") {
                    $this->session->set_flashdata('error_message', "error occured");
                }
                redirect(site_url("home/view_banner"), "refresh");
            }
        } else {
            $this->home_model->edit_banner($data, $id);
            $page_data['sliders'] = $this->home_model->get_banner();
            $page_data['page_name'] = "edit_banner";
            $page_data['page_title'] = "Edit Banner";
            $this->load->view("backend/index", $page_data);
        }
    }


    public function add_product()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        if (isset($_POST['pro_name'])) {
            $pro_name = $this->input->post("pro_name");
            $description = $this->input->post("description");
            $quantity = $this->input->post("quantity");
            $price = $this->input->post("price");
            $sp = $this->input->post("sp");
            $size = $this->input->post("size");
            $weight = $this->input->post("weight");
            $color = $this->input->post("color");
            $image = $this->input->post("image");


            if (!isset($_FILES['product']) || $_FILES['product']['error'] == UPLOAD_ERR_NO_FILE) {
                $image_path = $this->input->post("image");
                $image = $this->input->post("image");
            } else {
                $images = $this->product_fileupload($_FILES['product'], "product");
                //$images=$this->profile_upload();
                $image = $images['file_name'];
                $image_path = "uploads/product/" . $image;
            }
            if ($image == "error") {
                $this->session->set_flashdata('error_message', "error occured");
                redirect(site_url("home/add_product"), "refresh");
            } else {
                $data = array(
                    "pro_name" => $pro_name,
                    "pro_description" => $description,
                    "quantity" => $quantity,
                    "price" => $price,
                    "sp" => $sp,
                    "size_type" => $size,
                    "weight_type" => $weight,
                    "color" =>$color,
                    "prod_image" => $image_path
                );
                $res = $this->home_model->add_product($data);
                if ($res === "0") {
                    $this->session->set_flashdata('error_message', "Banner Already Added");
                    redirect(site_url('home/add_product'), 'refresh');
                } else if ($res === "1") {
                    $this->session->set_flashdata('flash_message', "Banner Added Successfully");
                    redirect(site_url('home/view_product'), 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', "Something Went Wrong. Please try after sometime");
                    redirect(site_url('home/add_product'), 'refresh');
                }
            }
        } else {

            $page_data['colour'] = $this->home_model->get_colour();
            $page_data['size'] = $this->home_model->get_size();
            $page_data['weights'] = $this->home_model->get_weights();
            $page_data['page_name'] = "add_product";
            $page_data['page_title'] = "Add Product";
            $this->load->view("backend/index", $page_data);
        }
    }

    public function view_product()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $page_data['product'] = $this->home_model->get_product();
        $page_data['page_name'] = "view_product";
        $page_data['page_title'] = "View Product";
        $this->load->view("backend/index", $page_data);
    }

    public function add_attributes()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);

        if (isset($_POST['size_type']) && $_POST['size_type']!="") {
            $size_type = $this->input->post("size_type");

            $data = array(
                "size_type" => $size_type
            );
            $res = $this->home_model->add_size($data);
            if ($res === "0") {
                $this->session->set_flashdata('flash_message', "added");
            } else if ($res === "1") {
                $this->session->set_flashdata('error_message', "error occured");
            }
            redirect(site_url("home/add_attributes"), "refresh");
        } else if (isset($_POST['color']) && $_POST['color']!="") {
            $color = $this->input->post("color");

            $data = array(
                "color" => $color
            );
            $res = $this->home_model->add_colour($data);
            if ($res === "0") {
                $this->session->set_flashdata('flash_message', "added");
            } else if ($res === "1") {
                $this->session->set_flashdata('error_message', "error occured");
            }
            redirect(site_url("home/add_attributes"), "refresh");
        } else if (isset($_POST['weight_type']) && $_POST['weight_type']!="") {
            $weight_type = $this->input->post("weight_type");

            $data = array(
                "weight_type" => $weight_type
            );
            $res = $this->home_model->add_weights($data);
            if ($res === "0") {
                $this->session->set_flashdata('flash_message', "added");
            } else if ($res === "1") {
                $this->session->set_flashdata('error_message', "error occured");
            }
            redirect(site_url("home/add_attributes"), "refresh");
        } else {
            $page_data['colour'] = $this->home_model->get_colour();
            $page_data['size'] = $this->home_model->get_size();
            $page_data['weights'] = $this->home_model->get_weights();
            $page_data['page_name'] = "add_attributes";
            $page_data['page_title'] = "Add Attributes";
            $this->load->view("backend/index", $page_data);
        }
    }

    /* public function add_attributess()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        if (isset($_POST['heading1'])) {
            $heading1 = $this->input->post("heading1");
            $heading2 = $this->input->post("heading2");
            $link = $this->input->post("link");

            if (!isset($_FILES['banner']) || $_FILES['banner']['error'] == UPLOAD_ERR_NO_FILE) {
                $image_path = $this->input->post("url");
                $image = $this->input->post("url");
            } else {
                $images = $this->banner_fileupload($_FILES['banner'], "banner");
                //$images=$this->profile_upload();
                $image = $images['file_name'];
                $image_path = "uploads/banner/" . $image;
            }
            if ($image == "error") {
                $this->session->set_flashdata('error_message', "error occured");
                redirect(site_url("home/add_banner"), "refresh");
            } else {
                $data = array(
                    "heading1" => $heading1,
                    "heading2" => $heading2,
                    "link" => $link,
                    "slide_image" => $image_path
                );
                $res = $this->home_model->add_banner($data);
                if ($res === "0") {
                    $this->session->set_flashdata('error_message', "Banner Already Added");
                    redirect(site_url('home/add_banner'), 'refresh');
                } else if ($res === "1") {
                    $this->session->set_flashdata('flash_message', "Banner Added Successfully");
                    redirect(site_url('home/view_banner'), 'refresh');
                } else {
                    $this->session->set_flashdata('error_message', "Something Went Wrong. Please try after sometime");
                    redirect(site_url('home/add_banner'), 'refresh');
                }
            }
        } else {
            $page_data['page_name'] = "add_banner";
            $page_data['page_title'] = "Add Banner";
            $this->load->view("backend/index", $page_data);
        }
    }*/

    public function add_vendor()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $page_data['page_name'] = "add_vendor";
        $page_data['page_title'] = "View Vendor";
        $this->load->view("backend/index", $page_data);
    }

    public function view_vendor()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $page_data['page_name'] = "view_vendor";
        $page_data['page_title'] = "View Vendor";
        $this->load->view("backend/index", $page_data);
    }

    public function add_suppliers()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $page_data['page_name'] = "add_supplier";
        $page_data['page_title'] = "Add Supplier";
        $this->load->view("backend/index", $page_data);
    }

    public function view_suppliers()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $page_data['page_name'] = "view_suppliers";
        $page_data['page_title'] = "View Suppliers";
        $this->load->view("backend/index", $page_data);
    }

    public function view_all_sales()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $page_data['page_name'] = "view_all_sales";
        $page_data['page_title'] = "View Sales";
        $this->load->view("backend/index", $page_data);
    }

    public function order_placed()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $page_data['page_name'] = "view_category";
        $page_data['page_title'] = "View Category";
        $this->load->view("backend/index", $page_data);
    }

    public function order_accepted()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $page_data['page_name'] = "view_category";
        $page_data['page_title'] = "View Category";
        $this->load->view("backend/index", $page_data);
    }

    public function order_delivered()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $user = $this->session->userdata("admin_data");
        $page_data['admin'] = $this->home_model->get_admin($user["admin_id"]);
        $page_data['page_name'] = "view_category";
        $page_data['page_title'] = "View Category";
        $this->load->view("backend/index", $page_data);
    }


    public function do_upload()
    {
        if (!$this->session->userdata("admin_user_logged_in")) {
            redirect(site_url("home/login"), "refresh");
        }
        $page_data['total_user'] = $this->home_model->get_users();
        $user = $this->session->userdata("admin_data");
    }
    public function logout()
    {
        $this->session->unset_userdata("admin_user_logged_in");
        redirect(site_url("home/login"), "refresh");
    }

    public function profile_fileupload($request, $object_name = "")
    {
        if ($request['size'] > 2097152) {
            return "error";
        } else {
            $file_tmp = $request['tmp_name'];
            $file_name = $request['name'];
            $file_ext = substr($file_name, strpos($file_name, '.'));
            $Random_Number = rand(0, 99999999);
            $upload_name1 =  time() . $Random_Number . $file_ext;
            $actualpath = "uploads/profile/" . $upload_name1;

            $config['upload_path'] = './uploads/profile/';
            $config['file_name'] = $upload_name1;
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['max_size'] = 2048;
            $config['overwrite'] = 1;
            $this->load->library('upload', $config); //Load the libary with the configuration

            if (!$this->upload->do_upload($object_name)) {
                return "error";
            } else {
                $p = $this->upload->data();
                return $p;
            }
        }
    }

    public function product_fileupload($request, $object_name = "")
    {
        if ($request['size'] > 2097152) {
            return "error";
        } else {
            $file_tmp = $request['tmp_name'];
            $file_name = $request['name'];
            $file_ext = substr($file_name, strpos($file_name, '.'));
            $Random_Number = rand(0, 99999999);
            $upload_name1 =  time() . $Random_Number . $file_ext;
            $actualpath = "uploads/product/" . $upload_name1;

            $config['upload_path'] = './uploads/product/';
            $config['file_name'] = $upload_name1;
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['max_size'] = 2048;
            $config['overwrite'] = 1;
            $this->load->library('upload', $config); //Load the libary with the configuration

            if (!$this->upload->do_upload($object_name)) {
                return "error";
            } else {
                $p = $this->upload->data();
                return $p;
            }
        }
    }


    public function banner_fileupload($request, $object_name = "")
    {
        if ($request['size'] > 2097152) {
            return "error";
        } else {
            $file_tmp = $request['tmp_name'];
            $file_name = $request['name'];
            $file_ext = substr($file_name, strpos($file_name, '.'));
            $Random_Number = rand(0, 99999999);
            $upload_name1 =  time() . $Random_Number . $file_ext;
            $actualpath = "uploads/banner/" . $upload_name1;

            $config['upload_path'] = './uploads/banner/';
            $config['file_name'] = $upload_name1;
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['max_size'] = 2048;
            $config['overwrite'] = 1;
            $this->load->library('upload', $config); //Load the libary with the configuration

            if (!$this->upload->do_upload($object_name)) {
                return "error";
            } else {
                $p = $this->upload->data();
                return $p;
            }
        }
    }
}
