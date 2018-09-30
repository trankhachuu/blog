
    $(document).ready(function(){
     // $('.form-1').hide();
     $('.form-2').hide();
     $('.form-3').hide();
     $('.form-4').hide();
     $('.form-5').hide();

     $('#o1').click(function(){
        $('.form-1').show(500);
        $('.form-2').hide(500);
        $('.form-3').hide(500);
        $('.form-4').hide(500);
        $('.form-5').hide(500);
    });

     $('#o2').click(function(){
        $('.form-1').hide(500);
        $('.form-2').show(500);
        $('.form-3').hide(500);
        $('.form-4').hide(500);
        $('.form-5').hide(500);
    });

     $('#o3').click(function(){
         $('.form-1').hide(500);
         $('.form-2').hide(500);
         $('.form-3').show(500);
         $('.form-4').hide(500);
         $('.form-5').hide(500);
     });

     $('#o4').click(function(){
         $('.form-1').hide(500);
         $('.form-2').hide(500);
         $('.form-3').hide(500);
         $('.form-4').show(500);
         $('.form-5').hide(500);
     });

     $('#o5').click(function(){
         $('.form-1').hide(500);
         $('.form-2').hide(500);
         $('.form-3').hide(500);
         $('.form-4').hide(500);
         $('.form-5').show(500);
     });
     var noidung;

     $("#p1").click(function(){
        noidung = document.getElementById("p1").getAttribute('value');
        document.getElementById("o1").innerHTML = noidung;
    });

     $("#p2").click(function(){
        noidung = document.getElementById("p2").getAttribute('value');
        document.getElementById("o1").innerHTML = noidung;
    });

     $("#p3").click(function(){
        noidung = document.getElementById("p3").getAttribute('value');
        document.getElementById("o1").innerHTML = noidung;
    });

     $("#p4").click(function(){
        noidung = document.getElementById("p4").getAttribute('value');
        document.getElementById("o1").innerHTML = noidung;
    });

 });

 function chonRap(obj){
    var message = document.getElementById('o2');
    message.innerHTML = "";
    var value = obj.value;
    var dd = document.getElementById("o2").innerHTML;
    if (value == ''){
        message.innerHTML = dd + "Bạn chưa chọn rap";
    }
    else if (value == 'rap1'){
        message.innerHTML = dd+ "Rạp Nguyễn Văn Linh";
    }
    else if (value == 'rap2'){
        message.innerHTML = dd +  "Rạp 2/9";
    }
    else if (value == 'rap3'){
        message.innerHTML = dd+ "Rạp BigC";
    }
    else if (value == 'rap4'){
        message.innerHTML = dd +  "Rạp Lotteia";
    }
}

window.onload = function(){

    var element = document.querySelectorAll(".time-line > li");
    element[1].onclick = function(){
        for(var i = 0 ; i < element.length ; i++){
            element[i].classList.remove("chon");
        }
        element[1].className = "chon";
    }
}