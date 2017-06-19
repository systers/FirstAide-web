<?php
if (Utils::getPageProperty($page['type'], Utils::PROPERTY_MENU)) {
    $menu = array();
    $menu['items'][] = array(
    'type' => 'logo',
    'img_src' => 'images/logo.png',
    'text' => 'Home',
    'url' => Router::getPageUrl(Router::HOME, Router::PAGE_ADDED_SOON)
    );
    $menu['items'][] = array(
    'text' => 'Get Help Now',
    'url' => Router::getPageUrl(Router::HOME, Router::PAGE_ADDED_SOON)
    );
    $menu['items'][] = array(
    'text' => 'Circle of Trust',
    'url' => Router::getPageUrl(Router::HOME, Router::PAGE_CIRCLE_OF_TRUST)
    );
    $menu['items'][] = array(
    'text' => 'Safety Tools',
    'url' => HOST.'p/safety-tools',
    'sub_menu' => array(
        array(
            'text' => 'Personal Security Strategies',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_ADDED_SOON)
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
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_SAFETY_PLAN_WORKSHEET)
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
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_ADDED_SOON)
        ),
        array(
            'text' => 'Confidentiality',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_CONFIDENTIALITY)
        ),
        array(
            'text' => 'Peace Corps Mythbusters',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_MYTHBUSTERS)
        )
    )
    );
    $menu['items'][] = array(
    'text' => 'Sexual Assault Awareness',
    'url' => HOST.'p/sexual-assault-awareness',
    'sub_menu' => array(
        array(
            'text' => 'Was it Sexual Assault',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_SEXUAL_ASSAULT)
        ),
        array(
            'text' => 'Sexual Assault Common Questions',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_COMMON_QUESTIONS)
        ),
        array(
            'text' => 'Impact of Sexual Assault',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_IMPACT_OF_ASSAULT)
        ),
        array(
            'text' => 'Sexual Harassment',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_SEXUAL_HARASSMENT)
        ),
        array(
            'text' => 'Helping a Friend or a Community Member',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_HELP_A_FRIEND)
        )
    )
    );
    $menu['items'][] = array(
    'text' => 'Policies and Glossary',
    'url' => HOST.'p/policies-and-glossary',
    'sub_menu' => array(
        array(
            'text' => 'Peace Corps Policy Summary Sheet',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_POLICY_SUMMARY)
        ),
        array(
            'text' => 'Glossary',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_GLOSSARY)
        ),
        array(
            'text' => 'Further Resources',
            'url' => Router::getPageUrl(Router::HOME, Router::PAGE_FURTHER_RESOURCES)
        )
    )
    );
    $menu['items'][] = array(
    'text' => 'Settings',
    'url' => Router::getPageUrl(Router::HOME, Router::PAGE_ADDED_SOON)
    );
    $menu['items'][] = array(
    'text' => 'Logged in as: Username',
    'url' => Router::getPageUrl(Router::HOME, Router::PAGE_ADDED_SOON)
    );
    $menu['items'][] = array(
    'text' => 'Logout',
    'url' => Router::getPageUrl(Router::HOME, Router::PAGE_ADDED_SOON)
    );

    $page['menu'] = $menu;
    $page['javascripts'][] = 'menu.js';
}
