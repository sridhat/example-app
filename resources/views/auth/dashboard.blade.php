@include('layouts.topbar')
@include('layouts.sidebar')
    <!-- MAIN -->
    <div class="col py-3" id="home_page">

        <h1>
            Hi <small class="text-muted">{{ auth()->user()->name }}</small>  have a Nice Day..
        </h1>


        <div class="card">
            <h4 class="card-header">Dashboard content</h4>
            <!-- <div class="card-body">
                <ul>
                    <li>JQuery</li>
                    <li>Bootstrap 4 beta-3</li>
                </ul>
            </div> -->
        </div>

        <hr>

       

    </div>
    <div class="col py-3 d-none" id="checkin_page">
            <h1>
                Hi
                <small class="text-muted">{{ auth()->user()->name }}</small>
            </h1>
            <div class="card">
                <h4 class="card-header">Check In</h4>
                <div class="card-body">
                    <h3> Kindly check In to Start Your work </h3>
                    <button class="btn btn-primary" id="check_in_btn">Check IN</button>
                </div>
            </div>
            <hr>
    </div>
    <div class="col py-3 d-none" id="checkout_page">
            <h1>
                Hi
                <small class="text-muted">{{ auth()->user()->name }}</small>
            </h1>
            <div class="card">
                <h4 class="card-header">Check Out</h4>
                <div class="card-body">
                    <h3> Kindly check Out to End Your work </h3>
                    <button class="btn btn-warning" id="check_out_btn">Check Out</button>
                </div>
            </div>
            <hr>
    </div>
 
    <!-- Main Col END -->

</div>
<!-- body-row END -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
var check_in_process="{{url('check_in_process')}}";
var check_out_process="{{url('check_out_process')}}";
var check_in_check="{{url('check_in_check')}}";
var check_out_check="{{url('check_out_check')}}";
var attedence_report_data="{{url('attedence_report_data')}}";
var restore_process="{{url('restore_process')}}";

</script>
<script src="../assets/pro_js/attedence_report.js"></script>

