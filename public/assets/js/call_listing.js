$("#cdr_table td a").each(function(){
        if ($(this).text()== 0) {
            $(this).hide();
;
        }
});
$('.back').hide();
var buttom = document.querySelector("button");
var submit_val = buttom.getAttribute("data-value");
console.log(submit_val);
if(submit_val!="q")
  $('.back').show();
