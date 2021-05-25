<?php defined('BASEPATH') or exit('No direct script access allowed');
class Home_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function login($data)
    {
        $this->db->where("email", $data['email']);
        $this->db->where("password", $data['password']);
        $res = $this->db->get("admin");
        if ($res->num_rows() > 0) {
            $row = $res->row_array();
            $this->session->set_userdata("admin_user_logged_in", true);
            $this->session->set_userdata("admin_data", $row);
            $this->session->set_flashdata("flash_message", "Welcome to " . $this->config->item("Website_title"));
            return true;
        } else {
            $this->session->set_flashdata("error_message", "Invalid Login credentials. Please check email and password");
            return false;
        }
    }
    public function get_users()
    {
        $this->db->from("user");
        $count = $this->db->count_all_results();
        return $count;
    }
    public function email_verification($email = "")
    {
        $this->db->where("email", $email);
        $res = $this->db->get("admin");
        if ($res->num_rows() > 0) {
            //write email function and otp generation
            $otp = random_string("alnum", 6);
            $data = array("email" => $email, "otp" => $otp);
            $this->db->where("email", $data['email']);
            $res1 = $this->db->get("user_otp");
            if ($res1->num_rows() == 1) {
                $this->db->where("email", $data['email']);
                $this->db->update("user_otp", $data);
            } else {
                $this->db->insert("user_otp", $data);
            }
            return $otp;
        } else {
            return false;
        }
    }

    public function get_admin($id = "")
    {

        $this->db->where("admin_id", $id);
        $res = $this->db->get("admin");

        $name = $res->row_array();
        return $name;
    }

    public function insert()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }
    public function fetchtable()
    {
        $this->db->select("admin_id,email,firstname");
        $this->db->from('admin');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_category()
    {
        $this->db->order_by("cat_id", "DESC");
        $res = $this->db->get("category");
        if ($res->num_rows() > 0) {
            $row = $res->result_array();
        } else {
            $row = [];
        }
        return $row;
    }

    public function add_category($data)
    {
        $this->db->where("cat_name", $data['cat_name']);
        $res = $this->db->get("category");
        if ($res->num_rows() > 0) {
            return "0"; // Category Already Added
        } else {
            $this->db->insert("category", $data);
            if ($this->db->affected_rows() > 0) {
                return "1"; // Category Added
            } else {
                return "2"; // Please try after sometime
            }
        }
    }

    public function edit_category($data ,$cat_id)
    {
        $this->db->where("cat_id", $cat_id);
        $this->db->update("category", $data);

        if ($this->db->affected_rows() > 0) {
            return 0; 
        } else {
            return 1; 
        }

    }

    public function edit_banner($data ,$id)
    {
        $this->db->where("id", $id);
        $this->db->update("sliders", $data);

        if ($this->db->affected_rows() > 0) {
            return 0; 
        } else {
            return 1; 
        }

    }

    public function delete_category($id)
    {
        $this->db->where("cat_id",$id);
        $this->db->delete("category");
        if ($this->db->affected_rows() > 0) {
            return true; 
        } else {
            return false; 
        }

    }
    public function update_profile($data, $admin_id)
    {
        $this->db->where("admin_id", $admin_id);
        $this->db->update("admin", $data);
    }
    public function add_banner($data)
    {
        $this->db->insert("sliders", $data);
        if ($this->db->affected_rows() > 0) {
            return "1"; // Category Added
        } else {
            return "2"; // Please try after sometime
        }
    }
    public function get_banner()
    {
        $this->db->order_by("id", "DESC");
        $res = $this->db->get("sliders");
        if ($res->num_rows() > 0) {
            $row = $res->result_array();
        } else {
            $row = [];
        }
        return $row;
    }


    public function delete_banner($id)
    {
        {
            $this->db->where("id",$id);
            $this->db->delete("sliders");
            if ($this->db->affected_rows() > 0) {
                return true; 
            } else {
                return false; 
            }
    
        }
    }


    public function get_colour()
    {
        $this->db->order_by("pro_color_id", "ASC");
        $res = $this->db->get("colors");
        if ($res->num_rows() > 0) {
            $row = $res->result_array();
        } else {
            $row = [];
        }
        return $row;  
    }

    public function get_size()
    {
        $this->db->order_by("s_id", "ASC");
        $res = $this->db->get("size");
        if ($res->num_rows() > 0) {
            $row = $res->result_array();
        } else {
            $row = [];
        }
        return $row;  
    }

    public function get_weights()
    {
        $this->db->order_by("wt_id", "ASC");
        $res = $this->db->get("weights");
        if ($res->num_rows() > 0) {
            $row = $res->result_array();
        } else {
            $row = [];
        }
        return $row;  
    }


    public function add_size($data)
    {
        $this->db->insert("size", $data);
        if ($this->db->affected_rows() > 0) {
            return "1"; // Category Added
        } else {
            return "2"; // Please try after sometime
        }
    }

    public function add_colour($data)
    {
        $this->db->insert("colors", $data);
        if ($this->db->affected_rows() > 0) {
            return "1"; // Category Added
        } else {
            return "2"; // Please try after sometime
        }
    }

    public function add_weights($data)
    {
        $this->db->insert("weights", $data);
        if ($this->db->affected_rows() > 0) {
            return "1"; // Category Added
        } else {
            return "2"; // Please try after sometime
        }
    }
    public function add_product($data)
    {
        $this->db->where("pro_name", $data['pro_name']);
        $res = $this->db->get("product_details");
        if ($res->num_rows() > 0) {
            return "0"; // Category Already Added
        } else {
            $this->db->insert("product_details", $data);
            if ($this->db->affected_rows() > 0) {
                return "1"; // Category Added
            } else {
                return "2"; // Please try after sometime
            }
        }
    }


    public function get_product()
    {
        $this->db->order_by("pro_id", "DESC");
        $res = $this->db->get("product_details");
        if ($res->num_rows() > 0) {
            $row = $res->result_array();
        } else {
            $row = [];
        }
        return $row;
    }

}

