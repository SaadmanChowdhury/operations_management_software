

////========SIDEBAR MENU==========////

const mainContainerFlexFlag = false;

var menu = document.getElementById('header_top');
var shade = document.getElementById('background-shade');
var content = document.getElementsByClassName('page-container');

const sidebarCloseWidth = "4.2vw";
const sidebarOpenWidth = "17vw";
const sidebarDuration = "0.5s";
const sidebarOpenCurve = "cubic-bezier(0,0.7,0.3,1.3)";
const sidebarCloseCurve = "cubic-bezier(0,.7,.3,1)";

var isMouseOnSideBar = false;
var isMenuUndergoingCloseOperation = false;

function sidebar_expand(sidebar) {
    var text = $(".label-text.sidebar");
    isMouseOnSideBar = true;
    sidebar.style.transition = sidebarDuration + " " + sidebarOpenCurve;
    sidebar.style.width = sidebarOpenWidth;

    if (mainContainerFlexFlag) {
        content[0].style.left = sidebarOpenWidth;
        content[0].style.width = "calc(100% - 17vw)";
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

    var text = $(".label-text.sidebar");

    isMouseOnSideBar = false;
    for (var i = 0; i < 5; i++) {
        text[i].style.display = "none";
    }

    sidebar.style.width = sidebarCloseWidth;
   // sidebar.style.minWidth = "40px";
    sidebar.style.transition = sidebarDuration + " " + sidebarCloseCurve;

    if (mainContainerFlexFlag) {
        content[0].style.left = sidebarCloseWidth;
        content[0].style.width = "calc(100% - " + sidebarCloseWidth + ")";
        content[0].style.minWidth = "calc(100% - " + sidebarCloseWidth + "- 40px)";
    }

    shade.style.opacity = 0;
    setTimeout(function () {
        shade.style.display = "none";
    }, 310);
}

////========ROW THICKNESS ADJUSTMENTS==========////

ROW_STATE = 0;


function adjustRowHeightByState(preference, toggle) {

    var state = parseInt(preference.value);
    if (toggle) {

        if (state + 1 > 3) {
            state = 0;
        } else
            state = state + 1;

    }


    preference.value = state;;

    switch (state) {
        case 0:
            $(".card").addClass("row-adjust-adjacent");
            $(".card-header").removeClass("row-adjust-compressed");
            $(".smallpic").removeClass("row-adjust-smaller-pic");
            $(".pos").removeClass("row-adjust-tiny-pos");
            $(".edit").removeClass("row-adjust-button-compressed")
            break;
        case 1:
            $(".card").addClass("row-adjust-adjacent");
            $(".card-header").addClass("row-adjust-compressed");
            $(".smallpic").addClass("row-adjust-smaller-pic");
            $(".pos").addClass("row-adjust-tiny-pos");
            $(".edit").addClass("row-adjust-button-compressed")
            break;
        case 2:
            $(".card").removeClass("row-adjust-adjacent");
            $(".card-header").addClass("row-adjust-compressed");
            $(".smallpic").addClass("row-adjust-smaller-pic");
            $(".pos").addClass("row-adjust-tiny-pos");
            $(".edit").addClass("row-adjust-button-compressed")
            break;
        case 3:
            $(".card").removeClass("row-adjust-adjacent");
            $(".card-header").removeClass("row-adjust-compressed");
            $(".smallpic").removeClass("row-adjust-smaller-pic");
            $(".pos").removeClass("row-adjust-tiny-pos");
            $(".edit").removeClass("row-adjust-button-compressed")
            break;

    }

}

/** Load initial state */
$(function () {


    var rowToogler = document.getElementById("toogler");

    rowToogler.addEventListener("click", function () {
        event.preventDefault();

        var preference = document.getElementById("initial-preference");
        adjustRowHeightByState(preference, true);
        updateUserUIPreference($("#page-name").val() + "_preference", preference.value);
    })
})





// function adjustRowHeight(isPageLoad = false) {

//     if (isPageLoad) {
//         $(".card").addClass("no-animation");
//         $(".card-header").addClass("no-animation");
//         $(".smallpic").addClass("no-animation");
//         $(".pos").addClass("no-animation");
//         $(".edit").addClass("no-animation");
//     }
//     else
//         event.preventDefault();

//     switch (ROW_STATE) {
//         case 0:
//             ROW_STATE++;
//             $(".card").addClass("row-adjust-adjacent");
//             $(".card-header").removeClass("row-adjust-compressed");
//             $(".smallpic").removeClass("row-adjust-smaller-pic");
//             $(".pos").removeClass("row-adjust-tiny-pos");
//             $(".edit").removeClass("row-adjust-button-compressed")
//             break;
//         case 1:
//             ROW_STATE++;
//             $(".card").addClass("row-adjust-adjacent");
//             $(".card-header").addClass("row-adjust-compressed");
//             $(".smallpic").addClass("row-adjust-smaller-pic");
//             $(".pos").addClass("row-adjust-tiny-pos");
//             $(".edit").addClass("row-adjust-button-compressed")
//             break;
//         case 2:
//             ROW_STATE++;
//             $(".card").removeClass("row-adjust-adjacent");
//             $(".card-header").addClass("row-adjust-compressed");
//             $(".smallpic").addClass("row-adjust-smaller-pic");
//             $(".pos").addClass("row-adjust-tiny-pos");
//             $(".edit").addClass("row-adjust-button-compressed")
//             break;
//         case 3:
//             ROW_STATE = 0;
//             $(".card").removeClass("row-adjust-adjacent");
//             $(".card-header").removeClass("row-adjust-compressed");
//             $(".smallpic").removeClass("row-adjust-smaller-pic");
//             $(".pos").removeClass("row-adjust-tiny-pos");
//             $(".edit").removeClass("row-adjust-button-compressed")
//             break;
//     }

//     setTimeout(function () {
//         if (isPageLoad) {
//             $(".card").removeClass("no-animation");
//             $(".card-header").removeClass("no-animation");
//             $(".smallpic").removeClass("no-animation");
//             $(".pos").removeClass("no-animation");
//             $(".edit").removeClass("no-animation");
//         }
//         else
//             updateUserUIPreference($("#page-name").val() + "_preference", ROW_STATE);
//     });
// }

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

function dateDifference(endDate, startDate) {
    var diffInMilliseconds = endDate.getTime() - startDate.getTime();
    var diffYear = diffInMilliseconds / 1000 / 3600 / 24 / 365;
    var monthDiff = Math.floor(((diffYear % 1) * 365) / 30);

    if (Math.floor(diffYear) == 0) {
        diffYear = ""
    }
    else {
        diffYear = Math.abs(Math.floor(diffYear)) + "年"
    }

    if (Math.floor(monthDiff) == 0) {
        if (Math.floor(diffYear) == 0) {
            monthDiff = Math.abs(Math.floor(monthDiff)) + "月"
        }
        else {
            monthDiff = "";
        }
    }
    else {
        monthDiff = Math.abs(Math.floor(monthDiff)) + "月"
    }


    return diffYear + monthDiff;
}

function isGeneralUser() {
    var currentUserAuthority = document.getElementById("user-authority");
    return currentUserAuthority.value == "一般ユーザー" ? true : false;
}

function isSystemAdmin() {
    var currentUserAuthority = document.getElementById("user-authority");
    return currentUserAuthority.value == "システム管理者" ? true : false;
}

function isCurrentUser(userId) {
    var currentUserId = document.getElementById("logged-in-id");
    return userId == currentUserId.value ? true : false;
}

function showEmptyListInfromation(targetDomId) {

    $(targetDomId).html(`
    
       <div style='text-align:center; line-height:100px; font-size: 2vw; color: red;  '>  表示できる項目が存在していません </div>
    
    `);

}


function resetCss(parent) {
    var allElements = parent.getElementsByTagName("*");
    for (var i = 0, len = allElements.length; i < len; i++) {
        var element = allElements[i];
        element.style = `{
            all: initial;
            * {
              all: unset;
            }
          }`;


        console.log(element.style);
    }
}
