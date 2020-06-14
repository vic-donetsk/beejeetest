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

    $('.creation_form').submit((e) => {
        e.preventDefault();
        let headers = ['user', 'email', 'content'];
        let axiosParams = new FormData();

        // set fillable fields to save
        for (let oneHeader of headers) {
            axiosParams.set(oneHeader, $(`.creation_form [name=${oneHeader}]`).val());
        }
        // set id (when editing, not creating)
        if ($(e.target).data('id')) axiosParams.set('id', $(e.target).data('id'));
        axiosParams.set('token', $('main').data('access'));

        axios({
            method: 'post',
            url: '/save',
            data: axiosParams,
            headers: {'Content-Type': 'multipart/form-data' }
        })
            .then((response) => {
                //handle success
                if (response.data.declined) {
                    window.location.href = '/auth';
                }
                if (response.data.location) {
                    console.log(response.data.location);
                    successCreation(response.data.location);
                } else {
                    showErrors('creation', response.data);
                }
            });
    });

    $('.auth_form').submit((e) => {
        e.preventDefault();
        let headers = ['login', 'password'];
        let axiosParams = new FormData();

        for (let oneHeader of headers) {
            axiosParams.set(oneHeader, $(`.auth_form [name=${oneHeader}]`).val());
        }
        axios({
            method: 'post',
            url: '/login',
            data: axiosParams,
            headers: {'Content-Type': 'multipart/form-data' }
        })
            .then((response) => {
                //handle success
                if (response.data.location) {
                    window.location.href = response.data.location;
                } else {
                    showErrors('auth', response.data);
                }
            });
    });

    $('#index_controls-logout').click(()=> {
        axios({
            method: 'post',
            url: '/logout',
        })
            .then((response) => {
                window.location.reload();
            });
    });

    $('.status_admin').change((e) => {
        let axiosParams = new FormData();
        axiosParams.set('id', $(e.target).val());
        axiosParams.set('token', $('main').data('access'));
        axios({
            method: 'post',
            url: '/done',
            data: axiosParams,
            headers: {'Content-Type': 'multipart/form-data' }
        })
            .then((response) => {
               if (response.data.accepted) {
                   $(e.target).prop({"disabled": true, "checked": true});
               } else {
                   window.location.href = '/auth';
               }
            });
    });

    $('.mod_edit-admin').click((e) => {
        window.location.href = '/edit?id=' + $(e.target).data('id');
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

    showErrors = (formName, errors) => {
        console.log('errors');
        console.log(errors);
        for(let field in errors) {
            let errorField = $('#' + formName + '_' + field);
            errorField.addClass('is-invalid').next().text(errors[field]);
            errorField.find(`[name = ${field}]`).focus( () => {
                errorField.removeClass('is-invalid').next().text('');
            });

        }
    };

    successCreation = (previousPage) => {
        $('.creation_success-wrapper').css('display', 'block');
        $('.creation_success-link').attr('href', previousPage);
    };

});
