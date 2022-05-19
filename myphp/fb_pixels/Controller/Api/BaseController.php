<?php
class BaseController
{
    /**
     * __call magic method.
     */
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }

    /**
     * Get URI elements.
     */
    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);
        return $uri;
    }


    /**
     * Get querystring params.
     */
    protected function getQueryStringParams()
    {
        return parse_str($_SERVER['QUERY_STRING'], $query);
    }


    /**
     * Send Error.
     */
    protected function sendOutput($data, $httpHeaders = array())
    {
        header_remove('Set-Cookie');

        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
        //echo $data;
        exit;
    }


    function responseHandler($code = 200, $status = 'success', $payload = null)
    {
        http_response_code($code);
        $response = [
            "code" => $code,
            "status" => $status,
        ];
        //var_dump($payload);
        if (isset($payload)) {
            foreach ($payload as $key => $value) {
                if ($status === 'success') {
                    $response['data'][$key] = $value;
                } else {
                    $response['error'][$key] =  $value;
                }
            }
        }
        if (isset($response['error'])) {
            $response['exception']  = "List array errors";
        }
        echo json_encode($response);
    }

    protected function checkData($data, $option)
    {
        $check = 0;
        $object = new stdClass();

        foreach ($data as $key => $val) {
            if ($option === 1) {
                //echo 1 . "\n\r";
                if (isset($_POST['shop']) && $key == 'shop' && ($val == null || empty($val) || $val === '')) {
                    //$data['shop']   = "The Shop field is required!";
                    $errors_shop = array();
                    $errors_shop = array_merge($errors_shop, array('The Shop field is required!'));
                    $object->shop = $errors_shop;
                    //echo array_values($data)[$n] . "\n\r";
                }
                if (isset($_POST['pixel_id']) && $key == 'pixel_id' && ($val == null || empty($val) || $val === '')) {
                    $errors_shop = array();
                    $errors_shop = array_merge($errors_shop, array('The Shop field is required!'));
                    $object->pixel_id = $errors_shop;
                }
                if (isset($_POST['pixel_title']) && $key == 'pixel_title' && ($val == null || empty($val) || $val === '')) {

                    $errors_shop = array();
                    $errors_shop = array_merge($errors_shop, array('The Shop field is required!'));
                    $object->pixel_title = $errors_shop;
                }
                if (isset($_POST['access_token']) && $key == 'access_token' && ($val == null || empty($val) || $val === '')) {
                    $errors_shop = array();
                    $errors_shop = array_merge($errors_shop, array('The Shop field is required!'));
                    $object->pixel_title = $errors_shop;
                }
            }

            if ($option === 0) {
                if (isset($_POST['id']) && $key == 'id' && ($val == null || empty($val) || $val === '')) {

                    $errors_shop = array();
                    $errors_shop = array_merge($errors_shop, array('The Shop field is required!'));
                    $object->id = $errors_shop;
                }
            }
        }
        return $object;
    }
}
