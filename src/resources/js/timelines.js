function like(videoid,userid) {
	$.ajax({
		method: "POST",
		url: "operaciones.php?op=like",
		data: {video_id:videoid,user_id:userid},
		success: function(response) {
			console.log("Respuesta: " + response);
			// colorear el enlace de like
			if (IsJsonString(response)) {
				var res = $.parseJSON(response);
				if (res.status == "OK") {
					if (res.msg == "Like") {
						Materialize.toast('¡Te gusta!', 2000);
					} else if (res.msg == "Dislike") {
						Materialize.toast('No te gusta :(', 2000)
					}
				}
				if (res.status == "ERROR") {
					Materialize.toast(res.message, 2000);
				}
			}
		}
	});
}
function followuser(follower,followed) {
	$.ajax({
		method: "POST",
		url: "operaciones.php?op=follow-user",
		data: {user_id:follower,target_id:followed},
		success: function(response) {
			console.log("Respuesta: " + response);
			// colorear el enlace de like
			if (IsJsonString(response)) {
				var res = $.parseJSON(response);
				if (res.status == "OK") {
					if (res.msg == "Followed") {
						Materialize.toast('¡Sigues a este usuario!', 2000);
					} else if (res.msg == "Unfollowed") {
						Materialize.toast('Ya no sigues a este usuario.', 2000)
					}
				}
				if (res.status == "ERROR") {
					Materialize.toast(res.message, 2000);
				}
			}
		}
	});
}
function loadMore(contador, tipo){
	//Materialize.toast("This is our ScrollFire Demo!", 1500 )
	var circle = '<div id="loadmore" class="preloader-wrapper active" style="margin-left: '+
	($("#timelines").width()/2)
	+'px;"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
	$("#timelines").append(circle);
	$("#"+tipo).load('pages/timelines.php?c='+contador+'&tipo='+tipo);
	$("#loadmore").remove();
}