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
                keyword: keyword,
                type: 'commune'
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
                type: 'commune',
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

function autocompletCours() {
    var min_length = 2;
    var inputId = $(this).attr('id');
    var keyword = $(this).val();

    if (keyword.length >= min_length) {
        var listId = inputId === 'libcours_base' ? 'nom_list_cours_base' : 'nom_list_cours_associe';
        var for_type = inputId === 'libcours_base' ? 'base' : 'associe';
        
        $.ajax({
            url: '../../includes/ajax_refresh.php',
            type: 'POST',
            data: {
                keyword: keyword,
                type: 'cours',
                for: for_type
            },
            success: function(data) {
                $('#' + listId).show();
                $('#' + listId).html(data);
            }
        });
    } else {
        var listId = inputId === 'libcours_base' ? 'nom_list_cours_base' : 'nom_list_cours_associe';
        $('#' + listId).hide();
    }
}

// Ajout des fonctions manquantes
function set_item_cours_base(libelle, id) {
    $('#libcours_base').val(libelle);
    $('#idcoursbase').val(id);
    $('#nom_list_cours_base').hide();
}

function set_item_cours_associe(libelle, id) {
    $('#libcours_associe').val(libelle);
    $('#idcoursassociee').val(id);
    $('#nom_list_cours_associe').hide();
}

function autocompletCavalier() {
    var min_length = 2;
    var keyword = $('#nom_cavalier').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../../includes/ajax_refresh.php',
            type: 'POST',
            data: {
                keyword: keyword,
                type: 'cavalier'
            },
            success: function(data) {
                $('#nom_list_cavalier').show();
                $('#nom_list_cavalier').html(data);
            }
        });
    } else {
        $('#nom_list_cavalier').hide();
    }
}

function set_item_cavalier(nom, id) {
    $('#nom_cavalier').val(nom);
    $('#idcavalier').val(id);
    $('#nom_list_cavalier').hide();
}


function autocompletCours() {
    var min_length = 2;
    var keyword = $('#nom_idcours').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../../includes/ajax_refresh.php',
            type: 'POST',
            data: {
                keyword: keyword,
                type: 'cours'
            },
            success: function(data) {
                $('#nom_list_idcours').show();
                $('#nom_list_idcours').html(data);
            }
        });
    } else {
        $('#nom_list_idcours').hide();
    }
}

function set_item_cours(nom, id) {
    $('#nom_idcours').val(nom);
    $('#idcours').val(id);
    $('#nom_list_idcours').hide();
}




    if (keyword.length >= min_length) {
        $.ajax({
            url: '../../includes/ajax_refresh.php',
            type: 'POST',
            data: {
                keyword: keyword,
                type: 'cavalier',
                type2: 'modif',
                rowId: rowId
            },
            success: function(data) {
                $('#nom_list_idcavalier_' + rowId).show();
                $('#nom_list_idcavalier_' + rowId).html(data);
            }
        });
    } else {
        $('#nom_list_idcavalier_' + rowId).hide();
    }




//scroll bar
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.getElementById('menu-button');
    const sidebar = document.querySelector('.sidebar');
    let lastScrollTop = 0; // Variable pour stocker la position de défilement précédente

    menuButton.addEventListener('click', function() {
        sidebar.classList.toggle('active'); // Ajouter ou retirer la classe active
    });

    const scrollToTopButton = document.getElementById('scroll-to-top');

    // Afficher ou masquer le bouton en fonction du défilement
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) { // Afficher le bouton si on a défilé de plus de 300px
            scrollToTopButton.style.display = 'flex';
        } else {
            scrollToTopButton.style.display = 'none';
        }

        // Vérifier la direction du défilement
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop > lastScrollTop && sidebar.classList.contains('active')) {
            // Si on défile vers le bas et que la sidebar est active, la désactiver
            sidebar.classList.remove('active');
        }
        lastScrollTop = scrollTop; // Mettre à jour la position de défilement précédente
    });

    // Faire défiler vers le haut lorsque le bouton est cliqué
    scrollToTopButton.addEventListener('click', function() {
        // Ajouter la classe d'animation
        scrollToTopButton.classList.add('animate');

        // Faire défiler vers le haut
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Défilement en douceur
        });

        // Retirer la classe d'animation après un court délai
        setTimeout(function() {
            scrollToTopButton.classList.remove('animate');
        }, 500); // Correspond à la durée de l'animation
    });
});

function autocompletcours21(row_id) {
    var min_length = 2;
    var keyword = $('#nom_idcours21_' + row_id).val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../../includes/ajax_refresh.php',
            type: 'POST',
            data: {
                keyword21: keyword,
                type: 'cours',
                row_id: row_id
            },
            success: function(data) {
                $('#nom_list_idcours21_' + row_id).show();
                $('#nom_list_idcours21_' + row_id).html(data);
            }
        });
    } else {
        $('#nom_list_idcours21_' + row_id).hide();
    }
}

function autocompletcavalier22(row_id) {
    var min_length = 2;
    var keyword = $('#nom_idcavalier22_' + row_id).val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../../includes/ajax_refresh.php',
            type: 'POST',
            data: {
                keyword22: keyword,
                type: 'cavalier',
                row_id: row_id
            },
            success: function(data) {
                $('#nom_list_idcavalier22_' + row_id).show();
                $('#nom_list_idcavalier22_' + row_id).html(data);
            }
        });
    } else {
        $('#nom_list_idcavalier22_' + row_id).hide();
    }
}

function set_item_cours21(libelle, id, row_id) {
    $('#nom_idcours21_' + row_id).val(libelle);
    $('#idcours21_' + row_id).val(id);
    $('#nom_list_idcours21_' + row_id).hide();
}

function set_item_cavalier22(nom, id, row_id) {
    $('#nom_idcavalier22_' + row_id).val(nom);
    $('#idcavalier22_' + row_id).val(id);
    $('#nom_list_idcavalier22_' + row_id).hide();
}