// 自定义js
$(function () {

    $(".sidebar .root").each(function () {
        if ($(this).hasClass('focus')) {
            $(this).children(".parent").append('<i class="icon icon-angle-down">&#xf107;</i>');
        } else {
            $(this).children(".parent").append('<i class="icon icon-angle-up">&#xf106;</i>');
        }
    });

    $(".parent").click(function (event) {
        event.preventDefault();
        $(this).next().slideToggle();
        if ($(this).children('i').hasClass('icon-angle-up')) {
            $(this).children('i').remove();
            $(this).append('<i class="icon icon-angle-down">&#xf107;</i>');
        } else {
            $(this).children('i').remove();
            $(this).append('<i class="icon icon-angle-up">&#xf106;</i>');
        }
    })
})