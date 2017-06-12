<?php

class Router
{
    const PAGE_REQUEST_PARAM = 'page_request';
    const PAGE_CONTENT = 'query';

    const INDEX = 'index';
    const HOME = 'home'; 

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

    const COUNTRY_LIST_FILE = '/javascripts/country_list.json';
    const LOGIN_SUCCESS_URL = HOST.'?page_request='.self::HOME;
        
    public static function getPage($page, $query = '')
    {
        global $APPLICATION_DIR;

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

                    case self::PAGE_SEXUAL_ASSAULT_MORE:
                        $out['content']['template'] = 'full_page_card.html';
                        $out['content']['data'] = array(
                            'title' => 'What is Sexual Assault?',
                            'card_content' => array(
                                'twig' => 'sexual_assault_more.html'
                            )
                        );
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
