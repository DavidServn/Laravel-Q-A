$(document).ready(function() {
    var url = "/question";

    //Accept question
    $('body').on("click",'#msg_accept', function() {
		var questionId = $(this).val();	
		$(this).parent().find('#msg_delete').remove();
		$(this).remove();

        $.ajax({
            type: "GET",
            url: url + '/accept/' + questionId,
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
	
	//Delete question
    $('body').on("click",'#msg_delete', function() {
		var questionId = $(this).val();
		$(this).parent().remove();

        $.ajax({
            type: "GET",
            url: url + '/delete/' + questionId,
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});