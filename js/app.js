$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

$(document).ready(function(){
    $('#demo1').stopwatch().stopwatch('start');
    var steps = $('form').find(".questions");
    var count = steps.size();
    steps.each(function(i){
        hider=i+2;
        if (i == 0) { 	
            $("#question_" + hider).hide();
            createNextButton(i);
        }
        else if(count==i+1){
            var step=i + 1;
            //$("#next"+step).attr('type','submit');
            $("#next"+step).on('click',function(){
                submit();
            });
        }
        else{
            $("#question_" + hider).hide();
            createNextButton(i);
        }
        
    });
    function submit(){
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: 'json',
            data: {
                data: $('#quiz_form').serializeObject(),
                type: 'results'
            },
            success: function(result) {
                if (result && result.data) {
                    var r = result.data;
                    $("#quiz_form,#demo1").addClass("hide");
                    $('#result').show();
                    $('#right_answer').html(r.right_answer);
                    $('#wrong_answer').html(r.wrong_answer);
                    $('#unanswered').html(r.unanswered);
                }
            }
        });
    
    }
    function createNextButton(i){
        var step = i + 1;
        var step1 = i + 2;
        $('#next'+step).on('click',function(){
            $("#question_" + step).hide();
            $("#question_" + step1).show();
        });
    }
    setTimeout(function() {
        submit();
    }, 50000);
    $(document).on('click', '#retake_btn', function() {
        $('#demo1').stopwatch().stopwatch('reset');
        $("#quiz_form,#demo1").removeClass("hide");
        $('#result').hide();
    });
});