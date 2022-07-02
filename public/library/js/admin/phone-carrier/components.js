var baseUrl = $('body').attr('data-url');

// create change of image
let create_image = null;
let valid_image = true;
const create_image_input = $('#create-phone-carrier-image');
create_image_input.on("change",function(e){
    create_image = e.target.files[0];
    valid_image = uploadImage(e,this,'create-phone-carrier-image-label','create-image-container','create-phone-carrier-image-error');
});

// Create Form Modal
const create_form = $('#create-form');
create_form.on("submit",function(e){
    e.preventDefault();
    let phone_carrier_input = $('#create-phone-carrier-name');
    let create_error = $('#create-phone-carrier-name-error');
    if(phone_carrier_input.val().trim()){
        if(valid_image){
            let form_data = new FormData();
            form_data.append('name',phone_carrier_input.val());
            create_image ? form_data.append('image',create_image) : null;
            $.ajax(`${baseUrl}/admin/settings/api/phone-carriers/create`,{
                method: "POST",
                processData: false,
                contentType: false,
                data: form_data,
                success: function(res){
                    console.log(res);
                    if(res.status){
                        swal({
                            title:'Successfully Created!',
                            text:'Phone Carrier Added',
                            icon:'success',
                        }).then(() => {
                            setTimeout(() => {
                                location.reload();
                            }, 0);
                        });
                    } else {
                        swal(
                            'Something went wrong!',
                            `${res.errors.image[0]}`,
                            'error',
                        );
                    }
                },
                error: function(err){
                    swal(
                        'Something went wrong!',
                        `${err.message}`,
                        'error',
                    );
                }
            });
        }
    } else {
        create_error.removeClass('d-none');
        phone_carrier_input.addClass('is-invalid');
    }
})

// End of create form modal


// Edit form modal
let edit_modal = $("#edit-modal");
edit_modal.on('show.bs.modal',function(event){
    let data = event.relatedTarget;
    let link = data.dataset.link;
    let carrier_name = data.dataset.name;

    let modal = $(this);
    modal.find('#edit-form').attr('action',link);
    modal.find('#edit-phone-carrier-name').val(carrier_name);
});

// edit change of image
let edit_image = null;
let edit_image_valid = true;
const edit_image_input = $('#edit-phone-carrier-image');
edit_image_input.on("change",function(e){
    edit_image = e.target.files[0];
    edit_image_valid = uploadImage(e,this,'edit-phone-carrier-image-label','edit-image-container','edit-phone-carrier-image-error',edit_image);
});

let edit_form = $('#edit-form');
edit_form.on('submit',function(e){
    e.preventDefault();
    let edit_phone_carrier_input = $('#edit-phone-carrier-name');
    let edit_error = $('#edit-phone-carrier-name-error');
    if(edit_phone_carrier_input.val().trim() != ''){
        if(edit_image_valid){
            let edit_form_data = new FormData();
            edit_form_data.append('_method',"PATCH");
            edit_form_data.append('name',edit_phone_carrier_input.val());
            edit_image ? edit_form_data.append('image',edit_image) : null;
            $.ajax(this.getAttribute('action'),{
                method: "POST",
                processData: false,
                contentType: false,
                data: edit_form_data,
                success: function(res){
                    if(res.status){
                        swal({
                            title:'Successfully Updated!',
                            text:'Phone Carrier Updated',
                            icon:'success',
                        }).then(() => {
                            setTimeout(() => {
                                location.reload();
                            }, 0);
                        });
                    } else {
                        console.log(res);
                        swal(
                            'Something went wrong!',
                            `${res.message}`,
                            'error',
                        );
                    }
                },
                error: function(err){
                    swal(
                        'Something went wrong!',
                        `${err.message}`,
                        'error',
                    );
                }
            });
        }
    } else {
        edit_error.removeClass('d-none');
        edit_phone_carrier_input.addClass('is-invalid');
    }
});
// End of edit form modal

// Delete user
function deleteCarrier(carrier_delete_url){
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        // buttons: true,
        buttons: ["No", "Yes"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax(`${carrier_delete_url}`,{
                method: "DELETE",
                success: function(res){
                    if(res.status){
                        swal({
                            title:'Successfully Deleted!',
                            text:'Phone Carrier Deleted',
                            icon:'success',
                        }).then(() => {
                            setTimeout(() => {
                                location.reload();
                            }, 0);
                        });
                    } else {
                        swal(
                            'Something went wrong!',
                            `${res.message}`,
                            'error',
                        );
                    }
                },
                error: function(err){
                    swal(
                        'Something went wrong!',
                        `${res.message}`,
                        'error',
                    );
                }
            });
        }
    });
}
// End Delete User

// Change image input
function uploadImage(e,image_input,image_label,image_container,label_error){
    file = e.target.files[0];
    $(`#${image_label}`).text(file.name);
    create_image_input.removeClass('is-invalid');
    $(`#${image_container}`).addClass('d-none');
    $(`#${label_error}`).text("You can leave this empty and it will just used the default image.");
    $(`#${label_error}`).addClass('text-gray');
    $(`#${label_error}`).removeClass('text-danger');
    const valid_image_pattern = /.+\.(png|jpeg|jpg|svg|gif|bmp)/g;
    if(valid_image_pattern.test(file.name)){
        var reader  = new FileReader();
        reader.addEventListener("load", function () {
            $(`#${image_container}`).attr('src',reader.result);
            $(`#${image_container}`).removeClass('d-none');
        }, false);
        if (file) {
            reader.readAsDataURL(file);
        }

        return true;
    } else {
        create_image_input.addClass('is-invalid');
        $(`#${label_error}`).text("Supported image types:jpeg,jpg,png,svg,gif,bmp");
        $(`#${label_error}`).removeClass('text-gray');
        $(`#${label_error}`).addClass('text-danger');

        return false;
    }
}