define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.card",
            [],
            {
                constructor: function () {
                    this.debug("smilelife.card constructor", this.getGame());

                },

            }
    );
});
