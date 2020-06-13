$(document).ready(() => {
    let parametersString = window.location.search.slice(1);
    let parametersArray = parametersString.split("&");
    let sortedField = '', sortDirection = '';

    for (let oneParameter of parametersArray) {
        let explodedParameter = oneParameter.split('=');
        if (explodedParameter[0] === 'orderBy') sortedField = explodedParameter[1];
        else if (explodedParameter[0] === 'direction') sortDirection = explodedParameter[1];
    }
    if (sortedField && sortDirection) {
        $('.sortable.mod_'+sortedField+'.mod_'+sortDirection).find('.sortable_item').addClass('mod_sorted');
    }


    $('.index_pagination-item.mod_selectable').click((e) => {

        let currentPage = +$('.index_pagination-item.mod_active').text().trim();
        let newPage = 1;

        let clickedPage = $(e.target).text().trim();

        if (isNaN(clickedPage)) {
            newPage = (clickedPage === 'Next') ? currentPage + 1 : currentPage - 1;
        } else {
            newPage = +clickedPage;
        }
        window.location.search = changePageUrl(currentPage, newPage);
    });

    $('.sortable').click((e) => {
        sortedField = $(e.delegateTarget).data('field');
        sortDirection = $(e.delegateTarget).hasClass('mod_desc') ? 'desc' : 'asc';
        window.location.search = changeSortUrl(sortedField, sortDirection);
    });


    changePageUrl = (currentPage, newPage) => {
        let outputParameters = '';

        if (parametersString.indexOf('page') !== -1) {
            outputParameters = parametersString.replace('page=' + currentPage, 'page=' + newPage);
        } else if (parametersString) {
            outputParameters = "?page=" + newPage + '&' + parametersString;
        } else {
            outputParameters = "?page=" + newPage;
        }
        return outputParameters;
    };

    changeSortUrl = (sortBy, sortDirection) => {
        let outputParameters = '?';
        for (let oneParameter of parametersArray) {
            if (oneParameter.indexOf('page') !== -1) {
                outputParameters += oneParameter + '&';
                break;
            }
        }
        outputParameters += 'orderBy=' + sortBy + '&direction=' + sortDirection;

        return outputParameters;
    };

});
