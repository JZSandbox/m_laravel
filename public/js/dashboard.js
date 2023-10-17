/* Navigation Toggle */

$('.dashboard-menu-nav-item').on("click", function (){
    let elem = $(this);
    $('.dashboard-menu-nav-item').each(function (){
        $('.dashboard-menu-nav-item').removeClass('active')
        elem.addClass('active');
    })
})
/* DropDown */
$('.customer-dropdown').on("click", function (){
    $('.customer-dropdown-items').slideToggle();
})

$('.customer-dropdown-items').on("mouseleave", function (){
    $(this).css("display", "none")
})
/* Category Tabs*/
$('.category-menu-link').on("click", function (){
    let elem = $(this).data('tabs-menu');
    let nav = $(this).parent();
    $('.category-menu-item').each(function (){
        $('.category-menu-item').removeClass('active')
        nav.addClass('active');
    })
    $('.category-tabs').each(function (){
        $('.category-tabs').removeClass('show').attr('aria-expanded', 'false').hide();
        $('.'+elem).attr('aria-expanded', 'true').slideDown();
    })
})


/* Ajax Call Handler */

var iconObject = {
    error: 'error',
    success : 'check_circle',
    info : 'tips_and_updates',
};

var iconColor = {
    success : 'success',
    error : 'error',
    info : 'info'
}

function success(response, iconObject, iconColor) {
    if(response.status == 400) {
        console.log(response)
        let error_notification = `
        <div class="notification-area">
            <div class="notification noti-${iconColor} mb-3">
                <div class="noti-left">
                    <span class="material-icons">${iconObject}</span>
                </div>
                <div class="noti-right">
                    <div class="noti-right-top">
                        <span>Fehler!</span>
                    </div>
                    <div class="noti-right-bottom">
                        ${response.error}
                    </div>
                </div>
            </div>
        </div>`
        $('body').append(error_notification);
        $('.notification-area').delay(5000).fadeOut();
    } else if (response.status == 202) {

    } else if (response.status == 200) {
        console.log(response)
        let error_notification = `
       <div class="notification-area">
            <div class="notification noti-${iconColor} mb-3">
                <div class="noti-left">
                    <span class="material-icons">${iconObject}</span>
                </div>
                <div class="noti-right">
                    <div class="noti-right-top">
                        <span>Erfolg!</span>
                    </div>
                    <div class="noti-right-bottom">
                        ${response.success}
                    </div>
                </div>
            </div>
        </div>
        `
        $('body').append(error_notification);
        $('.notification-area').delay(5000).fadeOut();
    } else if (response.status == 201) {
        /* Created */
    } else if (response.status == 403) {

    }
}

