<?php

namespace SmileLife\Card;

/**
 * Description of CardType
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class CardType {
    /* -------------------------------------------------------------------------
     *                  BEGIN - STUDIES
     * ---------------------------------------------------------------------- */

    const CARD_TYPE_STUDY_SINGLE = 1;
    const CARD_TYPE_STUDY_DOUBLE = 2;
    /* -------------------------------------------------------------------------
     *                  BEGIN - JOB
     * ---------------------------------------------------------------------- */
    //-- Official
    const CARD_TYPE_ENGLISH_TEACHER = 3;
    const CARD_TYPE_FRENCH_TEACHER = 4;
    const CARD_TYPE_HISTORY_TEACHER = 5;
    const CARD_TYPE_MATH_TEACHER = 6;
    const CARD_TYPE_GRAND_PROF = 7;
    const CARD_TYPE_MILITARY = 8;
    const CARD_TYPE_POLICEMEN = 9;
    //-- Interim
    const CARD_TYPE_BARMAN = 10;
    const CARD_TYPE_GARDENER = 11;
    const CARD_TYPE_PLUMBER = 12;
    const CARD_TYPE_STRIPTEASER = 13;
    const CARD_TYPE_WAITER = 14;
    //-- Normal
    const CARD_TYPE_AIRLINE_PILOT = 15;
    const CARD_TYPE_ARCHITECT = 16;
    const CARD_TYPE_ASTRONAUT = 17;
    const CARD_TYPE_DESIGNER = 18;
    const CARD_TYPE_DOCTOR = 19;
    const CARD_TYPE_BANDIT = 20;
    const CARD_TYPE_GURU = 21;
    const CARD_TYPE_JOURNALIST = 22;
    const CARD_TYPE_LAWYER = 23;
    const CARD_TYPE_HEAD_OF_PURCHASING = 24;
    const CARD_TYPE_HEAD_OF_SALES = 25;
    const CARD_TYPE_MECHANIC = 26;
    const CARD_TYPE_PHARMACIST = 27;
    const CARD_TYPE_PIZZA_MAKER = 28;
    const CARD_TYPE_MEDIUM = 29;
    const CARD_TYPE_RESEARCHER = 30;
    const CARD_TYPE_SURGEON = 31;
    const CARD_TYPE_WRITER = 32;
    /* -------------------------------------------------------------------------
     *                  BEGIN - WAGES
     * ---------------------------------------------------------------------- */
    const CARD_TYPE_WAGE_LEVEL_1 = 33;
    const CARD_TYPE_WAGE_LEVEL_2 = 34;
    const CARD_TYPE_WAGE_LEVEL_3 = 35;
    const CARD_TYPE_WAGE_LEVEL_4 = 36;
    /* -------------------------------------------------------------------------
     *                  BEGIN - FLIRTS
     * ---------------------------------------------------------------------- */
    const CARD_TYPE_FLIRT_BAR = 37;
    const CARD_TYPE_FLIRT_CAMPING = 38;
    const CARD_TYPE_FLIRT_CINEMA = 39;
    const CARD_TYPE_FLIRT_HOTEL = 40;
    const CARD_TYPE_FLIRT_WEB = 41;
    const CARD_TYPE_FLIRT_NIGTHCLUB = 42;
    const CARD_TYPE_FLIRT_PARC = 43;
    const CARD_TYPE_FLIRT_RESTAURANT = 44;
    const CARD_TYPE_FLIRT_THEATER = 45;
    const CARD_TYPE_FLIRT_ZOO = 46;
    /* -------------------------------------------------------------------------
     *                  BEGIN - MARRIAGE
     * ---------------------------------------------------------------------- */
    const CARD_TYPE_MARRIAGE_BOURG_LA_REINE = 47;
    const CARD_TYPE_MARRIAGE_BOURG_MADAME = 48;
    const CARD_TYPE_MARRIAGE_CORPS_NUDS = 49;
    const CARD_TYPE_MARRIAGE_FOURQUEUX = 50;
    const CARD_TYPE_MARRIAGE_MONTCUQ = 51;
    const CARD_TYPE_MARRIAGE_MONTETON = 52;
    const CARD_TYPE_MARRIAGE_SAINTE_VERGE = 53;
    const CARD_TYPE_ADULTERY = 54;
    /* -------------------------------------------------------------------------
     *                  BEGIN - CHILD
     * ---------------------------------------------------------------------- */
    const CARD_TYPE_CHILD_DIANA = 55;
    const CARD_TYPE_CHILD_HARRY = 56;
    const CARD_TYPE_CHILD_HERMIONE = 57;
    const CARD_TYPE_CHILD_LARA = 58;
    const CARD_TYPE_CHILD_LEIA = 59;
    const CARD_TYPE_CHILD_LUIGI = 60;
    const CARD_TYPE_CHILD_LUKE = 61;
    const CARD_TYPE_CHILD_MARIO = 62;
    const CARD_TYPE_CHILD_ROCKY = 63;
    const CARD_TYPE_CHILD_ZELDA = 64;

    /* -------------------------------------------------------------------------
     *                  BEGIN - AQUISITION
     * ---------------------------------------------------------------------- */
    //--PET
    const CARD_TYPE_PET_CAT = 65;
    const CARD_TYPE_PET_CHICK = 66;
    const CARD_TYPE_PET_RABBIT = 67;
    const CARD_TYPE_PET_DOG = 68;
    const CARD_TYPE_PET_UNICORN = 69;
    //-- TRAVEL
    const CARD_TYPE_TRAVEL_CAIRO = 70;
    const CARD_TYPE_TRAVEL_LONDON = 71;
    const CARD_TYPE_TRAVEL_NEW_YORK = 72;
    const CARD_TYPE_TRAVEL_RIO = 73;
    const CARD_TYPE_TRAVEL_SYDNEY = 74;
    //-- HOUSE
    const CARD_TYPE_HOUSE_SMALL_1 = 75;
    const CARD_TYPE_HOUSE_SMALL_2 = 76;
    const CARD_TYPE_HOUSE_MEDIUM_1 = 77;
    const CARD_TYPE_HOUSE_MEDIUM_2 = 78;
    const CARD_TYPE_HOUSE_BIG = 79;
    /* -------------------------------------------------------------------------
     *                  BEGIN - REWARD
     * ---------------------------------------------------------------------- */
    const CARD_TYPE_NATIONAL_MEDAL = 80;
    const CARD_TYPE_FREEDOM_MEDAL = 81;
    /* -------------------------------------------------------------------------
     *                  BEGIN - ATTACK
     * ---------------------------------------------------------------------- */
    const CARD_TYPE_ATTENTAT  = 82;
    const CARD_TYPE_JAIL = 83;
    const CARD_TYPE_ACCIDENT = 84;
    const CARD_TYPE_BURN_OUT = 85;
    const CARD_TYPE_SICKNESS = 86;
    const CARD_TYPE_DISMISSAL = 87;
    const CARD_TYPE_DIVORCE = 88;
    const CARD_TYPE_INCOME_TAX = 89;
    const CARD_TYPE_GRADE_REPETITION = 90;

    /* -------------------------------------------------------------------------
     *                  BEGIN - SPECIALS
     * ---------------------------------------------------------------------- */
    const CARD_TYPE_BIRTHDAY = 91;
    const CARD_TYPE_CASINO = 92;
    const CARD_TYPE_INHERITANCE = 93;
    const CARD_TYPE_LUCK = 94;
    const CARD_TYPE_RAINBOW = 95;
    const CARD_TYPE_REVENGE = 96;
    const CARD_TYPE_SHOOTING_STAR = 97;
    const CARD_TYPE_JOB_BOOST = 98;
    const CARD_TYPE_TROC = 99;
    const CARD_TYPE_TSUNAMI = 100;

}
