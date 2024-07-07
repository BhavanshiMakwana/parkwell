<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>QR Code | {{ $menu }}</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/flat/blue.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/colorpicker/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datepicker/datepicker3.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/summernote/summernote.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/drag_drop/jquery-ui.css')}}">
    <!-- CHECKBOX STYLE CSS  -->
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/checkbox.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/radio2.css') }}">

    <!-- LIGHT BOX CSS  -->
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/lightbox/css/jquery.magnify.css') }}">
    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
        }
        .disabled{color: #c5c5c5!important;}
        .help-block{
            color: #ff0000!important;
        }
        .btn{height:28px; padding:0 12px}
        #search{height: 28px;}
    </style>

</head>
<body class="hold-transition sidebar-mini " id="bodyid">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ url('admin/dashboard') }}" class="nav-link">Home</a>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4" id="left-menubar" style="min-height:0!important; overflow-x: hidden;">
        <a href="{{url('/admin')}}" class="brand-link" style="text-align: center">
            <span class="brand-text font-weight-light"><b>QR Code Admin</b></span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview @if(isset($menu) && $menu=='User') menu-open  @endif" style="border-bottom: 1px solid #4f5962; margin-bottom: 4.5%;">
                        <a href="#" class="nav-link @if(isset($menu) && $menu=='User') active  @endif">
                            <img src=" {{url('assets/dist/img/AdminLTELogo.png')}}" class="img-circle elevation-2" alt="User Image" style="width: 2.1rem; margin-right: 1.5%;">
                            <p style="padding-right: 6.5%;">
                                {{ ucfirst(Auth::user()->name) }}
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <?php $eid = \Illuminate\Support\Facades\Auth::user()->id; ?>
                                <a href="{{ url('admin/profile_update/'.$eid.'/edit') }}" class="nav-link @if(isset($menu) && $menu=='User') active @endif">
                                    <i class="nav-icon fa fa-pencil"></i><p class="text-warning">Edit Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/logout') }}" class="nav-link">
                                    <i class="nav-icon fa fa-sign-out"></i><p class="text-danger">Log out</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('admin/') }}" class="nav-link @if($menu=='Dashboard') active @endif">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('admin/qr_code') }}" class="nav-link @if($menu=='QR Code') active @endif">
                            <i class="nav-icon fa fa-qrcode"></i>
                            <p>QR Code</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('admin/notify_reason') }}" class="nav-link @if($menu=='Notify Reason') active @endif">
                            <i class="nav-icon fa fa-language"></i>
                            <p>Notify Reason</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('admin/users') }}" class="nav-link @if($menu=='Users') active @endif">
                            <i class="nav-icon fa fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    @yield('content')

    <footer class="main-footer">
        <strong>QR Code Admin</strong>
    </footer>
</div>
<script src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/jQuery/jquery.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>$.widget.bridge('uibutton', $.ui.button)</script>
<script src="{{ URL::asset('assets/plugins/drag_drop/jquery-1.12.4.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/drag_drop/jquery-ui.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ URL::asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/knob/jquery.knob.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ URL::asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/fastclick/fastclick.js')}}"></script>
<script src="{{ URL::asset('assets/dist/js/adminlte.js')}}"></script>
<script src="{{ URL::asset('assets/dist/js/pages/dashboard.js')}}"></script>
<script src="{{ URL::asset('assets/dist/js/demo.js')}}"></script>
<script src="{{ URL('assets/dist/js/custom.js')}}"></script>
<script src="{{ URL('assets/dist/lightbox/js/jquery.magnify.js')}}"></script>
<script src="{{ URL('assets/dist/js/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/iCheck/icheck.min.js')}}"></script>
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/ladda/ladda-themeless.min.css')}}">
<script src="{{ URL::asset('assets/plugins/ladda/spin.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/ladda/ladda.min.js')}}"></script>
<script>Ladda.bind( 'input[type=submit]' );</script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        $('.select2').select2();
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "dom": '<"top"i>rt<"bottom"flp><"clear">'
        });

        $('#example3').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
        });

        /*Datepicker*/
        $('.datepicker').datepicker({
            format: 'yyyy-m-d',
            autoclose: true,
        });

        $('#datepicker2').datepicker({
            format: 'yyyy-m-d',
            startDate: '+0d',
            autoclose: true,
        });

        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        });

        $(".timepicker").timepicker({
            showInputs: false,
            minuteStep: 1,
            showMeridian: true,
        });

        $('.my-colorpicker1').colorpicker();
    });
</script>

<script src="{{ URL::asset('assets/plugins/summernote/summernote.js') }}"></script>

<script type="text/javascript">
    /*DISPLAY IMAGE*/
    function AjaxUploadImage(obj,id){
        var file = obj.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
        {
            $('#previewing'+URL).attr('src', 'noimage.png');
            alert("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
            //$("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
            return false;
        } else{
            var reader = new FileReader();
            if(id == undefined){
                reader.onload = imageIsLoaded;
            }else{
                reader.onload = newimageIsLoaded;
            }
            reader.readAsDataURL(obj.files[0]);
        }

        function imageIsLoaded(e){
            $('#DisplayImage').css("display", "block");
            $('#DisplayImage').css("margin-top", "1.5%");
            $('#DisplayImage').attr('src', e.target.result);
            $('#DisplayImage').attr('width', '150');
        }

        function newimageIsLoaded(e){
            $('#DisplayImage1').css("display", "block");
            $('#DisplayImage1').css("margin-top", "1.5%");
            $('#DisplayImage1').attr('src', e.target.result);
            $('#DisplayImage1').attr('width', '150');
        }
    }

    /*REORDER CODE*/
    function slideout() {
        setTimeout(function() {
            $("#responce").slideUp("slow", function() {
                // window.location.reload();
            });
        }, 2000);
    }
    $("#responce").hide();

    /*GET SCALE NAME*/
    $('#category').change(function(){
        $.ajax({
            url: '{{url('admin/get_scale')}}',
            type: "post",
            data: {'cat_id': $(this).val()},
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            success: function(data){
                $("#scale").select2().empty();
                $("#scale").html(data);
                $('#scale').select2()
            }
        });
    });

    /*GET SCALE VALUE*/
    $('#scale').change(function(){
        $.ajax({
            url: '{{url('admin/get_scale_value')}}',
            type: "post",
            data: {'scale_id': $(this).val()},
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            success: function(data){
                $("#scale_value").select2().empty();
                $("#scale_value").html(data);
                $('#scale_value').select2()
            }
        });
    });

    $( function() {
        $( "#sortable" ).sortable({opacity: 0.9, cursor: 'move', update: function() {
                var order = $(this).sortable("serialize") + '&update=update';
                var reorder_url = $(this).attr("url");
                $.get(reorder_url, order, function(theResponse) {
                    $("#responce").html(theResponse);
                    $("#responce").slideDown('slow');
                    slideout();
                });
            }});
        $( "#sortable" ).disableSelection();
    } );

    /*GET SCALE*/
    $('#cat_id').change(function(){
        $.ajax({
            url: '{{url('admin/product/get_subcategory')}}',
            type: "post",
            data: {'cat_id': $(this).val(),'_token' : $('meta[name=_token]').attr('content') },
            success: function(data){
                $("#sub_category").select2().empty();
                $("#sub_category").html(data);
                $('#sub_category').select2()
            }
        });
    });

    /*SUMMER NOTE CODE*/
    $(function (){
        $("textarea[id=description]").summernote({
            height: 350,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize', 'height']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['table','picture','link','map','minidiag']],
                ['misc', ['fullscreen', 'codeview']],
            ],
            callbacks: {
                onImageUpload: function(files) {
                    for (var i = 0; i < files.length; i++)
                        upload_image(files[i], this);
                }
            },
        });
        function upload_image(file, el) {
            // var token = $('meta[name="csrf-token"]').attr('content');
            var form_data = new FormData();
            form_data.append('image', file);
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                data: form_data,
                url: '{{url('admin/image/upload')}}',
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                success: function(img){
                    $(el).summernote('editor.insertImage', img);
                }
            });
        }
    });

    $('.download_qr').on('click', function(){
        var qrID = $(this).attr('data-id');
        $.ajax({
            url: '{{url('admin/qr_code/download')}}',
            type: "post",
            data: {'qrID': qrID,'_token' : $('meta[name=_token]').attr('content') },
            success: function(data){
                if(data == 1){
                    $('#arrayorder_'+qrID).remove();
                    $('#responce').html('Qr Code is downloaded successfully.');
                    $('#responce').show();
                    slideout();
                }
            }
        });
    });
</script>

</body>
</html>
