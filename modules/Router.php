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
    const PAGE_SETTINGS = 'settings';

    const TEMPLATE_INDEX = 'index.html';
    const TEMPLATE_HOME = 'dashboard.html';
    const TEMPLATE_PAGE = 'page.html';
    
    const TEMPLATE_FULL_PAGE_CARD = 'full_page_card.html';
    const TEMPLATE_MULTI_CARDS_PAGE = 'multi_cards_page.html';
    const TEMPLATE_MULTI_SEGMENT_PAGE = 'multi_segment_page.html';
    const TEMPLATE_MULTI_SELGMENT_VERTICAL = 'multi_segment_vertical.html';
    const TEMPLATE_CIRCLE_OF_TRUST = 'circle_of_trust.html';
    const TEMPLATE_GET_HELP_NOW = 'get_help_now.html';

    const COUNTRY_LIST_FILE = '/js/country_list.json';
    const LOGIN_SUCCESS_URL = HOST.'?page_request='.self::HOME;

    /**
     * Method : getPage
     * Description : Method to render a selected page
     * @page = parameter for page selection
     * @query = Requested query parameter for the page to be displayed
     */
    public static function getPage($UserObj, $page, $query = '')
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
                $out['template'] = self::TEMPLATE_HOME;
                $out['content'] = array();
                switch ($query) {
                    case self::PAGE_SEEKING_STAFF_SUPPORT:
                        $out['content'] = self::getSeekingStaffSupport();
                        break;

                    case self::PAGE_SEXUAL_ASSAULT:
                        $out['content'] = self::getSexualAssault();
                        break;

                    case self::PAGE_SEXUAL_HARASSMENT:
                        $out['content'] = self::getSexualHarrassment();
                        break;

                    case self::PAGE_SEXUAL_ASSAULT_MORE:
                        $out['content'] = self::getSexualAssaultMore();
                        break;

                    case self::PAGE_GLOSSARY:
                        $out['content'] = self::getGlossary();
                        break;

                    case self::PAGE_POLICY_SUMMARY:
                        $out['content'] = self::getPolicySummary();
                        break;

                    case self::PAGE_FURTHER_RESOURCES:
                        $out['content'] = self::getFurtherResources();
                        break;

                    case self::PAGE_CIRCLE_OF_TRUST:
                        $out['content'] = self::getCircleOfTrust($UserObj);
                        $out['javascripts'][] = 'validation.js';
                        $out['javascripts'][] = 'circle_of_trust.js';
                        break;

                    case self::PAGE_SERVICES_AFTER_ASSAULT:
                        $out['content'] = self::getServicesAfterAssault();
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_PEACE_CORPS_COMMITMENT:
                        $out['content'] = self::getPeaceCorpsCommitment();
                        break;

                    case self::PAGE_CONFIDENTIALITY:
                        $out['content'] = self::getConfidentiality();
                        break;

                    case self::PAGE_GET_HELP_NOW:
                        $out['content'] = self::getGetHelpNow($UserObj);
                        $out['javascripts'][] = 'get_help_now.js';
                        break;

                    case self::PAGE_RADAR:
                        $out['content'] = self::getRadar();
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_SEXUAL_PREDATORS:
                        $out['content'] = self::getSexualPredators();
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_IMPACT_OF_ASSAULT:
                        $out['content'] = self::getImpactOfAssault();
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_HELP_A_FRIEND:
                        $out['content'] = self::getHelpAFriend();
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_SAFETY_PLAN_BASICS:
                        $out['content'] = self::getSafetyPlanBasics();
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_UNWANTED_ATTENTION:
                        $out['content'] = self::getUnwantedAttention();
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_BYSTANDER_INTERVENTION:
                        $out['content'] = self::getBystanderIntervention();
                        $out['javascripts'][] = 'multi_card.js';
                        break;

                    case self::PAGE_COMMON_QUESTIONS:
                        $out['content'] = self::getCommonQuestions();
                        $out['javascripts'][] = 'multi_segment.js';
                        break;

                    case self::PAGE_MYTHBUSTERS:
                        $out['content'] = self::getMythbusters();
                        $out['javascripts'][] = 'multi_segment.js';
                        break;

                    case self::PAGE_SAFETY_PLAN_WORKSHEET:
                        $out['content'] = self::getSafetyPlanWorksheet();
                        $out['javascripts'][] = 'multi_segment.js';
                        break;

                    case self::PAGE_ADDED_SOON:
                        $out['content'] = self::getAddedSoon();
                        break;

                    case self::PAGE_SETTINGS:
                        $out['content'] = self::getSettings($UserObj);
                        $out['javascripts'][] = 'validation.js';
                        $out['javascripts'][] = 'index.js';
                        break;

                    default:
                        break;
                }
                break;

            case self::INDEX:
                $out['type'] = self::INDEX;
                $out['title'] = "Home";
                $out['template'] = self::TEMPLATE_INDEX;
                break;

            default:
                $out['type'] = self::INDEX;
                $out['title'] = "Home";
                $out['template'] = self::TEMPLATE_INDEX;
                $out['found'] = false;
        }
        if (file_exists($APPLICATION_DIR.self::COUNTRY_LIST_FILE)) {
            $countries = file_get_contents($APPLICATION_DIR.self::COUNTRY_LIST_FILE);
            $out['country_list'] = json_decode($countries, true);
        }
        if (isset($out['content']['data']['title'])
            || isset($out['content']['data']['card_content']['data']['title'])
        ) {
            $out['title'] = $out['content']['data']['title']
                ?? ($out['content']['data']['card_content']['data']['title']
                    ?? $out['title']
                );
        }
        return $out;
    }

    /**
     * Method : getPageUrl
     * Description : Routes the page and content to the correct URL
     * @page : parameters for page selection
     * @content : content corresponding to the page selected
     */
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

    /**
     * Method : getSettings
     * Description : Returns array of template and data for settings page
     * @UserObj string : User class instance
     */
    public static function getSettings($UserObj)
    {
        if (!empty($UserObj) && $UserObj->isValidUser()) {
            $email = $UserObj->getEmailAddress();
            $name = $UserObj->getName();
            $country = $UserObj->getCurrentPostCountry();
        }
        return array(
            'template' => self::TEMPLATE_FULL_PAGE_CARD,
            'data' => array(
                'title' => 'Account Settings',
                'card_content' => array(
                    'twig' => 'settings.html',
                    'twig_data' => array(
                        'email' => $email ?? '',
                        'name' => $name ?? '',
                        'country' => $country ?? ''
                    )
                )
            )
        );
    }

    /**
     * Method : getCircleOfTrust
     * Description : Returns array of template and data for circle of trust page
     * @UserObj string : User class instance
     */
    public static function getCircleOfTrust($UserObj)
    {
        $comradesData = $UserObj->getCircleOfTrust() ?? array();
        $comradesArray = explode(", ", $comradesData['comrade_details']);
        for ($i = count($comradesArray); $i < User::COUNT_CIRCLE_OF_TRUST; $i++) {
            $comradesArray[] = '';
        }
        $comradesArray = array_slice($comradesArray, 0, User::COUNT_CIRCLE_OF_TRUST);
        return array(
            'template' => self::TEMPLATE_CIRCLE_OF_TRUST,
            'data' => array(
                'title' => 'Circle of Trust',
                'comrades' => $comradesArray
            )
        );
    }

    /**
     * Method : getGetHelpNow
     * Description : Returns array of template and data for get help now page
     * @UserObj string : User class instance
     */
    public static function getGetHelpNow($UserObj)
    {
        return array(
            'template' => self::TEMPLATE_PAGE,
            'data' => array(
                'card_content' => array(
                    'twig' => self::TEMPLATE_GET_HELP_NOW,
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
            )
        );
    }

    /**
     * Method : getSeekingStaffSupport
     * Description : Returns array of template and data for seeking staff support page
     */
    public static function getSeekingStaffSupport()
    {
        return array(
            'template' => self::TEMPLATE_FULL_PAGE_CARD,
            'data' => array(
                'title' => 'Benefits of Seeking Staff Support',
                'card_content' => array(
                    'twig' => 'seeking_staff_support.html'
                )
            )
        );
    }

    /**
     * Method : getSexualAssault
     * Description : Returns array of template and data for sexual assault first page
     */
    public static function getSexualAssault()
    {
        return array(
            'template' => self::TEMPLATE_FULL_PAGE_CARD,
            'data' => array(
                'title' => 'What is Sexual Assault?',
                'bottom_button' => array(
                    'text' => 'Know more About Sexual Assault',
                    'link' => self::getPageUrl(self::HOME, self::PAGE_SEXUAL_ASSAULT_MORE)
                ),
                'card_content' => array(
                    'twig' => 'sexual_assault.html'
                )
            )
        );
    }

    /**
     * Method : getSexualHarrassment
     * Description : Returns array of template and data for sexual harassment page
     */
    public static function getSexualHarrassment()
    {
        return array(
            'template' => self::TEMPLATE_FULL_PAGE_CARD,
            'data' => array(
                'title' => 'Sexual Harassment',
                'card_content' => array(
                    'twig' => 'sexual_harassment.html'
                )
            )
        );
    }

    /**
     * Method : getSexualAssaultMore
     * Description : Returns array of template and data for sexual assault second page
     */
    public static function getSexualAssaultMore()
    {
        return array(
            'template' => self::TEMPLATE_FULL_PAGE_CARD,
            'data' => array(
                'title' => 'What is Sexual Assault?',
                'card_content' => array(
                    'twig' => 'sexual_assault_more.html'
                )
            )
        );
    }

    /**
     * Method : getGlossary
     * Description : Returns array of template and data for glossary page
     */
    public static function getGlossary()
    {
        return array(
            'template' => self::TEMPLATE_FULL_PAGE_CARD,
            'data' => array(
                'title' => 'Glossary',
                'card_content' => array(
                    'class' => 'p0',
                    'twig' => 'glossary.html'
                )
            )
        );
    }

    /**
     * Method : getPolicySummary
     * Description : Returns array of template and data for return data for Policy Summary page
     */
    public static function getPolicySummary()
    {
        return array(
            'template' => self::TEMPLATE_FULL_PAGE_CARD,
            'data' => array(
                'title' => 'Peace Corps Policy Summary Sheet',
                'card_content' => array(
                    'twig' => 'policy_summary.html'
                )
            )
        );
    }

    /**
     * Method : getFurtherResources
     * Description : Returns array of template and data for further resources page
     */
    public static function getFurtherResources()
    {
        return array(
            'template' => self::TEMPLATE_FULL_PAGE_CARD,
            'data' => array(
                'title' => 'Further Resources',
                'card_content' => array(
                    'twig' => 'further_resources.html'
                )
            )
        );
    }

    /**
     * Method : getServicesAfterAssault
     * Description : Returns array of template and data for Services after Assault page
     */
    public static function getServicesAfterAssault()
    {
        return array(
            'template' => self::TEMPLATE_MULTI_CARDS_PAGE,
            'data' => array(
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
            )
        );
    }

    /**
     * Method : getPeaceCorpsCommitment
     * Description : Returns array of template and data for Peace Corps Commitment page
     */
    public static function getPeaceCorpsCommitment()
    {
        return array(
            'template' => self::TEMPLATE_FULL_PAGE_CARD,
            'data' => array(
                'title' => 'Peace Corps Commitment to Victims of Sexual Assualt',
                'card_content' => array(
                    'twig' => 'peace_corps_commitment.html'
                )
            )
        );
    }

    /**
     * Method : getConfidentiality
     * Description : Returns array of template and data for confidentiality
     */
    public static function getConfidentiality()
    {
        return array(
            'template' => self::TEMPLATE_FULL_PAGE_CARD,
            'data' => array(
                'title' => 'Confidentiality',
                'card_content' => array(
                    'twig' => 'confidentiality.html'
                )
            )
        );
    }

    /**
     * Method : getRadar
     * Description : Returns array of template and data for Radar page
     */
    public static function getRadar()
    {
        return array(
            'template' => self::TEMPLATE_MULTI_CARDS_PAGE,
            'data' => array(
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
            )
        );
    }

    /**
     * Method : getSexualPredators
     * Description : Returns array of template and data for sexual predators page
     */
    public static function getSexualPredators()
    {
        return array(
            'template' => self::TEMPLATE_MULTI_CARDS_PAGE,
            'data' => array(
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
            )
        );
    }

    /**
     * Method : getImpactOfAssault
     * Description : Returns array of template and data for impact of assault page
     */
    public static function getImpactOfAssault()
    {
        return array(
            'template' => self::TEMPLATE_MULTI_CARDS_PAGE,
            'data' => array(
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
            )
        );
    }

    /**
     * Method : getHelpAFriend
     * Description : Returns array of template and data for helping guidelines page
     */
    public static function getHelpAFriend()
    {
        return array(
            'template' => self::TEMPLATE_MULTI_CARDS_PAGE,
            'data' => array(
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
            )
        );
    }

    /**
     * Method : getSafetyPlanBasics
     * Description : Returns array of template and data for Safety plan basics page
     */
    public static function getSafetyPlanBasics()
    {
        return array(
            'template' => self::TEMPLATE_MULTI_CARDS_PAGE,
            'data' => array(
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
            )
        );
    }

    /**
     * Method : getUnwantedAttention
     * Description : Returns array of template and data for unwanted attention strategies page
     */
    public static function getUnwantedAttention()
    {
        return array(
            'template' => self::TEMPLATE_MULTI_CARDS_PAGE,
            'data' => array(
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
            )
        );
    }

    /**
     * Method : getBystanderIntervention
     * Description : Returns array of template and data for Bystander Intervention page
     */
    public static function getBystanderIntervention()
    {
        return array(
            'template' => self::TEMPLATE_MULTI_CARDS_PAGE,
            'data' => array(
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
            )
        );
    }

    /**
     * Method : getCommonQuestions
     * Description : Returns array of template and data for the common questions by PCVs
     */
    public static function getCommonQuestions()
    {
        return array(
            'template' => self::TEMPLATE_MULTI_SEGMENT_PAGE,
            'data' => array(
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
            )
        );
    }

    /**
     * Method : getMythbusters
     * Description : Returns array of template and data for mythbusters, facts and assumptions page
     */
    public static function getMythbusters()
    {
        return array(
            'template' => self::TEMPLATE_MULTI_SELGMENT_VERTICAL,
            'data' => array(
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
            )
        );
    }

    /**
     * Method : getSafetyPlanWorksheet
     * Description : Returns array of template and data for safety plan worksheet page
     */
    public static function getSafetyPlanWorksheet()
    {
        return array(
            'template' => self::TEMPLATE_MULTI_SEGMENT_PAGE,
            'data' => array(
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
            )
        );
    }

    /**
     * Method : getAddedSoon
     * Description : Returns array of template and data for a coming soon page
     */
    public static function getAddedSoon()
    {
        return array(
            'template' => self::TEMPLATE_FULL_PAGE_CARD,
            'data' => array(
                'title' => 'To Be Added Soon',
                'card_content' => array(
                    'twig' => 'added_soon.html'
                )
            )
        );
    }
}
