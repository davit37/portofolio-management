@extends('master-layout.app')
@section('title','Create Plan')


@section('content')
<form class="form" id="frmEntry" onSubmit="return false" method="post">
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Plan</h4>
           
                <p class="card-description">Personal info</p>
                <div id="boxEntry">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Plan Number </label>
                                <input type="text" class="form-control bg-white" value="{{$plan->plan_no}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="entry_date">Entry Date</label>
                                <input type="text" class="form-control bg-white" id="entry_date" value="{{date('d-m-Y',strtotime($plan->entry_date))}}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Pair</label>
                                <input type="text" class="form-control bg-white" id="entry_date" value="{{$plan->pair->pair_name}}"
                                disabled>
                            </div>
                        </div>
    
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Trading Rule</label>
                                <textarea class="form-control bg-white" id="trading_rule" rows="4" disabled> {{$plan->trading_rule}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block">Image Open</label>
                                @foreach ($plan->images as $image)
                                <div class="images-list">
                                    {{-- <input type="file"   id='img1' class="file-upload-default img"> --}}
                                    <img src="{{asset('storage/'.$image->file_name)}}" alt="" srcset=""
                                        class="file-upload-browse">
                                </div>
                                @endforeach
    
                            </div>
                        </div>
    
                    </div>
                </div>
               


           
        </div>
    </div>
</div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Riks Reword</h4>

            </p>
            <div class="table-responsive">
                <table class="table border-less" id="tblDetail">
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>RR Ratio</th>
                            <th>Risk Percentase</th>
                            <th>Entry Price</th>
                            <th>Stop Loss</th>
                            <th>Take Profit</th>
                            <th>Lot</th>
                            <th>Status</th>
                            <th>Exit Price</th>
                            <th>Profit Loss</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($plan->riskRiward as $item)
                        @php
                            $position ="";
                            switch ($item->position) {
                                case '1':
                                $position="Buy Limit";
                                    break;
                                case '2':
                                $position="Sell Limit";
                                    break;
                                case '3':
                                $position="Buy Stop";
                                    break;
                                case '4':
                                $position="Sell Stop";
                                    break;
                                case '5':
                                $position="Buy Market";
                                    break;
                                case '6':
                                $position="Sell Market";
                                    break;
                                
                            }
                        @endphp

                            <tr>
                                <td>
                                    <input type="hidden" class="id" value="{{$item->id}}">
                                    <input type="text" class="form-control form-no-border bg-white" id="risk_to_reward_ratio" 
                                    value="{{$position}}" disabled>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-no-border bg-white" id="risk_to_reward_ratio" disabled value="{{$item->risk_to_reward_ratio}}">
                                </td>
                                <td>
                                    <input type="text" class="form-control format-decimal form-no-border bg-white" disabled
                                        id="risk_percentase" value="{{$item->risk_percentase}}">
                                </td>
                                <td>
                                    <input type="text" class="form-control money-format form-no-border bg-white" disabled id="entry_price" value="{{$item->entry_price}}">
                                </td>
                                <td><input type="text" class="form-control money_format form-no-border bg-white" disabled id="stop_loss" value="{{$item->stop_loss}}"></td>
                                <td><input type="text" class="form-control money-format form-no-border bg-white" disabled id="take_profit" value="{{$item->take_profit}}">
                                </td>
                                <td><input type="text" class="form-control format-decimal form-no-border bg-white " disabled  value="{{$item->lot}}"></td>
                                <td>
                                    <select class="form-control form-no-border select2-auto-width-material status" >
                                        <option value="0" {{$item->status == 0 ? "selected":""}}>Pending Order</option>
                                        <option value="5" {{$item->status == 5 ? "selected":""}}>Floating</option>
                                        <option value="1" {{$item->status == 1 ? "selected":""}}>Hit Profit</option>
                                        <option value="2" {{$item->status == 2 ? "selected":""}}>Hit Loss</option>
                                        <option value="3" {{$item->status == 3 ? "selected":""}}>Cut Profit</option>
                                        <option value="4" {{$item->status == 4 ? "selected":""}}>Cut Loss</option>
                                      </select>
                                </td>
                                <td><input type="text" class="form-control money-format form-no-border exit-price" value="{{$item->exit_price}}">
                                </td>
                            <td><input type="text" class="form-control money-format form-no-border profit-loss" value="{{$item->profit_loss}}">
                                </td>
                                <td> 
                                    <a class="save-detail text-success " data-toggle="tooltip" title="Save" href="#" style="font-size: 15px; cursor: pointer;">
                                        <i class="mdi mdi-checkbox-marked-circle-outline "></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="text-center">
    <a class="btn btn-primary btn-fw" href="{{url("plans")}}" role="button">Back</a>
    
</div>

</form>


@endsection

@section('scripts')

<script>
    $(document).ready(function () {
        beforeUnload()

        $(".money-format").trigger("keyup")

        $('#frmEntry').submit(function () {
           

            
            if($("#entry_date").val()==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Entry Date Is Required!',
                    width:400,
                
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    $("#entry_date").focus()
                })
                return;
            }
            
            if($("#pair").val()==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pair Is Required!',
                    width:400,
                
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    $("#pair").focus()
                })
                return;
            }
            
            // if($("#trading_rule").val()==""){
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Oops...',
            //         text: 'Trading Rule Is Required!',
            //         width:400,
                
            //     }).then((result) => {
            //     /* Read more about isConfirmed, isDenied below */
            //         $("#trading_rule").focus()
            //     })
            //     return;
            // }

            var detail = [];
            var isError = false;
            
            $('#tblDetail tbody > tr').each(function (i, x) {
                obj = {};
                obj.risk_to_reward_ratio = $(this).find(':input[name=risk_to_reward_ratio]').val();
                obj.risk_percentase = $(this).find(':input[name=risk_percentase]').val();
                obj.entry_price = convertMoney($(this).find(':input[name=entry_price]').val());
                obj.stop_loss = convertMoney($(this).find(':input[name=stop_loss]')
                    .val());
                obj.take_profit = convertMoney($(this).find(':input[name=take_profit]').val());
                obj.lot = convertMoney($(this).find(':input[name=lot]')
                    .val());
                obj.position = convertMoney($(this).find(':input[name=position]')
                    .val());
            
            if(obj.risk_to_reward_ratio==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'RR Ratio Is Required!',
                    width:400,
                
                })
                isError=true;
                return;
            }
            if(obj.position==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'position Is Required!',
                    width:400,
                
                })
                isError=true;
                return;
            }
            
            if(obj.risk_percentase==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Risk Percentase Is Required!',
                    width:400,
                

                })

                isError=true;
                return;
             }

             if(obj.entry_price==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Entry Price Is Required!',
                    width:400,
                
                })

                isError=true;
                return;
             }

             if(obj.stop_loss==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Stop Loss Is Required!',
                    width:400,
                
                })

                isError=true;
                return;
             }

             if(obj.take_profit==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Take Profit Is Required!',
                    width:400,
                
                })

                isError=true;
                return;
             }
             if(obj.lot==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Lot Is Required!',
                    width:400,
                
                })

                isError=true;
                return;
             }
                detail.push(obj);

            });

            if(isError){
                return;
            }
        
            stopBeforeUnload();
            postData = new Object();
            $.each($('#boxEntry :input').serializeObject(), function (x, y) {
                postData[x] = y;
            });

            postData.detail = JSON.stringify(detail);
            postData.pair_id = $("#pair_id").val()
          
            postData.img1 = $("#img1")[0].files[0]==undefined?null:$("#img1")[0].files[0]
            postData.img2 = $("#img2")[0].files[0]==undefined?null:$("#img2")[0].files[0]
            postData.img3 = $("#img3")[0].files[0]==undefined?null:$("#img3")[0].files[0]
            postData.img4 = $("#img4")[0].files[0]==undefined?null:$("#img4")[0].files[0]
            postData.img5 = $("#img5")[0].files[0]==undefined?null:$("#img5")[0].files[0]
            postData.img6 = $("#img6")[0].files[0]==undefined?null:$("#img6")[0].files[0]
                
           

           
            
            postData.mode = '';

            url = "{{url('plans/store')}}";

            var requestData = new FormData();
			$.each(postData, function(key, value){
				requestData.append(key, value);
			});
            
            ajax({
                url: url,
                postData : requestData,
                processData: false,
				contentType: false,
                success: function (ret) {
                    window.location = "{{ url('plans') }}";
                },
            });
            
            return false;
        });


        $(document).on('click',".add-detail",function(e){
            e.preventDefault()
            var html = `<tr>
                            <td>
                                <select class="form-control form-no-border select2-auto-width-material" name="position">
                                    <option value="1">Buy Limit</option>
                                    <option value="2">Sell Limit</option>
                                    <option value="3">Buy Stop</option>
                                    <option value="4">Sell Stop</option>
                                    <option value="5">Buy Market</option>
                                    <option value="6">Sell Marker</option>
                                 
                                    
                                  </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-no-border" name="risk_to_reward_ratio">
                            </td>
                            <td>
                                <input type="text" class="form-control format-decimal form-no-border"
                                    name="risk_percentase">
                            </td>
                            <td>
                                <input type="text" class="form-control money-format form-no-border" name="entry_price">
                            </td>
                            <td><input type="text" class="form-control money_format form-no-border" name="stop_loss"></td>
                            <td><input type="text" class="form-control money-format form-no-border" name="take_profit">
                            </td>
                            <td><input type="text" class="form-control format-decimal form-no-border" name="lot"></td>
                            <td> 
                                <a class="add-detail" href="#">
                                    <i class="mdi mdi-plus-circle-outline "></i> </a>
                                <a class="del-detail text-danger" href="#">
                                    <i class="mdi mdi-delete "></i> </a>
                               
                            </td>
                        </tr>
                        `;
            $(".add-detail").hide();
            $(".del-detail").hide();
            $("#tblDetail").find("tbody").append(html);
            $('.select2-auto-width-material').select2({
                containerCssClass : "custom-material-select",
                dropdownCssClass: "custom-material-select",
                dropdownAutoWidth : true,
            });
        })

        $(document).on('click',".del-detail",function(e){
            e.preventDefault()
            $(this).parents('tr').remove()
            $(".add-detail").last().show();
            $(".del-detail").last().show();
        })

        $(document).on('click','.save-detail', function(e){
            e.preventDefault()
            var postData = {}
            var _this = $(this).parents('tr');
             postData.id = _this.find(".id").val();
             postData.status = _this.find(".status").val();
             postData.exit_price = convertMoney(_this.find(".exit-price").val())
             postData.profit_loss = convertMoney(_this.find(".profit-loss").val())

            ajax({
                url: "{{url("plans/save-detail")}}",
                postData : postData,
                
                success: function (ret) {
                    var body = $("html, body");
                    alertBox('show', {msg: 'Data berhasil disimpan', mode: 'success'});
                    body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                    });
                    
				    
                },
            });
            
        })

        
    })

</script>

@endsection
