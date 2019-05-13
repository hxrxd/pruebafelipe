<div class="row border-bottom">
    <nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="" class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message"><strong><?php echo  Auth::user()->fname." ".Auth::user()->lname; ?></strong></span>
            </li>
            <li>
              <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                  <i class="fa fa-bell" style="font-size:18px;"></i>  <span id="notify-counter" class="label label-warning animated bounceIn">1</span>
              </a>
              <ul id="notify-list" class="dropdown-menu dropdown-alerts animated bounceInRight" style="overflow-y:auto"></ul>
            </li>
            <li id="ipad-fix">
                <a href="{{ url('logout')}}">
                    <i class="fa fa-power-off close-session" style="font-size:18px;"></i>
                </a>
            </li>
        </ul>

    </nav>
</div>
<div id="popup" class="popup-notification animated bounceIn"></div>

<script>
  window.onload = function() {
      getNotificationsForUser("{{asset('notifications/'.Auth::user()->email)}}");
  }
</script>
