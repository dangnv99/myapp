<?php
class UserController extends BaseController
{
    /**
     * "/fb_pixels/list"
     */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();

                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }

                $arrUsers = $userModel->getUsers($intLimit);
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    //
    public function DetailAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        //$arrQueryStringParams = $this->validate_query_params();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();

                $arrUsers = $userModel->getDetail($_GET['shop'], $_GET['pixel_id']);
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }


    // Delete

    public function DeleteAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        //$arrQueryStringParams = $this->validate_query_params();

        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();
                $arrUsers = $userModel->postDelete($_GET['shop'], $_GET['pixel_id']);
                if ($arrUsers->query($arrUsers) === TRUE) {
                    echo "Record deleted successfully";
                } else {
                    echo "Error deleting record: " . $userModel->error;
                }
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }


    //
    public function CreateAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();
                $id =  mt_rand(10000000, 999999999);
                //echo $id . "\n\r";
                $shop = isset($_POST['shop']) ? $_POST['shop'] : "null";
                $pixel_id = isset($_POST['pixel_id']) ? $_POST['pixel_id'] : "null";
                $pixel_title = isset($_POST['pixel_title']) ? $_POST['pixel_title'] : "null";
                $status = isset($_POST['status']) ? $_POST['status'] : 0;
                $is_master = isset($_POST['is_master']) ? $_POST['is_master'] : "new";
                $is_conversion_api = isset($_POST['is_conversion_api']) ? $_POST['is_conversion_api'] : "";
                $access_token = isset($_POST['access_token']) ? $_POST['access_token'] : "";
                // $created_at = isset($_POST['created_at']) ? $_POST['created_at'] : "";
                // $updated_at = isset($_POST['updated_at']) ? $_POST['updated_at'] : "";

                $arrUsers = $userModel->postCreate($id, $shop, $pixel_id, $pixel_title, $status, $is_master, $is_conversion_api, $access_token);

                if ($arrUsers) {
                    $arrdata = $userModel->getReturn($id);
                    //var_dump($arrdata);
                    $this->responseHandler($code = 200, $status = 'success', $arrdata);
                } else {
                    echo "Error deleting record: " . $userModel->error;
                }
                //echo $id;
                $responseData = "";
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong!.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }


    //Update
    public function UpdateAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UserModel();
                $data = implode(",", array_keys($_POST));
                $data_ = implode(",", array_values($_POST));
                die;
                $id = $_POST['id'];
                $shop = isset($_POST['shop']) ? $_POST['shop'] : "null";
                $pixel_id = isset($_POST['pixel_id']) ? $_POST['pixel_id'] : "null";
                $pixel_title = isset($_POST['pixel_title']) ? $_POST['pixel_title'] : "null";
                $status = isset($_POST['status']) ? $_POST['status'] : 0;
                $is_master = isset($_POST['is_master']) ? $_POST['is_master'] : "new";
                $is_conversion_api = isset($_POST['is_conversion_api']) ? $_POST['is_conversion_api'] : "";
                $access_token = isset($_POST['access_token']) ? $_POST['access_token'] : "";
                $updated_at = time();
                foreach ($_POST as $key => $val) {
                    if ($val == null) {
                    } else if (is_numeric($val)) {
                        $val = $val;
                    } elseif ($val == 'true' || $val == 'false') {
                        $val .= $val;
                    }
                }
                $arrUsers = $userModel->postUpdate($data, $data_);

                // if ($arrUsers->query($arrUsers) === TRUE) {
                //     echo "Record deleted successfully";
                // } else {
                //     echo "Error deleting record: " . $userModel->error;
                // }
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                // $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}
