/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * function slideFromObject(game, object, fromId) {
 var from = document.getElementById(fromId);
 var originBR = from.getBoundingClientRect();
 if (document.visibilityState !== 'hidden' && !game.instantaneousMode) {
 var destinationBR = object.getBoundingClientRect();
 var deltaX = destinationBR.left - originBR.left;
 var deltaY = destinationBR.top - originBR.top;
 object.style.zIndex = '10';
 object.style.transform = "translate(".concat(-deltaX, "px, ").concat(-deltaY, "px)");
 if (object.parentElement.dataset.currentPlayer == 'false') {
 object.style.position = 'absolute';
 }
 setTimeout(function () {
 object.style.transition = "transform 0.5s linear";
 object.style.transform = null;
 });
 setTimeout(function () {
 object.style.zIndex = null;
 object.style.transition = null;
 object.style.position = null;
 }, 600);
 }
 }
 
 function slideToObjectAndAttach(game, object, destinationId, changeSide) {
 if (changeSide === void 0) { changeSide = false; }
 var destination = document.getElementById(destinationId);
 if (destination.contains(object)) {
 return;
 }
 var originBR = object.getBoundingClientRect();
 destination.appendChild(object);
 if (document.visibilityState !== 'hidden' && !game.instantaneousMode) {
 var destinationBR = object.getBoundingClientRect();
 var deltaX = destinationBR.left - originBR.left;
 var deltaY = destinationBR.top - originBR.top;
 object.style.zIndex = '10';
 object.style.transform = "translate(".concat(-deltaX, "px, ").concat(-deltaY, "px)");
 if (destination.dataset.currentPlayer == 'false') {
 object.style.order = null;
 object.style.position = 'absolute';
 }
 setTimeout(function () {
 object.style.transition = "transform 0.5s linear";
 object.style.transform = null;
 });
 setTimeout(function () {
 object.style.zIndex = null;
 object.style.transition = null;
 object.style.position = null;
 }, 600);
 }
 else {
 object.style.order = null;
 }
 }
 
 */
define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'common.mover',
            [
                //smilelife.state.draw
            ],
            {

                constructor: function () {
                    this.debug('common.mover constructor');
                },

                objectMove(object, destinationId) {
                    var destination = document.getElementById(destinationId);
                    if (destination.contains(object)) {
                        return;
                    }
                },

            }
    );
});

