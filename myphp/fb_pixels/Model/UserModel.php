<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class UserModel extends Database
{
    // Get list
    public function getUsers($limit)
    {
        //echo $limit;
        return $this->select("SELECT * FROM fb_pixels ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }
    // Get Detail
    public function getDetail($shop, $pixel_id)
    {

        return $this->select("SELECT * FROM fb_pixels where shop  = $shop && pixel_id = $pixel_id");;
    }
    //Return
    public function getReturn($id)
    {
        return $this->select("SELECT * FROM fb_pixels where id = $id");
    }

    // Post Delete
    public function postDelete($shop, $pixel_id)
    {
        return $this->select("DELETE  * FROM fb_pixels where shop = $shop && pixel_id = $pixel_id");;
    }
    // Post Create
    public function postCreate($id, $shop, $pixel_id, $pixel_title, $status, $is_master, $is_conversion_api, $access_token)
    {
        return $this->create("INSERT INTO fb_pixels (id, shop, pixel_id, pixel_title, status, is_master, is_conversion_api, access_token) VALUES ('$id', '$shop', '$pixel_id', '$pixel_title', $status, $is_master, $is_conversion_api, '$access_token')");;
    }
    //Post Update
    public function postUpdate($id, $data)
    {
        //echo $data->id;
        //var_dump($data);
        return $this->update("UPDATE  fb_pixels SET $data where id = $id");;
    }
}
