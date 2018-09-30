$(document).ready(function(){
    $(".img-search").hide();

    var check = 0;

    // $("input.timkiem").click(function(){
    //     if(check==0){

    //         $("input.timkiem").css("width", "500px");
    //         $("input.timkiem").css("padding", "5px");
    //     }
    // });

});

//search

$(document).ready(function(){
    $(".c-sub-menu").hide();    

    $(".c-menu").click(function(){
        $(this).next().slideToggle();
    })
    var check = 0;

    function show_menu(){
        check = 1;
        $(".menu-bar").slideDown(200);
    }

    function hide_menu(){
        $(".menu-bar").slideUp(200);
        check  = 0;
    }

    $(".show_nav").click(function(){

        if(check == 0){
            show_menu();
        } else {
            hide_menu();
        }
    });
    
});

