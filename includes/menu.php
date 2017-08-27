<?php
if (FirstAide\Utils::getPageProperty($page['type'], FirstAide\Utils::PROPERTY_MENU)) {
    $menu = array();
    $menu['items'][] = array(
        'type' => 'logo',
        'img_src' => 'images/logo.png',
        'text' => 'Home',
        'url' => HOST
    );
    $menu['items'][] = array(
        'text' => 'Get Help Now',
        'url' => FirstAide\Router::getPageUrl(
            FirstAide\Router::HOME,
            FirstAide\Router::PAGE_GET_HELP_NOW
        )
    );
    $menu['items'][] = array(
        'text' => 'Circle of Trust',
        'url' => FirstAide\Router::getPageUrl(
            FirstAide\Router::HOME,
            FirstAide\Router::PAGE_CIRCLE_OF_TRUST
        )
    );
    $menu['items'][] = array(
        'text' => 'Safety Tools',
        'url' => HOST.'p/safety-tools',
        'sub_menu' => array(
            array(
                'text' => 'Personal Security Strategies',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_ADDED_SOON
                )
            ),
            array(
                'text' => 'RADAR',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_RADAR
                )
            ),
            array(
                'text' => 'Coping with Unwanted Strategies',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_UNWANTED_ATTENTION
                )
            ),
            array(
                'text' => 'Commonalities of Sexual Predators',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_SEXUAL_PREDATORS
                )
            ),
            array(
                'text' => 'Bystander Intervention',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_BYSTANDER_INTERVENTION
                )
            ),
            array(
                'text' => 'Safety Plan Basics',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_SAFETY_PLAN_BASICS
                )
            ),
            array(
                'text' => 'Safety Plan Worksheet',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_SAFETY_PLAN_WORKSHEET
                )
            )
        )
    );
    $menu['items'][] = array(
        'text' => 'Support Services',
        'url' => HOST.'p/support-services',
        'sub_menu' => array(
            array(
                'text' => 'Benefits of Seeking Staff Support',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_SEEKING_STAFF_SUPPORT
                )
            ),
            array(
                'text' => 'Available Services after a Sexual Assault',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_SERVICES_AFTER_ASSAULT
                )
            ),
            array(
                'text' => 'Peace Corps Commitment to Victims of Sexual Assualt',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_PEACE_CORPS_COMMITMENT
                )
            ),
            array(
                'text' => 'What to do After an Assault',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_ADDED_SOON
                )
            ),
            array(
                'text' => 'Confidentiality',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_CONFIDENTIALITY
                )
            ),
            array(
                'text' => 'Peace Corps Mythbusters',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_MYTHBUSTERS
                )
            )
        )
    );
    $menu['items'][] = array(
        'text' => 'Sexual Assault Awareness',
        'url' => HOST.'p/sexual-assault-awareness',
        'sub_menu' => array(
            array(
                'text' => 'Was it Sexual Assault',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_SEXUAL_ASSAULT
                )
            ),
            array(
                'text' => 'Sexual Assault Common Questions',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_COMMON_QUESTIONS
                )
            ),
            array(
                'text' => 'Impact of Sexual Assault',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_IMPACT_OF_ASSAULT
                )
            ),
            array(
                'text' => 'Sexual Harassment',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_SEXUAL_HARASSMENT
                )
            ),
            array(
                'text' => 'Helping a Friend or a Community Member',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_HELP_A_FRIEND
                )
            )
        )
    );
    $menu['items'][] = array(
        'text' => 'Policies and Glossary',
        'url' => HOST.'p/policies-and-glossary',
        'sub_menu' => array(
            array(
                'text' => 'Peace Corps Policy Summary Sheet',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_POLICY_SUMMARY
                )
            ),
            array(
                'text' => 'Glossary',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_GLOSSARY
                )
            ),
            array(
                'text' => 'Further Resources',
                'url' => FirstAide\Router::getPageUrl(
                    FirstAide\Router::HOME,
                    FirstAide\Router::PAGE_FURTHER_RESOURCES
                )
            )
        )
    );
    $menu['items'][] = array(
        'text' => 'Settings',
        'url' => FirstAide\Router::getPageUrl(
            FirstAide\Router::HOME,
            FirstAide\Router::PAGE_SETTINGS
        )
    );

    $user_name = 'Username';
    if (isset($UserObj)) {
        $user_name =  $UserObj->getName() != ''
            ? $UserObj->getName() : $user_name;
    }

    $menu['items'][] = array(
        'text' => 'Logged in as: ' . $user_name,
        'url' => FirstAide\Router::getPageUrl(
            FirstAide\Router::HOME,
            FirstAide\Router::PAGE_SETTINGS
        )
    );
    $menu['items'][] = array(
        'elementId' => 'logout',
        'text' => 'Logout',
        'url' => '#'
    );

    $page['menu'] = $menu;
    $page['javascripts'][] = 'menu.js';
}
