$(document).ready(function(){
    required = ["f_name", "l_name", "office_loc"];

    errornotice = $("#error");
    // The text to show up within a field when it is incorrect
    emptyerror = "Please fill out this field.";

    $("#form").submit(function(){

        if($('#submit').val()=='Next'){
            errornotice.hide();
            return true;
        }


        for (i=0;i<required.length;i++) {
            var input = $('#'+required[i]);
            if ((input.val() == "") || (input.val() == emptyerror)) {
                input.addClass("needsfilled");
                input.val(emptyerror);
                errornotice.fadeIn(750);
            } else {
                input.removeClass("needsfilled");
            }
        }

        //if any inputs on the page have the class 'needsfilled' the form will not submit
        if ($(":input").hasClass("needsfilled")) {
            return false;
        } else {
            errornotice.hide();
            return true;
        }

    });

    // Clears any fields in the form when the user clicks on them
    $(":input").focus(function(){
        if ($(this).hasClass("needsfilled") ) {
            $(this).val("");
            $(this).removeClass("needsfilled");
        }
    });




});