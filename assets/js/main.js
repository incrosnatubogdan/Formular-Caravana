let inutilHTA = "<div class='inutil hta' data-id='hta'>grad <input name='grad_hta' class='input_1' placeholder='1, 2, 3' type='text'>"
let inutilDZ = "<div class='inutil dz' data-id='dz'>tip <input name='tip_dz' class='input_1' placeholder='1, 2' type='text'>"
let seen = "zzseen";
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = dd + '/' + mm + '/' + yyyy;
function addCheckbox() {
    jQuery('option').each(function () {
        var value = $(this).val();
        if (jQuery(this).parent().attr("multiple") && !jQuery("body").hasClass("loaded_check")) {
            var parentID = $(this).parent().attr("id");
            var text = $(this).text();
            var checkClass = $(this).attr("class");
            $("div#" + parentID).append("<input class='fake_box "+ checkClass +" ' type='checkbox' name='" + value + "' value='" + value + "'>" + text + "<br>");
        }
        if(jQuery(this).is(":selected") && jQuery(this).parent().attr("multiple")) {
            $('input[type=checkbox][name=' + value + ']').prop('checked', true);
            if(value == "HTA") {
                $("div#antecedente-patologice").append(inutilHTA)
                var inputValue = $(".col-half > input[name=grad_hta]").val();
                $(".inutil input[name=grad_hta]").val(inputValue)
            } else if (value == "DZ") {
                $("div#antecedente-patologice").append(inutilDZ)
                var inputValue = $(".col-half > input[name=tip_dz]").val();
                $(".inutil input[name=tip_dz]").val(inputValue)
            }
        } else if(!$(this).is(":selected")) {
            $('input[type=checkbox][name=' + value + ']').prop('checked', false);
            if(value == "HTA") {
                $(".inutil.hta").remove();
            } else if (value == "DZ") {
                $(".inutil.dz").remove();
            }
        }
    });
    jQuery("body").addClass("loaded_check");
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


$(document).ready(function () {
    addCheckbox();
    $('.select2').select2();
    $(".analize-table").clone().prependTo(".table");
    $(".today").val(today);
    $('.patient, .last_patient').on('click', function () {
        if ($(this).hasClass("seen")) {
            var name = seen + $(this).text() + '.json';
        } else {
            var name = $(this).text() + '.json';
        }
        
        $('.overlay').hide();
        // $("body").css("overflowY", "scroll");
        $("body").css("height", "auto");
        $.getJSON(name, function (JSONdata) {
                for (key in JSONdata) {
                    if (JSONdata.hasOwnProperty(key))
                        $('input[type=text][name=' + key + ']').val(JSONdata[key]);
                        $('textarea[type=text][name=' + key + ']').val(JSONdata[key]);
                        $('input[type=radio][name=' + key + ']').val([JSONdata[key]]);
                        $('select[id=' + key + ']').val([JSONdata[key]][0]);
                        $('select[id=' + key + ']').trigger('change');
                        $('select[name=' + key + ']').val(JSONdata[key]);
                        $('input[type=checkbox][name=' + key + ']').val([JSONdata[key]]);
                }
        });
        setTimeout(function () {
            addCheckbox();
        }, 100);
    });

    $('input.select-all').on('click', function () {
        
        // if(!$(this).is(":selected")) {
        //     $(this).parent().find("input[type=checkbox]").prop('checked', true);
        // } else {
        //     $(this).parent().find("input[type=checkbox]").prop('checked', false);
        // }
    });

    $(document).on("keyup", '.inutil input', function (event) {
        var currentID = $(this).attr("name");
        var inputValue = $(this).val();
        $("input[name=" + currentID + "]").val(inputValue);
    })

    $(".fake_box").on('click', function () {
        var parentID = $(this).parent().attr("id");
        var value = $(this).val();
        var checkStatus = $(this).is(":checked");

        if (checkStatus == true) {
            $("select#" + parentID + " option[value=" + value + "]").prop('selected', true);
        } else {
            $("select#" + parentID + " option[value=" + value + "]").prop('selected', false);
        }

        if(value == "HTA" && checkStatus == true) {    
            $(this).parent().append(inutilHTA);
            var inputValue = $(".col-half > input[name=grad_hta]").val();
            $(".inutil input[name=grad_hta]").val(inputValue)
        } else if(value == "HTA" && checkStatus == false) {
            $(".inutil.hta").remove();
        }

        if(value == "DZ" && checkStatus == true) {    
            $(this).parent().append(inutilDZ);
            var inputValue = $(".col-half > input[name=tip_dz]").val();
            $(".inutil input[name=tip_dz]").val(inputValue)
        } else if(value == "DZ" && checkStatus == false) {
            $(".inutil.dz").remove();
        }

        if($(this).hasClass("select-all")) {
            if (checkStatus == true) {
                $("select#" + parentID + " option").prop('selected', true);
                $(this).parent().find("input[type=checkbox]").prop('checked', true);
            } else {
                $("select#" + parentID + " option").prop('selected', false);
                $(this).parent().find("input[type=checkbox]").prop('checked', false);
            }
        }
        
    });

    $(".text-success").on('click', function () {
        $(".text-success").hide();
    });

    $(".close").on('click', function () {
        $('.overlay').hide();
        $("body").css("height", "auto");
    });

    $(".pacient_nou").on('click', function () {
        location.reload();
    });
    var loggedCookie = getCookie("logged");
    if (loggedCookie) {
        $(".login_popup").hide();
    }

    $(".signin_btn").on('click', function (event) {
        var usernameList = ["caravana_iasi","caravana_bucuresti","caravana_cluj"];
        var univpass = "carav";
        var username = $("#username").val();
        var pass = $("#parola").val();
        
        if ($.inArray(username, usernameList) != -1 && pass == univpass) {
            $(".login_popup").hide();
            document.cookie = "logged=true";
        }
    });

    $('#status_check').on('change', function() {
        if (this.checked) {
            $('.status').val(seen);
        } else {
            $('.status').val("");
        }
    });

    $(".analize").on('click', function () {
        $('.overlay').show();
        $("body").css("overflowY", "hidden");
        $("body").css("height", "0vh");
    });

    $(".make_pdf").on('click', function () {
        setTimeout(function (event) {
            window.open('pdf/make_pdf.php', '_blank');
        }, 1000);
    });

    $('.patient:contains(".json")').each(function () {
        $(this).html($(this).html().split(".json").join(""));
        var seenPatient = $(this).text();
        if (seenPatient.indexOf(seen) >= 0) {
            $(this).addClass("seen");
            $(this).text($(this).text().slice(6));
        }
    });

    $('.menu-btn').on('click', function (e) {
        e.preventDefault();
        $(".menu-bar").toggleClass('menu-bar_active');
        $(this).toggleClass('menu-btn_active');
        $('.menu').toggleClass('menu_active');
    });

    $(".submit-button").on('click', function () {
        $(".text-success").show();
        var lastPatient = $('input[name=name]').val();
        $('.last_patient').text(lastPatient);
    });

    $("#search_patient").on('keyup', function () {
        var value = $(this).val().toLowerCase();
        $(".table p").each(function () {
            if ($(this).text().toLowerCase().search(value) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    jQuery(document).on("click", "img.bottom", function (event) {

        var $target = $('html,body');
        $target.animate({
            scrollTop: 0
        }, "slow");
    });

    setInterval(function () {
        $(".submit-button").click();
    }, 300000);


});