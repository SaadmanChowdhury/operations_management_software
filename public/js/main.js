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

var text = document.getElementsByClassName('hide');
var menu = document.getElementById('header_top');
var shade = document.getElementById('background-shade');
var content = document.getElementsByClassName('page-container');

var isMouseOnSideBar = false;
var isMenuUndergoingCloseOperation = false;

function sidebar_expand(sidebar) {
    sidebar.style.transition = "0.3s ease-out";
    sidebar.style.width = "250px";

    if (mainContainerFlexFlag) {
        content[0].style.left = "250px";
        content[0].style.width = "calc(100% - 250px)";
        content[0].style.transition = "0.3s ease-out";
    }
    // menu.classList.add('fade-left');

    setTimeout(function () {
        for (var i = 0; i < 5; i++) {
            text[i].style.display = "inline-block";
        }
    }, 200);

    isMouseOnSideBar = true;


    if (!isMenuUndergoingCloseOperation) {
        shade.style.display = "block";
        isMenuUndergoingCloseOperation = false;
    }

    setTimeout(function () {
        shade.style.opacity = 0.3;
    }, 0);
}

function sidebar_mouseOutHandler(sidebar) {
    isMouseOnSideBar = false;

    setTimeout(function () {
        normalSideBar(sidebar)
    }, 200);
}

function normalSideBar(sidebar) {

    if (isMouseOnSideBar)
        return;

    for (var i = 0; i < 5; i++) {
        text[i].style.display = "none";
    }

    sidebar.style.width = "60px";
    sidebar.style.transition = "0.3s cubic-bezier(.51,.84,.77,.99)";
    menu.classList.remove('fade-left');

    if (mainContainerFlexFlag) {
        content[0].style.left = "60px";
        content[0].style.width = "calc(100% - 60px)";
    }

    isMenuUndergoingCloseOperation = true;

    shade.style.opacity = 0;
    setTimeout(function () {
        if (isMouseOnSideBar)
            return;

        shade.style.display = "none";
        isMenuUndergoingCloseOperation = false;
    }, 410);
}

ROW_STATE = 0;

function adjustRowHeight() {

    event.preventDefault();

    switch (ROW_STATE) {
        case 0:
            ROW_STATE++;
            $(".card").addClass("row-adjust-adjacent");
            break;
        case 1:
            ROW_STATE++;
            $(".card-header").addClass("row-adjust-compressed");
            $(".smallpic").addClass("row-adjust-smaller-pic");
            $(".pos").addClass("row-adjust-tiny-pos");
            $(".edit").addClass("row-adjust-button-compressed")
            break;
        case 2:
            ROW_STATE++;
            $(".card").removeClass("row-adjust-adjacent");
            break;
        case 3:
            ROW_STATE = 0;
            $(".card-header").removeClass("row-adjust-compressed");
            $(".smallpic").removeClass("row-adjust-smaller-pic");
            $(".pos").removeClass("row-adjust-tiny-pos");
            $(".edit").removeClass("row-adjust-button-compressed")
            break;
    }
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