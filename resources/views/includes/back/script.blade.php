<!-- js placed at the end of the document so the pages load faster -->
<script src="{{asset('back/js/jquery.js')}}"></script>
<script src="{{asset('back/js/jquery-ui-1.9.2.custom.min.js')}}"></script>
<script src="{{asset('back/js/jquery-migrate-1.2.1.min.js')}}"></script>

<script src="{{asset('back/js/bootstrap.min.js')}}"></script>
<script class="include" type="text/javascript" src="{{asset('back/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('back/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('back/js/slidebars.min.js')}}"></script>
<script src="{{asset('back/js/jquery.nicescroll.js')}}" type="text/javascript"></script>
<script src="{{asset('back/js/advanced-datatable/media/js/jquery.dataTables.js')}}" type="text/javascript"></script>
<script src="{{asset('back/js/data-tables/DT_bootstrap.js')}}" ></script>

<script src="{{asset('back/js/respond.min.js')}}" ></script>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyAtqWsq5Ai3GYv6dSa6311tZiYKlbYT4mw" async="" defer="defer" type="text/javascript"></script>

<!--right slidebar-->
    <script src="{{asset('back/js/slidebars.min.js')}}"></script>

    <!--dynamic table initialization -->
    <script src="{{asset('back/js/dynamic_table_init.js')}}"></script>

<!--common script for all pages-->
<script src="{{asset('back/js/common-scripts.js')}}"></script>



<script type="text/javascript">
	
$(document).ready( function() {
	$('#dynamic-table').dataTable({
                        "bPaginate": true,
                        "bLengthChange": true,
                        "bFilter": true,
                        "bSort": true,
                        "bInfo": true,
                        "bAutoWidth": true,
                     "aoColumns": [
                                        null,
                                        null //put as many null values as your columns

                    ]
     });
	} );

	$(document).ready( function() {
  $('#dynamic-tabl').dataTable( {
    "aoColumnDefs": [
      { "bVisible": false, "aTargets": [ 0 ] }
    ] } );
} );
 
 
// Using aoColumns
$(document).ready( function() {
  $('#dynamic-tabl').dataTable( {
    "aoColumns": [
      { "bVisible": false },
      null,
      null,
      null,
      null
    ] } );
} );
</script>

 

   

