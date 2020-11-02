<script>
// Update Status Pending, Tolak, Aktiv Global
$('#status_pending').on('click', function(e) {
	var idsArr = [];
	var status = $(this).val();
	$(".cb_element:checked").each(function(i) {
		idsArr.push($(this).val());
	});
	if(idsArr.length <=0)
	{
		swal("Gagal!", 'Silahkan Check List Data Terlebih Dahulu', {
			icon : "error",
			buttons: {
				confirm: {
					className : 'btn btn-danger'
				}
			},
		}).then(function(){
			$('.modal').modal('hide');
		});
	}  else {
		if(confirm("Yakin mau ubah data ini?")){
			$('.progress').fadeIn();
			var ids = idsArr.join(",");
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				xhr: function() {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener('progress', function(e){
						if(e.lengthComputable) {
							var persentase = Math.round((e.loaded/e.total) * 100);
							$('#progressBar').attr('aria-valuenow', persentase).css('width',persentase + '%');
						}
					});

					return xhr;
				},
				url: '/status'+paramArray[1],
				type: 'post',
				data: {ids:ids,status:status},
				success: function (data) {
					if (data['status']==true) {
						$('.progress').fadeOut();
						$(".cb_element:checked").each(function() {
							$(this).parents("tr").fadeIn().fadeOut();
						});
						swal("Sukses!", data['message'], {
							icon : "success",
							timer : 2000,
							buttons: {
								confirm: {
									className : 'btn btn-success'
								}
							},
						})

                        $('#tableUsers').DataTable().ajax.reload();
					} else {
						alert('Maaf terjadi kesalahan silahkan coba kembali!!');
					}
				},
				error: function (data) {
					swal(data.responseText);
				}
			});
		}
	}
});

$('#status_aktiv').on('click', function(e) {
	var idsArr = [];
	var status = $(this).val();

	$(".cb_element:checked").each(function(i) {
		idsArr.push($(this).val());
	});

	if(idsArr.length <=0)
	{
		swal("Gagal!", 'Silahkan Check List Data Terlebih Dahulu', {
			icon : "error",
			buttons: {
				confirm: {
					className : 'btn btn-danger'
				}
			},
		}).then(function(){
			$('.modal').modal('hide');
		});
	}  else {
		if(confirm("Yakin mau ubah data ini?")){
			$('.progress').fadeIn();
			var ids = idsArr.join(",");
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				xhr: function() {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener('progress', function(e){
						if(e.lengthComputable) {
							var persentase = Math.round((e.loaded/e.total) * 100);
							$('#progressBar').attr('aria-valuenow', persentase).css('width',persentase + '%');
						}
					});
					return xhr;
				},
				url: '/api/status'+paramArray[1],
				type: 'post',
				data: {ids:ids,status:status},
				success: function (data) {
					if (data['status']==true) {
						$('.progress').fadeOut();
						$(".cb_element:checked").each(function() {
							$(this).parents("tr").fadeIn().fadeOut();
						});
						swal("Sukses!", data['message'], {
							icon : "success",
							timer : 2000,
							buttons: {
								confirm: {
									className : 'btn btn-success'
								}
							},
						});
                        $('#tableUsers').DataTable().ajax.reload();
					} else {
						alert('Maaf terjadi kesalahan silahkan coba kembali!!');
					}
				},
				error: function (data) {
					swal(data.responseText);
				}
			});
		}
	}
});

$('#status_tolak').on('click', function(e) {
	var idsArr = [];
	var status = $(this).val();

	$(".cb_element:checked").each(function(i) {
		idsArr.push($(this).val());
	});

	if(idsArr.length <=0)
	{
		swal("Gagal!", 'Silahkan Check List Data Terlebih Dahulu', {
			icon : "error",
			buttons: {
				confirm: {
					className : 'btn btn-danger'
				}
			},
		}).then(function(){
			$('.modal').modal('hide');
		});
	}  else {
		if(confirm("Yakin mau ubah data ini?")){
			$('.progress').fadeIn();
			var ids = idsArr.join(",");
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				xhr: function() {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener('progress', function(e){
						if(e.lengthComputable) {
							var persentase = Math.round((e.loaded/e.total) * 100);
							$('#progressBar').attr('aria-valuenow', persentase).css('width',persentase + '%');
						}
					});

					return xhr;
				},
				url: '/api/status'+paramArray[1],
				type: 'post',
				data: {ids:ids,status:status},
				success: function (data) {
					if (data['status']==true) {
						$('.progress').fadeOut();
						$(".cb_element:checked").each(function() {
							$(this).parents("tr").fadeIn().fadeOut();
						});
						swal("Sukses!", data['message'], {
							icon : "success",
							timer : 2000,
							buttons: {
								confirm: {
									className : 'btn btn-success'
								}
							},
						});
                        //tambahkan tabel lain jika ada status
                        $('#tableUsers').DataTable().ajax.reload();
					} else {
						alert('Maaf terjadi kesalahan silahkan coba kembali!!');
					}
				},
				error: function (data) {
					swal(data.responseText);
				}
			});
		}
	}
});

//**end**
</script>
