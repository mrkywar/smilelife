define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.table.pile",
            [],
            {
                constructor: function () {
                    this.panelCounter = [];
                },

                /**
                 * This function get all piles content for a given Table
                 * @param {object} table
                 * @returns {String}
                 */
                getTablePiles: function (table) {
                    var professionalPile = table.studies;
                    if (null !== table.job) {
                        professionalPile.push(table.job);
                    }

                    var lovePile = table.flirts;
                    if (null !== table.marriage) {
                        lovePile.push(table.marriage);
                    }

                    var specialPile = table.rewards.concat(table.specials);

                    var adulteryPile = [];
                    if (null !== table.adultery) {
                        adulteryPile.push(table.adultery);
                        //-- TODO add adultery flirts
                    }

                    return {
                        professionalPile: professionalPile,
                        lovePile: lovePile,
                        wagePile: table.wages,
                        childPile: table.childs,
                        attackPile: table.attacks,
                        acquisitionPile: table.acquisitions,
                        adulteryPile: adulteryPile,
                        specialPile: specialPile
                    }
                },

                /**
                 * This function display all piles content (last card) for a given Table
                 * @param {object} table
                 * @returns {String} player who owned the table
                 */
                displayTablePile: function (table, player) {
                    var tableCards = this.getTablePiles(table);

                    //---- Display professional Pile infos
                    if (tableCards.professionalPile.length > 0) {
                        var card = tableCards.professionalPile[tableCards.professionalPile.length - 1];
                        this.displayCard(card, 'pile_job_' + player.id);
                    }
                    var pileJobCounter = new ebg.counter();
                    pileJobCounter.create("pile_job_count_" + player.id);
                    pileJobCounter.setValue(tableCards.professionalPile.length);

                    //---- Display love Pile infos
                    if (tableCards.lovePile.length > 0) {
                        var card = tableCards.lovePile[tableCards.lovePile.length - 1];
                        this.displayCard(card, 'pile_love_' + player.id);
                    }
                    var pileLoveCounter = new ebg.counter();
                    pileJobCounter.create("pile_love_count_" + player.id);
                    pileJobCounter.setValue(tableCards.lovePile.length);

                    //---- Display Wage Pile infos
                    if (tableCards.wagePile.length > 0) {
                        var card = tableCards.wagePile[tableCards.wagePile.length - 1];
                        this.displayCard(card, 'pile_wage_' + player.id);
                    }
                    var pileWageCounter = new ebg.counter();
                    pileWageCounter.create("pile_wage_count_" + player.id);
                    pileWageCounter.setValue(tableCards.wagePile.length);

                    //---- Display Child Pile infos
                    if (tableCards.childPile.length > 0) {
                        var card = tableCards.childPile[tableCards.childPile.length - 1];
                        this.displayCard(card, 'pile_child_' + player.id);
                    }
                    var pileChildCounter = new ebg.counter();
                    pileChildCounter.create("pile_child_count_" + player.id);
                    pileChildCounter.setValue(tableCards.childPile.length);

                    //---- Display Attack Pile infos
                    if (tableCards.attackPile.length > 0) {
                        var card = tableCards.attackPile[tableCards.attackPile.length - 1];
                        this.displayCard(card, 'pile_attack_' + player.id);
                    }
                    var pileAttackCounter = new ebg.counter();
                    pileAttackCounter.create("pile_attack_count_" + player.id);
                    pileAttackCounter.setValue(tableCards.attackPile.length);

                    //---- Display Acquisitions Pile infos
                    if (tableCards.acquisitionPile.length > 0) {
                        var card = tableCards.acquisitionPile[tableCards.acquisitionPile.length - 1];
                        this.displayCard(card, 'pile_acquisition_' + player.id);
                    }
                    var pileAcquisitionCounter = new ebg.counter();
                    pileAcquisitionCounter.create("pile_acquisition_count_" + player.id);
                    pileAcquisitionCounter.setValue(tableCards.acquisitionPile.length);

                    //---- Display Adultery Pile infos
                    if (tableCards.adulteryPile.length > 0) {
                        var card = tableCards.adulteryPile[tableCards.adulteryPile.length - 1];
                        this.displayCard(card, 'pile_adultery_' + player.id);
                    }
                    $('pile_adultery_count_' + player.id).innerHTML = tableCards.adulteryPile.length;
                    var pileAdulteryCounter = new ebg.counter();
                    pileAdulteryCounter.create("pile_adultery_count_" + player.id);
                    pileAdulteryCounter.setValue(tableCards.adulteryPile.length);

                    //---- Display Specials Pile infos
                    if (null !== tableCards.specialPile && tableCards.specialPile.length > 0) {
                        var card = tableCards.specialPile[tableCards.specialPile.length - 1];
                        this.displayCard(card, 'pile_special_' + player.id);
                    }
                    $('pile_special_count_' + player.id).innerHTML = tableCards.specialPile.length;
                    var pileSpecialCounter = new ebg.counter();
                    pileSpecialCounter.create("pile_special_count_" + player.id);
                    pileSpecialCounter.setValue(tableCards.specialPile.length);


                    //---- Save object
                    this.panelCounter[player.id] = {
                        job: pileJobCounter,
                        love: pileLoveCounter,
                        wage: pileWageCounter,
                        child: pileChildCounter,
                        attack: pileAttackCounter,
                        acquisition: pileAcquisitionCounter,
                        adultery: pileAdulteryCounter,
                        special: pileSpecialCounter
                    }
                }
            }


    );
});

            