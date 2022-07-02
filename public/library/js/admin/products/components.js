// const { defaultsDeep } = require("lodash");

var baseUrl = $('body').attr('data-url');

function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
      var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
      return v.toString(16);
    });
  }

function makesku(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
  
function percent(amount, offer) {
    goodPrice = parseFloat($('#good').val());
    fairPrice = parseFloat($('#fair').val());
    poorPrice = parseFloat($('#poor').val());
    amount = parseFloat(amount);
    if(offer == 'good'){
      return amount - (goodPrice / 100 * amount);
    }
    if(offer == 'fair'){
      return amount - (fairPrice / 100 * amount);
    }
    if(offer == 'poor'){
      return amount - (poorPrice / 100 * amount);
    }
}

function deleteproduct(hashedId){

    var CSRF_TOKEN = '{{ csrf_token() }}';
    swal({
        title: "Confirmation",
        text: "Do you want to delete selected record?",
        icon: "warning",
          buttons: ["Cancel", "Confirm"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: baseUrl+"/admin/products/"+hashedId,
                type: 'DELETE',
                dataType: 'json',
                success: function (data) {
                    if (data.status == 200) {
                        // toastr.success('Product has been deleted!')
                        productTable.draw();
                        swal({
                            title : "Product has been deleted!",
                            text : data.message,
                            icon : "success", 
                        })
                    }
                }
            });
        } else {
            /*swal({
                title : "Congratulations!",
                text : "Service is still in records",
                icon : "success", 
                buttons: "Done",
            })*/
        }
    });
}

function deleteStoragePrice(hashed_id,sell = false){
    if(sell){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax(`${baseUrl}/admin/products/delete/add-storage-price/${hashed_id}`,{
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
    } else {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax(`${baseUrl}/admin/products/delete/add-storage-price/${hashed_id}`,{
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
}

$(function() {
    
    $('#btn-product-buy').click(function () {
        $('#product-buy-form').find("select, input[type=number]").val("")
    });

    $('#btn-product-sell').click(function () {
        $('#product-sell-form').find("select, input[type=number]").val("")
    });

    $('#btn-product-sell').click(function () {
        $('#fieldSellId').val(0);
        $('#isSellForEdit').val('');
        $('#modal-product-sell').modal();
    });


    $("#edit-modal-product-sell").on('show.bs.modal',function(event){
        const button = event.relatedTarget;
        const storage = button.dataset.storage;
        const amount = button.dataset.amount;
        const product_id = button.dataset.id;
        const network_id = button.dataset.network_id;
        const url = `${baseUrl}/admin/products/edit/edit-selling-device/${product_id}`;

        $(this).find('.modal-body #amount').val(amount);
        $(this).find('.modal-body select[name=storage]').val(storage);
        $(this).find('#edit-product-sell-form').attr('action',url);
        $(this).find('select[name=product_network]').val(network_id);
    });

    $("#edit-product-sell-form").on("submit",function(e){
        e.preventDefault();
        let data = $(this).serializeArray();

        $.ajax($(this).attr('action'),{
            method: "PATCH",
            data: {
                title: data[1].value,
                network_id: data[2].value,
                amount: data[3].value,
            },
            success: res => {
                if(res.status) {
                    swal({
                        title: "Success!",
                        text: "Successfully Udated!",
                        icon: "success",
                    }).then(() => {
                        
                    });
                } else {
                    swal({
                        title: "Error!",
                        text:res.message ?? "Something went wrong!",
                        icon: "error",
                    });
                }
            },
            error: err => {
                swal({
                    title: "Error!",
                    text: "Something went wrong!",
                    icon: "error",
                });
            }
        });
    });

    // $(".edit-row-product-sell").on('click',function(event){
    //     console.log(event.target.dataset.storage);
    //     console.log(event.target.dataset.amount);
    //     $('#product-sell-form').find("select[name=storage]").val(event.target.dataset.storage);
    //     $('#product-sell-form').find("input[type=number").val(event.target.dataset.amount);
    //     $('#modal-product-sell').modal('show');
    // });


    var edit_selected_network = "";
    $("#sell-network").on('change',function(e){
        edit_selected_network = this.options[this.selectedIndex].text
    });

    $("#modal_product_sell_network").on('change',function(e){
        edit_selected_network = this.options[this.selectedIndex].text
    });
    
    $('#product-sell-submit').click(function () {
        var data = $('#product-sell-form').serializeArray();
        // return false;
        var setId = (data[3].value == 0) ? 0 : data[3].value;
        if ($('#isSellForEdit').val() == "true") {
            var tempId = $('#fieldBuyId').val();
            var newRecord = '<td align="center"><input type="hidden" name="product-storage-id[]" value="'+setId+'">'+data[0].value+' <input type="hidden" name="storage[]" value="'+data[0].value+'"><input type="hidden" name="storage_sell[]" value="'+data[0].value+'"></td>'+
                '<td align="right">$'+data[1].value+' <input type="hidden" name="amount[]" value="'+data[1].value+'"></td>'+
                '<td align="center">'+
                    '<a href="javascript:void(0);" class="delete-row-product-storage btn btn-primary btn-xs" data-attr-id="'+uuidv4()+'">'+
                        '<i class="fa fa-edit"></i>'+
                    '</a>'+
                    '<a href="javascript:void(0);" class="delete-row-product-storage btn btn-danger btn-xs" data-attr-id="'+uuidv4()+'">'+
                        '<i class="fa fa-trash"></i>'+
                    '</a>'+
                '</td>';
                $('.tr-id-'+tempId).attr('data-attr-saved', "true");
                // <tr class="tr-id-'+tempId+'" data-attr-saved="true" data-attr-id="'+tempId+'">'+
                
            $('.tr-id-'+tempId).html(newRecord);
        } else {
            var newRecord = `
            <tr class="tr-id" data-attr-saved="false" data-attr-id="${uuidv4()}">
                <td align="center">
                    <input type="hidden" name="product-storage-id[]" value="${setId}">
                    ${data[0].value}
                    <input type="hidden" name="storage[]" value="${data[0].value}">
                    <input type="hidden" name="storage_sell[]" value="${data[0].value}">
                </td>
                <td align="right">
                    ${edit_selected_network}
                    <input type="hidden" name="network_id[]" value="${data[1].value}">
                </td>
                <td align="right">
                    $${data[2].value}
                    <input type="hidden" name="amount[]" value="${data[2].value}">
                </td>
                <td align="center">
                    <button type="button" class="btn btn-primary btn-xs"
                    data-attr-id="${uuidv4()}" data-toggle="modal" data-target="#modal-edit-product-sell"
                    data-network="${data[1].value}" data-storage="${data[0].value}"
                    data-amount="${data[2].value}">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="delete-row-sell-product btn btn-danger btn-xs"
                    data-attr-id="${uuidv4()}">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;
            $('#table-product-sell').append(newRecord);
        }
        $('#modal-product-sell').modal('hide');
    });

    $("#modal-edit-product-sell").on('show.bs.modal',function(e){
        const button = e.relatedTarget;
        const modal = $(this);
        modal.find('#rowIndex').val(e.relatedTarget.parentElement.parentElement.rowIndex);
        modal.find('select[name=storage]').val(button.dataset.storage)
        modal.find('#modal_product_sell_network').val(button.dataset.network)
        modal.find('#modal_product_amount').val(button.dataset.amount)
    });

    $("#modal-product-button-submit").on('click',function(){
        var data = $('#modal-product-sell-form').serializeArray();
        console.log(data);
        var newRecord = `
            <tr class="tr-id" data-attr-saved="false" data-attr-id="${uuidv4()}">
                <td align="center">
                    <input type="hidden" name="product-storage-id[]" value="0">
                    ${data[1].value}
                    <input type="hidden" name="storage[]" value="${data[1].value}">
                    <input type="hidden" name="storage_sell[]" value="${data[1].value}">
                </td>
                <td align="right">
                    ${edit_selected_network}
                    <input type="hidden" name="network_id[]" value="${data[2].value}">
                </td>
                <td align="right">
                    $${data[3].value}
                    <input type="hidden" name="amount[]" value="${data[3].value}">
                </td>
                <td align="center">
                    <button type="button" class="btn btn-primary btn-xs"
                    data-attr-id="${uuidv4()}" data-toggle="modal" data-target="#modal-edit-product-sell"
                    data-network="${data[2].value}" data-storage="${data[1].value}"
                    data-amount="${data[3].value}">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="delete-row-sell-product btn btn-danger btn-xs"
                    data-attr-id="${uuidv4()}">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;
        $('#table-product-sell').append(newRecord);
        document.getElementById('parent-table-product-sell').deleteRow($('#rowIndex').val());
        $("#modal-edit-product-sell").modal('hide');
    });

    $(document).on('click','button.delete-row-sell-product',function(e){
        if(confirm('Delete this data?')){
            const tableRow = e.target.parentElement.parentElement
            if(tableRow.rowIndex !== undefined){
                tableRow.remove();
            } else {
                tableRow.parentElement.remove();
            }
        }
    });

    $('.edit-row-product-storage').click(function () {
        $('#network-dropdown-container').show();
        $('#network-checkboxes-container').hide();

        $('#isBuyForEdit, #fieldBuyId').val('');
        var inDb = $(this).attr('data-attr-saved');
        var id = $(this).attr('data-attr-id');
        if (inDb == "true") 
        {
            $('#isBuyForEdit').val(inDb);
            $('#fieldBuyId').val(id);
            $.ajax({
                type: "GET",
                url: baseUrl+"/admin/products/storage/"+id+"/find",
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        $('.input-product-storage').val(response.result.title);
                        $('#network').val(response.result.network_id);
                        $('#excellent_offer').val(response.result.excellent_offer);
                        $('#good_offer').val(response.result.good_offer);
                        $('#fair_offer').val(response.result.fair_offer);
                        $('#poor_offer').val(response.result.poor_offer);
                        $('#modal-product-buy').modal('show');
                    }
                }
            });
        }
    });

    $('#btn-product-buy').click(function (e) {
        // let hashed_id = e.target.dataset.hashed_id ?? 0;
        $('#fieldBuyId').val(0);
        // $("#fieldBuyId").val(hashed_id);
        $('#modal-product-buy').modal();
        $('#network-checkboxes-container').show();
        $('#network-dropdown-container').hide();

    });
    
    selected_network = "";
    $("#network").on('change',function(e){
        selected_network = this.options[this.selectedIndex].text
    });

    $("#edit-network").on('change',function(e){
        selected_network = this.options[this.selectedIndex].text
    });


    $('#product-buy-submit').click(function (e) {
        var dataArr = $('#product-buy-form').serializeArray();
        const data = {}
        for (let i = 0; i < dataArr.length; i++) {
            const item = dataArr[i]
            data[item.name] = item.value
        }



        console.log('h1', dataArr);
        // console.log("h1", data)
        var setId = (data["hashedid"] == 0) ? 0 : data["hashedid"];
        if ($('#isBuyForEdit').val() == "true") {
            console.log('ajax');


            if (!data['storage']) return
            if (!data['network']) return

            var tempId = $('#fieldBuyId').val();
            $.ajax(`${baseUrl}/admin/products/edit/product-storage/${setId}`,{
                type: "PATCH",
                data: {
                    title: data['storage'],
                    network_id: data["network"],
                    excellent_offer: data["excellent_offer"],
                    good_offer: data["good_offer"],
                    fair_offer: data["fair_offer"],
                    poor_offer: data["poor_offer"],
                },
                success: function(res){
                    $('#modal-product-buy').modal('hide');
                    console.log(res);
                    if(res.status){
                        swal({
                            title: "Success",
                            text: "Successfully updated",
                            icon: "success",
                        });
                    } else {
                        swal({
                            title: "Error",
                            text: res.message ?? "Something went wrong. Please try again",
                            icon: "error",
                        });
                    }
                },
                error: function(err){
                    $('#modal-product-buy').modal('hide');
                    swal({
                        title: "Error",
                        text: "Something went wrong. Please try again",
                        icon: "error",
                    });
                }
            });
            // var newRecord = '<td align="center"><input type="hidden" name="product-storage-id[]" value="'+setId+'">'+data[0].value+' <input type="hidden" name="storage[]" value="'+data[0].value+'"><input type="hidden" name="storage_buy[]" value="'+data[0].value+'"></td>'+
            //     '<td align="right">$'+data[1].value+' <input type="hidden" name="excellent_offer[]" value="'+data[1].value+'"></td>'+
            //     '<td align="right">$'+data[2].value+' <input type="hidden" name="good_offer[]" value="'+data[2].value+'"></td>'+
            //     '<td align="right">$'+data[3].value+' <input type="hidden" name="fair_offer[]" value="'+data[3].value+'"></td>'+
            //     '<td align="right">$'+data[4].value+' <input type="hidden" name="poor_offer[]" value="'+data[4].value+'"></td>'+
            //     // '<td align="right">$'+data[6].value+' <input type="hidden" name="amount[]" value="'+data[6].value+'"></td>'+
            //     '<td align="center">'+
            //         '<a href="javascript:void(0);" class="delete-row-product-storage btn btn-primary btn-xs" data-attr-id="'+uuidv4()+'">'+
            //             '<i class="fa fa-edit"></i>'+
            //         '</a>'+
            //         '<a href="javascript:void(0);" class="delete-row-product-storage btn btn-danger btn-xs" data-attr-id="'+uuidv4()+'">'+
            //             '<i class="fa fa-trash"></i>'+
            //         '</a>'+
            //     '</td>';
            //     $('.tr-id-'+tempId).attr('data-attr-saved', "true");
            //     // <tr class="tr-id-'+tempId+'" data-attr-saved="true" data-attr-id="'+tempId+'">'+
                
            // $('.tr-id-'+tempId).html(newRecord);
        } else {
            var checkboxes = document.querySelectorAll(".network-check-input");
            var checkedNetworks = [];
            
            for (let i = 0; i < checkboxes.length; i++) {
                const checkbox = checkboxes[i];
                if (checkbox.checked) {
                    checkedNetworks.push({id: checkbox.id.replace("checkbox-", ""), title: checkbox.dataset.title})
                    checkbox.checked = false
                }
            }

            if (checkedNetworks.length === 0) {
                return
            }
            
            if (!data['storage']) return

            
            for (let i = 0; i < checkedNetworks.length; i++) {
                const network = checkedNetworks[i];
                var newRecord = `<tr class="tr-id" data-attr-saved="false" data-attr-id="${uuidv4()}">
                    <td align="center">
                        <input type="hidden" name="product-storage-id[]" value="${setId}">
                        ${data['storage']}
                        <input type="hidden" name="storage[]" value="${data['storage']}">
                        <input type="hidden" name="storage_buy[]" value="${data['storage']}">
                    </td>'+
                    <td align="right">${network.title || ""}<input type="hidden" name="network[]" value="${network.id}"></td>
                    <td align="right">$${data['excellent_offer']}<input type="hidden" name="excellent_offer[]" value="${data['excellent_offer']}"></td>
                    <td align="right">$${data['good_offer']}<input type="hidden" name="good_offer[]" value="${data['good_offer']}"></td>
                    <td align="right">$${data['fair_offer']}<input type="hidden" name="fair_offer[]" value="${data['fair_offer']}"></td>
                    <td align="right">$${data['poor_offer']}<input type="hidden" name="poor_offer[]" value="${data['poor_offer']}"></td>
                    <td align="center">
                        <button type="button"
                        class="edit-row-product-storage btn btn-primary btn-xs"
                        data-toggle="modal" data-target="#edit-modal-product-buy"
                        data-excellent="${data['excellent_offer']}" data-good="${data['good_offer']}"
                        data-fair="${data['fair_offer']}" data-poor="${data['poor_offer']}" data-network=${network.id}
                        data-storage="${data['storage']}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="delete-row-product-storage btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>`;
                $('#table-product-buy').append(newRecord);
            }

            $('#modal-product-buy').modal('hide');
        }
    });

    $("#edit-modal-product-buy").on("show.bs.modal",function(e){
        var data = $('#edit-product-buy-form').serializeArray();
        console.log("h2");
        const button = e.relatedTarget;
        let tr = button.parentElement.parentElement;
        const modal = $(this);
        console.log(button.dataset.storage);
        console.log(button.dataset.network);
        modal.find('select[name=storage]').val(button.dataset.storage)
        modal.find('#edit-network').val(button.dataset.network)
        modal.find('#edit_excellent_offer').val(button.dataset.excellent)
        modal.find('#edit_good_offer').val(button.dataset.good)
        modal.find('#edit_fair_offer').val(button.dataset.fair)
        modal.find('#edit_poor_offer').val(button.dataset.poor)
        modal.find('#replacing-row-index').val(tr.rowIndex);
    });

    $("#edit-product-buy-submit").on("click",function(){
        document.getElementById('parent-table-product-buy').deleteRow($('#replacing-row-index').val());
        var dataArr = $('#edit-product-buy-form').serializeArray();
        const data = {}
        for (let i = 0; i < dataArr.length; i++) {
            const item = dataArr[i]
            data[item.name] = item.value
        }
        console.log('h3', dataArr);
        if (!data['storage']) return
        if (!data['network']) return

        let selected_network = ""
        const selectNetwork = document.querySelector("#edit-network")
        const options = selectNetwork.querySelectorAll("option")
        for (let i = 0; i < options.length; i++) {
            const option = options[i]
            if (option.value == data['network']) {
                selected_network = option.innerHTML
                break
            }
            
        }
        
        // {/* <input type="hidden" name="product-storage-id[]" value="${setId}"> */}
        var newRecord = `<tr class="tr-id" data-attr-saved="false" data-attr-id="${uuidv4()}">
                <td align="center">
                    ${data['storage']}
                    <input type="hidden" name="storage[]" value="${data['storage']}">
                    <input type="hidden" name="storage_buy[]" value="${data['storage']}">
                </td>'+
                <td align="right">${selected_network}<input type="hidden" name="network[]" value="${data['network']}"></td>
                <td align="right">$${data['excellent_offer']}<input type="hidden" name="excellent_offer[]" value="${data['excellent_offer']}"></td>
                <td align="right">$${data['good_offer']}<input type="hidden" name="good_offer[]" value="${data['good_offer']}"></td>
                <td align="right">$${data['fair_offer']}<input type="hidden" name="fair_offer[]" value="${data['fair_offer']}"></td>
                <td align="right">$${data['poor_offer']}<input type="hidden" name="poor_offer[]" value="${data['poor_offer']}"></td>
                <td align="center">
                    <button type="button"
                    class="edit-row-product-storage btn btn-primary btn-xs"
                    data-toggle="modal" data-target="#edit-modal-product-buy"
                    data-excellent="${data['excellent_offer']}" data-good="${data['good_offer']}"
                    data-fair="${data['fair_offer']}" data-poor="${data['poor_offer']}" data-network=${data['network']}
                    data-storage="${data['storage']}">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="delete-row-product-storage btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;
            $('#table-product-buy').append(newRecord);
            $("#edit-modal-product-buy").modal('hide');
    });

    $('#excellent_offer').keyup(function(){
        if($('#offer_type').prop('checked')){
            var good = percent($('#excellent_offer').val(), 'good');
            var fair = percent($('#excellent_offer').val(), 'fair');
            var poor = percent($('#excellent_offer').val(), 'poor');
            $('#good_offer').val(good.toFixed(2));
            $('#fair_offer').val(fair.toFixed(2));
            $('#poor_offer').val(poor.toFixed(2));
        }
    });

    $('#edit_excellent_offer').keyup(function(){
        if($('#edit_offer_type').prop('checked')){
            var good = percent($('#edit_excellent_offer').val(), 'good');
            var fair = percent($('#edit_excellent_offer').val(), 'fair');
            var poor = percent($('#edit_excellent_offer').val(), 'poor');
            $('#edit_good_offer').val(good.toFixed(2));
            $('#edit_fair_offer').val(fair.toFixed(2));
            $('#edit_poor_offer').val(poor.toFixed(2));
        }
    });

    $(document).on('click','button.delete-row-product-storage',function(event){
        if(confirm('Remove this data?')){
            const tableRow = event.target.parentElement.parentElement
            if(tableRow.rowIndex != undefined){
                tableRow.remove();
            } else {
            tableRow.parentElement.remove();
            }
        }
    });

    $('#offer_type').change(function() {
        if($(this).prop('checked'))
        {
            var good = percent($('#excellent_offer').val(), 'good');
            var fair = percent($('#excellent_offer').val(), 'fair');
            var poor = percent($('#excellent_offer').val(), 'poor');
            $('#good_offer').val(good);
            $('#fair_offer').val(fair);
            $('#poor_offer').val(poor);
        }
    });

    $('#edit_offer_type').on('change', function() {
        if($(this).prop('checked'))
        {
        console.log('sad');
            var good = percent($('#edit_excellent_offer').val(), 'good');
            var fair = percent($('#edit_excellent_offer').val(), 'fair');
            var poor = percent($('#edit_excellent_offer').val(), 'poor');
            $('#edit_good_offer').val(good);
            $('#edit_fair_offer').val(fair);
            $('#edit_poor_offer').val(poor);
        }
    });

    // $('#network').change(function(){
    //     var data = $('#productForm').serializeArray();
    //     console.log(data);
    //     form_data = {
    //         name: data[4].value,
    //         brand_id: data[3].value,
    //         storage: $('select[name=storage]').val(),
    //         network_id: $(this).val(),
    //         id: data[11].value
    //     };
    //     console.log(form_data);
    //     $.ajax({
    //         type: "POST",
    //         url: baseUrl+"/admin/products/checkduplicate",
    //         data: form_data,
    //         dataType: "json",
    //         success: function (response) {
    //             console.log(response);
    //             if(response.duplicate){
    //                 $('#network-exist-error').css('display', 'inline');
    //             }
    //         }
    //     });
    // });

    $('.input-storage').change(function(){
        var data = $('#productForm').serializeArray();
        $.ajax({
            type: "POST",
            url: baseUrl+"/admin/products/checkduplicate",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.duplicate){
                    $('#storage-exist-error').css('display', 'inline');
                }else{
                    $('#storage-exist-error').css('display', 'none');
                }
            }
        });
    });

    $('.device-check').change(function() {
            var val = $(this).val();
            if(val == 'Buy') 
            {
                $('#div-offer, .div-offer').show();
                $('#div-amount').hide();
                $('#sku').val('');
            }
            if(val == 'Sell')
            {
                $('#div-offer, .div-offer').hide();
                $('#div-amount').show();
                $('#sku').val(makesku(7));
            }
            if(val == 'Both')
            {
                $('#div-offer, .div-offer').show();
                $('#div-amount').show();
                $('#sku').val(makesku(7));
            }
    });


    // $('#productForm').submit(function () {
        
    //     if ($("#device_type").val() == '' || $("#device_type").val() == null)
    //     {
    //         swal({
    //             title : "Opps!",
    //             text : "Device Type is required",
    //             icon : "warning", 
    //             buttons: "Close",
    //         })
    //         return false;
    //     }

    // });
    
    $('#remove-photo').click(function(){
        if(confirm('Are you sure you want to delete this photo?'))
        {
            var id = $('#product_id').val();
            $.ajax({
                type: "POST",
                url: "{{ url('admin/products/deletephoto') }}",
                data: {
                    id: id
                },
                dataType: "json",
                success: function (response) {
                }
            });
        }
    });


    $( "#brand_id" ).blur(function() {
        if ($(this).val() == '' && $('#product-name').val() != '' && $('#color').val() != '') {
            var validate = validateExistProduct($(this).val(), $('#product-name').val() != '', $('#color').val());
        }
        // alert($(this).val());
    });
    $( "#product-name" ).blur(function() {
        if ($(this).val() != '' && $('#brand_id').val() != '' && $('#color').val() != '') {
            var validate = validateExistProduct($('#brand_id').val(), $(this).val(), $('#color').val());
        }
    });
    $( "#color" ).blur(function() {
        if ($(this).val() != '' && $('#brand_id').val() != '' && $('#product-name').val() != '') {
            var validate = validateExistProduct($('#brand_id').val(), $('#product-name').val(), $(this).val());
        }
    });

    function validateExistProduct(brandId, productName, productColor) 
    {
        $.ajax({
            type: "POST",
            url: baseUrl+"/admin/products/checkduplicatedevice",
            data: {
                'model' : productName, 
                'color' : productColor, 
                'brand_id' : brandId, 
                'product_id' : $('#product_id').val()
            },
            dataType: "json",
            success: function (result) {
                if (result.response == "400") 
                {
                    swal({
                        title : "Opps!",
                        text : result.message,
                        icon : "warning", 
                        buttons: "Close",
                    });
                    // $('#product-name').focus();
                    return false;
                }
                // if(response.duplicate){
                //     $('#storage-exist-error').css('display', 'inline');
                // }else{
                //     $('#storage-exist-error').css('display', 'none');
                // }
            }
        });
    }

}) 

