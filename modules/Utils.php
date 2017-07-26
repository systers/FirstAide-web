<?php
namespace FirstAide;

use Twig;

class Utils
{
    const PROPERTY_MENU = 'menu';
        
    public static function getTwig($twigFile, $data = array())
    {
        $twigLoader = new \Twig_Loader_Filesystem('template');
        $Twig = new \Twig_Environment($twigLoader, array(
            'cache' => 'cache',
        ));
        $template = $Twig->loadTemplate($twigFile);

        return $template->render($data);
    }

    public static function getPageProperty($page, $property)
    {
        $propertyMenuArray = array(
            Router::HOME
        );
        if ($property == self::PROPERTY_MENU && in_array($page, $propertyMenuArray)) {
            return true;
        }
        return false;
    }

    public static function jsonify($response)
    {
        ob_clean();
        header("Content-Type: application/json");
        echo json_encode($response);
        exit(0);
    }

    public static function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
