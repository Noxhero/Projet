function autocompletcommune() {
    var nomId = 'nom_idcommune';
    var nomListId = 'nom_list_idcommune';
    var min_length = 2;
    var keyword = $('#' + nomId).val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../../includes/ajax_refresh.php',
            type: 'POST',
            data: {
                keyword: keyword
            },
            success: function(data) {
                $('#' + nomListId).show();
                $('#' + nomListId).html(data);
            }
        });
    } else {
        $('#' + nomListId).hide();
    }
}
function set_item(item, item2, item3) {
    $('#nom_idcommune').val(item);
    $('#cp').val(item2);
    $('#idcommune').val(item3);
    $('#nom_list_idcommune').hide();
}

function autocompletcommune21(cavalier_id) {
    var nomId21 = 'nom_idcommune21_'+ cavalier_id;
    var nomListId21 = 'nom_list_idcommune21_'+ cavalier_id;
    var min_length = 2;
    var keyword21 = $('#' + nomId21).val();

    if (keyword21.length >= min_length) {
        $.ajax({
            url: '../../includes/ajax_refresh.php',
            type: 'POST',
            data: {
                keyword21: keyword21,
                cavalier_id: cavalier_id

            },
            success: function(data) {
                $('#' + nomListId21).show();
                $('#' + nomListId21).html(data);
            }
        });
    } else {
        $('#' + nomListId21).hide();
    }
}
function set_item21(item, item2, item3, cavalier_id) {
    $(`#nom_idcommune21_${cavalier_id}`).val(item);
    $(`#cp21_${cavalier_id}`).val(item2);
    $(`#idcommune21_${cavalier_id}`).val(item3);
    $(`#nom_list_idcommune21_${cavalier_id}`).hide();
}

function autocompletgalop() {
    var nomId2 = 'nom_idgalop' ;
    var nomListId2 = 'nom_list_idgalop';
    var min_length = 2;
    var keyword2 = $('#' + nomId2).val();

    if (keyword2.length >= min_length) {
        $.ajax({
            url: '../../includes/ajax_refresh.php',
            type: 'POST',
            data: {
                keyword2: keyword2
            },
            success: function(data) {
                $('#' + nomListId2).show();
                $('#' + nomListId2).html(data);
            }
        });
    } else {
        $('#' + nomListId2).hide();
    }
}


function set_item2(item, item3) {
    $('#nom_idgalop').val(item);
    $('#idgalop').val(item3);
    $('#nom_list_idgalop').hide();
}

function autocompletgalop22(cavalier_id) {
    var nomId22 = 'nom_idgalop22_'+ cavalier_id;
    var nomListId22 = 'nom_list_idgalop22_'+ cavalier_id;
    var min_length = 2;
    var keyword22 = $('#' + nomId22).val();

    if (keyword22.length >= min_length) {
        $.ajax({
            url: '../../includes/ajax_refresh.php',
            type: 'POST',
            data: {
                keyword22: keyword22,
                cavalier_id: cavalier_id
            },
            success: function(data) {
                $('#' + nomListId22).show();
                $('#' + nomListId22).html(data);
            }
        });
    } else {
        $('#' + nomListId22).hide();
    }
}



function set_item22(item, item3, cavalier_id) {
    $(`#nom_idgalop22_${cavalier_id}`).val(item);
    $(`#idgalop22_${cavalier_id}`).val(item3);
    $(`#nom_list_idgalop22_${cavalier_id}`).hide();
}



function autocompletrobe() {
    var nomId3 = 'nom_idrobe';
    var nomListId3 = 'nom_list_idrobe';
    var min_length = 2;
    var keyword3 = $('#' + nomId3).val();

    if (keyword3.length >= min_length) {
        $.ajax({
            url: '../../includes/ajax_refresh.php',
            type: 'POST',
            data: {
                keyword3: keyword3
            },
            success: function(data) {
                $('#' + nomListId3).show();
                $('#' + nomListId3).html(data);
            }
        });
    } else {
        $('#' + nomListId3).hide();
    }
}


function set_item3(item, item3) {
    $('#nom_idrobe').val(item);
    $('#idrobe').val(item3);
}


function autocompletrace() {
    var nomId4 = 'nom_idrace';
    var nomListId4 = 'nom_list_idrace';
    var min_length = 2;
    var keyword4 = $('#' + nomId4).val();

    if (keyword4.length >= min_length) {
        $.ajax({
            url: '../../includes/ajax_refresh.php',
            type: 'POST',
            data: {
                keyword4: keyword4
            },
            success: function(data) {
                $('#' + nomListId4).show();
                $('#' + nomListId4).html(data);
            }
        });
    } else {
        $('#' + nomListId4).hide();
    }
}


function set_item4(item, item3) {
    $('#nom_idrace').val(item);
    $('#idrace').val(item3);
}

// Ajouter ces fonctions JavaScript
function autocompletCheval(pension_id = '') {
    var min_length = 2;
    var keyword = pension_id ? 
        $('#nom_cheval_' + pension_id).val() : 
        $('#nom_cheval').val();
    var listId = pension_id ? 
        'nom_list_cheval_' + pension_id : 
        'nom_list_cheval';

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../../includes/ajax_refresh.php',
            type: 'POST',
            data: {
                keyword: keyword,
                type: 'cheval',
                pension_id: pension_id
            },
            success: function(data) {
                $('#' + listId).show();
                $('#' + listId).html(data);
            }
        });
    } else {
        $('#' + listId).hide();
    }
}

function set_item_cheval(nom, sire, pension_id = '') {
    if (pension_id) {
        $('#nom_cheval_' + pension_id).val(nom);
        $('#numsire_' + pension_id).val(sire);
        $('#nom_list_cheval_' + pension_id).hide();
    } else {
        $('#nom_cheval').val(nom);
        $('#numsire').val(sire);
        $('#nom_list_cheval').hide();
    }
}