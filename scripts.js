$(document).ready(function(){
    $('.button').click(function(){
        var clickBtnValue = $(this).val();
        var clickBtnFun = $(this)[0].id;
        var ajaxurl = 'ajax.php',
        data =  {'action': clickBtnValue, 'param': clickBtnFun};
        $.post(ajaxurl, data, function (response) {
            // alert(clickBtnFun);
            console.log(clickBtnFun);
            // console.log("Console log");
            // alert(response);
            // alert("action performed successfully");
        });
    });
});

// $(document).ready(function(){
//     $('.admin').click(function(){
//         var clickBtnValue = $(this).val();
//         var clickBtnFun = $(this)[0].id;
//         var ajaxurl = 'ajax.php',
//         data =  {'action': clickBtnValue, 'param': clickBtnFun};
//         $.post(ajaxurl, data, function (response) {
//             // alert(clickBtnFun);
//             console.log(clickBtnFun);
//             // console.log("Console log");
//             // alert(response);
//             // alert("action performed successfully");
//         });
//     });
// });