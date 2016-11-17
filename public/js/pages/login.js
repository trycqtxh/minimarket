$(function () {
	var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};
	var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
	var stack_bar_bottom = {"dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0};

	$('body').addClass('login-page');
	PNotify.prototype.options.styling = "bootstrap3";

	$('button#sign').click(function () {
		$.ajax({
			type    : "post",
			url     : "/login",
			dataType: 'json',
			cache : false,
			data: {
				'_token'    : $("input[name='_token']").val(),
				'username'  : $('input[name="username"]').val(),
				'password'  : $('input[name="password"]').val()

			},
			success: function(request, textStatus, errorThrown) {
				window.location.replace(request.intended);//location.reload(request);
			},
			error: function(request, textStatus, errorThrown){
				switch (request.status){
					case 422 :
						$.each(request.responseJSON, function(key, val){
							var opts = {
								type: textStatus,
								title: "",
								text: val,
								addclass: "stack-bar-bottom",
								cornerclass: "",
								width: "100%",
								stack: stack_bar_bottom,
								delay: 1200
							};
							show_notif(opts);
						});
						break;
					case  401:
						var opts = {
							type: textStatus,
							title: "Gagal Login",
							text: request.responseJSON,
							addclass: "stack-bar-bottom",
							cornerclass: "",
							width: "100%",
							stack: stack_bar_bottom,
							delay: 1200
						};
						show_notif(opts);
						break;
				}
			}
		})
	});
});
function show_notif(notif) {
	new PNotify(notif);
}