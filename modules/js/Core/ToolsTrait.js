
/*
 * ToolsTrait is toobox can be used by any games
 * 
 */


define(['dojo', 'dojo/_base/declare', 'ebg/core/gamegui'], (dojo, declare) => {
    return declare('common.ToolsTrait', ebg.core.gamegui, {

        constructor: function () {
            this.isDebugEnabled = ('studio.boardgamearena.com' === window.location.host || window.location.hash.indexOf('debug') > -1);
        },

        /* -------------------------------------------------------------
         *                  BEGIN - DEBUG TOOL
         * ---------------------------------------------------------- */
        debug: function () {
            if (this.isDebugEnabled) {
                console.log.apply(null, arguments);
            }
        },
        /* -------------------------------------------------------------
         *                  BEGIN - CSS Manipulate
         * ---------------------------------------------------------- */
        insertCSS: function (css) {
            var styleSheet = document.createElement("style");
            styleSheet.type = "text/css";
            styleSheet.innerText = css;
            document.head.appendChild(styleSheet);
        },
    });
});