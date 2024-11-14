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

function autocompletgalop() {
    var nomId2 = 'nom_idgalop';
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
