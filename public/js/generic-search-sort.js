"use strict";

var searchSortConfig = {

    tableHeader: "data-header",  //this helps to add action listener for asc or dsc sort
    tableHeaderNameTag: "li",

    tableRow: "data-row",
    order: ">",//asc or desc
    tableDataTag: "li",//can be string or text or custom // please add code for custom

    columnNumberToSort: 3, //starts from 0 to n
    columnDataType: "number"  //string


};

class GenericSearchSort {

    constructor() {


    }


    sortTable() {
        var rows, switching, i, x, y, shouldSwitch;
        switching = true;
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = document.querySelectorAll(`[${searchSortConfig.tableRow}]`);

            if (rows == null) {
                throw new Error("Please add property tableRow to select the rows");;
            }
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 0; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */

                var tableDataTag = searchSortConfig.tableDataTag;

                if (tableDataTag == null) {
                    throw new Error("Please initialize property tableDataTag of searchSortConfig");
                }

                x = rows[i].getElementsByTagName(tableDataTag)[searchSortConfig.columnNumberToSort].innerHTML.replaceAll(/([ ,円])/ig, "");
                y = rows[i + 1].getElementsByTagName(tableDataTag)[searchSortConfig.columnNumberToSort].innerHTML.replaceAll(/([ ,円])/ig, "");
                // Check if the two rows should switch place:


                var compare = new Function('x', 'y', 'return ' + `x${searchSortConfig.order}y`);

                if (searchSortConfig.columnDataType == "number")
                    compare = new Function('x', 'y', 'return ' + `parseFloat(x)${searchSortConfig.order}parseFloat(y)`);

                if (compare(x, y)) {
                    // If so, mark as a switch and break the loop:
                    console.log(parseFloat(x), parseFloat(y));
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }


    handleHeaderDataType(head, columnIndex) {
        var header_data_type = head.getAttribute("data-type");
        if (header_data_type == null) {
            header_data_type = "string";
            head.setAttribute("data-type", header_data_type);
            console.warn("Please try to add 'data-type' property in each column name with value of string or number.");
        }

        searchSortConfig.columnDataType = header_data_type;
        searchSortConfig.columnNumberToSort = columnIndex;

    }


    handleSortOrder(head) {


        var sort_order = head.getAttribute("sort-order");


        if (sort_order == null) {
            sort_order = ">";
            head.setAttribute("sort-order", sort_order);
            head.classList.add("sort-by-asc");
        }
        else if (sort_order === ">") {
            sort_order = "<";
            head.setAttribute("sort-order", sort_order);
            head.classList.add("sort-by-desc");
        }


        else if (sort_order === "<") {
            sort_order = ">";
            head.setAttribute("sort-order", sort_order);
            head.classList.add("sort-by-asc");
        }

        searchSortConfig.order = sort_order;
    }


    resetClassListsFromHeader(heads) {

        for (let i = 0; i < heads.length; i++) {

            heads[i].classList.remove("sort-by-asc", "sort-by-desc");
        }


    }

    addSortListener() {
        var header = document.querySelector(`[${searchSortConfig.tableHeader}]`);
        if (header == null) throw new Error("Please add a property named  'data-header' in the table of the header variable 'tableHeader' .");

        var heads = header.getElementsByTagName(searchSortConfig.tableHeaderNameTag);
        if (heads == null) throw new Error(("Please add a property named 'tableHeaderNameTag' in the table of the header."));


        var classContext = this;


        for (let i = 0; i < heads.length; i++) {



            heads[i].addEventListener("click", function () {
                classContext.resetClassListsFromHeader(heads);

                classContext.handleHeaderDataType(heads[i], i);
                classContext.handleSortOrder(heads[i]);
                console.log(searchSortConfig);
                classContext.sortTable();

            });
        }


    }


    functionExists(func) {
        return (typeof func == "function");
    }

    searchInTable(query) {
        var rows = document.querySelectorAll(`[${searchSortConfig.tableRow}]`);
        for (let i = 0; i < rows.length; i++) {
            if (rows[i].innerText.toLowerCase().includes(query.toLowerCase())) {

                if (this.functionExists(showCard))
                    showCard(rows[i]);
                else {
                    console.warn("Please check showcard definition.");
                }
            }
            else {
                if (this.functionExists(hideCard))
                    hideCard(rows[i]);
                else {
                    console.warn("Please check hidecard definition.");
                }
            }
        }
    }

    searchInColumn(query, column) {
        var rows = document.querySelectorAll(`[${searchSortConfig.tableRow}]`);
        for (let i = 0; i < rows.length; i++) {
            if (rows[i].innerText.toLowerCase().includes(query.toLowerCase())) {

                if (this.functionExists(showCard))
                    showCard(rows[i]);
                else {
                    console.warn("Please check showcard definition.");
                }
            }
            else {
                if (this.functionExists(hideCard))
                    hideCard(rows[i]);
                else {
                    console.warn("Please check hidecard definition.");
                }
            }
        }
    }


    addSearchListener() {
        var search = document.getElementById("search");
        var classContext = this;
        if (search == null)
            throw new Error("Please add an input field with id of 'search' .");

        else {

            search.addEventListener("keyup", function () {
                classContext.searchInTable(search.value);
            });

        }


    }


    checkSearchSortDefinition() {

        if (typeof searchSortConfig == "undefined" || searchSortConfig == null) {
            throw new Error(`Please initialize a variable for the table ie 
            
            var searchSortConfig = {

                tableHeader: "data-header",  //this helps to add action listener for asc or dsc sort
                tableHeaderNameTag: "li",
            
                tableRow: "data-row",
                order: ">",//asc or desc
                tableDataTag: "li",//can be string or text or custom // please add code for custom
            
                columnNumberToSort: 3, //starts from 0 to n
                columnDataType: "number"  //string
            
            
            };`);
        }


    }


    configure() {


        this.checkSearchSortDefinition();
        this.addSortListener();
        this.addSearchListener();
    }




}


new GenericSearchSort().configure();