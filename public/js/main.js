function validateForm() {

    event.preventDefault();

    var x = document.forms["myForm"]["email"].value;
    var y = document.forms["myForm"]["password"].value;
    var error = document.getElementsByClassName('error-msg');
    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;


    // REQUIRED VALIDATION


    if (x == "" && y == "") {
        error[0].innerHTML = "Required!";
        error[0].style.display = "block";
        error[1].style.display = "block";
        return false;
    }
    else if (x == "") {
        error[0].innerHTML = "Required!";
        error[0].style.display = "block";
        error[1].style.display = "none";
        return false;
    }
    else if (y == "") {
        error[0].style.display = "none";
        error[1].style.display = "block";
        return false;
    }
    else {
        error[0].style.display = "none";
        error[1].style.display = "none";
    }

    // EMAIL FORMAT VALIDATION

    if (x != "" && x.match(mailformat) && y != "") {
        error[0].style.display = "none";
        // return true;
    }
    else {
        if (x != "" && x.match(mailformat) && y == "") {
            error[0].style.display = "none";
            error[1].style.display = "block";
            return false;
        }
        else {
            error[0].innerHTML = "Invalid Email";
            error[0].style.display = "block";
            return false;
        }
    }

    document.getElementById("loginForm").submit();
}

////========SIDEBAR MENU==========////

const mainContainerFlexFlag = false;

var text = $(".label-text.sidebar");
var menu = document.getElementById('header_top');
var shade = document.getElementById('background-shade');
var content = document.getElementsByClassName('page-container');

const sidebarCloseWidth = "60px";
const sidebarOpenWidth = "250px";
const sidebarDuration = "0.5s";
const sidebarOpenCurve = "cubic-bezier(0,0.7,0.3,1.3)";
const sidebarCloseCurve = "cubic-bezier(0,.7,.3,1)";

var isMouseOnSideBar = false;
var isMenuUndergoingCloseOperation = false;

function sidebar_expand(sidebar) {
    isMouseOnSideBar = true;
    sidebar.style.transition = sidebarDuration + " " + sidebarOpenCurve;
    sidebar.style.width = sidebarOpenWidth;

    if (mainContainerFlexFlag) {
        content[0].style.left = sidebarOpenWidth;
        content[0].style.width = "calc(100% - 250px)";
        content[0].style.transition = sidebarDuration + " " + sidebarOpenCurve;
    }

    setTimeout(function () {
        if (isMouseOnSideBar)
            for (var i = 0; i < 5; i++) {
                text[i].style.display = "inline-block";
            }
    }, 150);

    shade.style.display = "block";
    setTimeout(function () {
        shade.style.opacity = 0.3;
    }, 0);
}

function sidebar_contract(sidebar) {

    isMouseOnSideBar = false;
    for (var i = 0; i < 5; i++) {
        text[i].style.display = "none";
    }

    sidebar.style.width = sidebarCloseWidth;
    sidebar.style.transition = sidebarDuration + " " + sidebarCloseCurve;

    if (mainContainerFlexFlag) {
        content[0].style.left = sidebarCloseWidth;
        content[0].style.width = "calc(100% - " + sidebarCloseWidth + ")";
    }

    shade.style.opacity = 0;
    setTimeout(function () {
        shade.style.display = "none";
    }, 310);
}

////========ROW THICKNESS ADJUSTMENTS==========////

ROW_STATE = 0;

/** Load initial state */
$(function () {
    let preference = $("#initial-preference").val();
    if (preference == 0)
        return;

    ROW_STATE = preference - 1;
    adjustRowHeight(true);
})

function adjustRowHeight(isPageLoad = false) {

    if (isPageLoad) {
        $(".card").addClass("no-animation");
        $(".card-header").addClass("no-animation");
        $(".smallpic").addClass("no-animation");
        $(".pos").addClass("no-animation");
        $(".edit").addClass("no-animation");
    }
    else
        event.preventDefault();

    switch (ROW_STATE) {
        case 0:
            ROW_STATE++;
            $(".card").addClass("row-adjust-adjacent");
            $(".card-header").removeClass("row-adjust-compressed");
            $(".smallpic").removeClass("row-adjust-smaller-pic");
            $(".pos").removeClass("row-adjust-tiny-pos");
            $(".edit").removeClass("row-adjust-button-compressed")
            break;
        case 1:
            ROW_STATE++;
            $(".card").addClass("row-adjust-adjacent");
            $(".card-header").addClass("row-adjust-compressed");
            $(".smallpic").addClass("row-adjust-smaller-pic");
            $(".pos").addClass("row-adjust-tiny-pos");
            $(".edit").addClass("row-adjust-button-compressed")
            break;
        case 2:
            ROW_STATE++;
            $(".card").removeClass("row-adjust-adjacent");
            $(".card-header").addClass("row-adjust-compressed");
            $(".smallpic").addClass("row-adjust-smaller-pic");
            $(".pos").addClass("row-adjust-tiny-pos");
            $(".edit").addClass("row-adjust-button-compressed")
            break;
        case 3:
            ROW_STATE = 0;
            $(".card").removeClass("row-adjust-adjacent");
            $(".card-header").removeClass("row-adjust-compressed");
            $(".smallpic").removeClass("row-adjust-smaller-pic");
            $(".pos").removeClass("row-adjust-tiny-pos");
            $(".edit").removeClass("row-adjust-button-compressed")
            break;
    }

    setTimeout(function () {
        if (isPageLoad) {
            $(".card").removeClass("no-animation");
            $(".card-header").removeClass("no-animation");
            $(".smallpic").removeClass("no-animation");
            $(".pos").removeClass("no-animation");
            $(".edit").removeClass("no-animation");
        }
        else
            updateUserUIPreference($("#page-name").val() + "_preference", ROW_STATE);
    });
}

function updateUserUIPreference(pageName, value) {

    let package = {
        pageName: pageName,
        value: value,
        _token: $('#CSRF-TOKEN').val(),
    };

    $.ajax({
        type: "post",
        url: "/API/updateUIPreference",
        data: package,
        cache: false,
        success: function (response) {
        },
        error: function (err) {
        }
    });
}

function showCard(cardDom) {

    $(cardDom).show();
    $(cardDom).removeClass("row-adjust-card-no-shadow");

    cardHeader = $(cardDom).children('.card-header');
    $(cardHeader).removeClass("row-adjust-card-hide");
    $(cardHeader).find('.smallpic').show();
    $(cardHeader).find('.pos').css('transition', 'unset');
    $(cardHeader).find('.edit').css('transition', 'unset');

    $(cardHeader).find('.pos').show();
    $(cardHeader).find('.edit').show();

    showCard_Inner(cardHeader);

    function showCard_Inner(val) {
        let cardHeader = val;
        setTimeout(function () {
            $(cardHeader).find('.pos').css('transition', '0.3s ease');
            $(cardHeader).find('.edit').css('transition', '0.3s ease-out all');
        }, 300)
    }
}

function hideCard(cardDom) {

    $(cardDom).addClass("row-adjust-card-no-shadow");

    cardHeader = $(cardDom).children('.card-header');
    $(cardHeader).addClass("row-adjust-card-hide");
    $(cardHeader).find('.smallpic').hide();

    $(cardHeader).find('.pos').hide();
    $(cardHeader).find('.edit').hide();

    hideCard_Inner(cardDom);

    function hideCard_Inner(val) {
        let cardDom = val;
        setTimeout(function () {
            $(cardDom).hide();
        }, 300)
    }
}

function showModal(id) {
    event.preventDefault();

    $(".row.row-content").css("transition", "0.5s ease-in");
    $(".row.row-content").css("transform", "translateY(30px)");
    $(".row.row-content").css("opacity", "0");

    $("#" + id).css('display', "block");
    setTimeout(function () {
        $("#" + id).addClass("modal-show");
    }, 500)
}

function closeModal(id) {
    event.preventDefault();
    $("#" + id).removeClass("modal-show");
    $(".row.row-content").css("transition", "transform 0.5s cubic-bezier(0.7, .5, .5, 0.9), opacity 0.5s cubic-bezier(0.8, .1, .9, 1)");
    setTimeout(function () {
        $(".row.row-content").css("transform", "translateY(0px)");
        $(".row.row-content").css("opacity", "1");

        setTimeout(function () {
            $("#" + id).css('display', "none");
        }, 300)
        // $(".row.row-content").css("transition", "unset");
    }, 300)


}

function clearModalData(id) {
    $("#" + id).find("input").val("");
}

function numberWithCommas(x) {
    var z = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return z;
}