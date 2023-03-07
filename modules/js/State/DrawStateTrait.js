define([
    'dojo',
    'dojo/_base/declare',
    g_gamethemeurl + 'modules/js/Core/ToolsTrait.js'
], function (dojo, declare) {
    return declare(
            'smilelife.state.draw',
            [
                common.ToolsTrait
            ],
            {

                constructor: function () {
//                    this.debug('smilelife.StatesManager constructor');
                },

                displayButton: function () {
                    this.debug(this.myTable);
                    if (null !== this.myTable.job) {
                        if (this.myTable.job.isTemporary) {
                            this.addActionButton('resign_button', _('Resign and Play'), 'doResign', null, false, 'red');
                        } else {
                            this.addActionButton('resign_button', _('Resign and Pass'), 'doResign', null, false, 'red');
                        }
                    }

                    this.addActionButton('drawCard_button', _('Draw from deck'), 'doDraw', null, false, 'blue');
                    if (null !== this.discard) {
                        this.addActionButton('resign_button', _('Draw and play from discard'), 'doDiscardDraw', null, false, 'gray');
                    }
//                    this.debug('DST', this.myTable, null !== this.myTable.job, null != this.myTable.job);

                },

                doResign: function () {
//                    this.debug("Resign");
                    this.ajaxcall("/" + this.game_name + "/" + this.game_name + "/resign.html", {
                        lock: true
                    }, this, function (result) {
                        this.debug("Resign :", result);
                    }, function (is_error) {
                        //--error
                        this.debug("Resign fail:", is_error);
                    });
                },

                doDraw: function () {
//                    this.debug("doDraw");
                    this.ajaxcall("/" + this.game_name + "/" + this.game_name + "/draw.html", {
                        lock: true
                    }, this, function (result) {
                        this.debug("Resign :", result);
                    }, function (is_error) {
                        //--error
                        this.debug("Resign fail:", is_error);
                    });
                },

                doDiscardDraw: function () {
                    this.debug("doDiscardDraw");
                },

            }


    );
});


