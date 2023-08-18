@include('layouts.topbar')

@if($data != null || isset($data1))
  @include('layouts.sidebar')

@else
@include('layouts.sidebar1')
@endif

    <!-- MAIN -->
    <div class="col py-3 d-none" id="home_page">

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
                <div class="card-body d-none" id='before_check_in'>
                    <h3> Kindly check In to Start Your work </h3>
                    <button class="btn btn-primary" id="check_in_btn">Check IN</button>
                </div>
                <div class="card-body d-none" id='after_check_in'>
                    <h3>Checked In Kindly check Out or continue the Work </h3>
                </div>
            </div>
            <hr>
    </div>
    <div class="col py-3 d-none" id="checkout_page">
            <h1>
                Hi
                <small class="text-muted">{{ auth()->user()->name }}</small>
            </h1>
            <div class="card" id="before_check_out">
                <h4 class="card-header">Check Out</h4>
                <div class="card-body">
                    <h3> Kindly check Out to End Your work </h3>
                    <button class="btn btn-warning" id="check_out_btn">Check Out</button>
                </div>
            </div>
            <div class="card" id="after_check_out">
                <h4 class="card-header">Check Out</h4>
                <div class="card-body">
                    <h3> Already Checked out Want to restore it</h3>
                    <button class="btn btn-warning" id="check_out_restore_btn">Release</button>
                </div>
            </div>
            <hr>
    </div>
    <div class="col p-3 d-none" id="attedence_report_page">

<h1>
    Attedence Report
</h1>
<div  id="after_check_out">
<div class="card">      
<div class="card-body">

             <div class="col-sm-6">
                <label for="">Date</label><br>
             <input type="date" id="date" name="date">
             </div>
                </div>
<div class="card">      
<div class="card-body">

             <div class="col-sm-6">
              <h6>Name   : {{ auth()->user()->name }}</h6>
              <h6>Emp Id : {{ auth()->user()->id }}</h6>
             </div>
                </div>
            </div>
</div>
<table id="attedence_table"class="table">
    <thead>
      <tr>
        <th>SI.No</th>
        <th>Date</th>
        <th>Employee ID</th>
        <th>Name</th>
        <th>Check In Time</th>
        <th>Check Out Time</th>
        <th>Break Hours</th>
        <th>Logged Hours</th>
      </tr>
    </thead>
    <tbody>
    
    </tbody>
  </table>

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




