/**
 * User: Vinicius Cardoso
 * Date: 02/04/14
 * Time: 08:23
 */

"use strict";

var Main = window.Main || {};

Main.Sync = function($){
    return {
        changeLoggedUserPassword: function(newPasswd1,newPasswd2) {
            var valida = Main.Util.checkPassword(newPasswd1, newPasswd2);
            if (valida) {
                $("#form-change-logged-user-password").submit();
            } else {
                $("#alerta_senha").html(
                    '<div class="alert alert-danger">' +
                    '<span>Senhas divergentes ou vazias.</span>' +
                    '<a href="#" class="close xbtn" data-dismiss="alert">&times;</a>' +
                    '</div>');
            }
        }
    }
}($);
