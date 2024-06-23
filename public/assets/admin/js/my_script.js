$(document).ready(function() {
    $('#imageInput').change(function(e) {
        const imagePreview = $('#imagePreview');
        imagePreview.empty();

        const files = e.target.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const image = $('<img>').addClass('m-3 rounded-1').attr('src', e.target.result).attr('width', 150);
                imagePreview.append(image);

            }

            reader.readAsDataURL(file);
        }
    });


    // hiden notification after 2s
    $(document).ready(function() {
        setTimeout(function() {
            $('#notification').fadeOut('fast');
        }, 2000); // 2 giây
    });

    // delete group
    $('.delete-group').click(function(e){
        e.preventDefault();

        var id = $(this).data('id_group');
        var _token = $('input[name="_token"]').val();

        Swal.fire({
            title: "Bạn có chắc chắn?",
            text: "Bạn sẽ không thể khôi phục lại điều này!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Có, xóa nó đi!",
            cancelButtonText: "Hủy"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('group.destroy2') }}",
                    method: "POST",
                    data: {
                        group_id: id,
                        _token: _token
                    },
                    success: function(data) {
                        Swal.fire({
                            title: "Đã xóa!",
                            text: "Dữ liệu đã được xóa thành công.",
                            icon: "success"
                        }).then((result) => {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            title: "Lỗi!",
                            text: "Đã xảy ra lỗi. Vui lòng thử lại.",
                            icon: "error"
                        });
                    }
                });
            }
        });
    });
});


