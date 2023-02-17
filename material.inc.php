<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * Smile Life implementation : © Jean Portemer <jportemer@mailz.org> & Mr_Kywar <mr_kywar@gmail.com>
 * 
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * material.inc.php
 *
 * Smile Life game material description
 *
 * Here, you can describe the material of your game with PHP variables.
 *   
 * This file is loaded in your game logic class constructor, ie these variables
 * are available everywhere in your game logic code.
 *
 */

require_once 'modules/constants.inc.php';

$this->cardProperty = array(
    /* -------------------------------------------------------------------------
     *                  BEGIN - SPECIAL
     * ---------------------------------------------------------------------- */
    CardType::SPECIAL_BIRTHDAY => [
        'title' => clienttranslate('Birthday'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('Each player selects and gives you a paycheck '
                . 'card (face down)'),
        'text2' => clienttranslate(''),
    ],
    CardType::SPECIAL_CASINO => [
        'title' => clienttranslate('Casino'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('Bet a paycheck card face down. If another 
            player bets the same card, he wins. If they bet differently, you win'),
        'text2' => clienttranslate(''),
    ],
    CardType::SPECIAL_INHERITANCE => [
        'title' => clienttranslate('Inheritance'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('This money is yours to keep'),
        'text2' => clienttranslate(''),
    ],
    CardType::SPECIAL_JOB_BOOST => [
        'title' => clienttranslate('String-pulling'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('put down a job card without the requisite '
                . 'level of education'),
        'text2' => clienttranslate(''),
    ],
    CardType::SPECIAL_LUCK => [
        'title' => clienttranslate('Luck'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('Take three cards, keep one and play'),
        'text2' => clienttranslate(''),
    ],
    CardType::SPECIAL_RAINBOW => [
        'title' => clienttranslate('Rainbow'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('Play up to 3 cards at once then pick '
                . 'a new card'),
        'text2' => clienttranslate(''),
    ],
    CardType::SPECIAL_REVENGE => [
        'title' => clienttranslate('Revenge'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('Inflict a penalty on another player'),
        'text2' => clienttranslate(''),
    ],
    CardType::SPECIAL_SHOOTING_STAR=> [
        'title' => clienttranslate('Shooting star'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('Take any card from the discard pile and '
                . 'play it'),
        'text2' => clienttranslate(''),
    ],
    CardType::SPECIAL_TROC => [
        'title' => clienttranslate('Swap'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('Exchange a card randomly with another player'),
        'text2' => clienttranslate(''),
    ],
    CardType::SPECIAL_TSUNAMI => [
        'title' => clienttranslate('Tsunami'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('Mix and re-distribute all cards held'),
        'text2' => clienttranslate(''),
    ],
    /* -------------------------------------------------------------------------
     *                  BEGIN - FLIRTS
     * ---------------------------------------------------------------------- */
    CardType::FLIRT_BAR => [
        'title' => clienttranslate('Flirt'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('In a Bar'),
        'text2' => clienttranslate(''),
    ],
    CardType::FLIRT_CAMPING => [
        'title' => clienttranslate('Flirt'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('At a campsite'),
        'text2' => clienttranslate('Possibility to have a child'),
    ],
    CardType::FLIRT_CINEMA => [
        'title' => clienttranslate('Flirt'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('In a cinema'),
        'text2' => clienttranslate(''),
    ],
    
    CardType::FLIRT_WEB => [
        'title' => clienttranslate('Flirt'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('On the internet'),
        'text2' => clienttranslate(''),
    ],
    CardType::FLIRT_NIGTHCLUB => [
        'title' => clienttranslate('Flirt'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('In a nightclub'),
        'text2' => clienttranslate(''),
    ],
    CardType::FLIRT_PARC => [
        'title' => clienttranslate('Flirt'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('In a park'),
        'text2' => clienttranslate(''),
    ],
    CardType::FLIRT_RESTAURANT => [
        'title' => clienttranslate('Flirt'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('At a restaurant'),
        'text2' => clienttranslate(''),
    ],
    CardType::FLIRT_THEATER => [
        'title' => clienttranslate('Flirt'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('At the theater'),
        'text2' => clienttranslate(''),
    ],
    
    /* -------------------------------------------------------------------------
     *                  BEGIN - WEDDING
     * ---------------------------------------------------------------------- */
    CardType::WEDDING_BOURG_LA_REINE => [
        'title' => clienttranslate('Marriage'),
        'subtitle' => clienttranslate('Bourg-la-reine'),
        'text' => clienttranslate(''),
        'text2' => clienttranslate(''),
    ],
    CardType::WEDDING_BOURG_MADAME => [
        'title' => clienttranslate('Marriage'),
        'subtitle' => clienttranslate('Bourg-Madame'),
        'text' => clienttranslate(''),
        'text2' => clienttranslate(''),
    ],
    CardType::WEDDING_CORPS_NUDS => [
        'title' => clienttranslate('Marriage'),
        'subtitle' => clienttranslate('Corps-Nuds'),
        'text' => clienttranslate(''),
        'text2' => clienttranslate(''),
    ],
    CardType::WEDDING_FOURQUEUX => [
        'title' => clienttranslate('Marriage'),
        'subtitle' => clienttranslate('Fourqueux'),
        'text' => clienttranslate(''),
        'text2' => clienttranslate(''),
    ],
    CardType::WEDDING_MONTCUQ => [
        'title' => clienttranslate('Marriage'),
        'subtitle' => clienttranslate('Montcuq'),
        'text' => clienttranslate(''),
        'text2' => clienttranslate(''),
    ],
    CardType::WEDDING_MONTETON => [
        'title' => clienttranslate('Marriage'),
        'subtitle' => clienttranslate('Monteton'),
        'text' => clienttranslate(''),
        'text2' => clienttranslate(''),
    ],
    CardType::WEDDING_SAINTE_VERGE => [
        'title' => clienttranslate('Marriage'),
        'subtitle' => clienttranslate('Sainte-Verge'),
        'text' => clienttranslate(''),
        'text2' => clienttranslate(''),
    ],
    /* -------------------------------------------------------------------------
     *                  BEGIN - ADULTERY
     * ---------------------------------------------------------------------- */
    CardType::ADULTERY => [
        'title' => clienttranslate('Adultery'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('Flirt while married while you keep this card
            put down. Loss of children in the case of divorce.'),
        'text2' => clienttranslate(''),
    ],
    
    /* -------------------------------------------------------------------------
     *                  BEGIN - STUDIES
     * ---------------------------------------------------------------------- */
    CardType::STUDY_SINGLE => [
        'title' => clienttranslate('Higher'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate(''),
        'text2' => clienttranslate('Studies'),
    ],
    CardType::STUDY_DOUBLE => [
        'title' => clienttranslate('Higher'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('You’re a genius!'),
        'text2' => clienttranslate('Studies'),
    ],
    /* -------------------------------------------------------------------------
     *                  BEGIN - JOB
     * ---------------------------------------------------------------------- */
    //-- Official
    CardType::JOB_FRENCH_TEACHER => [
        'title' => clienttranslate('English teacher'),
        'subtitle' => clienttranslate('Official'),
        'text' => clienttranslate('Cervantes is your idol'),
        'text2' => clienttranslate(''),
    ],
    CardType::JOB_FRENCH_TEACHER => [
        'title' => clienttranslate('French teacher'),
        'subtitle' => clienttranslate('Official'),
        'text' => clienttranslate('Cervantes is your idol'),
        'text2' => clienttranslate(''),
    ],
    CardType::JOB_MATH_TEACHER => [
        'title' => clienttranslate('Math teacher'),
        'subtitle' => clienttranslate('Official'),
        'text' => clienttranslate('Pythagoras is your idol'),
        'text2' => clienttranslate(''),
    ],
    CardType::JOB_GRAND_PROF => [
        'title' => clienttranslate('Grand Professor'),
        'subtitle' => clienttranslate('Official'),
        'text' => clienttranslate('Career promotion exclusive to teachers'),
        'text2' => clienttranslate('P'),
    ],
    CardType::JOB_MILITARY => [
        'title' => clienttranslate('Soldier'),
        'subtitle' => clienttranslate('Official'),
        'text' => clienttranslate('Never victim to terrorist attacks'),
        'text2' => '',
    ],
    CardType::JOB_POLICEMEN => [
        'title' => clienttranslate('Policemen'),
        'subtitle' => clienttranslate('Official'),
        'text' => clienttranslate('No gurus or bandits in your presence'),
        'text2' => '',
    ],
    //-- Interim
    CardType::JOB_BARMAN => [
        'title' => clienttranslate('Barman'),
        'subtitle' => clienttranslate('Temporary employee'),
        'text' => clienttranslate('Unlimited flirts before marriage'),
        'text2' => '',
    ],
    CardType::JOB_GARDENER => [
        'title' => clienttranslate('Gardener'),
        'subtitle' => clienttranslate('Temporary employee'),
        'text' => clienttranslate('You’re an ecologist'),
        'text2' => '',
    ],
    CardType::JOB_PLUMBER => [
        'title' => clienttranslate('Plumber'),
        'subtitle' => clienttranslate('Temporary employee'),
        'text' => clienttranslate('You’re good with your hands'),
        'text2' => '',
    ],
    CardType::JOB_STRIPTEASER => [
        'title' => clienttranslate('Stripper'),
        'subtitle' => clienttranslate('Temporary employee'),
        'text' => clienttranslate('You’re hot'),
        'text2' => '',
    ],
    CardType::JOB_WAITER => [
        'title' => clienttranslate('Waiter'),
        'subtitle' => clienttranslate('Temporary employee'),
        'text' => clienttranslate('You’re very obliging'),
        'text2' => '',
    ],
    //-- Normal
    CardType::JOB_AIRLINE_PILOT => [
        'title' => clienttranslate('Airline pilot'),
        'subtitle' => '',
        'text' => clienttranslate('You travel for free'),
        'text2' => '',
    ],
    CardType::JOB_ARCHTECT => [
        'title' => clienttranslate('Architect'),
        'subtitle' => '',
        'text' => clienttranslate('A free house when you put it down'),
        'text2' => '',
    ],
    CardType::JOB_ASTRONAUT => [
        'title' => clienttranslate('Astronaut'),
        'subtitle' => '',
        'text' => clienttranslate('Choose a card in the discard pile'),
        'text2' => '',
    ],
    CardType::JOB_DESIGNER => [
        'title' => clienttranslate('Designer'),
        'subtitle' => '',
        'text' => clienttranslate('You’re hip'),
        'text2' => '',
    ],
    CardType::JOB_DOCTOR => [
        'title' => clienttranslate('Doctor'),
        'subtitle' => '',
        'text' => clienttranslate('Never sick and continuous studies'),
        'text2' => '',
    ],
    CardType::JOB_BANDIT => [
        'title' => clienttranslate('Bandit'),
        'subtitle' => '',
        'text' => clienttranslate('Bandit: Pays no taxes, is never laid off.'),
        'text2' => clienttranslate('Jail is possible'),
    ],
    CardType::JOB_GURU => [
        'title' => clienttranslate('Guru'),
        'subtitle' => '',
        'text' => clienttranslate('You’re a visionary'),
        'text2' => '',
    ],
    CardType::JOB_JOURNALIST => [
        'title' => clienttranslate('Journalist'),
        'subtitle' => '',
        'text' => clienttranslate('Entitled to see the other players hands'),
        'text2' => '',
    ],
    CardType::JOB_LAWYER => [
        'title' => clienttranslate('Lawyer'),
        'subtitle' => '',
        'text' => clienttranslate('No-one can divorce you'),
        'text2' => '',
    ],
    CardType::JOB_HEAD_OF_PURCHASING => [
        'title' => clienttranslate('Head of purchasing'),
        'subtitle' => '',
        'text' => clienttranslate('Swap while protecting a card'),
        'text2' => '',
    ],
    CardType::JOB_HEAD_OF_SALES => [
        'title' => clienttranslate('Head of sales'),
        'subtitle' => '',
        'text' => clienttranslate('Swap while protecting a card'),
        'text2' => '',
    ],
    CardType::JOB_MECHANIC => [
        'title' => clienttranslate('Mechanic'),
        'subtitle' => '',
        'text' => clienttranslate('You never have accidents'),
        'text2' => '',
    ],
    CardType::JOB_PHARMACIST => [
        'title' => clienttranslate('Pharmacist'),
        'subtitle' => '',
        'text' => clienttranslate('Never sick'),
        'text2' => '',
    ],
    CardType::JOB_PIZZA_MAKER => [
        'title' => clienttranslate('Pizza maker'),
        'subtitle' => '',
        'text' => clienttranslate('You have fine taste'),
        'text2' => '',
    ],
    CardType::JOB_MEDIUM => [
        'title' => clienttranslate('Medium'),
        'subtitle' => '',
        'text' => clienttranslate('You may read the 13 coming cards'),
        'text2' => '',
    ],
    CardType::JOB_RESEARCHER => [
        'title' => clienttranslate('Researcher'),
        'subtitle' => '',
        'text' => clienttranslate('Try a 6-card hand'),
        'text2' => '',
    ],
    CardType::JOB_SURGEON => [
        'title' => clienttranslate('Surgeon'),
        'subtitle' => '',
        'text' => clienttranslate('Never sick and continuous studies'),
        'text2' => '',
    ],
    CardType::JOB_WRITER => [
        'title' => clienttranslate('Writer'),
        'subtitle' => '',
        'text' => clienttranslate('You’re a romantic'),
        'text2' => '',
    ],
    /* -------------------------------------------------------------------------
     *                  BEGIN - ATTACK
     * ---------------------------------------------------------------------- */
    CardType::ATTACK_ACCIDENT => [
        'title' => clienttranslate('Accident'),
        'subtitle' => '',
        'text' => clienttranslate('Skip your turn'),
        'text2' => '',
    ],
    CardType::ATTACK_BURN_OUT => [
        'title' => clienttranslate('Burn out'),
        'subtitle' => '',
        'text' => clienttranslate('Take a turn if you’re working'),
        'text2' => '',
    ],
    CardType::ATTACK_DISMISSAL => [
        'title' => clienttranslate('Dismissal'),
        'subtitle' => '',
        'text' => clienttranslate('You’re fired. Discard your actual job card'),
        'text2' => '',
    ],
    CardType::ATTACK_DIVORCE => [
        'title' => clienttranslate('Divorce'),
        'subtitle' => '',
        'text' => clienttranslate('You lose your marriage'),
        'text2' => '',
    ],
    CardType::ATTACK_GRADE_REPETITION => [
        'title' => clienttranslate('Grade repetition'),
        'subtitle' => '',
        'text' => clienttranslate('If you’re a student, discard your last'
                . ' education card'),
        'text2' => '',
    ],
    CardType::ATTACK_HUMAN_ATTACK => [
        'title' => clienttranslate('Terrorist attack'),
        'subtitle' => '',
        'text' => clienttranslate('Discard all child cards including your own'),
        'text2' => '',
    ],
    CardType::ATTACK_SICKNESS => [
        'title' => clienttranslate('Illness'),
        'subtitle' => '',
        'text' => clienttranslate('Skip your turn'),
        'text2' => '',
    ],
    CardType::ATTACK_INCOME_TAX => [
        'title' => clienttranslate('Income tax'),
        'subtitle' => '',
        'text' => clienttranslate('Discard your last paycheck card if you have'
                . ' a job'),
        'text2' => '',
    ],
    CardType::ATTACK_JAIL => [
        'title' => clienttranslate('Jail'),
        'subtitle' => '',
        'text' => clienttranslate('Skip 3 turns if you are a bandit then '
                . 'discard both cards'),
        'text2' => '',
    ],
    /* -------------------------------------------------------------------------
     *                  BEGIN - PET
     * ---------------------------------------------------------------------- */
    CardType::PET_CAT => [
        'title' => clienttranslate('Pet'),
        'subtitle' => '',
        'text' => clienttranslate('Meow ...'),
        'text2' => '',
    ],
    CardType::PET_DOG => [
        'title' => clienttranslate('Pet'),
        'subtitle' => '',
        'text' => clienttranslate('Woof woof !!'),
        'text2' => '',
    ],
    CardType::PET_CHICK => [
        'title' => clienttranslate('Pet'),
        'subtitle' => '',
        'text' => clienttranslate('Piou Piou !'),
        'text2' => '',
    ],
    CardType::PET_RABBIT => [
        'title' => clienttranslate('Pet'),
        'subtitle' => '',
        'text' => clienttranslate('Honk honk !'),
        'text2' => '',
    ],
    CardType::PET_UNICORN => [
        'title' => clienttranslate('Pet'),
        'subtitle' => '',
        'text' => clienttranslate('Worth twice its value if your put it down '
                . 'with a rainbow or shooting star card!'),
        'text2' => '',
    ],
    /* -------------------------------------------------------------------------
     *                  BEGIN - TRAVEL
     * ---------------------------------------------------------------------- */
    CardType::TRAVEL_CAIRO => [
        'title' => clienttranslate('Travel'),
        'subtitle' => clienttranslate('Cairo'),
        'text' => clienttranslate('Price'),
        'text2' => '',
    ],
    CardType::TRAVEL_LONDON => [
        'title' => clienttranslate('Travel'),
        'subtitle' => clienttranslate('London'),
        'text' => clienttranslate('Price'),
        'text2' => '',
    ],
    CardType::TRAVEL_NEW_YORK => [
        'title' => clienttranslate('Travel'),
        'subtitle' => clienttranslate('New York'),
        'text' => clienttranslate('Price'),
        'text2' => '',
    ],
    CardType::TRAVEL_RIO => [
        'title' => clienttranslate('Travel'),
        'subtitle' => clienttranslate('Rio de Janeiro'),
        'text' => clienttranslate('Price'),
        'text2' => '',
    ],
    CardType::TRAVEL_SYDNEY => [
        'title' => clienttranslate('Travel'),
        'subtitle' => clienttranslate('Sydney'),
        'text' => clienttranslate('Price'),
        'text2' => '',
    ],
    /* -------------------------------------------------------------------------
     *                  BEGIN - HOUSE
     * ---------------------------------------------------------------------- */
    CardType::HOUSE_SMALL_1 => [
        'title' => clienttranslate('House'),
        'subtitle' => '',
        'text' => clienttranslate('Minimum Deposit'),
        'text2' => clienttranslate('Half price if you’re married'),
    ],
    CardType::HOUSE_SMALL_2 => [
        'title' => clienttranslate('House'),
        'subtitle' => '',
        'text' => clienttranslate('Minimum Deposit'),
        'text2' => clienttranslate('Half price if you’re married'),
    ],
    CardType::HOUSE_MEDIUM_1 => [
        'title' => clienttranslate('House'),
        'subtitle' => '',
        'text' => clienttranslate('Minimum Deposit'),
        'text2' => clienttranslate('Half price if you’re married'),
    ],
    CardType::HOUSE_MEDIUM_2 => [
        'title' => clienttranslate('House'),
        'subtitle' => '',
        'text' => clienttranslate('Minimum Deposit'),
        'text2' => clienttranslate('Half price if you’re married'),
    ],
    CardType::HOUSE_BIG => [
        'title' => clienttranslate('House'),
        'subtitle' => '',
        'text' => clienttranslate('Minimum Deposit'),
        'text2' => clienttranslate('Half price if you’re married'),
    ],
    /* -------------------------------------------------------------------------
     *                  BEGIN - REWARD
     * ---------------------------------------------------------------------- */
    CardType::REWARD_NATIONAL_MEDAL => [
        'title' => clienttranslate('Grand Prize of Excellence'),
        'subtitle' => '',
        'text' => clienttranslate('Can only be attributed to writers, '
                . 'researchers and journalists'),
        'text2' => clienttranslate('You may pocket paychecks from 1 to 4 while '
                . 'you work in the awarded job.'),
    ],
    CardType::REWARD_FREEDOM_MEDAL => [
        'title' => clienttranslate('Medal of Freedom'),
        'subtitle' => '',
        'text' => clienttranslate('You are awarded by the nation'
                . '(bandits excluded)'),
        'text2' => '',
    ],
    /* -------------------------------------------------------------------------
     *                  BEGIN - CHILD
     * ---------------------------------------------------------------------- */
    CardType::CHILD_DIANA => [
        'title' => clienttranslate('Child'),
        'subtitle' => '',
        'text' => clienttranslate('Diana'),
        'text2' => '',
    ],
    CardType::CHILD_HARRY => [
        'title' => clienttranslate('Harry'),
        'subtitle' => '',
        'text' => clienttranslate('Diana'),
        'text2' => '',
    ],
    CardType::CHILD_HERMIONE => [
        'title' => clienttranslate('Child'),
        'subtitle' => '',
        'text' => clienttranslate('Hermione'),
        'text2' => '',
    ],
    CardType::CHILD_LARA => [
        'title' => clienttranslate('Child'),
        'subtitle' => '',
        'text' => clienttranslate('Lara'),
        'text2' => '',
    ],
    CardType::CHILD_LEIA => [
        'title' => clienttranslate('Child'),
        'subtitle' => '',
        'text' => clienttranslate('Leia'),
        'text2' => '',
    ],
    CardType::CHILD_LUIGI => [
        'title' => clienttranslate('Child'),
        'subtitle' => '',
        'text' => clienttranslate('Luigi'),
        'text2' => '',
    ],
    CardType::CHILD_LUKE => [
        'title' => clienttranslate('Child'),
        'subtitle' => '',
        'text' => clienttranslate('Luke'),
        'text2' => '',
    ],
    CardType::CHILD_MARIO => [
        'title' => clienttranslate('Child'),
        'subtitle' => '',
        'text' => clienttranslate('Mario'),
        'text2' => '',
    ],
    CardType::CHILD_ROCKY => [
        'title' => clienttranslate('Child'),
        'subtitle' => '',
        'text' => clienttranslate('Rocky'),
        'text2' => '',
    ],
    CardType::CHILD_ZELDA => [
        'title' => clienttranslate('Child'),
        'subtitle' => '',
        'text' => clienttranslate('Zelda'),
        'text2' => '',
    ],
    
    
    
    
    /* -------------------------------------------------------------------------
     *                  BEGIN - WAGES
     * ---------------------------------------------------------------------- */
    CardType::WAGE_LEVEL_1 => [
        'title' => clienttranslate('Wage'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('Level ${level}', ['level' => 1]),
        'text2' => clienttranslate(''),
    ],
    CardType::WAGE_LEVEL_2 => [
        'title' => clienttranslate('Wage'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('Level ${level}', ['level' => 2]),
        'text2' => clienttranslate(''),
    ],
    CardType::WAGE_LEVEL_3 => [
        'title' => clienttranslate('Wage'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('Level ${level}', ['level' => 3]),
        'text2' => clienttranslate(''),
    ],
    CardType::WAGE_LEVEL_4 => [
        'title' => clienttranslate('Wage'),
        'subtitle' => clienttranslate(''),
        'text' => clienttranslate('Level ${level}', ['level' => 4]),
        'text2' => clienttranslate(''),
    ],
);

