$(document).ready(() => {
    $('.index_pagination-item.mod_selectable').click((e) => {

        let currentPage = +$('.index_pagination-item.mod_active').text().trim();
        let newPage = 1;

        let clickedPage = $(e.target).text().trim();

        if (isNaN(clickedPage)) {
            newPage = (clickedPage === 'Next') ? currentPage + 1 : currentPage - 1;
        } else {
            newPage = +clickedPage;
        }


        console.log('Вызвана страница: ' + $(e.target).text().trim());
        console.log('Текущая страница: ' + $('.index_pagination-item.mod_active').text().trim());


        window.location.search = changeUrlParameters(currentPage, newPage);
        // console.log(changeUrlParameters(currentPage, newPage));
    });


});

changeUrlParameters = (currentPage, newPage) => {
    let parametersString = window.location.search;
    let outputParameters = '';
    console.log(parametersString);

    if (parametersString.indexOf('page') !== -1) {
        outputParameters = parametersString.replace('page=' + currentPage, 'page=' + newPage);
    } else if (parametersString) {
        outputParameters = "?page=" + newPage + '&' + parametersString;
    } else {
        outputParameters = "?page=" + newPage;
    }

    console.log(outputParameters);

    return outputParameters;

    //
    // let parametersArray = parametersString.split('&');
    // console.log(parametersArray);
    // let pageExist = false;
    // parametersArray.forEach((parametersItem) => {
    //     let oneParameter = parametersItem.split('=');
    //     console.log(oneParameter);
    //     if (oneParameter[0] === 'page') {
    //         oneParameter[1] = 123;
    //         parametersItem = oneParameter.join('=');
    //         pageExist = true;
    //     }
    // });
    // console.log(parametersArray);
    // if (!pageExist)
    //
};
