define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.table.pile",
            [],
            {
                constructor: function () {
                    this.boardCounter = [];
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
                        adulteryPile = [...adulteryPile, ...table.adulteryFlirts]
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
                 * This function display all piles content for a given Table
                 * @param {object} table
                 * @param {object} player who owned the table
                 * @returns {object} ebg counters associated objects to each piles
                 */
                displayTablePiles: function (table) {
                    var tableCards = this.getTablePiles(table);
                    var player = table.player;

                    //---- Display professional Pile infos
                    var pileJobCounter = this.displayPile(tableCards.professionalPile, 'pile_job_', player);

                    //---- Display love Pile infos
                    var pileLoveCounter = this.displayPile(tableCards.lovePile, 'pile_love_', player);

                    //---- Display Wage Pile infos
                    var pileWageCounter = this.displayPile(tableCards.wagePile, 'pile_wage_', player);

                    //---- Display Child Pile infos
                    var pileChildCounter = this.displayPile(tableCards.childPile, 'pile_child_', player);

                    //---- Display Attack Pile infos
                    var pileAttackCounter = this.displayPile(tableCards.attackPile, 'pile_attack_', player);

                    //---- Display Acquisitions Pile infos
                    var pileAcquisitionCounter = this.displayPile(tableCards.acquisitionPile, 'pile_acquisition_', player);

                    //---- Display Adultery Pile infos
                    this.debug(tableCards.adulteryPile);
                    var pileAdulteryCounter = this.displayPile(tableCards.adulteryPile, 'pile_adultery_', player);

                    //---- Display Specials Pile infos
                    var pileSpecialCounter = this.displayPile(tableCards.specialPile, 'pile_special_', player);

                    //---- Save object
                    this.boardCounter[player.id] = {
                        job: pileJobCounter,
                        love: pileLoveCounter,
                        wage: pileWageCounter,
                        child: pileChildCounter,
                        attack: pileAttackCounter,
                        acquisition: pileAcquisitionCounter,
                        adultery: pileAdulteryCounter,
                        special: pileSpecialCounter
                    }
                    return this.boardCounter[player.id];
                },

                /**
                 * This function display one piles content (all cards) for a given pile
                 * @param {object} pile to display
                 * @param {string} pilePrefix pile name prefix to define where it's should be displayed
                 * @param {object} player who owned the pile
                 * @returns {object} ebg counter associated object
                 */
                displayPile: function (pile, pilePrefix, player) {
                    if (pile.length > 0) {
                        for (var index in pile) {
                            var card = pile[index];
                            this.displayCard(card, pilePrefix + player.id);
                        }
                    }
                    var pileCounter = new ebg.counter();
                    pileCounter.create(pilePrefix + "count_" + player.id);
                    pileCounter.setValue(pile.length);

                    return pileCounter;

                }
            }


    );
});

            