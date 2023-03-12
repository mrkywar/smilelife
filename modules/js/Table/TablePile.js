define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.table.pile",
            [],
            {
                constructor: function () {
                    this.debug("smilelife.table.pile constructor");
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

                    return {
                        professionalPile: professionalPile,
                        lovePile: lovePile,
                        wagePile: table.wages,
                        childPile: table.childs,
                        attackPile: table.attacks,
                        acquisitionPile: table.acquisitions,
                        bonus1Pile: table.adultery,
                    }
                },
                
                /**
                 * This function display all piles content (last card) for a given Table
                 * @param {object} table
                 * @returns {String} player who owned the table
                 */
                displayTablePile: function (table,player) {
                    var tableCards = this.getTablePiles(table);
                    this.debug('Piles of' + player.id, tableCards);
                    if (tableCards.professionalPile.length > 0) {
                        var card = tableCards.professionalPile[tableCards.professionalPile.length - 1];
                        this.createMoveOrUpdateCard(card, 'pile_job_' + player.id);
                    }
                    if (tableCards.lovePile.length > 0) {
                        var card = tableCards.lovePile[tableCards.lovePile.length - 1];
                        this.createMoveOrUpdateCard(card, 'pile_love_' + player.id);
                    }
                    if (tableCards.wagePile.length > 0) {
                        var card = tableCards.wagePile[tableCards.wagePile.length - 1];
                        this.createMoveOrUpdateCard(card, 'pile_wage_' + player.id);
                    }
                    if (tableCards.childPile.length > 0) {
                        var card = tableCards.childPile[tableCards.childPile.length - 1];
                        this.createMoveOrUpdateCard(card, 'pile_child_' + player.id);
                    }
                    if (tableCards.attackPile.length > 0) {
                        var card = tableCards.attackPile[tableCards.attackPile.length - 1];
                        this.createMoveOrUpdateCard(card, 'pile_attack_' + player.id);
                    }
                    if (tableCards.acquisitionPile.length > 0) {
                        var card = tableCards.acquisitionPile[tableCards.acquisitionPile.length - 1];
                        this.createMoveOrUpdateCard(card, 'pile_aquisition_' + player.id);
                    }
                    if (null !== tableCards.bonus1Pile && tableCards.bonus1Pile.length > 0) {
                        var card = tableCards.acquisitionPile[tableCards.acquisitionPile.length - 1];
                        this.createMoveOrUpdateCard(card, 'pile_bonus1_' + player.id);
                    }
                }
            }


    );
});

            