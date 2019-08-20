/**
 * User: Vinicius Cardoso
 * Date: 02/04/14
 * Time: 08:23
 */

"use strict";

var Main = window.Main || {};

Main.Event = function ($) {
    return {
        setChangeMyPasswordModalEvent: function () {
            $("#send-usuario-new-password").on('click', function (e) {
                e.preventDefault();
                var newPasswd1 = $("#senha1-usulogado").val();
                var newPasswd2 = $("#senha2-usulogado").val();
                Main.Sync.changeLoggedUserPassword(newPasswd1, newPasswd2);
            });
        }
    }
}($);