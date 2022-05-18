<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class UserModel extends Database
{
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM fb_pixels ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }

    public function getDetail($shop, $pixel_id)
    {

        return $this->select("SELECT * FROM fb_pixels where shop  = $shop && pixel_id = $pixel_id");;
    }
    //
    public function getReturn($id)
    {
        return $this->select("SELECT * FROM fb_pixels where id = $id");
    }

    //
    public function postDelete($shop, $pixel_id)
    {
        return $this->select("DELETE  * FROM fb_pixels where shop = $shop && pixel_id = $pixel_id");;
    }

    public function postCreate($id, $shop, $pixel_id, $pixel_title, $status, $is_master, $is_conversion_api, $access_token)
    {
        return $this->create("INSERT INTO fb_pixels (id, shop, pixel_id, pixel_title, status, is_master, is_conversion_api, access_token) VALUES ('$id', '$shop', '$pixel_id', '$pixel_title', $status, $is_master, $is_conversion_api, '$access_token')");;
    }

    public function postUpdate($data, $data_)
    {
        return $this->update("INSERT INTO fb_pixels ($data) VALUES ($data_)");;
    }
}
