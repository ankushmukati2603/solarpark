 <script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
 <script src="{{ URL::asset('public/js/jquery-ui.min.js') }}"></script>
 <!-- <script src="{{ URL::asset('public/js/jquery.validate.min.js') }}"></script> 
 <script src="{{ URL::asset('public/js/base_forms_validation.js') }}"></script>
 <script src="{{ URL::asset('public/js/password-validation.js') }}"></script>
<script src="{{ URL::asset('public/js/dataTables.bootstrap.min.js') }}"></script>
-->
 <script src="{{ URL::asset('public/js/icheck.min.js') }}"></script>

 <script src="{{ URL::asset('public/js/bootstrap.min.js') }}"></script>
 <script src="{{ URL::asset('public/js/Chart.min.js') }}"></script>
 <script src="{{ URL::asset('public/js/bootstrap-datepicker.min.js') }}"></script>
 <script src="{{ URL::asset('public/js/bootstrap3-wysihtml5.all.min.js') }}"></script>
 <script src="{{ URL::asset('public/js/adminlte.min.js') }}"></script>




 <script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
 <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
 <script src="{{ URL::asset('public/js/select2.full.min.js') }}"></script>
 <script src="{{ URL::asset('public/js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ URL::asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.2/dist/Chart.min.js"></script> -->

 <script src="{{ URL::asset('public/assets/js/main.js') }}"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

 <script>
window.onscroll = function() {
    myFunction()
};

var navbar = document.getElementById("stick_nav");
var sticky = navbar.offsetTop;

function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}

$(document).ready(function() {
    $('.customer-logos').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3
            }
        }, {
            breakpoint: 760,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 1
            }
        }]
    });
});
 </script>


 <script type="text/javascript">
var baseUrl = '{{URL::to("/")}}';
var validator = '';
@if(Session::has('msg'))
$('#msgModal').modal('show');
@endif
 </script>



 <script src="{{ URL::asset('public/js/common.js') }}"></script>
 <script>
function openPage(pageName, elmnt, color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
 </script>