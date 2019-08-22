let inutilHTA = "<div class='inutil hta' data-id='hta'>grad <input name='grad_hta' class='input_1' placeholder='1, 2, 3' type='text'>"
let inutilDZ = "<div class='inutil dz' data-id='dz'>tip <input name='tip_dz' class='input_1' placeholder='1, 2' type='text'>"
let seen = "zzseen";
let dir = "./carav_1/";
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
            $("div#" + parentID).append("<div class='check_child'><input class='fake_box " + checkClass + " ' type='checkbox' name='" + value + "' value='" + value + "'><label for='" + value + "'>" + text + "</label></div>");
        }
        if (jQuery(this).is(":selected") && jQuery(this).parent().attr("multiple")) {
            $('input[type=checkbox][name=' + value + ']').prop('checked', true);
            if (value == "HTA") {
                $("div#antecedente-patologice").append(inutilHTA)
                var inputValue = $(".col-half > input[name=grad_hta]").val();
                $(".inutil input[name=grad_hta]").val(inputValue)
            } else if (value == "DZ") {
                $("div#antecedente-patologice").append(inutilDZ)
                var inputValue = $(".col-half > input[name=tip_dz]").val();
                $(".inutil input[name=tip_dz]").val(inputValue)
            }
        } else if (!$(this).is(":selected")) {
            $('input[type=checkbox][name=' + value + ']').prop('checked', false);
            if (value == "HTA") {
                $(".inutil.hta").remove();
            } else if (value == "DZ") {
                $(".inutil.dz").remove();
            }
        }
    });
    jQuery("body").addClass("loaded_check");
}

function checkImportantData() {
    if ($('.protected_data').val().length) {
        var elemenets = $(".protected_data");
        for (i = 0; i < elemenets.length; i++) {
            if ($(elemenets[i]).val().length) {
                // elemenets[i].disabled = 'true';
                $(elemenets[i]).addClass("blocked");
            }
        }
    }
}

function editPopup() {
    var popup = '<div class="overlay accept_edit"><div class="popup"><p>Datele de identificare ale pacientului au fost introduse la receptie. Sunteti sigur ca doriti sa modificati aceste date?</p><div class="button_holder edit_btn"><button class="nu">Nu</button><button class="da">Da</butto></div></div></div>';
    $("body").append(popup);
}


function positionPopup() {
    var popup = '<div class="overlay accept_edit"><div class="popup"><p>Va ocupati de zona de receptie?</p><div class="button_holder confirm_pos"><button class="nu">Nu</button><button class="da">Da</butto></div></div></div>';
    $("body").append(popup);
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
            var loggedCookie = getCookie("logged");
            if (loggedCookie) {
                $(".login_popup").hide();
            }
            $('.select2').select2();
            $(".analize-table").clone().prependTo(".table");
            $(".today").val(today);
            jQuery(document).on("click", '.patient, .last-patient', function (event) {
                if ($(this).hasClass("seen")) {
                    var name = dir + seen + $(this).text() + '.json';
                    $("#status_check").prop( "checked", true );
                } else {
                    var name = dir + $(this).text() + '.json';
                    $("#status_check").prop( "checked", false );
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
                        $('input[type=text][name=' + key + '_statistica]').val(JSONdata[key]);
                        $('input[type=checkbox][name=' + key + ']').val([JSONdata[key]]);
                    }
                });
                setTimeout(function () {
                    addCheckbox();
                    checkImportantData();
                }, 100);
            });

            jQuery(document).on("click", '.edit', function (event) {
                jQuery(this).parent().find("p.patient").trigger("click");
            });

            jQuery(document).on("click", 'input.select_all', function (event) {
                var parentID = $(this).parent().parent().attr("id");
                var checkStatus = $(this).is(":checked");
                if (checkStatus == true) {
                    $("select#" + parentID + " option").prop('selected', true);
                    $(this).parent().parent().find("input[type=checkbox]").prop('checked', true);
                } else {
                    $("select#" + parentID + " option").prop('selected', false);
                    $(this).parent().parent().find("input[type=checkbox]").prop('checked', false);
                }
            });

            $(document).on("keyup", '.inutil input', function (event) {
                var currentID = $(this).attr("name");
                var inputValue = $(this).val();
                $("input[name=" + currentID + "]").val(inputValue);
            })

            jQuery(document).on("click", '.fake_box', function (event) {
                var parentID = $(this).parent().parent().attr("id");
                var value = $(this).val();
                var checkStatus = $(this).is(":checked");


                if (checkStatus == true) {
                    $("select#" + parentID + " option[value=" + value + "]").prop('selected', true);
                    $("select#" + parentID + "").trigger("change");
                } else {
                    $("select#" + parentID + " option[value=" + value + "]").prop('selected', false);
                    $("select#" + parentID + "").trigger("change");
                }

                if (value == "HTA" && checkStatus == true) {
                    $(this).parent().append(inutilHTA);
                    var inputValue = $(".col-half > input[name=grad_hta]").val();
                    $(".inutil input[name=grad_hta]").val(inputValue)
                } else if (value == "HTA" && checkStatus == false) {
                    $(".inutil.hta").remove();
                }

                if (value == "DZ" && checkStatus == true) {
                    $(this).parent().append(inutilDZ);
                    var inputValue = $(".col-half > input[name=tip_dz]").val();
                    $(".inutil input[name=tip_dz]").val(inputValue)
                } else if (value == "DZ" && checkStatus == false) {
                    $(".inutil.dz").remove();
                }

                if ($(this).hasClass("select_all")) {
                    if (checkStatus == true) {
                        $("select#" + parentID + " option").prop('selected', true);
                        $(this).parent().find("input[type=checkbox]").prop('checked', true);
                    } else {
                        $("select#" + parentID + " option").prop('selected', false);
                        $(this).parent().find("input[type=checkbox]").prop('checked', false);
                    }
                }

            });

            jQuery(document).on("click", '.text-success', function (event) {
                $(".text-success").hide();
            });

            $('select').on('change', function () {
                var currentName = $(this).attr("name");

                // var statInput = $("input[name=" + parentID + "_statistica]");
                // statInput.val(statInput.val() + this.value);
                if ($(this).attr("multiple")) {
                    var valueSelected = $(this).val();
                    var currentName = currentName.substring(0, currentName.length - 2);
                    $("input[name=statistica_" + currentName + "]").val(valueSelected)
                }

            });

            jQuery(document).on("click", '.close', function (event) {
                $('.overlay').hide();
                $("body").css("height", "auto");
            });

            jQuery(document).on("click", '.pacient_nou', function (event) {
                location.reload();
            });

            jQuery(document).on("click", '.pozitie', function (event) {
                positionPopup();
            });

            jQuery(document).on("click", '.delete', function (event) {
                // if(jQuery(this).parent.find("p.seen")) {
                //     return;
                // }
                deleteFile($(this).attr('id'));
                jQuery(this).parent().addClass("deleted");
            });

            function deleteFile(id) {
                $.ajax('carav_1/delete.php?fileid=' + id)
                    .done(function () {
                        alert('Pacientul a fost sters.');
                        jQuery(".deleted").remove();
                    })
                    .fail(function () {
                        alert('A aparut o problema la stergerea pacientului.');
                        jQuery(".deleted").removeClass("deleted");
                    })
            }

            jQuery(document).on("click", '.signin_btn', function (event) {
                var usernameList = ["medicb", "medici", "medicc"];
                var univpass = "kar@vana283";
                var username = $("#username").val().toLowerCase();
                var pass = $("#parola").val().toLowerCase();

                if ($.inArray(username, usernameList) != -1 && pass == univpass) {
                    $(".login_popup").hide();
                    document.cookie = "logged=true";
                } else {
                    $(".login_popup p").removeClass("hide");
                }

                // if (username == "medicb") {
                //     window.location.replace("https://caravanacumedici.ro/form_bucuresti/index.php");
                // } else if (username == "medicc") {
                //     window.location.replace("https://caravanacumedici.ro/form_cj/index.php");
                // } else if (username == "medici") {
                //     window.location.replace("https://caravanacumedici.ro/form_iasi/index.php");
                // }
            });

            jQuery(document).on("click", '.confirm_pos button.da', function (event) {
                document.cookie = "frontdesk=true";
                $(".accept_edit").hide();
                $('.protected_data').each(function () {
                    jQuery(this).prop('disabled', false);
                    $(this).addClass("editing")
                });
            });

            jQuery(document).on("click", '.confirm_pos button.nu', function (event) {
                document.cookie = "frontdesk=false";
                $(".accept_edit").hide();
                $('.protected_data').each(function () {
                    $(this).removeClass("editing")
                });
            });

            var userPosition = getCookie("frontdesk");
            if (userPosition == "true") {
                $(".accept_edit").hide();
                $('.protected_data').each(function () {
                    jQuery(this).prop('disabled', false);
                    $(this).addClass("editing")
                });
            } else if (userPosition == "false") {
                $('.overlay').show();
                $("body").css("overflowY", "hidden");
                $("body").css("height", "0vh");

                // $('.protected_data').each(function () {
                //     jQuery(this).prop('disabled', true);
                // });
            } else {
                positionPopup();
            }

            jQuery(document).on("click", 'input', function (event) {
                if ($(this).hasClass("protected_data") && !$(this).hasClass("editing")) {
                    editPopup();
                }
            });

            jQuery(document).on("click", '.accept_edit .edit_btn button', function (event) {
                var currentAction = $(this).attr("class");
                $(".overlay.accept_edit").remove();
                if (currentAction == "da") {
                    $('.protected_data').each(function () {
                        jQuery(this).prop('disabled', false);
                        $(this).addClass("editing")
                    });
                }
            });

            

            jQuery(document).on("click", '#consultari_suplimentare input', function (event) {
                var value = $(this).val();
                var elemenets = $("#consultari_suplimentare input");
                if (value == "fara_consulturi" && $(this).is(':checked')) {
                    $(this).addClass("all_select");
                    elemenets.prop("checked", false);
                    $(".all_select").prop("checked", true);
                    for (i = 0; i < elemenets.length; i++) {
                        elemenets[i].disabled = 'true';
                    }
                    $(".all_select").removeAttr("disabled");
                } else {
                    for (i = 0; i < elemenets.length; i++) {
                        elemenets.removeAttr("disabled");
                    }
                }
            });

            $(document).on('change','select[name=fumator]',function(){
            // jQuery(document).on("click", 'select[name=fumator]', function (event) {
                var value = $(this).val();
                if (value == "Da_prezent" || value == "Da_trecut") {
                    $(".smoker").removeClass("hide_alcohol");
                } else {
                    $(".smoker").addClass("hide_alcohol");
                }
            });

            $(document).on('change','select[name=alcool]',function(){ 
                var value = $(this).val();
                if (value == "Da") {
                    $(".alcohol_info").removeClass("hide_alcohol");
                } else {
                    $(".alcohol_info").addClass("hide_alcohol");
                }
            });

            $('#status_check').on('change', function () {
                if (this.checked) {
                    $('.status').val(seen);
                } else {
                    $('.status').val("");
                }
            });

            jQuery(document).on("click", '.analize', function (event) {
                $('.overlay').show();
                $("body").css("overflowY", "hidden");
                $("body").css("height", "0vh");
            });

            jQuery(document).on("click", '.make_pdf', function (event) {
                $('.protected_data').each(function () {
                    jQuery(this).prop('disabled', false);
                    $(this).addClass("editing")
                });
                setTimeout(function (event) {
                    window.open('pdf/make_pdf.php', '_blank');
                    $('.protected_data').each(function () {
                        jQuery(this).prop('disabled', true);
                    });
                        
                    }, 1000);
                });

                $('.patient:contains(".json")').each(function () {
                    $(this).html($(this).html().split(".json").join(""));
                    var seenPatient = $(this).text();
                    if (seenPatient.indexOf(seen) >= 0) {
                        $(this).addClass("seen");
                        $(this).text($(this).text().slice(6));
                    }
                    // var seenPatient = seenPatient.replace(/[0-9]/g, '').replace(/\./g,' ');
                    // $(this).text(seenPatient);
                });

                $('.patient').each(function () {
                    if ($(this).is(':empty')) {
                        $(this).parent().hide();
                    }
                });

                $('.menu-btn').on('click', function (e) {
                    e.preventDefault();
                    $(".menu-bar").toggleClass('menu-bar_active');
                    $(this).toggleClass('menu-btn_active');
                    $('.menu').toggleClass('menu_active');
                });

                $(".submit-button").on('click', function () {
                    $(".text-success").css("display", "flex");
                    setTimeout(function () {
                        $(".text-success").hide();
                        location.reload();
                    }, 3000);
                    var lastPatient = $('input[name=name]').val();
                    
                    $('.last_patient').text(lastPatient);
                    $(".stat_btn").trigger("click");
                });

                $("#search_patient").on('keyup', function () {
                    var value = $(this).val().toLowerCase();
                    $(".list p").each(function () {
                        if ($(this).text().toLowerCase().search(value) > -1) {
                            $(this).parent().show();
                        } else {
                            $(this).parent().hide();
                        }
                    });
                    $(".analize-table .list:first-child").hide();
                });

                jQuery(document).on("click", "img.bottom", function (event) {
                    console.log(200)
                    $('html, body').animate({
                        scrollTop: $('.submit-button').offset().top
                        //scrollTop: $('#your-id').offset().top
                        //scrollTop: $('.your-class').offset().top
                     }, 'slow');
                });

                setInterval(function () {
                    $(".submit-button").click();
                }, 300000);


            });