<?php
namespace FirstAide;

class Router
{
    const PAGE_REQUEST_PARAM = 'page_request';
    const PAGE_CONTENT = 'query';

    const INDEX = 'index';
    const HOME = 'home';

    const PAGE_ADDED_SOON = 'added-soon';
    const PAGE_SEEKING_STAFF_SUPPORT = 'seeking-staff-support';
    const PAGE_SERVICES_AFTER_ASSAULT = 'services-after-assault';
    const PAGE_PEACE_CORPS_COMMITMENT = 'peace-corps-commitment';
    const PAGE_CONFIDENTIALITY = 'confidentiality';
    const PAGE_RADAR = 'radar';
    const PAGE_SEXUAL_PREDATORS = 'sexual-predators';
    const PAGE_SAFETY_PLAN_BASICS = 'safety-plan-basics';
    const PAGE_UNWANTED_ATTENTION = 'unwanted-attention';
    const PAGE_BYSTANDER_INTERVENTION = 'bystander-intervention';
    const PAGE_COMMON_QUESTIONS = 'common-questions';
    const PAGE_SAFETY_PLAN_WORKSHEET = 'safety-plan-worksheet';
    const PAGE_SEXUAL_ASSAULT = 'sexual-assault';
    const PAGE_SEXUAL_ASSAULT_MORE = 'sexual-assault-more';
    const PAGE_GLOSSARY = 'glossary';
    const PAGE_POLICY_SUMMARY = 'policy-summary';
    const PAGE_FURTHER_RESOURCES = 'further-resources';
    const PAGE_IMPACT_OF_ASSAULT = 'impact-of-assault';
    const PAGE_HELP_A_FRIEND = 'help-a-friend';
    const PAGE_MYTHBUSTERS = 'mythbusters';
    const PAGE_SEXUAL_HARASSMENT = 'sexual-harassment';
    const PAGE_CIRCLE_OF_TRUST = 'circle-of-trust';
    const PAGE_GET_HELP_NOW = 'get-help-now';

    const COUNTRY_LIST_FILE = '/javascripts/country_list.json';
    const LOGIN_SUCCESS_URL = HOST.'?page_request='.self::HOME;
        
    public static function getPage($page, $query = '')
    {
        global $APPLICATION_DIR, $UserObj;

        $out = array(
            'found' => true,
            'javascripts' => array(
                'jquery-3.2.1.min.js',
                'semantic.min.js'
            )
        );
        switch ($page) {
            case self::HOME:
                $out['type'] = self::HOME;
                $out['title'] = "Home";
                $out['template'] = "dashboard.html";
                $out['content'] = array();
                switch ($query) {
                    case self::PAGE_SEEKING_STAFF_SUPPORT:
                        $out['content']['template'] = 'full_page_card.html';
                        $out['content']['data'] = array(
                            'title' => 'Benefits of Seeking Staff Support',
                            'card_content' => array(
                                'twig' => 'seeking_staff_support.html'
                            )
                        );
                        break;

                    case self::PAGE_SEXUAL_ASSAULT:
                        $out['content']['template'] = 'full_page_card.html';
                        $out['content']['data'] = array(
                            'title' => 'What is Sexual Assault?',
                            'bottom_button' => array(
                                'text' => 'Know more About Sexual Assault',
                                'link' => self::getPageUrl(self::HOME, self::PAGE_SEXUAL_ASSAULT_MORE)
                            ),
                            'card_content' => array(
                                'twig' => 'sexual_assault.html'
                            )
                        );
                        break;

                    case self::PAGE_SEXUAL_HARASSMENT:
                        $out['content']['template'] = 'full_page_card.html';
                        $out['content']['data'] = array(
                            'title' => 'Sexual Harassment',
                            'card_content' => array(
                                'twig' => 'sexual_harassment.html'
                            )
                        );
                        break;

                    case self::PAGE_SEXUAL_ASSAULT_MORE:
                        $out['content']['template'] = 'full_page_card.html';
                        $out['content']['data'] = array(
                            'title' => 'What is Sexual Assault?',
                            'card_content' => array(
                                'twig' => 'sexual_assault_more.html'
                            )
                        );
                        break;

                    case self::PAGE_GLOSSARY:
                        $out['content']['template'] = 'full_page_card.html';
                        $out['content']['data'] = array(
                            'title' => 'Glossary',
                            'card_content' => array(
                                'class' => 'p0',
                                'twig' => 'glossary.html'
                            )
                        );
                        break;

                    case self::PAGE_POLICY_SUMMARY:
                        $out['content']['template'] = 'full_page_card.html';
                        $out['content']['data'] = array(
                            'title' => 'Peace Corps Policy Summary Sheet',
                            'card_content' => array(
                                'twig' => 'policy_summary.html'
                            )
                        );
                        break;

                    case self::PAGE_FURTHER_RESOURCES:
                        $out['content']['template'] = 'full_page_card.html';
                        $out['content']['data'] = array(
                            'title' => 'Further Resources',
                            'card_content' => array(
                                'twig' => 'further_resources.html'
                            )
                        );
                        break;

                    case self::PAGE_CIRCLE_OF_TRUST:
                        $comradesData = $UserObj->getCircleOfTrust() ?? array();
                        $comradesArray = explode(", ", $comradesData['comrade_details']);
                        for ($i = count($comradesArray); $i < User::COUNT_CIRCLE_OF_TRUST; $i++) {
                            $comradesArray[] = '';
                        }
                        $comradesArray = array_slice($comradesArray, 0, User::COUNT_CIRCLE_OF_TRUST);
                        $out['content']['template'] = 'circle_of_trust.html';
                        $out['content']['data'] = array(
                            'title' => 'Circle of Trust',
                            'comrades' => $comradesArray
                        );
                        $out['javascripts'][] = 'circle_of_trust.js';
                        break;

                    case self::PAGE_SERVICES_AFTER_ASSAULT:
                        $out['content']['template'] = 'multi_cards_page.html';
                        $out['content']['data'] = array(
                            'title' => 'Available Services after a Sexual Assault',
                            'show_card_count' => 2,
                            'cards_content' => array(
                                0 => array(
                                    'twig' => 'services_after_assault_1.html'
                                ),
                                1 => array(
                                    'twig' => 'services_after_assault_2.html'
                                ),
                                2 => array(
                                    'twig' => 'services_after_assault_3.html'
                                )
                            )
                        );
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_PEACE_CORPS_COMMITMENT:
                        $out['content']['template'] = 'full_page_card.html';
                        $out['content']['data'] = array(
                            'title' => 'Peace Corps Commitment to Victims of Sexual Assualt',
                            'card_content' => array(
                                'twig' => 'peace_corps_commitment.html'
                            )
                        );
                        break;

                    case self::PAGE_CONFIDENTIALITY:
                        $out['content']['template'] = 'full_page_card.html';
                        $out['content']['data'] = array(
                            'title' => 'Confidentiality',
                            'card_content' => array(
                                'twig' => 'confidentiality.html'
                            )
                        );
                        break;

                    case self::PAGE_GET_HELP_NOW:
                        $out['content']['template'] = 'page.html';
                        $out['content']['data'] = array(
                            'card_content' => array(
                                'twig' => 'get_help_now.html',
                                'data' => array(
                                    'title' => 'Get Help Now',
                                    'country_name' => $UserObj->getCurrentPostCountry(),
                                    'button_list' => array(
                                        0 => array(
                                            'title' => 'Contact Post Staff',
                                            'buttons' => array(
                                                0 => array(
                                                    'text' => 'Contact PCMO',
                                                    'id' => 'pcmo'
                                                ),
                                                1 => array(
                                                    'text' => 'Contact SSM',
                                                    'id' => 'ssm'
                                                ),
                                                2 => array(
                                                    'text' => 'Contact SARL',
                                                    'id' => 'sarl'
                                                )
                                            )
                                        ),
                                        1 => array(
                                            'title' => 'Contact Other Staff',
                                            'buttons' => array(
                                                0 => array(
                                                    'text' => 'PC Saves Anonymous Helpline',
                                                    'id' => 'anonymous-helpline',
                                                    'content_container' => Utils::getTwig(
                                                        'partial/get_help_now/anonymous_helpline.html'
                                                    )
                                                ),
                                                1 => array(
                                                    'text' => 'Office of Victim Advocacy',
                                                    'id' => 'victim-advocacy',
                                                    'content_container' => Utils::getTwig(
                                                        'partial/get_help_now/victim_advocacy.html'
                                                    )
                                                ),
                                                2 => array(
                                                    'text' => 'Office of Inspector General',
                                                    'id' => 'inspector-general',
                                                    'content_container' => Utils::getTwig(
                                                        'partial/get_help_now/inspector_general.html'
                                                    )
                                                ),
                                                3 => array(
                                                    'text' => 'Office of Civil Rights and Diversity',
                                                    'id' => 'civil-rights',
                                                    'content_container' => Utils::getTwig(
                                                        'partial/get_help_now/civil_rights.html'
                                                    )
                                                )
                                            )
                                        )
                                    )
                                )
                            )
                        );
                        $out['javascripts'][] = 'get_help_now.js';
                        break;

                    case self::PAGE_RADAR:
                        $out['content']['template'] = 'multi_cards_page.html';
                        $out['content']['data'] = array(
                            'title' => 'RADAR',
                            'show_card_count' => 2,
                            'cards_content' => array(
                                0 => array(
                                    'twig' => 'radar_1.html'
                                ),
                                1 => array(
                                    'twig' => 'radar_2.html'
                                ),
                                2 => array(
                                    'twig' => 'radar_3.html'
                                ),
                                3 => array(
                                    'twig' => 'radar_4.html'
                                ),
                                4 => array(
                                    'twig' => 'radar_5.html'
                                ),
                                5 => array(
                                    'twig' => 'radar_6.html'
                                )
                            )
                        );
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_SEXUAL_PREDATORS:
                        $out['content']['template'] = 'multi_cards_page.html';
                        $out['content']['data'] = array(
                            'title' => 'Commonalities Of Sexual Predators',
                            'show_card_count' => 2,
                            'cards_content' => array(
                                0 => array(
                                    'twig' => 'sexual_predators_1.html'
                                ),
                                1 => array(
                                    'twig' => 'sexual_predators_2.html'
                                ),
                                2 => array(
                                    'twig' => 'sexual_predators_3.html'
                                )
                            )
                        );
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_IMPACT_OF_ASSAULT:
                        $out['content']['template'] = 'multi_cards_page.html';
                        $out['content']['data'] = array(
                            'title' => 'Impact Of Sexual Assault',
                            'show_card_count' => 3,
                            'class' => 'p0',
                            'cards_content' => array(
                                0 => array(
                                    'twig' => 'impact_of_assault/impact_1.html'
                                ),
                                1 => array(
                                    'twig' => 'impact_of_assault/impact_2.html'
                                ),
                                2 => array(
                                    'twig' => 'impact_of_assault/impact_3.html'
                                )
                            )
                        );
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_HELP_A_FRIEND:
                        $out['content']['template'] = 'multi_cards_page.html';
                        $out['content']['data'] = array(
                            'title' => 'Helping a Friend or Community Member',
                            'show_card_count' => 3,
                            'class' => 'p0',
                            'cards_content' => array(
                                0 => array(
                                    'twig' => 'helping_a_friend/help_1.html'
                                ),
                                1 => array(
                                    'twig' => 'helping_a_friend/help_2.html'
                                ),
                                2 => array(
                                    'twig' => 'helping_a_friend/help_3.html'
                                ),
                                3 => array(
                                    'twig' => 'helping_a_friend/help_4.html'
                                ),
                                4 => array(
                                    'twig' => 'helping_a_friend/help_5.html'
                                ),
                                5 => array(
                                    'twig' => 'helping_a_friend/help_6.html'
                                )
                            )
                        );
                        $out['javascripts'][] = 'multi_card.js';
                        break;


                    case self::PAGE_SAFETY_PLAN_BASICS:
                        $out['content']['template'] = 'multi_cards_page.html';
                        $out['content']['data'] = array(
                            'title' => 'Safety Plan Basics',
                            'show_card_count' => 2,
                            'cards_content' => array(
                                0 => array(
                                    'twig' => 'sexual_predators_1.html'
                                ),
                                1 => array(
                                    'twig' => 'sexual_predators_2.html'
                                ),
                                2 => array(
                                    'twig' => 'sexual_predators_3.html'
                                )
                            )
                        );
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_UNWANTED_ATTENTION:
                        $out['content']['template'] = 'multi_cards_page.html';
                        $out['content']['data'] = array(
                            'title' => 'Coping With Unwanted Attention Strategies',
                            'show_card_count' => 2,
                            'cards_content' => array(
                                0 => array(
                                    'twig' => 'unwanted_attention_1.html'
                                ),
                                1 => array(
                                    'twig' => 'unwanted_attention_2.html'
                                )
                            )
                        );
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_UNWANTED_ATTENTION:
                        $out['content']['template'] = 'multi_cards_page.html';
                        $out['content']['data'] = array(
                            'title' => 'Coping With Unwanted Attention Strategies',
                            'show_card_count' => 2,
                            'cards_content' => array(
                                0 => array(
                                    'twig' => 'unwanted_attention_1.html'
                                ),
                                1 => array(
                                    'twig' => 'unwanted_attention_2.html'
                                )
                            )
                        );
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_BYSTANDER_INTERVENTION:
                        $out['content']['template'] = 'multi_cards_page.html';
                        $out['content']['data'] = array(
                            'title' => 'Bystander Intervention',
                            'show_card_count' => 2,
                            'cards_content' => array(
                                0 => array(
                                    'twig' => 'bystander_intervention_1.html'
                                ),
                                1 => array(
                                    'twig' => 'bystander_intervention_2.html'
                                ),
                                2 => array(
                                    'twig' => 'bystander_intervention_3.html'
                                ),
                                3 => array(
                                    'twig' => 'bystander_intervention_4.html'
                                )
                            )
                        );
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_COMMON_QUESTIONS:
                        $out['content']['template'] = 'multi_segment_page.html';
                        $out['content']['data'] = array(
                            'title' => 'Sexual Assault Common Questions',
                            'show_card_count' => 2,
                            'cards_content' => array(
                                0 => array(
                                    'twig' => 'common_questions/ques_1.html'
                                ),
                                1 => array(
                                    'twig' => 'common_questions/ques_2.html'
                                ),
                                2 => array(
                                    'twig' => 'common_questions/ques_3.html'
                                ),
                                3 => array(
                                    'twig' => 'common_questions/ques_4.html'
                                ),
                                4 => array(
                                    'twig' => 'common_questions/ques_5.html'
                                )
                            )
                        );
                        $out['javascripts'][] = 'multi_segment.js';
                        break;

                    case self::PAGE_MYTHBUSTERS:
                        $out['content']['template'] = 'multi_segment_vertical.html';
                        $out['content']['data'] = array(
                            'title' => 'Peace Corps Mythbusters: Assumptions and Facts',
                            'show_card_count' => 2,
                            'cards_content' => array(
                                0 => array(
                                    'twig' => 'mythbusters/myth_1.html'
                                ),
                                1 => array(
                                    'twig' => 'mythbusters/myth_2.html'
                                ),
                                2 => array(
                                    'twig' => 'mythbusters/myth_3.html'
                                ),
                                3 => array(
                                    'twig' => 'mythbusters/myth_4.html'
                                ),
                                4 => array(
                                    'twig' => 'mythbusters/myth_5.html'
                                ),
                                5 => array(
                                    'twig' => 'mythbusters/myth_6.html'
                                ),
                                6 => array(
                                    'twig' => 'mythbusters/myth_7.html'
                                ),
                                7 => array(
                                    'twig' => 'mythbusters/myth_8.html'
                                ),
                                8 => array(
                                    'twig' => 'mythbusters/myth_9.html'
                                )
                            )
                        );
                        $out['javascripts'][] = 'multi_segment.js';
                        break;

                    case self::PAGE_SAFETY_PLAN_WORKSHEET:
                        $out['content']['template'] = 'multi_segment_page.html';
                        $out['content']['data'] = array(
                            'title' => 'Safety Plan Worksheet',
                            'show_card_count' => 2,
                            'cards_content' => array(
                                0 => array(
                                    'twig' => 'safety_plan_worksheet/concern_1.html'
                                ),
                                1 => array(
                                    'twig' => 'safety_plan_worksheet/concern_2.html'
                                ),
                                2 => array(
                                    'twig' => 'safety_plan_worksheet/concern_3.html'
                                ),
                                3 => array(
                                    'twig' => 'safety_plan_worksheet/concern_4.html'
                                ),
                                4 => array(
                                    'twig' => 'safety_plan_worksheet/concern_5.html'
                                ),
                                5 => array(
                                    'twig' => 'safety_plan_worksheet/concern_6.html'
                                )
                            )
                        );
                        $out['javascripts'][] = 'multi_segment.js';
                        break;

                    case self::PAGE_ADDED_SOON:
                        $out['content']['template'] = 'full_page_card.html';
                        $out['content']['data'] = array(
                            'title' => 'To Be Added Soon',
                            'card_content' => array(
                                'twig' => 'added_soon.html'
                            )
                        );
                        break;

                    default:
                        break;
                }
                break;
            case self::INDEX:
                $out['type'] = self::INDEX;
                $out['title'] = "Home";
                $out['template'] = "index.html";
                break;
            default:
                $out['type'] = self::INDEX;
                $out['title'] = "Home";
                $out['template'] = "index.html";
                $out['found'] = false;
        }
        if (file_exists($APPLICATION_DIR.self::COUNTRY_LIST_FILE)) {
            $countries = file_get_contents($APPLICATION_DIR.self::COUNTRY_LIST_FILE);
            $out['country_list'] = json_decode($countries, true);
        }
        return $out;
    }

    public static function getPageUrl($page, $content)
    {
        $pageUrl = array(
            self::PAGE_REQUEST_PARAM => $page,
            self::PAGE_CONTENT => $content
        );
        $url = HOST;
        if (!empty($pageUrl)) {
            $url .= '?';
            $url .= http_build_query($pageUrl, '', '&');
        }
        return $url;
    }
}
