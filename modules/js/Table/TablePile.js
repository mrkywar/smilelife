define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.table.pile",
            [],
            {
                constructor: function () {
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

                    return {
                        professionalPile: professionalPile,
                        lovePile: lovePile,
                        wagePile: table.wages,
                        childPile: table.childs,
                        attackPile: table.attacks,
                        acquisitionPile: table.acquisitions,
//                        bonus1Pile: table.adultery,
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
                    $('pile_job_count_' + player.id).innerHTML = tableCards.professionalPile.length;

                    //---- Display love Pile infos
                    if (tableCards.lovePile.length > 0) {
                        var card = tableCards.lovePile[tableCards.lovePile.length - 1];
                        this.displayCard(card, 'pile_love_' + player.id);
                    }
                    $('pile_love_count_' + player.id).innerHTML = tableCards.lovePile.length;
                    
                    //---- Display Wage Pile infos
                    if (tableCards.wagePile.length > 0) {
                        var card = tableCards.wagePile[tableCards.wagePile.length - 1];
                        this.displayCard(card, 'pile_wage_' + player.id);
                    }
                    $('pile_wage_count_' + player.id).innerHTML = tableCards.wagePile.length;
                    
                    //---- Display Child Pile infos
                    if (tableCards.childPile.length > 0) {
                        var card = tableCards.childPile[tableCards.childPile.length - 1];
                        this.displayCard(card, 'pile_child_' + player.id);
                    }
                    $('pile_child_count_' + player.id).innerHTML = tableCards.childPile.length;
                    
                    //---- Display Attack Pile infos
                    if (tableCards.attackPile.length > 0) {
                        var card = tableCards.attackPile[tableCards.attackPile.length - 1];
                        this.displayCard(card, 'pile_attack_' + player.id);
                    }
                    $('pile_attack_count_' + player.id).innerHTML = tableCards.attackPile.length;
                    
                    //---- Display Acquisitions Pile infos
                    if (tableCards.acquisitionPile.length > 0) {
                        var card = tableCards.acquisitionPile[tableCards.acquisitionPile.length - 1];
                        this.displayCard(card, 'pile_aquisition_' + player.id);
                    }
                    $('pile_aquisition_count_' + player.id).innerHTML = tableCards.acquisitionPile.length;
                    
                    
                   
                    
                    
                    //---- Display Bonus1 Pile infos
//                    if (null !== tableCards.bonus1Pile && tableCards.bonus1Pile.length > 0) {
//                        var card = tableCards.bonus1Pile[tableCards.bonus1Pile.length - 1];
//                        this.displayCard(card, 'pile_bonus1_' + player.id);
//                    }
//                    $('pile_bonus1_count_' + player.id).innerHTML = tableCards.bonus1Pile.length;
                }
            }


    );
});

            