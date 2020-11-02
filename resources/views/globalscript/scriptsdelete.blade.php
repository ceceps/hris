<script>
//Hapus Global
var paramArray = window.location.pathname.split('/');
// console.log(paramArray);
$('#hapus_data').on('click', function(e) {
	e.preventDefault();
	var idsArr = [];
	$(".cb_element:checked").each(function(i) {
		idsArr.push($(this).val());
	});

   console.log(idsArr);

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
		if(confirm("Yakin mau hapus data ini?")){
			$('.progress').fadeIn();
            var strIds = idsArr.join(",");

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
				url: "/api/"+paramArray[1]+"/"+strIds,
				type: 'DELETE',
				data: {id:strIds,_method:'DELETE' },
				success: function (data) {

					if (data['status']==true) {
						$('.progress').fadeOut();
						$(".cb_element:checked").each(function() {
							$(this).parents("tr").fadeIn().fadeOut();
						});
						swal("Sukses!", data['msg'], {
							icon : "success",
							timer : 2000,
							buttons: {
								confirm: {
									className : 'btn btn-success'
								}
							},
						})

                        $('#tableUsers').DataTable().ajax.reload();
						$('#tableJob').DataTable().ajax.reload();
                        $('#tableJobLevel').DataTable().ajax.reload();
                        $('#tableCategory').DataTable().ajax.reload();
                        $('#tableDepartement').DataTable().ajax.reload();
                        $('#tableEmployee').DataTable().ajax.reload();
                        $('#tableAttendace').DataTable().ajax.reload();

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
