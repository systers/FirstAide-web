<?php
if (Utils::getPageProperty($page['type'], Utils::PROPERTY_MENU)) {
    $menu = array();
    $menu['items'][] = array(
    'type' => 'logo',
    'img_src' => 'images/logo.png',
    'text' => 'Home',
    'url' => HOST
    );
    $menu['items'][] = array(
    'text' => 'Get Help Now',
    'url' => HOST.'p/get-help-now'
    );
    $menu['items'][] = array(
    'text' => 'Circle of Trust',
    'url' => HOST.'p/circle-of-trust'
    );
    $menu['items'][] = array(
    'text' => 'Safety Tools',
    'url' => HOST.'p/safety-tools',
    'sub_menu' => array(
        array(
            'text' => 'Personal Security Strategies',
            'url' => HOST.'p/xyz'
        ),
        array(
            'text' => 'RADAR',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_RADAR)
        ),
        array(
            'text' => 'Coping with Unwanted Strategies',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_UNWANTED_ATTENTION)
        ),
        array(
            'text' => 'Commonalities of Sexual Predators',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_SEXUAL_PREDATORS)
        ),
        array(
            'text' => 'Bystander Intervention',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_BYSTANDER_INTERVENTION)
        ),
        array(
            'text' => 'Safety Plan Basics',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_SAFETY_PLAN_BASICS)
        ),
        array(
            'text' => 'Safety Plan Worksheet',
            'url' => HOST.'p/xyz'
        )
    )
    );
    $menu['items'][] = array(
    'text' => 'Support Services',
    'url' => HOST.'p/support-services',
    'sub_menu' => array(
        array(
            'text' => 'Benefits of Seeking Staff Support',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_SEEKING_STAFF_SUPPORT)
        ),
        array(
            'text' => 'Available Services after a Sexual Assault',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_SERVICES_AFTER_ASSAULT)
        ),
        array(
            'text' => 'Peace Corps Commitment to Victims of Sexual Assualt',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_PEACE_CORPS_COMMITMENT)
        ),
        array(
            'text' => 'What to do After an Assault',
            'url' => HOST.'p/xyz'
        ),
        array(
            'text' => 'Confidentiality',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_CONFIDENTIALITY)
        ),
        array(
            'text' => 'Peace Corps Mythbusters',
            'url' => HOST.'p/xyz'
        )
    )
    );
    $menu['items'][] = array(
    'text' => 'Sexual Assault Awareness',
    'url' => HOST.'p/sexual-assault-awareness',
    'sub_menu' => array(
        array(
            'text' => 'Was it Sexual Assault',
            'url' => HOST.'p/xyz'
        ),
        array(
            'text' => 'Sexual Assault Common Questions',
            'url' => HOST.'p/xyz'
        ),
        array(
            'text' => 'Impact of Sexual Assault',
            'url' => HOST.'p/xyz'
        ),
        array(
            'text' => 'Sexual Harassment',
            'url' => HOST.'p/xyz'
        ),
        array(
            'text' => 'Helping a Friend or a Community Member',
            'url' => HOST.'p/xyz'
        )
    )
    );
    $menu['items'][] = array(
    'text' => 'Policies and Glossary',
    'url' => HOST.'p/policies-and-glossary',
    'sub_menu' => array(
        array(
            'text' => 'Peace Corps Policy Summary Sheet',
            'url' => HOST.'p/xyz'
        ),
        array(
            'text' => 'Glossary',
            'url' => HOST.'p/xyz'
        ),
        array(
            'text' => 'Further Resources',
            'url' => HOST.'p/xyz'
        )
    )
    );
    $menu['items'][] = array(
    'text' => 'Settings',
    'url' => HOST.'settings'
    );
    $menu['items'][] = array(
    'text' => 'Logged in as: Username',
    'url' => HOST.'p/settings'
    );
    $menu['items'][] = array(
    'text' => 'Logout',
    'url' => HOST.'logout'
    );

    $page['menu'] = $menu;
    $page['javascripts'][] = 'menu.js';
}
