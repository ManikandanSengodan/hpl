$(document).ready(function () {
	$("#file").change(function (e) {
		var img = e.target.files[0];


		if (!pixelarity.open(img, false, function (res, faces) {
			$("#result").attr("src", res);
			$("#front_crop_image").val(res);
			$(".face").remove();

			for (var i = 0; i < faces.length; i++) {
				console.log("width" + faces[i].height, faces[i].width);
				$("body").append("<div class='face' style='height: " + faces[i].height + "px; width: " + faces[i].width + "px; top: " + ($("#result").offset().top + faces[i].y) + "px; left: " + ($("#result").offset().left + faces[i].x) + "px;'>");
			}

		}, "jpg", 0.7, true)) {
			alert("Whoops! That is not an image!");
		}

	});

	$("#file1").change(function (e) {
		var img = e.target.files[0];

		if (!pixelarity.open(img, false, function (res, faces) {
			console.log(faces);

			$("#result1").attr("src", res);
			$("#back_crop_image").val(res);
			$(".face").remove();

			for (var i = 0; i < faces.length; i++) {
				$("body").append("<div class='face' style='height: " + faces[i].height + "px; width: " + faces[i].width + "px; top: " + ($("#result").offset().top + faces[i].y) + "px; left: " + ($("#result").offset().left + faces[i].x) + "px;'>");
			}

		}, "jpg", 0.7, true)) {
			alert("Whoops! That is not an image!");
		}

	});

	$("#file2").change(function (e) {
		var img = e.target.files[0];

		if (!pixelarity.open(img, false, function (res, faces) {
			console.log(faces);

			$("#result2").attr("src", res);
			$("#all_view_crop_image").val(res);
			$(".face").remove();

			for (var i = 0; i < faces.length; i++) {
				$("body").append("<div class='face' style='height: " + faces[i].height + "px; width: " + faces[i].width + "px; top: " + ($("#result").offset().top + faces[i].y) + "px; left: " + ($("#result").offset().left + faces[i].x) + "px;'>");
			}

		}, "jpg", 0.7, true)) {
			alert("Whoops! That is not an image!");
		}

	});


});